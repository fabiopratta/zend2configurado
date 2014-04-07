<?php

/**
 * @file           VendedorFilter.php
 * @package        Expression package is undefined on line 4, column 22 in Templates/Scripting/PHPClass.php.
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 20/02/2014
 * @version        Release: 1.0
 * @since 20/02/2014
 */

namespace APPUser\Form;

use Zend\InputFilter\InputFilter;

class VendedorFilter extends InputFilter
{
    public function __construct() {
        
        $this->add(array(
           'name'=>'nome',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array('name'=>'NotEmpty','options' =>array('message'=> array('isEmpty'=>'Não pode estar em branco')))
            )
        ));
        
        $validator = new \Zend\Validator\EmailAddress();
        $validator->setOptions(array('domain'=>FALSE));
        
        $this->add(array(
            'name' => 'email',
            'validators' => array($validator)
        ));
        
         $this->add(array(
           'name'=>'password',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array('name'=>'NotEmpty','options' =>array('message'=> array('isEmpty'=>'Não pode estar em branco')))
            )
        ));
         
         $this->add(array(
           'name'=>'confirmation',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array('name'=>'NotEmpty','options' =>array('message'=> array('isEmpty'=>'Não pode estar em branco')),
                          'name' => 'Identical','options' => array('token'=>'password')
                    )
            )
        ));
    }
}
