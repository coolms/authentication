<?php 
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Controller;

use Zend\Form\FormInterface,
    Zend\Http\PhpEnvironment\Response,
    Zend\Mvc\Controller\AbstractActionController,
    Zend\Stdlib\Parameters,
    Zend\View\Model\ViewModel,
    CmsAuthentication\Form\LoginInterface,
    CmsAuthentication\Options\ControllerOptionsInterface;

/**
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class AuthenticationController extends AbstractActionController
{
    /**
     * @var ControllerOptionsInterface
     */
    protected $options;

    /**
     * @var FormInterface
     */
    protected $loginForm;

    /**
     * @var string
     */
    protected $authenticationNamespace = 'cms-authentication';

    /**
     * @var string
     */
    protected $forwardingController;

    /**
     * __construct
     *
     * @param ControllerOptionsInterface $options
     * @param FormInterface $form
     */
    public function __construct(ControllerOptionsInterface $options, FormInterface $form)
    {
        $this->options = $options;
        $this->loginForm = $form;
    }

    /**
     * {@inheritDoc}
     */
    public function indexAction()
    {
        $authPlugin = $this->cmsAuthentication();
        if ($authPlugin->hasIdentity()) {
            return $this->redirect()->toRoute($this->options->getLoginRedirectRoute());
        }

        return $this->redirect()->toRoute(null, ['action' => 'login']);
    }

    /**
     * Log in action
     *
     * The method uses cmsUserAuthentication controller plugin to authenticate the input data
     *
     * @return Response|ViewModel
     */
    public function loginAction()
    {
        $authPlugin = $this->cmsAuthentication();

        $redirectKey = $this->options->getRedirectKey();
        $redirect = $this->options->getUseRedirectParameter()
            ? $this->params()->fromQuery($redirectKey, false)
            : false;

        $url = $this->url()->fromRoute(
            null,
            [],
            $redirect ? ['query' => [$redirectKey => $redirect]] : []
        );

        $prg = $this->prg($url, true);
        // Return early if prg plugin returned a response
        if ($prg instanceof Response) {
            return $prg;
        }

        $post = $prg;

        $form = $this->loginForm;
        $fm   = $this->flashMessenger();
        $namespace = $form->getName();

        $fm->setNamespace($namespace . '-' . $fm::NAMESPACE_ERROR);
        if ($this->forwardingController && $fm->hasCurrentMessages()) {
            foreach($fm->getCurrentMessages() as $messages) {
                $form->setMessages($messages);
            }
            $fm->clearCurrentMessages();
        } elseif ($fm->hasMessages()) {
            foreach($fm->getMessages() as $messages) {
                $form->setMessages($messages);
            }
        }

        $fm->setNamespace($namespace);

        $form->setAttribute('action', $this->url()->fromRoute());
        if ($redirect) {
            $form->get($redirectKey)->setValue($redirect);
        }

        if ($post && $form->setData($post)->isValid()) {

            // clear adapters
            $this->cmsAuthentication()->getAuthenticationAdapter()->resetAdapters();
            $this->cmsAuthentication()->getAuthenticationService()->clearIdentity();

            $routeMatch = $this->getEvent()->getRouteMatch();
            $this->getRequest()->setPost(new Parameters($post));
            $this->options->setLoginRoute($routeMatch->getMatchedRouteName());
            $this->forwardingController = $routeMatch->getParam('controller');

            return $this->forward()->dispatch(
                $this->forwardingController,
                ['action' => 'authenticate']
            );
        }

        $this->forwardingController = null;

        $registrationRoute    = $this->options->getRegistrationRoute();
        $resetCredentialRoute = $this->options->getResetCredentialRoute();

        return new ViewModel(compact('form', 'registrationRoute', 'resetCredentialRoute'));
    }

    /**
     * Logout and clear the identity
     *
     * The method destroys session for a logged user
     *
     * @return Response
     */
    public function logoutAction()
    {
        $this->flashMessenger()->setNamespace($this->authenticationNamespace)->clearCurrentMessages();
        $this->cmsAuthentication()->logout();

        if ($redirect = $this->getRedirectParameter()) {
            return $this->redirect()->toUrl($redirect);
        }

        $redirect = $this->params()->fromRoute('redirect', $this->options->getLogoutRedirectRoute());

        return $this->redirect()->toRoute($redirect);
    }

    /**
     * General-purpose authentication action
     */
    public function authenticateAction()
    {
        if ($this->cmsAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->options->getLoginRedirectRoute());
        }

        $result = $this->cmsAuthentication()->authenticate();

        // Return early if $result is a response
        if ($result instanceof Response) {
            return $result;
        }

        $redirect = $this->getRedirectParameter();

        if (!$result->isValid()) {
            if ($this->forwardingController) {
                return $this->forward()->dispatch(
                    $this->forwardingController,
                    ['action' => 'login']
                );
            }

            $url = $this->url()->fromRoute(
                $this->options->getLoginRoute(),
                [],
                $redirect ? ['query' => [$this->options->getRedirectKey() => $redirect]] : []
            );

            return $this->redirect()->toUrl($url);
        }

        if ($redirect) {
            return $this->redirect()->toUrl($redirect);
        }

        $route = $this->options->getLoginRedirectRoute();
        if (is_callable($route)) {
            $route = $route($this->cmsAuthentication()->getIdentity());
        }

        return $this->redirect()->toRoute($route);
    }

    /**
     * @return string|bool
     */
    protected function getRedirectParameter()
    {
        if ($this->options->getUseRedirectParameter()) {
            $redirectKey = $this->options->getRedirectKey();
            $redirect    = $this->params()->fromPost(
                $redirectKey,
                $this->params()->fromQuery($redirectKey, false)
            );
        } else {
            $redirect = false;
        }

        return $redirect;
    }
}
