<?php

/**
 * @file           LoadUser.php
 * @package        Expression package is undefined on line 4, column 22 in Templates/Scripting/PHPClass.php.
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 20/02/2014
 * @version        Release: 1.0
 * @since 20/02/2014
 */


namespace APPUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
      Doctrine\Common\Persistence\ObjectManager;

use APPUser\Entity\Vendedores;

class LoadVendedores extends AbstractFixture {
  
    public function load(ObjectManager $manager) {
        
         $vendedor = new Vendedores();
         $vendedor->setNome("Fabio Pratta")
                 ->setEmail("fabiopratta@fundacaoceu.org.br")
                 ->setPassword('f25b6i87')
                 ->setActive(true);
         
         $manager->persist($vendedor);
         
         $manager->flush();
        
    }

}
