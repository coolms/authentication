<?php 
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\View\Helper;

use Zend\Authentication\AuthenticationServiceInterface,
    Zend\View\Helper\AbstractHelper,
    CmsAuthentication\Service\AuthenticationServiceAwareInterface,
    CmsAuthentication\Service\AuthenticationServiceAwareTrait;

class Identity extends AbstractHelper implements AuthenticationServiceAwareInterface
{
    use AuthenticationServiceAwareTrait;

    /**
     * __construct
     *
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->setAuthenticationService($authenticationService);
    }

    /**
     * __invoke
     *
     * @access public
     * @return object|void
     */
    public function __invoke()
    {
        if ($this->getAuthenticationService()->hasIdentity()) {
            return $this->getAuthenticationService()->getIdentity();
        }
    }
}
