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

use CmsCommon\Form\Options\FormOptionsInterface as CommonFormOptionsInterface;

interface FormOptionsInterface extends AuthenticationOptionsInterface, CommonFormOptionsInterface
{
    /**
     * @param string $label
     * @return self
     */
    public function setIdentityFieldLabel($label);

    /**
     * @return string
     */
    public function getIdentityFieldLabel();

    /**
     * @param string $label
     * @return self
     */
    public function setCredentialFieldLabel($label);

    /**
     * @return string
    */
    public function getCredentialFieldLabel();

    /**
     * @param bool $flag
     * @return self
     */
    public function setUseRememberMeElement($flag);

    /**
     * @return bool
     */
    public function getUseRememberMeElement();
}
