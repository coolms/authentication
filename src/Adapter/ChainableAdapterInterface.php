<?php 
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Adapter;

interface ChainableAdapterInterface
{
    /**
     * @param AdapterChainEvent $e
     */
    public function authenticate(AdapterChainEvent $e);

    /**
     * @param AdapterChainEvent $e
     */
    public function logout(AdapterChainEvent $e);
}
