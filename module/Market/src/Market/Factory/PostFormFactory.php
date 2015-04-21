<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Market\Form\PostForm;

class PostFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {    	
        $categories = $sm->get('categories');
        
        $form = new PostForm();
        $form->setCategories($sm->get('categories'));
        $form->buildForm();
        $form->setInputFilter($sm->get('market-post-filter'));
        
        return $form;
    }
}