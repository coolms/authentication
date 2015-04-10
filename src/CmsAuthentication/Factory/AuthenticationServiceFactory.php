<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory;

use Zend\Authentication\AuthenticationService,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $adapter \CmsAuthentication\Adapter\AdapterChain */
        $adapter = $serviceLocator->get('CmsAuthentication\\Adapter\\AdapterChain');

        /* @var $options \CmsAuthentication\Options\AuthenticationOptionsInterface */
        $options = $serviceLocator->get('CmsAuthentication\\Options\\ModuleOptions');

        $adapter->getEvent()
                ->setIdentityKey($options->getIdentityField())
                ->setCredentialKey($options->getCredentialField())
                ->setRememberMeTimeout($options->getRememberMeTimeout());

        return new AuthenticationService(
            $serviceLocator->has('Zend\\Authentication\\Storage\\StorageInterface')
                ? $serviceLocator->get('Zend\\Authentication\\Storage\\StorageInterface')
                : null,
            $adapter
        );
    }
}
