<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\InputFilter;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\InputFilter\Login,
    CmsAuthentication\Options\InputFilterOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class LoginInputFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Login
     */
    public function createService(ServiceLocatorInterface $elements)
    {
        $parentLocator = $elements->getServiceLocator();

        /* @var $options InputFilterOptionsInterface */
        $options = $parentLocator->get(ModuleOptions::class);

        return new Login($options);
    }
}
