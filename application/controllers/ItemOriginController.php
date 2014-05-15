<?php
class ItemOriginController extends Zend_Controller_Action {
	
	private $_itemOriginDao;
	
	public function init()
	{
		$this->_itemOriginDao = new App_Dao_ItemOriginDao ();
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
	}
	
	public function indexAction() {		
		$this->view->dataList = $this->_itemOriginDao->getAll();		
	}
	
	public function viewAction() {
		$id = $this->_getParam('id', '');
	
		if(empty($id))
			$this->_helper->redirector('itemorigin');
		
		$itemOrigin = $this->_itemOriginDao->getById($id);
		
		if($itemOrigin == null)
			$this->_helper->redirector('itemorigin');
	
		$this->view->item = $itemOrigin;
	}
	
	public function addAction() {
		$form = new App_Form_ItemOriginForm();
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
		
				$itemOrigin = new App_Model_ItemOrigin();
				$itemOrigin->setName	( $formData['name'] );
				
				$this->_itemOriginDao->save($itemOrigin);
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
	
		$itemOrigin = $this->_itemOriginDao->getById($id);
	
		if($itemOrigin == null)
			$this->_helper->redirector('index');
	
		$form = new App_Form_ItemOriginForm();
		
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				$itemOrigin->setName	( $formData['name'] );
				
				$this->_itemOriginDao->save($itemOrigin);
				$this->_helper->redirector('index');
				return;
			}
			else
				$form->populate($formData);
		}
		else {
			$form = new App_Form_ItemOriginForm();			
		}
		
		if (!empty($itemOrigin))
			$form->populate($itemOrigin->toArray());
		
		$this->view->form = $form;
	}
	
	public function removeAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
	
		$itemOrigin = $this->_itemOriginDao->getById($id);
	
		if($itemOrigin == null)
			$this->_helper->redirector('index');
	
		$this->view->itemOrigin = $itemOrigin;
	
		if ($this->_request->getPost()) {
			
			$this->_itemOriginDao->remove($itemOrigin);
			$this->_helper->redirector('index');
			return;
		}
	}
}
