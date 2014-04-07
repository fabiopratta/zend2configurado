<?php

/**
 * @file           VendedoresRepository.php
 * @package        Expression package is undefined on line 4, column 22 in Templates/Scripting/PHPClass.php.
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 21/02/2014
 * @version        Release: 1.0
 * @since 21/02/2014
 */


namespace APPUser\Entity;


use Doctrine\ORM\EntityRepository;

class VendedoresRepository extends EntityRepository 
{

    public function findByEmailAndPassword($email , $password){
        $vendedor = $this->findOneByEmail($email);
        if($vendedor){
            $hashSenha = $vendedor->encryptPassword($password);
            if($hashSenha == $vendedor->getPassword()){
                return $vendedor;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
}
