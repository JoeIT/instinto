<?php
// PHPExcel
include '../library/PHPExcel/PHPExcel.php';
// PHPExcel_Writer_Excel2007
include '../library/PHPExcel/PHPExcel/Writer/Excel2007.php';

class App_Util_XlsxGenerator
{
	private $objPHPExcel = null;
	private $row = 1;
	private $documentName = 'Listado';
	
	private $rowLimiter = '@';
	private $colLimiter = '|';
	
	private $borderStyleArray = null;
	private $headerStyleArray = null;
	
	public function __construct()
	{
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
		
		// Setting properties
		$this->objPHPExcel->getProperties()->setCreator($this->documentName);
		//$this->objPHPExcel->getProperties()->setTitle($this->documentName);
		
		// Renaming sheet
		$this->objPHPExcel->getActiveSheet()->setTitle($this->documentName);
	
		$this->objPHPExcel->getActiveSheet()->mergeCells("A1:S1");
		$this->objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(75);
		$this->addRow(array($this->documentName), true);
		
		
		$headersTable = array('Tipo',
							'Marca',
							'Talla',
							'Color',
							'Cantidad',
							'Precio',
							'Precio final',
							'Descripcion',
							'Proveedor',
							'Codigo',
							'Costo');
		
		// Adding data row
		$this->addRow( $headersTable, true );
	}
	
	public function parseTable($table)
	{
		$matrixData = explode($this->rowLimiter, $table);
		
		foreach($matrixData as $row)
		{
			if( !empty($row) )
				$this->addRow( explode($this->colLimiter, $row), false );
		}
	}
	
	public function addRow($arrayData, $isHeader)
	{
		$i = 0;
		
		foreach($arrayData as $value)
		{
			$this->objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(''.$i, ''.$this->row, $value);
			
			if( $isHeader )
			{
				// Adding header settings
				// Setting autosize for each column
				$this->objPHPExcel->getActiveSheet()->getColumnDimensionByColumn(''.$i)->setAutoSize(true);
				
				// To allow multiline cells
				$this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i, $this->row)->getAlignment()->setWrapText(true);
				
				// Setting the backgroud color
				$this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i, $this->row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFCDFFCC'); 
				
				// Setting font
				$this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i, $this->row)->applyFromArray($this->headerStyleArray);
				
				// Setting center align
				$this->objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i, $this->row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			
			$i ++;
		}
		
		$this->row ++;
	}
	
	public function saveDocument()
	{
		$this->objPHPExcel->getActiveSheet()->setShowRowColHeaders(true);
		$this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setFirstHeader(true);
		
		// Save Excel 2007 file and redirect output to client browser
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $this->documentName .'.xlsx"');
		//header('Cache-Control: max-age=0');
		
		$this->objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
		$this->objWriter->save('php://output');
	}


}

//$table = $_GET['table'];

//$eg = new App_Util_XlsxGenerator();
//$eg->parseTable($table);
//$eg->saveDocument()

?>