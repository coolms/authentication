<?php 
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\View\Model\ViewModel,
    CmsAuthentication\Form\Login;

class LoginWidget extends AbstractHelper
{
    /**
     * Login form
     *
     * @var Login
     */
    protected $form;

    /**
     * Template used for view
     *
     * @var string 
     */
    protected $viewTemplate;

    /**
     * @var mixed
     */
    protected $options;

    /**
     * __construct
     *
     * @param mixed $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * __invoke
     *
     * @access public
     * @param array $options array of options
     * @return string|ViewModel
     */
    public function __invoke($options = [])
    {
        if (array_key_exists('render', $options)) {
            $render = $options['render'];
        } else {
            $render = true;
        }

        if (array_key_exists('redirect', $options)) {
            $redirect = $options['redirect'];
        } else {
            $redirect = false;
        }

        $vm = new ViewModel([
            'form'      => $this->getForm(),
            'redirect'  => $redirect,
        ]);

        $vm->setTemplate($this->viewTemplate);

        if ($render) {
            return $this->getView()->render($vm);
        } else {
            return $vm;
        }
    }

    /**
     * Inject Login form
     *
     * @param Login $form
     * @return self
     */
    public function setForm(Login $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * Retrieve Login form
     *
     * @return Login
     */
    public function getForm()
    {
        if (null === $this->form) {
            $this->setForm($this->getUserService()->getLoginForm());
        }

        return $this->form;
    }

    /**
     * @param string $viewTemplate
     * @return self
     */
    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;
        return $this;
    }

    /**
     * @return string
     */
    public function getViewTemplate()
    {
        if (null === $this->viewTemplate) {
            $this->setViewTemplate($this->options->getUserLoginWidgetViewTemplate());
        }

        return $this->viewTemplate;
    }
}
