<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace APPUser;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use APPUser\Auth\Adapter as AuthAdapter;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Zend\Log\FirePhp' => function($sm) {
            $writer_firebug = new \Zend\Log\Writer\FirePhp();
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer_firebug);
            return $logger;
        },
                'APPUser\Mail\Transport' => function($sm) {
            $config = $sm->get('Config');
            $transport = new SmtpTransport;
            $options = new SmtpOptions($config['mail']);
            $transport->setOptions($options);
            return $transport;
        },
                'APPUser\Service\Vendedor' => function($sm) {
            return new Service\Vendedor($sm->get('Doctrine\ORM\EntityManager'), $sm->get('APPUser\Mail\Transport'), $sm->get('View'));
        },
                'APPUser\Auth\Adapter' => function($sm) {
            return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
        }
            ),
        );
    }

    public function init(ModuleManager $moduleManager) {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController", MvcEvent::EVENT_DISPATCH, array($this, 'mvcPreDispatch'), 100);
    }

    public function mvcPreDispatch($e) {
        
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('APPUser'));

        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

        $getAdmin = explode("/", $matchedRoute);
        $getAdmin = explode("-", $getAdmin[0]);
        
        //echo $getAdmin[1];
        if (!$auth and $getAdmin[1] == "admin") {
            return $controller->redirect()->toRoute("appuser-auth");
        }
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity()
            )
        );
    }

}
