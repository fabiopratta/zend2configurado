<?php

/**
 * @file           TesteController.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - ZendSkeletonAdmin | 21/02/2014
 * @version        Release: 1.0
 * @since          21/02/2014
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel,
    Zend\Mvc\Controller\AbstractActionController;

class TesteController extends AbstractActionController {

    public function testeAction() {
        return new ViewModel();
    }

}
