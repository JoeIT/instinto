<?php
class ItemSizeController extends Zend_Controller_Action {
	
	private $_itemSizeDao;
	
	public function init()
	{
		$this->_itemSizeDao = new App_Dao_ItemSizeDao ();
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
	}
	
	public function indexAction() {		
		$this->view->dataList = $this->_itemSizeDao->getAll();		
	}
	
	public function viewAction() {
		$id = $this->_getParam('id', '');
	
		if(empty($id))
			$this->_helper->redirector('indexsize');
		
		$itemSize = $this->_itemSizeDao->getById($id);
		
		if($itemSize == null)
			$this->_helper->redirector('indexsize');
	
		$this->view->item = $itemSize;
	}
	
	public function addAction() {
		$form = new App_Form_ItemSizeForm();
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
		
				$itemSize = new App_Model_ItemSize();
				$itemSize->setName			( $formData['name'] );
				$itemSize->setDescription	( $formData['description'] );
				
				$this->_itemSizeDao->save($itemSize);
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
	
		$itemSize = $this->_itemSizeDao->getById($id);
	
		if($itemSize == null)
			$this->_helper->redirector('index');
	
		$form = new App_Form_ItemSizeForm();
		
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				$itemSize->setName			( $formData['name'] );
				$itemSize->setDescription	( $formData['description'] );
				
				$this->_itemSizeDao->save($itemSize);
				$this->_helper->redirector('index');
				return;
			}
			else
				$form->populate($formData);
		}
		else {
			$form = new App_Form_ItemSizeForm();			
		}
		
		if (!empty($itemSize))
			$form->populate($itemSize->toArray());
		
		$this->view->form = $form;
	}
	
	public function removeAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
	
		$itemSize = $this->_itemSizeDao->getById($id);
	
		if($itemSize == null)
			$this->_helper->redirector('index');
	
		$this->view->itemSize = $itemSize;
	
		if ($this->_request->getPost()) {
				
			$this->_itemSizeDao->remove($itemSize);
			$this->_helper->redirector('index');
			return;
		}
	}
}
