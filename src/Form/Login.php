<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Form;

use Zend\Form\ElementInterface,
    CmsCommon\Form\Form;

class Login extends Form
{
    /**
     * @var ElementInterface
     */
    protected $identityElement;

    /**
     * @var ElementInterface
     */
    protected $credentialElement;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->identityElement = $this->getFormFactory()
            ->getFormElementManager()->get('CmsAuthenticationIdentity');
        $this->add(
            $this->identityElement,
            ['priority' => 40]
        );

        $this->credentialElement = $this->getFormFactory()
            ->getFormElementManager()->get('CmsAuthenticationCredential');
        $this->add(
            $this->credentialElement,
            ['priority' => 30]
        );

        if ($this->getOption('use_remember_me_element')) {
            $this->add(
                [
                    'name' => 'rememberme',
                    'type' => 'Checkbox',
                    'options' => [
                        'label' => 'Remember me?',
                    ],
                    'filters'   => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' => [
                        [
                            'name' => 'InArray',
                            'options' => [
                                'haystack' => ['0', '1'],
                            ],
                        ],
                    ],
                ],
                ['priority' => 20]
            );
        }

        $this->add(['name' => 'redirect', 'type' => 'Hidden'], ['priority' => 10]);

        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this);
    }

    /**
     * {@inheritDoc}
     */
    public function has($elementOrFieldset)
    {
        if (parent::has($elementOrFieldset)) {
            return true;
        }

        if ($elementOrFieldset === 'identity' && $this->identityElement) {
            $elementOrFieldset = $this->identityElement->getName();
        } elseif ($elementOrFieldset === 'credential' && $this->credentialElement) {
            $elementOrFieldset = $this->credentialElement->getName();
        } else {
            return false;
        }

        return parent::has($elementOrFieldset);
    }

    /**
     * {@inheritDoc}
     */
    public function get($elementOrFieldset)
    {
        if (!parent::has($elementOrFieldset)) {
            if ($elementOrFieldset === 'identity' && $this->identityElement) {
                $elementOrFieldset = $this->identityElement->getName();
            } elseif ($elementOrFieldset === 'csrf' && $this->credentialElement) {
                $elementOrFieldset = $this->credentialElement->getName();
            }
        }

        return parent::get($elementOrFieldset);
    }

    /**
     * {@inheritDoc}
     */
    public function remove($elementOrFieldset)
    {
        if (!parent::has($elementOrFieldset)) {
            if ($elementOrFieldset === 'identity' && $this->identityElement) {
                $elementOrFieldset = $this->identityElement->getName();
            } elseif ($elementOrFieldset === 'credential' && $this->credentialElement) {
                $elementOrFieldset = $this->credentialElement->getName();
            }
        }

        return parent::remove($elementOrFieldset);
    }
}
