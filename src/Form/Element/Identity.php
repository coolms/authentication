<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Form\Element;

use Zend\Form\Element\Text,
    Zend\InputFilter\InputProviderInterface;

class Identity extends Text implements InputProviderInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'text',
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
                ['name' => 'CmsAuthenticationIdentity'],
            ],
        ];

        return $inputSpec;
    }
}
