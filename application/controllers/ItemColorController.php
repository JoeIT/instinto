<?php
class ItemColorController extends Zend_Controller_Action {
	
	private $_itemColorDao;
	
	public function init()
	{
		$this->_itemColorDao = new App_Dao_ItemColorDao ();
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
	}
	
	public function indexAction() {		
		$this->view->dataList = $this->_itemColorDao->getAll();		
	}
	
	public function viewAction() {
		$id = $this->_getParam('id', '');
	
		if(empty($id))
			$this->_helper->redirector('itemcolor');
		
		$itemColor = $this->_itemColorDao->getById($id);
		
		if($itemColor == null)
			$this->_helper->redirector('itemcolor');
	
		$this->view->item = $itemColor;
	}
	
	public function addAction() {
		$form = new App_Form_ItemColorForm();
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
		
				$itemColor = new App_Model_ItemColor();
				$itemColor->setName	( $formData['name'] );
				
				$this->_itemColorDao->save($itemColor);
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
	
		$itemColor = $this->_itemColorDao->getById($id);
	
		if($itemColor == null)
			$this->_helper->redirector('index');
	
		$form = new App_Form_ItemColorForm();
		
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				$itemColor->setName	( $formData['name'] );
				
				$this->_itemColorDao->save($itemColor);
				$this->_helper->redirector('index');
				return;
			}
			else
				$form->populate($formData);
		}
		else {
			$form = new App_Form_ItemColorForm();			
		}
		
		if (!empty($itemColor))
			$form->populate($itemColor->toArray());
		
		$this->view->form = $form;
	}
	
	public function removeAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
	
		$itemColor = $this->_itemColorDao->getById($id);
	
		if($itemColor == null)
			$this->_helper->redirector('index');
	
		$this->view->itemColor = $itemColor;
	
		if ($this->_request->getPost()) {
			
			$this->_itemColorDao->remove($itemColor);
			$this->_helper->redirector('index');
			return;
		}
	}
}
