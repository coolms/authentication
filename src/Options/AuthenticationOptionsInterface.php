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

interface AuthenticationOptionsInterface
{
    /**
     * Sets identity field
     *
     * @param string $field
     * @return self
     */
    public function setIdentityField($field);

    /**
     * Retrieves identity field
     *
     * @return string
     */
    public function getIdentityField();

    /**
     * Sets credential field
     *
     * @param string $field
     * @return self
     */
    public function setCredentialField($field);

    /**
     * Retrieves credential field
     *
     * @return string
     */
    public function getCredentialField();

    /**
     * Set remember me ttl in seconds.
     *
     * @param int $ttl
     * @return self
     */
    public function setRememberMeTimeout($ttl);

    /**
     * Get remember me ttl in seconds.
     *
     * @return int
    */
    public function getRememberMeTimeout();
}
