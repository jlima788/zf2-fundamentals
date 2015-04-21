<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController
{
    use ListingsTableTrait;
    
    public function indexAction()
    {
    	$category = $this->params()->fromRoute("category");
    	
    	$listings = $this->listingsTable->getListingsByCategory($category);
        
        return new ViewModel(array ('category'=>$category,'list'=>$listings));
    }	
    
    public function itemAction()
    {
    	$itemId = $this->params()->fromRoute('itemId');
    	
    	$item = $this->listingsTable->getListingsById($itemId);
    	
    	if(!$itemId){
    		$this->flashMessenger()->addMessage("Item not found");
    		return $this->redirect()->toRoute('market');
    	}
    	
    	return new ViewModel(array('itemId'=>$itemId, 'item'=>$item));
    }
}