<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication;

return [
    'controller_plugins' => [
        'aliases' => [
            'cmsAuthentication' => 'CmsAuthentication\Controller\Plugin\Authentication',
        ],
        'factories' => [
            'CmsAuthentication\Controller\Plugin\Authentication'
                => 'CmsAuthentication\Factory\Controller\Plugin\AuthenticationPluginFactory',
        ],
    ],
    'controllers' => [
        'factories' => [
            'CmsAuthentication\Controller\Authentication'
                => 'CmsAuthentication\Factory\Controller\AuthenticationControllerFactory',
        ],
    ],
    'form_elements' => [
        'factories' => [
            'CmsAuthentication\Form\Login'  => 'CmsAuthentication\Factory\Form\LoginFormFactory',
            'CmsAuthenticationCredential'   => 'CmsAuthentication\Factory\Form\Element\CredentialElementFactory',
            'CmsAuthenticationIdentity'     => 'CmsAuthentication\Factory\Form\Element\IdentityElementFactory',
        ],
    ],
    'input_filters' => [
        'factories' => [
            'CmsAuthentication\InputFilter\Login'  => 'CmsAuthentication\Factory\InputFilter\LoginInputFilterFactory',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'CmsAuthentication\Adapter\AdapterChain'    => 'CmsAuthentication\Factory\AdapterChainFactory',
            'Zend\Authentication\AuthenticationServiceInterface'
                => 'CmsAuthentication\Factory\AuthenticationServiceFactory',
            'CmsAuthentication\Options\ModuleOptions'   => 'CmsAuthentication\Factory\ModuleOptionsFactory',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type'          => 'gettext',
                'base_dir'      => __DIR__ . '/../language',
                'pattern'       => '%s.mo',
                'text_domain'   => __NAMESPACE__,
            ],
        ],
    ],
    'validators' => [
        'factories' => [
            'CmsAuthenticationCredential'   => 'CmsAuthentication\Factory\Validator\CredentialValidatorFactory',
            'CmsAuthenticationIdentity'     => 'CmsAuthentication\Factory\Validator\IdentityValidatorFactory',
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'cmsIdentity' => 'CmsAuthentication\View\Helper\Identity',
        ],
        'factories' => [
            'CmsAuthentication\View\Helper\Identity' => 'CmsAuthentication\Factory\View\Helper\IdentityHelperFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'CmsAuthentication' => __DIR__ . '/../view',
        ],
    ],
];
