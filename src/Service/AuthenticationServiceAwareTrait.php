<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Service;

use Zend\Authentication\AuthenticationServiceInterface;

trait AuthenticationServiceAwareTrait
{
    /**
     * @var AuthenticationServiceInterface
     */
    protected $authenticationService;

    /**
     * Get authentication service
     *
     * @return AuthenticationServiceInterface
     */
    public function getAuthenticationService()
    {
        return $this->authenticationService;
    }

    /**
     * Set authentication service
     *
     * @param AuthenticationServiceInterface $authenticationService
     * @return self
     */
    public function setAuthenticationService(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;

        return $this;
    }
}
