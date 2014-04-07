<?php

/**
 * @file           AuthController.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 24/02/2014
 * @version        Release: 1.0
 * @since 24/02/2014
 */

namespace APPUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use APPUser\Form\Login;

class AuthController extends AbstractActionController {

    public function indexAction() {

        $form = new Login();
        $error = false;

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();
                //Gravando Storage Autenticacao
                $sessionStorage = new SessionStorage("APPUser");
                $auth = new AuthenticationService;
                $auth->setStorage($sessionStorage);

                $authAdapter = $this->getServiceLocator()->get("APPUser\Auth\Adapter");
                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);
                
                if ($result->isValid()) {
                    $vendedor = $auth->getIdentity();
                    $vendedor = $vendedor['vendedor'];
                    $sessionStorage->write($vendedor, null);
                    return $this->redirect()->toRoute("appuser-admin", array("controller" => 'vendedores'));
                } else {
                    $error = true;
                }
            }
        }
        return new ViewModel(array('form' => $form, 'error' => $error));
    }

    public function logoutAction() {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("APPUser"));
        $auth->clearIdentity();
        return $this->redirect()->toRoute('appuser-auth');
    }

}
