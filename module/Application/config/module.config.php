<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;


return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action][/:category_name][/:sub_category_name][/:post_name]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'register' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/register[/:action][/:message]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                     ],
                ],
            ],

            'contacts' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/contact-us[/:action][/:id][/:name]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ], 
                   'defaults' => [ 
                      'controller' => Controller\ContactsController::class,
                      'action' => 'index', 
                   ], 
                ], 
             ],

             'services' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/nos-services[/:action][/:id][/:name]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ], 
                   'defaults' => [ 
                      'controller' => Controller\ServicesController::class,
                      'action' => 'index', 
                   ], 
                ], 
             ],


             'news' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/news[/:action][/:category_name][/:sub_category_name][/:post_name]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ], 
                   'defaults' => [ 
                      'controller' => Controller\NewsController::class,
                   ], 
                ], 
             ],

             'search' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/search[/:action][/:q][/:page]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ], 
                   'defaults' => [ 
                      'controller' => Controller\SearchController::class,
                   ], 
                ], 
             ],
             'candidat' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/inscription[/:action]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ], 
                   'defaults' => [ 
                    'controller' => Controller\CandidatController::class,
                    'action'     => 'inscription',
                   ], 
                ], 
             ],

             'faq' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/faq[/:action]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ], 
                   'defaults' => [ 
                    'controller' => Controller\IndexController::class,
                    'action'     => 'faq',
                   ], 
                ], 
             ],
             'nf' => [ 
                'type' => Segment::class,
                'options' => [ 
                   'route' => '/404[/:action]',
                   'constraints' => [
                      'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   ] 
                ], 
             ],
        ],
    ],
 
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => function($container) {
                $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $tableGateway = new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
                $tableGateway1 = new TableGateway('candidat', $dbAdapter, null, $resultSetPrototype);
                return new Controller\IndexController(
                    new \Application\Model\CategorieTable($tableGateway),
                    new \Application\Form\PostForm(),
                    new \Application\Model\CandidatTable($tableGateway1),
                    new \Application\Form\CandidatForm(),

                );
            },

            Controller\CandidatController::class => function($container) {
                $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $tableGateway = new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
                $tableGateway1 = new TableGateway('candidat', $dbAdapter, null, $resultSetPrototype);
                return new Controller\CandidatController(
                    new \Application\Model\CategorieTable($tableGateway),
                    new \Application\Form\PostForm(),
                    new \Application\Model\CandidatTable($tableGateway1),
                    new \Application\Form\CandidatForm(),

                );
            },

            Controller\ContactsController::class => function($container) {
                $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $tableGateway = new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
    
                return new Controller\ContactsController(
                    new \Application\Model\CategorieTable($tableGateway),
                    new \Application\Form\PostForm(),
                    new \Application\Form\CandidatForm(),
                );
            },

            Controller\ServicesController::class => function($container) {
                $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $tableGateway = new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
    
                return new Controller\ServicesController(
                    new \Application\Model\CategorieTable($tableGateway),
                    new \Application\Form\PostForm(),
                    new \Application\Form\CandidatForm(),
                );
            },

            Controller\NewsController::class => function($container) {
                $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $tableGateway = new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
    
                return new Controller\NewsController(
                    new \Application\Model\CategorieTable($tableGateway),
                    new \Application\Form\PostForm(),
                    new \Application\Form\CandidatForm(),
                );
            },

            Controller\SearchController::class => function($container) {
                $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $tableGateway = new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
    
                return new Controller\SearchController(
                    new \Application\Model\CategorieTable($tableGateway),
                    new \Application\Form\PostForm(),
                    new \Application\Form\CandidatForm(),
                );
            },
        ],
    ],  
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
