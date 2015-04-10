<?php 
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Controller\Plugin;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\AuthenticationServiceInterface,
    Zend\Authentication\Result,
    Zend\Mvc\Controller\Plugin\AbstractPlugin,
    Zend\Stdlib\ResponseInterface,
    Zend\Stdlib\RequestInterface,
    CmsAuthentication\Service\AuthenticationServiceAwareInterface,
    CmsAuthentication\Service\AuthenticationServiceAwareTrait;

class Authentication extends AbstractPlugin implements AuthenticationServiceAwareInterface
{
    use AuthenticationServiceAwareTrait;

    /**
     * @var AuthenticationAdapter
     */
    protected $authenticationAdapter;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * __construct
     */
    public function __construct(AuthenticationServiceInterface $service)
    {
        $this->setAuthenticationService($service);
    }

    /**
     * Set request to be authenticated
     *
     * @param RequestInterface $request
     * @return self
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Get request to be authenticated
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        if (null === $this->request) {
            $this->setRequest($this->getController()->getRequest());
        }

        return $this->request;
    }

    /**
     * Authenticate action
     *
     * @return ResponseInterface|Result
     */
    public function authenticate()
    {
        $request = $this->getRequest();
        $adapter = $this->getAuthenticationAdapter();
        $result  = $adapter->setRequest($request);

        if ($result instanceof ResponseInterface) {
            return $result;
        }

        $result = $this->getAuthenticationService()->authenticate($adapter);
        $messages = $result->getMessages();
        if (!$messages) {
            return $result;
        }

        $controller = $this->getController();
        /* @var $flash \Zend\Mvc\Controller\Plugin\FlashMessenger */
        $flash = $controller->flashMessenger();
        $namespace = $flash->getNamespace();

        switch ($result->getCode()) {
            case Result::SUCCESS:
                $flash->setNamespace($namespace . '-' . $flash::NAMESPACE_SUCCESS);
                foreach ($messages as $message) {
                    $flash->addMessage($controller->translate($message));
                }
                break;
            case Result::FAILURE_UNCATEGORIZED:
                $flash->setNamespace($namespace . '-' . $flash::NAMESPACE_ERROR);
                foreach ($messages as $message) {
                    $flash->addMessage($controller->translate($message));
                }
                break;
            case Result::FAILURE_IDENTITY_NOT_FOUND:
                $flash->setNamespace($namespace . '-' . $flash::NAMESPACE_ERROR);
                $identityKey = $adapter->getEvent()->getIdentityKey();
                foreach ($messages as $message) {
                    $errors[$identityKey][] = $controller->translate($message);
                }
                $flash->addMessage($errors);
                break;
            case Result::FAILURE_CREDENTIAL_INVALID:
                $flash->setNamespace($namespace . '-' . $flash::NAMESPACE_ERROR);
                $credentialKey = $adapter->getEvent()->getCredentialKey();
                foreach ($messages as $message) {
                    $errors[$credentialKey][] = $controller->translate($message);
                }
                $flash->addMessage($errors);
        }

        $flash->setNamespace($namespace);

        if (!$result->isValid()) {
            $adapter->resetAdapters();
        }

        return $result;
    }

    /**
     * Logout action
     *
     * @return void
     */
    public function logout()
    {
        $this->getAuthenticationAdapter()->resetAdapters();
        $this->getAuthenticationAdapter()->logoutAdapters();
        $this->getAuthenticationService()->clearIdentity();
    }

    /**
     * Proxy convenience method
     *
     * @return bool
     */
    public function hasIdentity()
    {
        return $this->getAuthenticationService()->hasIdentity();
    }

    /**
     * Proxy convenience method
     *
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->getAuthenticationService()->getIdentity();
    }

    /**
     * Get authentication adapter
     *
     * @return AdapterInterface
     */
    public function getAuthenticationAdapter()
    {
        if (null === $this->authenticationAdapter) {
            $authenticationAdapter = $this->getAuthenticationService()->getAdapter();
            $this->setAuthenticationAdapter($authenticationAdapter);
        }

        return $this->authenticationAdapter;
    }

    /**
     * Set authentication adapter
     *
     * @param AdapterInterface $authenticationAdapter
     * @return self
     */
    public function setAuthenticationAdapter(AdapterInterface $authenticationAdapter)
    {
        $this->authenticationAdapter = $authenticationAdapter;
        return $this;
    }
}
