<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


namespace Admin;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface {

   const VERSION = '3.1.4dev';


   public function getConfig() {
      return include __DIR__ . '/../config/module.config.php';
   }

   public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CategorieController::class => function($container) {
                    return new Controller\CategorieController(
                        $container->get(Model\CategorieTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\EtablissementController::class => function($container) {
                    return new Controller\EtablissementController(
                        $container->get(Model\EtablissementTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\SessionController::class => function($container) {
                    return new Controller\SessionController(
                        $container->get(Model\SessionTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\ModepaieController::class => function($container) {
                    return new Controller\ModepaieController(
                        $container->get(Model\ModeTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\FiliereController::class => function($container) {
                    return new Controller\FiliereController(
                        $container->get(Model\FiliereTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\InscriptionsController::class => function($container) {
                    return new Controller\InscriptionsController(
                        $container->get(Model\InscriptionTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\CalendrierController::class => function($container) {
                    return new Controller\CalendrierController(
                        $container->get(Model\CalendrierTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\PaiementsController::class => function($container) {
                    return new Controller\PaiementsController(
                        $container->get(Model\PaiementsTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },


                Controller\PartenaireController::class => function($container) {
                    return new Controller\PartenaireController(
                        $container->get(Model\PartenaireTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\CandidatController::class => function($container) {
                    return new Controller\CandidatController(
                        $container->get(Model\CandidatTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\StatistiqueController::class => function($container) {
                    return new Controller\StatistiqueController(
                        $container->get(Model\CandidatTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\SubcatController::class => function($container) {
                    return new Controller\SubcatController(
                        $container->get(Model\SubcatTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\ContactController::class => function($container) {
                    return new Controller\ContactController(
                        $container->get(Model\ContactTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\PostController::class => function($container) {
                    return new Controller\PostController(
                        $container->get(Model\PostTable::class),
                        $container->get(Model\UsersTable::class)
                    );
                },

                Controller\IndexController::class => function($container) {
                    return new Controller\IndexController(
                        $container->get(Model\UsersTable::class)
                    );
                },
                
                Controller\RegistrationController::class => function($container) {
                    return new Controller\RegistrationController(
                        $container->get(Model\UsersTable::class)
                    );
                },
            ],
        ];
    }

   public function getServiceConfig()
    {
        return [
            'factories' => [
             
                /**
                 * category table injection
                 */
                Model\CategorieTable::class => function($container) {
                    $tableGateway = $container->get(Model\CategorieTableGateway::class);
                    return new Model\CategorieTable($tableGateway);
                },
                Model\CategorieTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Categorie());
                    return new TableGateway('category', $dbAdapter, null, $resultSetPrototype);
                },


                   /**
                 * etablissement table injection
                 */
                Model\EtablissementTable::class => function($container) {
                    $tableGateway = $container->get(Model\EtablissementTableGateway::class);
                    return new Model\EtablissementTable($tableGateway);
                },
                Model\EtablissementTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Etablissement());
                    return new TableGateway('etablissements', $dbAdapter, null, $resultSetPrototype);
                },



                 /**
                 * session table injection
                 */
                Model\SessionTable::class => function($container) {
                    $tableGateway = $container->get(Model\SessionTableGateway::class);
                    return new Model\SessionTable($tableGateway);
                },
                Model\SessionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Session());
                    return new TableGateway('sessions', $dbAdapter, null, $resultSetPrototype);
                },


                 /**
                 * mode_paiement table injection
                 */
                Model\ModeTable::class => function($container) {
                    $tableGateway = $container->get(Model\ModeTableGateway::class);
                    return new Model\ModeTable($tableGateway);
                },
                Model\ModeTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Mode());
                    return new TableGateway('mode_paiement', $dbAdapter, null, $resultSetPrototype);
                },
                
                 /**
                 * filiere table injection
                 */
                Model\FiliereTable::class => function($container) {
                    $tableGateway = $container->get(Model\FiliereTableGateway::class);
                    return new Model\FiliereTable($tableGateway);
                },
                Model\FiliereTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Filiere());
                    return new TableGateway('filieres', $dbAdapter, null, $resultSetPrototype);
                },



                 /**
                 * inscriptions table injection
                 */
                Model\InscriptionTable::class => function($container) {
                    $tableGateway = $container->get(Model\InscriptionTableGateway::class);
                    return new Model\InscriptionTable($tableGateway);
                },
                Model\InscriptionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Inscription());
                    return new TableGateway('inscriptions', $dbAdapter, null, $resultSetPrototype);
                },


                 /**
                 * calendrier table injection
                 */
                Model\CalendrierTable::class => function($container) {
                    $tableGateway = $container->get(Model\CalendrierTableGateway::class);
                    return new Model\CalendrierTable($tableGateway);
                },
                Model\CalendrierTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Calendrier());
                    return new TableGateway('session_filiere', $dbAdapter, null, $resultSetPrototype);
                },

                 /**
                 * paiement table injection
                 */
                Model\PaiementsTable::class => function($container) {
                    $tableGateway = $container->get(Model\PaiementsTableGateway::class);
                    return new Model\PaiementsTable($tableGateway);
                },
                Model\PaiementsTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Paiements());
                    return new TableGateway('paiements', $dbAdapter, null, $resultSetPrototype);
                },



                /**
                 * partenaire table injection
                 */
                Model\PartenaireTable::class => function($container) {
                    $tableGateway = $container->get(Model\PartenaireTableGateway::class);
                    return new Model\PartenaireTable($tableGateway);
                },
                Model\PartenaireTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Partenaire());
                    return new TableGateway('partenaires', $dbAdapter, null, $resultSetPrototype);
                },

                /**
                 * candidat table injection
                 */
                Model\CandidatTable::class => function($container) {
                    $tableGateway = $container->get(Model\CandidatTableGateway::class);
                    return new Model\CandidatTable($tableGateway);
                },
                Model\CandidatTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Candidat());
                    return new TableGateway('candidat', $dbAdapter, null, $resultSetPrototype);
                },
                
                /**
                 * sub category table injection
                 */
                Model\SubcatTable::class => function($container) {
                    $tableGateway = $container->get(Model\SubcatTableGateway::class);
                    return new Model\SubcatTable($tableGateway);
                },
                Model\SubcatTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Subcat());
                    return new TableGateway('subcat', $dbAdapter, null, $resultSetPrototype);
                },


                /**
                 * sub category table injection
                 */
                Model\PostTable::class => function($container) {
                    $tableGateway = $container->get(Model\PostTableGateway::class);
                    return new Model\PostTable($tableGateway);
                },
                Model\PostTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Post());
                    return new TableGateway('posts', $dbAdapter, null, $resultSetPrototype);
                },


                /**
                 * contact table injection
                 */
                Model\ContactTable::class => function($container) {
                    $tableGateway = $container->get(Model\ContactTableGateway::class);
                    return new Model\ContactTable($tableGateway);
                },
                Model\ContactTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Contact());
                    return new TableGateway('contact', $dbAdapter, null, $resultSetPrototype);
                },


                /**
                 * users table injection 
                 */
                Model\UsersTable::class => function($container) {
                    $tableGateway = $container->get(Model\UsersTableGateway::class);
                    return new Model\UsersTable($tableGateway);
                },
                Model\UsersTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

 
}