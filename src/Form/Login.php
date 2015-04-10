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

use CmsCommon\Form\Form;

class Login extends Form implements LoginInterface
{
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->getEventManager()->trigger(__METHOD__, $this);

        $this->add(
            [
                'type' => 'CmsAuthenticationIdentity',
                'attributes' => [
                    'required' => true,
                ],
            ],
            ['priority' => 40]
        );

        $this->add(
            [
                'type' => 'CmsAuthenticationCredential',
                'attributes' => [
                    'required' => true,
                ],
            ],
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

        parent::init();

        $this->getEventManager()->trigger(__METHOD__ . '.post', $this);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentityElement()
    {
        $field = $this->getOption('identity_field') ?: 'identity';
        if ($this->has($field)) {
            return $this->get($field);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getCredentialElement()
    {
        $field = $this->getOption('credential_field') ?: 'credential';
        if ($this->has($field)) {
            return $this->get($field);
        }
    }
}
