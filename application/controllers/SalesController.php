<?php
class SalesController extends Zend_Controller_Action {
	
	private $_saleDao;
	private $_saleTypeDao;
	
	private $_itemDao;
	private $_itemTypeDao;
	private $_itemBrandDao;
	private $_itemSizeDao;
	private $_itemColorDao;
	private $_itemOriginDao;
	
	private $_itemUtils;
	
	const PHOTO_ROOT_URL = "Photos/";
	
	public function init() {
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
		
		$this->_saleDao = new App_Dao_SaleDao();
		$this->_saleTypeDao = new App_Dao_SaleTypeDao();
		
		$this->_itemDao = new App_Dao_ItemDao();
		$this->_itemTypeDao = new App_Dao_ItemTypeDao();
		$this->_itemBrandDao = new App_Dao_ItemBrandDao();
		$this->_itemSizeDao = new App_Dao_ItemSizeDao();
		$this->_itemColorDao = new App_Dao_ItemColorDao();
		$this->_itemOriginDao = new App_Dao_ItemOriginDao();
		
		$this->_itemUtils = new App_Util_ItemUtils();
	}
	
	public function indexAction() {		
	}
	
	public function salesAction() {
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
		
		if ($this->_request->getPost()) {
			$rows = $this->_getParam('sale_index_row');
			$saleDate = $this->_getParam('sale_date');

			for($index = 0; $index <= $rows; $index++)
			{
				$id = $this->_getParam('sale_id_' . $index, '');
				if(!empty($id))
				{
					echo "Saving: $id</br>";
					// Sale saving data
					echo $this->_getParam('sale_type_' . $index) . '</br>';
					echo $this->_getParam('sale_quantity_' . $index) . '</br>';
					echo $this->_getParam('sale_unit_price_' . $index) . '</br>';
					echo $this->_getParam('sale_observation_' . $index) . '</br>';
					
					echo $this->_getParam('sale_client_' . $index) . '</br>';
					echo $this->_getParam('sale_anticipated_payment_' . $index) . '</br>';
					
					echo '</br></br>';
				}
			}
		}
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
	
	public function ajaxaddsaleitemAction() {
		$this->_helper->layout->disableLayout();
		$itemId = $this->_getParam('id', '');
		$this->view->row = $this->_getParam('row', '');
		
		$this->view->item = $this->_itemDao->getById($itemId);
		$this->view->salesType = $this->_saleTypeDao->getAll();
		
		$this->view->photosPath = self::PHOTO_ROOT_URL;
	}	
}