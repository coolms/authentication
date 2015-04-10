<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Form;

use Zend\Form\FormInterface,
    Zend\Form\ElementInterface;

interface LoginInterface extends FormInterface
{
    /**
     * Get identity element
     *
     * @return ElementInterface
     */
    public function getIdentityElement();

    /**
     * Get credential element
     *
     * @return ElementInterface
     */
    public function getCredentialElement();
}
