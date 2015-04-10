<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Service;

use Zend\Authentication\AuthenticationServiceInterface;

interface AuthenticationServiceAwareInterface
{
    /**
     * @return AuthenticationServiceInterface
     */
    public function getAuthenticationService();

    /**
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function setAuthenticationService(AuthenticationServiceInterface $authenticationService);
}