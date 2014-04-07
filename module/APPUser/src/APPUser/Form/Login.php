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

namespace APPUser\Form;

use Zend\Form\Form;

class Login extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('login', $options);

        //add filters  
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', "form-horizontal");

        $email = new \Zend\Form\Element\Text('email');
        $email->setAttribute("placeholder", 'Entre com o Email')
                ->setAttribute('class', 'form-control input-md');
        $this->add($email);

        $password = new \Zend\Form\Element\Password('password');
        $password->setAttribute("placeholder", 'Entre com a Senha')
                ->setAttribute('class', 'form-control input-md');
                
        $this->add($password);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Login',
                'class' => 'btn btn-primary'
            )
        ));
    }

}
