<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Event;

use Zend\EventManager\AbstractListenerAggregate,
    Zend\EventManager\EventManagerInterface,
    Zend\Http\Request as HttpRequest,
    Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    CmsCommon\Form\Options\FormOptionsInterface;

/**
 * Form captcha event listener
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class CaptchaListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH,       [$this, 'setUseCapture'], 100);
    	$this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'setUseCapture'], 100);
    }

    /**
     * Event callback to be triggered on dispatch
     *
     * @param MvcEvent $e
     * @return void
     */
    public function setUseCapture(MvcEvent $e)
    {
        if (!$e->getRequest() instanceof HttpRequest || !($options = $e->getParam('module-options'))) {
            return;
        }

        if ($options instanceof FormOptionsInterface && null === $options->getUseCaptcha()) {
            $authService = $e->getApplication()->getServiceManager()
                ->get('Zend\\Authentication\\AuthenticationServiceInterface');
            $options->setUseCaptcha(!$authService->hasIdentity());
        }
    }
}
