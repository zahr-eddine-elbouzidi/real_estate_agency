<?php

namespace Admin;
use Zend\Router\Http\Segment;  
return [ 
    


   'router' => [ 
      'routes' => [ 
         

         'category' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/category[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\CategorieController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'etablissement' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/etablissement[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\EtablissementController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 


         'sessions' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/sessions[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\SessionController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'modes' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/modes[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\ModepaieController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 


         'filieres' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/filieres[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\FiliereController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 


         'inscriptions' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/inscriptions[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\InscriptionsController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'paiements' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/paiements[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\PaiementsController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'calendrier' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/calendrier[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\CalendrierController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'partenaires' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/partenaires[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\PartenaireController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'candidat_back' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/candidat_back[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\CandidatController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'dashboard' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/dashboard[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\StatistiqueController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'subcategory' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/subcategory[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\SubcatController::class,
                  'action' => 'index', 
               ], 
            ], 
         ],

         'posts' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/posts[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\PostController::class,
                  'action' => 'index', 
               ], 
            ], 
         ],

         'contact' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/contact[/:action][/:id][/:name]',
               'constraints' => [
                  'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\ContactController::class,
                  'action' => 'index', 
               ], 
            ], 
         ],

         'index' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/index[/:action[/:id]]',
               'constraints' => [
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'id'         => '[a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\IndexController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 

         'registration' => [ 
            'type' => Segment::class,
            'options' => [ 
               'route' => '/registration[/:action[/:id]]',
               'constraints' => [
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
               ], 
               'defaults' => [ 
                  'controller' => Controller\RegistrationController::class,
                  'action' => 'index', 
               ], 
            ], 
         ], 
      ], 
   ], 
   'view_manager' => [ 
    'strategies' => [
        'ViewJsonStrategy',
    ],
   ], 

   /*'service_manager' => [
    'factories' => [
        \Laminas\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
    ],
],*/
]; 