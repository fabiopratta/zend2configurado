<?php

/**
 * @file           Adapter.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 24/02/2014
 * @version        Release: 1.0
 * @since 24/02/2014
 */

namespace APPUser\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
      Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface {
    
    protected $em;
    protected $username;
    protected $password;
   
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function authenticate() {
        
        $repository = $this->em->getRepository("APPUser\Entity\Vendedores");
        $vendedor = $repository->findByEmailAndPassword($this->username,$this->password);
        
        if($vendedor){
            return new Result(Result::SUCCESS,array('vendedor'=>$vendedor),array('OK'));
        }else{
            return new Result(Result::FAILURE_CREDENTIAL_INVALID,null,array());
        }
        
        
    }

}
