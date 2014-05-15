<?php
class ItemTypeController extends Zend_Controller_Action {
	
	private $_itemTypeDao;
	
	public function init()
	{
		$this->_itemTypeDao = new App_Dao_ItemTypeDao ();
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
	}
	
	public function indexAction() {		
		$this->view->dataList = $this->_itemTypeDao->getAll();		
	}
	
	public function viewAction() {
		$id = $this->_getParam('id', '');
	
		if(empty($id))
			$this->_helper->redirector('indextype');
		
		$itemType = $this->_itemTypeDao->getById($id);
		
		if($itemType == null)
			$this->_helper->redirector('indextype');
	
		$this->view->item = $itemType;
	}
	
	public function addAction() {
		$form = new App_Form_ItemTypeForm();
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
		
				$itemType = new App_Model_ItemType();
				$itemType->setName			( $formData['name'] );
				$itemType->setDescription	( $formData['description'] );
				
				$this->_itemTypeDao->save($itemType);
				$this->_helper->redirector('index');
				return;
			}
		}
		$this->view->form = $form;
	}
	
	public function editAction() {
	
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
	
		$itemType = $this->_itemTypeDao->getById($id);
	
		if($itemType == null)
			$this->_helper->redirector('index');
	
		$form = new App_Form_ItemTypeForm();
		
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				$itemType->setName			( $formData['name'] );
				$itemType->setDescription	( $formData['description'] );
				
				$this->_itemTypeDao->save($itemType);
				$this->_helper->redirector('index');
				return;
			}
			else
				$form->populate($formData);
		}
		else {
			$form = new App_Form_ItemTypeForm();			
		}
		
		if (!empty($itemType))
			$form->populate($itemType->toArray());
		
		$this->view->form = $form;
	}
	
	public function removeAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
	
		$itemType = $this->_itemTypeDao->getById($id);
	
		if($itemType == null)
			$this->_helper->redirector('index');
	
		$this->view->itemType = $itemType;
	
		if ($this->_request->getPost()) {
				
			$this->_itemTypeDao->remove($itemType);
			$this->_helper->redirector('index');
			return;
		}
	}
}
