<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Mvc\Controller\Plugin;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Mvc\Controller\Plugin\Authentication,
    CmsAuthentication\Options\ModuleOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class AuthenticationPluginFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Authentication
     */
    public function createService(ServiceLocatorInterface $plugins)
    {
        $parentLocator = $plugins->getServiceLocator();

        /* @var $options ModuleOptionsInterface */
        $options = $parentLocator->get(ModuleOptions::class);
        $authService = $parentLocator->get($options->getAuthenticationService());

        return new Authentication($authService);
    }
}
