<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    use ListingsTableTrait;
    
	public $categories;
	private $postForm;
	
	function setPostForm($postForm) {
	    $this->postForm = $postForm;
	}
	
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}
	
	public function indexAction()
	{
	    $data = $this->params()->fromPost();
	    $form = $this->getServiceLocator()->get('market-post-form');
	    $viewModel = new ViewModel(array('postForm' => $form, 'data'=>$data));
	    $viewModel->setTemplate('market/post/index.phtml');
	    
	    if($this->getRequest()->isPost()){
	        $form->setData($data);
	        if($form->isValid()){
	            $this->listingsTable->addPosting($this->postForm->getValue());
	            $this->flashMessenger()->addMessage("Thanks for posting!");
	            $this->redirect()->toRoute('home');
	        } else {
	            $invalidView = new ViewModel();
	            $invalidView->setTemplate("market/post/invalid.phtml");
	            $invalidView->addChild($viewModel, 'main');
	            return $invalidView;
	        }
	    }
	    
		return $viewModel;
	}
}