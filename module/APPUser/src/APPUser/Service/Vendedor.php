<?php

/**
 * @file           Vendedor.php
 * @package        Expression package is undefined on line 4, column 22 in Templates/Scripting/PHPClass.php.
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 20/02/2014
 * @version        Release: 1.0
 * @since 20/02/2014
 */

namespace APPUser\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use APPBase\Mail\Mail;
use APPBase\Service\AbstractService;

class Vendedor extends AbstractService {

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view) {
        parent::__construct($em);
        $this->entity = "APPUser\Entity\Vendedores";
        $this->transport = $transport;
        $this->view = $view;
    }

    //Insert
    public function insert(array $data) {
        $entity = parent::insert($data);
        $dataEmail = array('nome' => $data['nome'], 'activationKey' => $entity->getActivationKey());
        if ($entity) {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject("Sistema de Agendamento ::: Ative seu cadastro")
                    ->setTo($data['email'])
                    ->setData($dataEmail)
                    ->prepare()
                    ->send();
            return $entity;
        }
    }
    
    public function activate($key){
        $repo = $this->em->getRepository("APPUser\Entity\Vendedores");
        $user = $repo->findOneByActivationKey($key);
        if($user && !$user->getActive()){
            $user->setActive(true);
            $this->em->persist($user);
            $this->em->flush();
            return $user;
        }
    }
    
    public function update(array $data){
        $entity = $this->em->getReference($this->entity, $data['id']);
        $hydrator = new Hydrator\ClassMethods;
        $hydrator->hydrate($data, $entity);
       
        if(empty($data['password'])){
            unset($data['password']);
        }
        
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
