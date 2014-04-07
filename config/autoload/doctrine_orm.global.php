<?php

/**
 * 
 * @file           doctrine_orm.local.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 19/02/2014
 * @version        Release: 1.0
 * @since 19/02/2014
 */

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'f25b6i87',
                    'dbname'   => 'CeuControl',
                    'driverOptions'=> array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8' "
                    )
                )
            )
        )
    ),
);