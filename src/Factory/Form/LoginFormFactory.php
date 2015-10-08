<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Form;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Form\Login,
    CmsAuthentication\Options\FormOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class LoginFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Login
     */
    public function createService(ServiceLocatorInterface $elements)
    {
        $services = $elements->getServiceLocator();
        /* @var $options FormOptionsInterface */
        $options = $services->get(ModuleOptions::class);

        $creationOptions = $options->toArray();
        $creationOptions['label'] = 'Sign in';

        // Use submit button by default
        if (!isset($creationOptions['use_submit_element'])) {
            $creationOptions['use_submit_element'] = true;
        }

        return new Login('login-form', $creationOptions);
    }
}
