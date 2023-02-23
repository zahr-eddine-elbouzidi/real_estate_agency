<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

//declare(strict_types=1);

namespace Application;

class Module
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
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
                 * candidat  table injection
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
                }


 
            ],
        ];
    }
}
