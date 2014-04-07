<?php

/**
 * @file           IndexController.php
 * @package        Expression package is undefined on line 4, column 22 in Templates/Scripting/PHPClass.php.
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 19/02/2014
 * @version        Release: 1.0
 * @since 19/02/2014
 */

namespace APPUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use APPUser\Form\Vendedor as FormVendedor;

class IndexController extends AbstractActionController {

    public function registerAction() {
        $form = new FormVendedor;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid())
                $service = $this->getServiceLocator()->get('APPUser\Service\Vendedor');
            if ($service->insert($request->getPost()->toArray())) {
                $this->flashMessenger()->setNamespace('APPUser')
                        ->addMessage("Usuario cadastrado com sucesso");
            }
            return $this->redirect()->toRoute('appuser-register');
        }
        $messages = $this->flashMessenger()->setNamespace('APPUser')
                ->getMessages();

        return new ViewModel(array(
            'form' => $form,
            'messages' => $messages
        ));
    }

    public function activateAction() {
        $activationKey = $this->params()->fromRoute("key");
            
        $userService = $this->getServiceLocator()->get('APPUser\Service\Vendedor');
        $result = $userService->activate($activationKey);
       
        if ($result) {
            return new ViewModel(array('user' => $result));
        }else{
            return new ViewModel();
        }
        
    }

}
