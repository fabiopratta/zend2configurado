<?php

/**
 * 
 * @file           module.config.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 19/02/2014
 * @version        Release: 1.0
 * @since 19/02/2014
 */

namespace APPUser;

return array(
    'router' => array(
        'routes' => array(
            //Rota registro
            'appuser-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'APPUser\Controller',
                        'controller' => 'Index',
                        'action' => 'register'
                    )
                )
            ),
            //rota de ativacao
            'appuser-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        'controller' => 'APPUser\Controller\Index',
                        'action' => 'activate'
                    )
                )
            ),
            ////Rota Authenctica
            'appuser-auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'APPUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            'appuser-logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'APPUser\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),
            //Rota Adm
            'appuser-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/vendedores',
                    'defaults' => array(
                        '__NAMESPACE__' => 'APPUser\Controller',
                        'controller' => 'Vendedores',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'APPUser\Controller',
                                'controller' => 'vendedores',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/page/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'APPUser\Controller',
                                'controller' => 'vendedores',
                            ),
                        ),
                    ),
              
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'APPUser\Controller\Index' => 'APPUser\Controller\IndexController',
            'APPUser\Controller\Vendedores' => 'APPUser\Controller\VendedoresController',
            'APPUser\Controller\Auth' => 'APPUser\Controller\AuthController',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../../APPBase/view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../../APPBase/view/error/404.phtml',
            'error/index' => __DIR__ . '/../../APPBase/view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
        ),
        'fixture' => array(
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
        )
    ),
);

