<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Form\Element;

use Zend\Form\Element\Password,
    Zend\InputFilter\InputProviderInterface;

class Credential extends Password implements InputProviderInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'password',
        'required' => true,
    ];

    /**
     * {@inheritDoc}
     */
    public function getInputSpecification()
    {
        $inputSpec = [
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                ['name' => 'CmsAuthenticationCredential'],
            ],
        ];

        return $inputSpec;
    }
}
