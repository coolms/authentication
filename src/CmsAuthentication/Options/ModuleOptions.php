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

use Zend\Stdlib\AbstractOptions,
    CmsCommon\Form\CommonOptionsTrait;

class ModuleOptions extends AbstractOptions implements
    AuthenticationOptionsInterface,
    FormOptionsInterface,
    ControllerOptionsInterface,
    InputFilterOptionsInterface,
    ModuleOptionsInterface
{
    use CommonOptionsTrait;

    /**
     * Turn off strict options mode
     *
     * @var bool
     */
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $identityField = 'identity';

    /**
     * @var string
     */
    protected $credentialField = 'credential';

    /**
     * @var int
     */
    protected $rememberMeTimeout = 86400;

    /**
     * @var string
     */
    protected $loginRoute = 'cms-authentication/login';

    /**
     * @var string
     */
    protected $loginRedirectRoute = 'cms-authentication';

    /**
     * @var bool
     */
    protected $useRedirectParameter = true;

    /**
     * @var string
     */
    protected $redirectKey = 'redirect';

    /**
     * @var string
     */
    protected $logoutRedirectRoute = 'cms-authentication';

    /**
     * @var string
     */
    protected $registrationRoute;

    /**
     * @var string
     */
    protected $resetCredentialRoute;

    /**
     * @var array
     */
    protected $identityFieldLabel;

    /**
     * @var array
     */
    protected $credentialFieldLabel;

    /**
     * @var bool
     */
    protected $useRememberMeElement = true;

    /**
     * @var int
     */
    protected $minIdentityLength = 0;

    /**
     * @var int
     */
    protected $maxIdentityLength = 60;

    /**
     * @var string
     */
    protected $identityRegexPattern = '/^[a-z0-9\@\.\-\_]+$/ui';

    /**
     * @var int
     */
    protected $minCredentialLength = 0;

    /**
     * @var int
     */
    protected $maxCredentialLength = 255;

    /**
     * @var string
     */
    protected $authenticationService = 'Zend\\Authentication\\AuthenticationServiceInterface';

    /**
     * @var array
     */
    protected $authenticationAdapters = [];


    /** @see \CmsAuthentication\Options\AuthenticationOptionsInterface */

    /**
     * {@inheritDoc}
     */
    public function setIdentityField($field)
    {
        $this->identityField = (string) $field;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityField()
    {
        return $this->identityField;
    }

    /**
     * {@inheritDoc}
     */
    public function setCredentialField($field)
    {
        $this->credentialField = (string) $field;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCredentialField()
    {
        return $this->credentialField;
    }

    /**
     * {@inheritDoc}
     */
    public function setRememberMeTimeout($ttl)
    {
        $this->rememberMeTimeout = (int) $ttl;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRememberMeTimeout()
    {
        return $this->rememberMeTimeout;
    }

    /** @see \CmsAuthentication\Options\ControllerOptionsInterface */

    /**
     * {@inheritDoc}
     */
    public function setLoginRoute($route)
    {
        $this->loginRoute = $route;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLoginRoute()
    {
        return $this->loginRoute;
    }

    /**
     * {@inheritDoc}
     */
    public function setLoginRedirectRoute($route)
    {
        $this->loginRedirectRoute = $route;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLoginRedirectRoute()
    {
        return $this->loginRedirectRoute;
    }

    /**
     * {@inheritDoc}
     */
    public function setUseRedirectParameter($flag)
    {
        $this->useRedirectParameter = (bool) $flag;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUseRedirectParameter()
    {
        return $this->useRedirectParameter;
    }

    /**
     * {@inheritDoc}
     */
    public function setRedirectKey($key)
    {
        $this->redirectKey = (string) $key;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRedirectKey()
    {
        return $this->redirectKey;
    }

    /**
     * {@inheritDoc}
     */
    public function setLogoutRedirectRoute($route)
    {
        $this->logoutRedirectRoute = $route;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLogoutRedirectRoute()
    {
        return $this->logoutRedirectRoute;
    }

    /**
     * {@inheritDoc}
     */
    public function setRegistrationRoute($route)
    {
        $this->registrationRoute = $route;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRegistrationRoute()
    {
        return $this->registrationRoute;
    }

    /**
     * {@inheritDoc}
     */
    public function setResetCredentialRoute($route)
    {
        $this->resetCredentialRoute = $route;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getResetCredentialRoute()
    {
        return $this->resetCredentialRoute;
    }

    /** @see \CmsAuthentication\Options\FormOptionsInterface */

    /**
     * {@inheritDoc}
     */
    public function setIdentityFieldLabel($label)
    {
        $this->identityFieldLabel = $label;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityFieldLabel()
    {
        return $this->identityFieldLabel;
    }

    /**
     * @param string $label
     * @return self
     */
    public function setCredentialFieldLabel($label)
    {
        $this->credentialFieldLabel = $label;

        return $this;
    }

    /**
     * @return string
    */
    public function getCredentialFieldLabel()
    {
        return $this->credentialFieldLabel;
    }

    /**
     * {@inheritDoc}
     */
    public function setUseRememberMeElement($flag)
    {
        $this->useRememberMeElement = (bool) $flag;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUseRememberMeElement()
    {
        return $this->useRememberMeElement;
    }

    /** @see \CmsAuthentication\Options\InputFilterOptionsInterface */

    /**
     * {@inheritDoc}
     */
    public function setMinIdentityLength($length)
    {
        $this->minIdentityLength = (int) $length;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMinIdentityLength()
    {
        return $this->minIdentityLength;
    }

    /**
     * {@inheritDoc}
     */
    public function setMaxIdentityLength($length)
    {
        $this->maxIdentityLength = (int) $length;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMaxIdentityLength()
    {
        return $this->maxIdentityLength;
    }

    /**
     * {@inheritDoc}
     */
    public function setIdentityRegexPattern($pattern)
    {
        $this->identityRegexPattern = (string) $pattern;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityRegexPattern()
    {
        return $this->identityRegexPattern;
    }

    /**
     * {@inheritDoc}
     */
    public function setMinCredentialLength($length)
    {
        $this->minCredentialLength = (int) $length;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMinCredentialLength()
    {
        return $this->minCredentialLength;
    }

    /**
     * {@inheritDoc}
     */
    public function setMaxCredentialLength($length)
    {
        $this->maxCredentialLength = (int) $length;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMaxCredentialLength()
    {
        return $this->maxCredentialLength;
    }

    /** @see \CmsAuthentication\Options\ModuleOptionsInterface */

    /**
     * {@inheritDoc}
     */
    public function setAuthenticationService($service)
    {
        $this->authenticationService = (string) $service;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthenticationService()
    {
        return $this->authenticationService;
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthenticationAdapters($adapters)
    {
        $this->authenticationAdapters = (array) $adapters;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthenticationAdapters()
    {
        return $this->authenticationAdapters;
    }
}
