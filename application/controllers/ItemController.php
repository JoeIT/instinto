<?php
class ItemController extends Zend_Controller_Action {
	
	private $_search;
	
	private $_itemDao;
	private $_itemTypeDao;
	private $_itemBrandDao;
	private $_itemColorDao;
	private $_itemOriginDao;
	private $_itemSizeDao;
	
	const PHOTO_ROOT_URL = "Photos/";
	
	private $ROOT_PATH;
	
	public function init() {
		/* Initialize action controller here */
		$this->_itemDao = new App_Dao_ItemDao ();
		$this->_itemTypeDao = new App_Dao_ItemTypeDao();
		$this->_itemBrandDao = new App_Dao_ItemBrandDao();
		$this->_itemSizeDao = new App_Dao_ItemSizeDao();
		$this->_itemColorDao = new App_Dao_ItemColorDao();
		$this->_itemOriginDao = new App_Dao_ItemOriginDao();
		
		//echo date('H:i:s');
		/*
		$uri = "$_SERVER[REQUEST_URI]";
		$uriPathArray = explode('/', $uri );
		$this->ROOT_PATH = "http://$_SERVER[HTTP_HOST]" . '/' . $uriPathArray[1] . '/'; // http://localhost/zf/
		$this->view->rootPath = $this->ROOT_PATH . 'public/';*/
		
		$this->view->rootPath = $this->getFrontController()->getBaseUrl() . '/'; // /zf/public/
	}
	
	public function indexAction() {
		$page 				= $this->_getParam ( 'page', 1 );
		$brandSelected 		= $this->_getParam ( 'brand', '' );
		$typeSelected 		= $this->_getParam ( 'type', '' );
		$sizeSelected		= $this->_getParam ( 'size', '' );
		$colorSelected		= $this->_getParam ( 'color', '' );
		$originSelected		= $this->_getParam ( 'origin', '' );
		$code 				= $this->_getParam ( 'code', '' );
		
		$extraSearchURL = '';
		if( !empty($brandSelected) )
			$extraSearchURL .= "/brand/$brandSelected";
		if( !empty($typeSelected) )
			$extraSearchURL .= "/type/$typeSelected";
		if( !empty($sizeSelected) )
			$extraSearchURL .= "/size/$sizeSelected";
		if( !empty($colorSelected) )
			$extraSearchURL .= "/color/$color";
		if( !empty($originSelected) )
			$extraSearchURL .= "/origin/$originSelected";
		if( !empty($code) )
			$extraSearchURL .= "/code/$code";
		
		$this->_itemDao->createSearchWhere($brandSelected, $typeSelected, $sizeSelected, $colorSelected, $originSelected, $code);
		$totalItems = $this->_itemDao->countSearchAll();
		
		$paginator = new App_Util_Paginator( $this->getRequest()->getBaseUrl() . '/item/index', $totalItems, $page, 50 );
		$paginator->addExtraUrlData($extraSearchURL);
		
		$this->view->totalItems = $totalItems;
		$this->view->dataList = $this->_itemDao->getSearchLimitOffset($paginator->getLimit(), $paginator->getOffset() );
		$this->view->htmlPaginator = $paginator->showHtmlPaginator();
		
		$this->view->brandSelect	= $this->_buildSelectFromArray( 'brand', $this->_itemBrandDao->getAll(), $brandSelected, 'search_component' );
		$this->view->typeSelect		= $this->_buildSelectFromArray( 'type', $this->_itemTypeDao->getAll(), $typeSelected, 'search_component');
		$this->view->sizeSelect		= $this->_buildSelectFromArray( 'size', $this->_itemSizeDao->getAll(), $sizeSelected, 'search_component');
		$this->view->colorSelect	= $this->_buildSelectFromArray( 'color', $this->_itemColorDao->getAll(), $colorSelected, 'search_component' );
		$this->view->originSelect	= $this->_buildSelectFromArray( 'origin', $this->_itemOriginDao->getAll(), $originSelected, 'search_component' );
		$this->view->code			= $code;
		$this->view->extraSearchURL = $extraSearchURL;
	}
	
	public function viewAction() {
		$id = $this->_getParam('id', '');
		
		if(empty($id))
			$this->_helper->redirector('index');

		$item = $this->_itemDao->getById($id);
		if($item == null)
			$this->_helper->redirector('index');
		
		$this->view->item = $item;
		$this->view->photosPath = self::PHOTO_ROOT_URL;
	}
	
	public function addAction() {
		$form = new App_Form_ItemForm();
		
		$this->_loadFormSelects($form);
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				
				$item = new App_Model_Item();
				$item->setCode			( $formData['code'] );
				$item->setBrand			( $this->_itemBrandDao->getById($formData['brand_select']) );
				$item->setType			( $this->_itemTypeDao->getById($formData['type_select']) );
				$item->setColor			( $this->_itemColorDao->getById($formData['color_select']) );
				$item->setSize			( $this->_itemSizeDao->getById($formData['size_select']) );
				$item->setOrigin		( $this->_itemOriginDao->getById($formData['origin_select']) );
				$item->setQuantity		( $formData['quantity'] );
				$item->setPrice			( $formData['price'] );
				$item->setFinalPrice	( $formData['finalPrice'] );
				$item->setCost			( $formData['cost'] );
				$item->setDescription	( $formData['description'] );
				$item->setCreationDate	( date_create(date('Y-m-d H:m:s')) );
				
				$photoUrl = $item->getCode();
				
				$item->setPhotoDir($photoUrl);
				
				$dirPermission = "0777";
				if( mkdir( self::PHOTO_ROOT_URL . $photoUrl, $dirPermission) )
				{
					$this->_itemDao->save($item);
					$this->_helper->redirector('index');
					return;
				}
				else
					$this->view->message = "Error al crear directorio de fotografias.";
			}
		}
		$this->view->form = $form;
	}
	
	public function editAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
		
		$item = $this->_itemDao->getById($id);
		
		if($item == null)
			$this->_helper->redirector('index');
		
		$form = new App_Form_ItemForm();
		$this->_loadFormSelects($form);
		
		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
		
			if ($form->isValid($formData)) {
				
				$lastCode = $item->getCode();
				
				$item->setCode			( $formData['code'] );
				$item->setBrand			( $this->_itemBrandDao->getById($formData['brand_select']) );
				$item->setType			( $this->_itemTypeDao->getById($formData['type_select']) );
				$item->setColor			( $this->_itemColorDao->getById($formData['color_select']) );
				$item->setSize			( $this->_itemSizeDao->getById($formData['size_select']) );
				$item->setOrigin		( $this->_itemOriginDao->getById($formData['origin_select']) );
				$item->setQuantity		( $formData['quantity'] );
				$item->setPrice			( $formData['price'] );
				$item->setFinalPrice	( $formData['finalPrice'] );
				$item->setCost			( $formData['cost'] );
				$item->setDescription	( $formData['description'] );
				$item->setModifiedDate	( date_create(date('Y-m-d H:m:s')) );
		
				$newPhotoUrl = "";
				
				if( $lastCode != $item->getCode() )
					$newPhotoUrl = $item->getCode();
				
				if( !empty( $newPhotoUrl ) && !empty( $lastCode ) ) {
					if( rename( self::PHOTO_ROOT_URL . $lastCode, self::PHOTO_ROOT_URL . $newPhotoUrl) )
					{
						$item->setPhotoDir( $newPhotoUrl );
						$this->_itemDao->save($item);
						$this->_helper->redirector->gotoUrl("item/view/id/$id");
						return;
					}
					else
						$this->view->message = "Error al renombrar directorio de fotografias.";
				}
				else if( !empty( $newPhotoUrl ) && empty( $lastCode ) ) {
					$dirPermission = "0777";
					if( mkdir( self::PHOTO_ROOT_URL . $newPhotoUrl, $dirPermission) )
					{
						$this->_itemDao->save($item);
						$this->_helper->redirector('index');
						return;
					}
					else
						$this->view->message = "Error al crear directorio de fotografias.";
				}
				else {
					$this->_itemDao->save($item);
					$this->_helper->redirector->gotoUrl("item/view/id/$id");
					return;
				}
			}
		}
		else {
			$form = new App_Form_ItemForm();
		}
		
		if (!empty($item)) {
			$form->populate($item->toArray());
			$form->enableEditFormExtraConfig();
			
			$this->_loadFormSelects($form);
			
			// 
			$form->type_select->		setValue( $item->getType()->getId() );
			$form->brand_select->		setValue( $item->getBrand()->getId() );
			$form->size_select->		setValue( $item->getSize()->getId() );
			$form->color_select->		setValue( $item->getColor()->getId() );
			$form->origin_select->		setValue( $item->getOrigin()->getId() );
		}
		
		$this->view->item = $item;
		$this->view->form = $form;
		$this->view->photosPath = self::PHOTO_ROOT_URL;
	}
	
	public function removeAction() {
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
		
		$item = $this->_itemDao->getById($id);
		
		if($item == null)
			$this->_helper->redirector('index');
		
		$this->view->item = $item;
		$this->view->photosPath = self::PHOTO_ROOT_URL;
		
		if ($this->_request->getPost()) {
			
			rename( self::PHOTO_ROOT_URL . $item->getPhotoDir(), self::PHOTO_ROOT_URL . "(BORRADO)" . $item->getPhotoDir() );
			
			$this->_itemDao->remove($item);
			$this->_helper->redirector('index');
			return;
		}
	}
	
	public function toxlsxAction() {
		$this->_helper->layout->disableLayout();
		
		$code 				= $this->_getParam ( 'code', '' );
		$typeSelected 		= $this->_getParam ( 'type', '' );
		$brandSelected 		= $this->_getParam ( 'brand', '' );
		$originSelected		= $this->_getParam ( 'origin', '' );
		$colorSelected		= $this->_getParam ( 'color', '' );
		$sizeSelected		= $this->_getParam ( 'size', '' );
		
		$this->_itemDao->createSearchWhere($brandSelected, $typeSelected, $sizeSelected, $colorSelected, $originSelected, $code);
		
		$excel = new App_Util_XlsxGenerator();
		$items = $this->_itemDao->getSearchLimitOffset(99999, 0);
		
		foreach($items as $item)
		{
			$dataArray = array(
					$item->getType()->getName(),
					$item->getBrand()->getName(),
					$item->getSize()->getName(),
					$item->getColor()->getName(),
					$item->getQuantity(),
					$item->getPrice(),
					$item->getFinalPrice(),
					$item->getDescription(),
					$item->getOrigin()->getName(),
					$item->getCode(),
					$item->getCost()
			);
			
			$excel->addRow($dataArray, false);
		}
		
		$excel->saveDocument();
	}
	
	public function ajaxrefreshselectelementAction() {
		$this->_helper->layout->disableLayout();
		
		$selectElement = $this->_getParam('selectElement', '');
		$optionSelected = $this->_getParam('optionSelected', '');
		
		if( empty($selectElement)) {
			echo "";
			return;
		}
		
		$optionsArray = array();
		
		switch($selectElement)
		{
			case 'brand_select':
				$optionsArray = $this->_itemBrandDao->getAll();
				break;
			case 'type_select':
				$optionsArray = $this->_itemTypeDao->getAll();
				break;
			case 'color_select':
				$optionsArray = $this->_itemColorDao->getAll();
				break;
			case 'size_select':
				$optionsArray = $this->_itemSizeDao->getAll();
				break;
			case 'origin_select':
				$optionsArray = $this->_itemOriginDao->getAll();
				break;
			default:
				return;
		}
		
		$this->view->selectId = $selectElement;
		$this->view->optionSelected = $optionSelected;
		$this->view->options = $optionsArray;		
	}
	
	private function _loadFormSelects(&$form) {
		$form->brand_select->		addMultiOptions( $this->_buildSelectArray( $this->_itemBrandDao->getAll() ) );
		$form->type_select->		addMultiOptions( $this->_buildSelectArray( $this->_itemTypeDao->getAll() ));
		$form->color_select->		addMultiOptions( $this->_buildSelectArray( $this->_itemColorDao->getAll() ) );
		$form->size_select->		addMultiOptions( $this->_buildSelectArray( $this->_itemSizeDao->getAll() ) );
		$form->origin_select->		addMultiOptions( $this->_buildSelectArray( $this->_itemOriginDao->getAll() ) );
	}
	
	private function _buildSelectArray($fullTypeArray) {
		$result = array();
		
		foreach($fullTypeArray as $type)
		{
			$result[$type->getId()] = $type->getName(); 
		}

		return $result;
	}
	
	private function _buildSelectFromArray( $htmlId, $fullDataArray, $thisSelected, $htmlClass='')
	{
		$class = '';
		if(!empty($htmlClass))
			$class = " class='$htmlClass' ";
		
		$selectHtml = "<select id='$htmlId' name='$htmlId' $class >";
		$selectHtml .= "<option value=''>TODOS</option>";
	
		foreach($fullDataArray as $type)
		{
			$selected = '';
			if($type->getId() == $thisSelected)
				$selected = 'selected';
			
			$selectHtml .= "<option value='". $type->getId() ."' $selected >". $type->getName() ."</option>";
		}
	
		$selectHtml .= "</select>";
	
		return $selectHtml;
	}
	
	public function testAction() {
		
		
		/*
		// PHPExcel
		include '../library/PHPExcel/PHPExcel.php';
		// PHPExcel_Writer_Excel2007
		include '../library/PHPExcel/PHPExcel/Writer/Excel2007.php';
		
		
		// Create new PHPExcel object
		$this->objPHPExcel = new PHPExcel();
		
		$this->objPHPExcel->setActiveSheetIndex(0);
		
		$this->borderStyleArray = array(
				'borders' => array(
						'outline' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => '00000000'),
						),
				),
		);
		
		$this->headerStyleArray = array(
				'font' => array(
						'bold' => true
				)
		);
		
		$documentName = 'Administracion de activos fijos';
		
		// Setting properties
		$this->objPHPExcel->getProperties()->setCreator($documentName);
		$this->objPHPExcel->getProperties()->setTitle($documentName);
		
		// Renaming sheet
		$this->objPHPExcel->getActiveSheet()->setTitle($documentName);
		
		$this->objPHPExcel->getActiveSheet()->mergeCells("A1:R1");
		$this->objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(75);
		$this->addRow(array($documentName), true, false);
		
		
		$headersTable = array('Codigo',
				'Nuevo codigo',
				'codigo contable',
				'Tipo',
				'Nombre',
				'Marca',
				'Material',
				'Color',
				'Procedencia',
				'Ubicacion',
				'Propietario',
				'Cantidad',
				'Costo unitario',
				'Costo esperado',
				'Costo de venta',
				'Estado',
				'Disponibilidad',
				'Observaciones');
						
				// Adding data row
		$this->addRow( $headersTable, true, false );
		
		
		$this->objPHPExcel->getActiveSheet()->setShowRowColHeaders(true);
		$this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setFirstHeader(true);
		
		// Save Excel 2007 file and redirect output to client browser
		header('Content-Type: application/vnd.ms-excel');
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $documentName .'.xlsx"');
		header('Cache-Control: max-age=0');
		
		$this->objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
		$this->objWriter->save('php://output');*/
		
		
		
		
		/*$uri = "$_SERVER[REQUEST_URI]";
			$arr = explode('/', $uri );
			
		$path = "$_SERVER[HTTP_HOST]" . '/' . $arr[1] . '/';
		
		echo "<br/>Test Path: http://$path";*/
		
		// Create directory, with full permissions
		//mkdir("NewDir", "0777");
		// Rename
		//rename("newDir", "renameDir");
	
		/*
			$indicesServer = array('PHP_SELF',
					'argv',
					'argc',
					'GATEWAY_INTERFACE',
					'SERVER_ADDR',
					'SERVER_NAME',
					'SERVER_SOFTWARE',
					'SERVER_PROTOCOL',
					'REQUEST_METHOD',
					'REQUEST_TIME',
					'REQUEST_TIME_FLOAT',
					'QUERY_STRING',
					'DOCUMENT_ROOT',
					'HTTP_ACCEPT',
					'HTTP_ACCEPT_CHARSET',
					'HTTP_ACCEPT_ENCODING',
					'HTTP_ACCEPT_LANGUAGE',
					'HTTP_CONNECTION',
					'HTTP_HOST',
					'HTTP_REFERER',
					'HTTP_USER_AGENT',
					'HTTPS',
					'REMOTE_ADDR',
					'REMOTE_HOST',
					'REMOTE_PORT',
					'REMOTE_USER',
					'REDIRECT_REMOTE_USER',
					'SCRIPT_FILENAME',
					'SERVER_ADMIN',
					'SERVER_PORT',
					'SERVER_SIGNATURE',
					'PATH_TRANSLATED',
					'SCRIPT_NAME',
					'REQUEST_URI',
					'PHP_AUTH_DIGEST',
					'PHP_AUTH_USER',
					'PHP_AUTH_PW',
					'AUTH_TYPE',
					'PATH_INFO',
					'ORIG_PATH_INFO') ;
	
		echo "<br/>";
	
	
		echo '<table cellpadding="10">' ;
		foreach ($indicesServer as $arg) {
		if (isset($_SERVER[$arg])) {
		echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
		}
		else {
		echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
		}
		}
		echo '</table>' ;
		*/
	}	
}