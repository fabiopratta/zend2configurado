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

class Vendedor extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('vendedor', $options);

        //add filters
        $this->setInputFilter(new VendedorFilter());

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', "form-horizontal");

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setAttribute("placeholder", 'Entre com o Nome')
                ->setAttribute('class', 'form-control input-md');
        $this->add($nome);

        $email = new \Zend\Form\Element\Text('email');
        $email->setAttribute("placeholder", 'Entre com o Email')
                ->setAttribute('class', 'form-control input-md');
        $this->add($email);

        $password = new \Zend\Form\Element\Password('password');
        $password->setAttribute('class', 'form-control input-md')
                ->setAttribute("placeholder", 'Entre com a Senha');
        $this->add($password);

        $confirmation = new \Zend\Form\Element\Password('confirmation');
        $confirmation->setAttribute('class', 'form-control input-md')
                ->setAttribute("placeholder", 'Redegite a Senha');
        // ->setAttribute('class', 'btn btn-success');

        $this->add($confirmation);

        $csrf = new \Zend\Form\Element\Csrf('security');
        $this->add($csrf);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));
    }

}
