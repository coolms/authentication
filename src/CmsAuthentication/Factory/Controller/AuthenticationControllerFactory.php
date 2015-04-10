<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Controller;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Controller\AuthenticationController;

class AuthenticationControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $controllers)
    {
        $parentLocator = $controllers->getServiceLocator();

        return new AuthenticationController(
            $parentLocator->get('CmsAuthentication\\Options\\ModuleOptions'),
            $parentLocator->get('FormElementManager')->get('CmsAuthentication\\Form\\Login')
        );
    }
}
