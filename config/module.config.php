<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication;

return [
    'cmspermissions' => [
        'acl' => [
            'guards' => [
                'CmsAcl\Guard\Route' => [
                    ['route' => 'cms-authentication', 'roles' => []],
                    ['route' => 'cms-authentication/login', 'roles' => ['guest']],
                    ['route' => 'cms-authentication/logout', 'roles' => ['user']],
                ],
            ],
        ],
    ],
    'controller_plugins' => [
        'aliases' => [
            'cmsAuthentication' => 'CmsAuthentication\Mvc\Controller\Plugin\Authentication',
        ],
        'factories' => [
            'CmsAuthentication\Mvc\Controller\Plugin\Authentication'
                => 'CmsAuthentication\Factory\Mvc\Controller\Plugin\AuthenticationPluginFactory',
        ],
    ],
    'controllers' => [
        'aliases' => [
            'CmsAuthentication\Controller\Authentication'
                => 'CmsAuthentication\Mvc\Controller\AuthenticationController',
        ],
        'factories' => [
            'CmsAuthentication\Mvc\Controller\AuthenticationController'
                => 'CmsAuthentication\Factory\Mvc\Controller\AuthenticationControllerFactory',
        ],
    ],
    'form_elements' => [
        'aliases' => [
            'CmsAuthenticationCredential' => 'CmsAuthentication\Form\Element\Credential',
            'CmsAuthenticationIdentity' => 'CmsAuthentication\Form\Element\Identity',
        ],
        'factories' => [
            'CmsAuthentication\Form\Login'
                => 'CmsAuthentication\Factory\Form\LoginFormFactory',
            'CmsAuthentication\Form\Element\Credential'
                => 'CmsAuthentication\Factory\Form\Element\CredentialElementFactory',
            'CmsAuthentication\Form\Element\Identity'
                => 'CmsAuthentication\Factory\Form\Element\IdentityElementFactory',
        ],
    ],
    'input_filters' => [
        'factories' => [
            'CmsAuthentication\InputFilter\Login'
                => 'CmsAuthentication\Factory\InputFilter\LoginInputFilterFactory',
        ],
    ],
    'listeners' => [
        'CmsAuthentication\Listener\CaptchaListener' => 'CmsAuthentication\Listener\CaptchaListener',
    ],
    'router' => [
        'routes' => [
            'cms-authentication' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/auth',
                    'defaults' => [
                        '__NAMESPACE__' => 'CmsAuthentication\Controller',
                        'controller' => 'Authentication',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'login' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/login',
                            'defaults' => [
                                'action' => 'login',
                            ],
                        ],
                    ],
                    'logout' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/logout',
                            'defaults' => [
                                'action' => 'logout',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'Zend\Authentication\AuthenticationServiceInterface'
                => 'Zend\Authentication\AuthenticationService',
            'CmsAuthentication\Options\ModuleOptionsInterface'
                => 'CmsAuthentication\Options\ModuleOptions',
        ],
        'factories' => [
            'Zend\Authentication\AuthenticationService'
                => 'CmsAuthentication\Factory\AuthenticationServiceFactory',
            'CmsAuthentication\Adapter\AdapterChain'
                => 'CmsAuthentication\Factory\AdapterChainFactory',
            'CmsAuthentication\Options\ModuleOptions'
                => 'CmsAuthentication\Factory\ModuleOptionsFactory',
        ],
        'invokables' => [
            'CmsAuthentication\Listener\CaptchaListener' => 'CmsAuthentication\Listener\CaptchaListener',
        ],
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
                'text_domain' => __NAMESPACE__,
            ],
        ],
    ],
    'validators' => [
        'factories' => [
            'CmsAuthenticationCredential'
                => 'CmsAuthentication\Factory\Validator\CredentialValidatorFactory',
            'CmsAuthenticationIdentity'
                => 'CmsAuthentication\Factory\Validator\IdentityValidatorFactory',
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'cmsIdentity' => 'CmsAuthentication\View\Helper\Identity',
        ],
        'factories' => [
            'CmsAuthentication\View\Helper\Identity'
                => 'CmsAuthentication\Factory\View\Helper\IdentityHelperFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'CmsAuthentication' => __DIR__ . '/../view',
        ],
    ],
];
