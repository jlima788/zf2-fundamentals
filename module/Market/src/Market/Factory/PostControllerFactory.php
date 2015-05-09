<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Controller\PostController;

class PostControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
    	$sm = $controllerManager->getServiceLocator();
    	//$sm = $allServices->get('ServiceManager');
    	
        //$categories = $sm->get('categories');
        
        $postController = new PostController();
        $postController->setCategories($categories);
        $postController->setPostForm($sm->get('market-post-form'));
        $postController->setListingsTable($sm->get('listings-table'));
        
        return $postController;
    }
}