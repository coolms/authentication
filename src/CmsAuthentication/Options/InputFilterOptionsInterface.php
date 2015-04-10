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

interface InputFilterOptionsInterface extends AuthenticationOptionsInterface
{
    /**
     * Set minimum identity length.
     *
     * @param int $length
     * @return self
     */
    public function setMinIdentityLength($length);

    /**
     * Get minimum identity length.
     *
     * @return int
     */
    public function getMinIdentityLength();

    /**
     * Set maximum identity length.
     *
     * @param int $length
     * @return self
     */
    public function setMaxIdentityLength($length);

    /**
     * Get maximum identity length.
     *
     * @return int
     */
    public function getMaxIdentityLength();

    /**
     * Set identity regex pattern.
     *
     * @param string $pattern
     * @return self
     */
    public function setIdentityRegexPattern($pattern);

    /**
     * Get identity regex pattern.
     *
     * @return string
     */
    public function getIdentityRegexPattern();

    /**
     * Set minimum credential length.
     *
     * @param int $length
     * @return self
     */
    public function setMinCredentialLength($length);

    /**
     * Get minimum credential length.
     *
     * @return int
     */
    public function getMinCredentialLength();

    /**
     * Set maximum credential length.
     *
     * @param int $length
     * @return self
     */
    public function setMaxCredentialLength($length);

    /**
     * Get maximum credential length.
     *
     * @return int
     */
    public function getMaxCredentialLength();
}
