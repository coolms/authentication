<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\View\Helper\Identity,
    CmsAuthentication\Options\ModuleOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class IdentityHelperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Identity
     */
    public function createService(ServiceLocatorInterface $plugins)
    {
        $parentLocator = $plugins->getServiceLocator();

        /* @var $options ModuleOptionsInterface */
        $options = $parentLocator->get(ModuleOptions::class);
        $authService = $parentLocator->get($options->getAuthenticationService());

        return new Identity($authService);
    }
}
