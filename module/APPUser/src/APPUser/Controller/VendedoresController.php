<?php

/**
 * @file           VendedoresController.php
 * @author         Fabio Pratta <fabiobrotas@hotmail.com>
 * @license        default 
 * @copyright      Copyright - publico.fundacaoceu.org.br | 21/02/2014
 * @version        Release: 1.0
 * @since 21/02/2014
 */

namespace APPUser\Controller;

use Zend\View\Model\ViewModel;
use APPBase\Controller\CrudController;

class VendedoresController extends CrudController {

    public function __construct() {
        
        $this->entity = "APPUser\Entity\Vendedores";
        $this->form = "APPUser\Form\Vendedor";
        $this->service = "APPUser\Service\Vendedor";
        $this->controller = "Vendedores";
        $this->route = "appuser-admin";
    }

    public function editAction() {
        $form = new $this->form;
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $array = $entity->toArray();
            unset($array['password']);
            $form->setData($array);
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

}
