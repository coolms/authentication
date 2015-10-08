<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Mvc\Controller;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Form\Login,
    CmsAuthentication\Mvc\Controller\AuthenticationController,
    CmsAuthentication\Options\ModuleOptions;

class AuthenticationControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return AuthenticationController
     */
    public function createService(ServiceLocatorInterface $controllers)
    {
        $parentLocator = $controllers->getServiceLocator();

        return new AuthenticationController(
            $parentLocator->get(ModuleOptions::class),
            $parentLocator->get('FormElementManager')->get(Login::class)
        );
    }
}
