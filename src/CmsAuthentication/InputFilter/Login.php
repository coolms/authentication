<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\InputFilter;

use CmsCommon\InputFilter\InputFilter,
    CmsAuthentication\Options\InputFilterOptionsInterface;

/**
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class Login extends InputFilter
{
    /**
     * @var InputFilterOptionsInterface
     */
    protected $options;

    /**
     * __construct
     *
     * @param InputFilterOptionsInterface $options
     */
    public function __construct(InputFilterOptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->getEventManager()->trigger(__METHOD__, $this);

        $this->add(
            [
                'name'          => $this->options->getIdentityField() ?: 'identity',
                'required'      => true,
                'filters'       => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators'    => [
                    ['name' => 'CmsAuthenticationIdentity'],
                ],
            ]
        );

        $this->add(
            [
                'name'          => $this->options->getCredentialField() ?: 'credential',
                'required'      => true,
                'filters'       => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators'    => [
                    ['name' => 'CmsAuthenticationCredential'],
                ],
            ]
        );

        $this->add(
            [
                'name'          => 'rememberme',
                'required'      => false,
                'allow_empty'   => true,
                'filters'       => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators'    => [
                    [
                        'name' => 'InArray',
                        'options' => [
                            'haystack' => [0, 1],
                        ],
                    ],
                ],
            ]
        );

        $this->getEventManager()->trigger(__METHOD__ . '.post', $this);
    }
}
