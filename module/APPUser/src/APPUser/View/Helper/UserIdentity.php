<?php

/**
 * @file           UserIdentity.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 24/02/2014
 * @version        Release: 1.0
 * @since 24/02/2014
 */

namespace APPUser\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

class UserIdentity extends AbstractHelper {

    protected $authService;

    public function getAuthService() {
        return $this->authService;
    }

    public function __invoke($namespace = null) {
        $sessionStorage = new SessionStorage($namespace);
        $this->authService = new AuthenticationService;
        $this->authService->setStorage($sessionStorage);

        if ($this->getAuthService()->hasIdentity()) {
            return $this->getAuthService()->getIdentity();
        }
        else
            return false;
    }

}