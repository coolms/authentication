<?php 
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Options;

interface ModuleOptionsInterface
{
    /**
     * Sets authentication service from config file
     *
     * @param string $service
     * @return self
     */
    public function setAuthenticationService($service);

    /**
     * Retrieves authentication service from config file
     *
     * @return string
     */
    public function getAuthenticationService();

    /**
     * Sets authentication adapters from config file
     *
     * @param array $adapters
     * @return self
     */
    public function setAuthenticationAdapters($adapters);

    /**
     * Retrieves authetication adapters from config file
     *
     * @return array
     */
    public function getAuthenticationAdapters();
}
