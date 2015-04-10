<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\View\Helper\Identity;

class IdentityHelperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $plugins)
    {
        $parentLocator = $plugins->getServiceLocator();

        /* @var $options \CmsAuthentication\Options\ModuleOptionsInterface */
        $options = $parentLocator->get('CmsAuthentication\\Options\\ModuleOptions');
        $authService = $parentLocator->get($options->getAuthenticationService());

        return new Identity($authService);
    }
}
