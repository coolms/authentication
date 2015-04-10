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

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Adapter\AdapterChain;

class AdapterChainFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $options \CmsAuthentication\Options\ModuleOptionsInterface */
        $options = $serviceLocator->get('CmsAuthentication\\Options\\ModuleOptions');

        $chain = new AdapterChain;
        $eventManager = $chain->getEventManager();

        // iterate and attach multiple adapters and events if offered
        foreach ($options->getAuthenticationAdapters() as $priority => $adapterName) {
            $adapter = $serviceLocator->get($adapterName);
            if (is_callable(array($adapter, 'authenticate'))) {
                $eventManager->attach('authenticate', [$adapter, 'authenticate'], $priority);
            }
            if (is_callable(array($adapter, 'logout'))) {
                $eventManager->attach('logout', [$adapter, 'logout'], $priority);
            }
        }

        return $chain;
    }
}
