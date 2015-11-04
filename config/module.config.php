<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile;

return [
    'cmspermissions' => [
        'acl' => [
            'guards' => [
                'CmsAcl\Guard\Route' => [
                    ['route' => 'cms-admin/cms-file',   'roles' => ['admin']],
                    ['route' => 'cms-file/default',     'roles' => []],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'CmsFile\Controller\File'   => 'CmsFile\Factory\Mvc\Controller\FileControllerFactory',
            'CmsFile\Controller\Index'  => 'CmsFile\Factory\Mvc\Controller\IndexControllerFactory',
        ],
        'invokables' => [
            'CmsFile\Controller\Admin'  => 'CmsFile\Controller\AdminController',
        ],
    ],
    'domain_services' => [
        'aliases' => [
            'CmsFile\Mapping\FileInterface' => 'CmsFile\Service\FileServiceInterface',
            'CmsFile\Mapping\FolderInterface' => 'CmsFile\Service\FolderServiceInterface',
            'CmsFile\Service\FileServiceInterface' => 'CmsFile\Service\FileService',
            'CmsFile\Service\FolderServiceInterface' => 'CmsFile\Service\FolderService',
        ],
        'factories' => [
            'CmsFile\Service\FileService' => 'CmsFile\Factory\FileServiceFactory',
            'CmsFile\Service\FolderService' => 'CmsFile\Factory\FolderServiceFactory',
        ],
    ],
    'filters' => [
        'aliases' => [
            'FileRenameUpload' => 'CmsFile\Filter\RenameUpload',
        ],
        'factories' => [
            'FileUpload' => 'CmsFile\Factory\Filter\FileUploadFilterFactory',
        ],
        'invokables' => [
            'CmsFile\Filter\RenameUpload' => 'CmsFile\Filter\RenameUpload',
        ],
    ],
    'form_elements' => [
        'aliases' => [
            'File' => 'CmsFile\Form\Element\File',
            'FileCollection' => 'CmsFile\Form\Element\FileCollection',
        ],
        'factories' => [
            'FileUpload' => 'CmsFile\Factory\Form\Element\FileUploadElementFactory',
        ],
        'invokables' => [
            'CmsFile\Form\Element\File' => 'CmsFile\Form\Element\File',
            'CmsFile\Form\Element\FileCollection' => 'CmsFile\Form\Element\FileCollection',
        ]
    ],
    'router' => [
        'routes' => [
            'cms-admin' => [
                'child_routes' => [
                    'cms-file' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/cms-file[/:controller[/:action[/:id]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z\-]*',
                                'action' => '[a-zA-Z\-]*',
                                'id' => '[a-zA-Z0-9\-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'CmsFile\Controller',
                                'controller' => 'Admin',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            'cms-file' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/file',
                    'defaults' => [
                        '__NAMESPACE__' => 'CmsFile\Controller',
                    ],
                ],
                'priority' => 9001,
                'may_terminate' => false,
                'child_routes' => [
                    'default' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => 's[/:path]',
                            'constraints' => [
                                'path' => '[a-zA-Z0-9\/\-\._]+',
                            ],
                            'defaults' => [
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            'cms-user' => [
                'child_routes' => [
                    'file' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/file[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z\-]*',
                                'id' => '[0-9]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'CmsFile\Controller',
                                'controller' => 'User',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'CmsFile\Options\ModuleOptions' => 'CmsFile\Options\ModuleOptionsInterface',
        ],
        'factories' => [
            'CmsFile\Options\ModuleOptionsInterface' => 'CmsFile\Factory\ModuleOptionsFactory',
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
    'view_helpers' => [
        'invokables' => [
            'fileBasePath' => 'CmsFile\View\Helper\BasePath',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],
];
