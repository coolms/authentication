<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\StorageInterface,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Adapter\AdapterChain,
    CmsAuthentication\Options\AuthenticationOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $adapter AdapterChain */
        $adapter = $serviceLocator->get(AdapterChain::class);

        /* @var $options AuthenticationOptionsInterface */
        $options = $serviceLocator->get(ModuleOptions::class);

        $adapter->getEvent()
                ->setIdentityKey($options->getIdentityField())
                ->setCredentialKey($options->getCredentialField())
                ->setRememberMeTimeout($options->getRememberMeTimeout());

        return new AuthenticationService(
            $serviceLocator->has(StorageInterface::class)
                ? $serviceLocator->get(StorageInterface::class)
                : null,
            $adapter
        );
    }
}
