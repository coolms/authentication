<?php 
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Options;

interface ControllerOptionsInterface
{
    /**
     * Set login route.
     *
     * @param string $route
     * @return self
     */
    public function setLoginRoute($route);

    /**
     * Get login route.
     * 
     * @return string
     */
    public function getLoginRoute();

    /**
     * Set login redirect route.
     *
     * @param string $route
     * @return self
     */
    public function setLoginRedirectRoute($route);

    /**
     * Get login redirect route.
     *
     * @return string
     */
    public function getLoginRedirectRoute();

    /**
     * Set use redirect param.
     *
     * @param bool $flag
     * @return self
     */
    public function setUseRedirectParameter($flag);

    /**
     * Get use redirect param.
     *
     * @return bool
     */
    public function getUseRedirectParameter();

    /**
     * Sets redirect key
     *
     * @param string $key
     * @return self
     */
    public function setRedirectKey($key);

    /**
     * Retrieves redirect key
     *
     * @return string
     */
    public function getRedirectKey();

    /**
     * Set logout route.
     *
     * @param string $route
     * @return self
     */
    public function setLogoutRoute($route);

    /**
     * Get logout route.
     *
     * @return string
     */
    public function getLogoutRoute();

    /**
     * Set logout redirect route.
     *
     * @param string $route
     * @return self
     */
    public function setLogoutRedirectRoute($route);

    /**
     * Get logout redirect route.
     * 
     * @return string
     */
    public function getLogoutRedirectRoute();

    /**
     * Set reset credential route.
     *
     * @param string $route
     * @return self
     */
    public function setResetCredentialRoute($route);

    /**
     * Get reset credential route.
     *
     * @return string
     */
    public function getResetCredentialRoute();

    /**
     * Set registration route
     *
     * @param string $route
     * @return self
     */
    public function setRegistrationRoute($route);

    /**
     * Get registration route
     *
     * @return string
     */
    public function getRegistrationRoute();
}
