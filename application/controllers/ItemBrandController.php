<?php
class ItemBrandController extends Zend_Controller_Action {
	
	private $_itemBrandDao;
	
	public function init()
	{
		$this->_itemBrandDao = new App_Dao_ItemBrandDao ();
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
	}
	
	public function indexAction() {		
		$this->view->dataList = $this->_itemBrandDao->getAll();		
	}
	
	public function viewAction() {
		$id = $this->_getParam('id', '');
	
		if(empty($id))
			$this->_helper->redirector('indexbrand');
		
		$itemBrand = $this->_itemBrandDao->getById($id);
		
		if($itemBrand == null)
			$this->_helper->redirector('indexbrand');
	
		$this->view->item = $itemBrand;
	}
	
	public function addAction() {
		$form = new App_Form_ItemBrandForm();
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
		
				$itemBrand = new App_Model_ItemBrand();
				$itemBrand->setName			( $formData['name'] );
				$itemBrand->setDescription	( $formData['description'] );
				
				$this->_itemBrandDao->save($itemBrand);
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
	
		$itemBrand = $this->_itemBrandDao->getById($id);
	
		if($itemBrand == null)
			$this->_helper->redirector('index');
	
		$form = new App_Form_ItemBrandForm();
		
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				$itemBrand->setName			( $formData['name'] );
				$itemBrand->setDescription	( $formData['description'] );
				
				$this->_itemBrandDao->save($itemBrand);
				$this->_helper->redirector('index');
				return;
			}
			else
				$form->populate($formData);
		}
		else {
			$form = new App_Form_ItemBrandForm();			
		}
		
		if (!empty($itemBrand))
			$form->populate($itemBrand->toArray());
		
		$this->view->form = $form;
	}
	
	public function removeAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
	
		$itemBrand = $this->_itemBrandDao->getById($id);
	
		if($itemBrand == null)
			$this->_helper->redirector('index');
	
		$this->view->itemBrand = $itemBrand;
	
		if ($this->_request->getPost()) {
			
			$this->_itemBrandDao->remove($itemBrand);
			$this->_helper->redirector('index');
			return;
		}
	}
}
