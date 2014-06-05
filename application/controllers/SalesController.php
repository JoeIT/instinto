<?php
class SalesController extends Zend_Controller_Action {
	
	private $_itemDao;
	
	private $_itemUtils;
	
	public function init() {
		$this->_itemDao = new App_Dao_ItemDao ();
		$this->_itemTypeDao = new App_Dao_ItemTypeDao();
		$this->_itemBrandDao = new App_Dao_ItemBrandDao();
		$this->_itemSizeDao = new App_Dao_ItemSizeDao();
		$this->_itemColorDao = new App_Dao_ItemColorDao();
		$this->_itemOriginDao = new App_Dao_ItemOriginDao();
		
		
		$this->_itemUtils = new App_Util_ItemUtils();
	}
	
	public function indexAction() {
		$brandSelected = '';
		$typeSelected = '';
		$sizeSelected = '';
		$colorSelected = '';
		$originSelected = '';
		
		$this->view->brandSelect	= $this->_itemUtils->buildSelectFromArray( 'brand_select_search', $this->_itemBrandDao->getAll(), $brandSelected, 'search_component', true );
		$this->view->typeSelect		= $this->_itemUtils->buildSelectFromArray( 'type_select_search', $this->_itemTypeDao->getAll(), $typeSelected, 'search_component', true );
		$this->view->sizeSelect		= $this->_itemUtils->buildSelectFromArray( 'size_select_search', $this->_itemSizeDao->getAll(), $sizeSelected, 'search_component', true );
		$this->view->colorSelect	= $this->_itemUtils->buildSelectFromArray( 'color_select_search', $this->_itemColorDao->getAll(), $colorSelected, 'search_component', true );
		$this->view->originSelect	= $this->_itemUtils->buildSelectFromArray( 'origin_select_search', $this->_itemOriginDao->getAll(), $originSelected, 'search_component', true );
	}
	
	public function ajaxfinditemAction() {
		$this->_helper->layout->disableLayout();
		
		$itemSearch = $this->_getParam('itemSearch', '');
		$brand = $this->_getParam('brand', '');
		$type = $this->_getParam('type', '');
		$size = $this->_getParam('size', '');
		$color = $this->_getParam('color', '');
		$code = $this->_getParam('code', '');
		
		$this->_itemDao->createSearchWhere($brand, $type, $size, $color, '', $code);
		$this->view->itemResults = $this->_itemDao->getSearchLimitOffset(999999, 0);
	}	
}