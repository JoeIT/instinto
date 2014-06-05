<?php
class App_Form_ItemForm extends Zend_Form
{
	public function __construct($modify = false)
	{
		parent::__construct();
		
		$this->setMethod('post');		
		$this->getView()->setEscape('stripslashes');
		
		//$this->setElementDecorators(array(new App_CustomDecorator_InputData()) );
		//$id = new Zend_Form_Element_Hidden('id');
		
		$type = new Zend_Form_Element_Select('type_select');
		//$type->addMultiOptions($this->typeArray);
		$type->setLabel("Tipo (*):");
		$type->setRequired(true);
		
		$brand = new Zend_Form_Element_Select('brand_select');
		$brand->setLabel("Marca:");
		$brand->setRequired(false);
		
		if($modify == true)
		{
			$color = new Zend_Form_Element_Select('color_select');
			$color->setLabel("Color:");
			$color->setRequired(false);
			
			$size = new Zend_Form_Element_Select('size_select');
			$size->setLabel("Talla:");
			$size->setRequired(false);
			
			$availability = new Zend_Form_Element_Select('availability_select');
			$availability->setLabel("Disponibilidad:");
			$availability->setRequired(false);
		}		
		
		$quantity = new Zend_Form_Element_Text('quantity');
		$quantity->setLabel("Cantidad:");
		$quantity->addValidator( new Zend_Validate_Float() );
		$quantity->setValue("0");
		$quantity->setRequired(true);
		$quantity->setAttrib('class', 'css-input_number_form');
		
		$price = new Zend_Form_Element_Text('price');
		$price->setLabel("Precio unid.:");
		$price->addValidator( new Zend_Validate_Float() );
		$price->setValue("0.00");
		$price->setRequired(false);
		$price->setAttrib('class', 'css-input_number_form');
		
		$finalPrice = new Zend_Form_Element_Text('finalPrice');
		$finalPrice->setLabel("Precio final unid.:");
		$finalPrice->addValidator( new Zend_Validate_Float() );
		$finalPrice->setValue("0.00");
		$finalPrice->setRequired(false);
		$finalPrice->setAttrib('class', 'css-input_number_form');
		
		$origin = new Zend_Form_Element_Select('origin_select');
		$origin->setLabel("Procedencia:");
		$origin->setRequired(false);
		
		$cost = new Zend_Form_Element_Text('cost');
		$cost->setLabel("Costo:");
		$cost->addValidator( new Zend_Validate_Float() );
		$cost->setValue("0.00");
		$cost->setRequired(false);
		$cost->setAttrib('class', 'css-input_number_form');
		
		$code = new Zend_Form_Element_Text('code');
		$code->setLabel("Codigo (*):");
		//$code->addValidator( new App_CustomZendValidator_CodeExist("code") );
		//$code->setRequired(true)->addErrorMessage('No puede estar vacio.');
		$code->setRequired(true);
		$code->setAttrib('class', 'css-input_text_form');
		
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel("Descripcion:");
		$description->setAttrib("cols", "40");
		$description->setAttrib("rows", "8");
		
		$detailRowsNumber = new Zend_Form_Element_Hidden('detail_rows_number');
		$detailRowsNumber->setValue("0");
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'GUARDAR'));
		
		if($modify == false)
			$this->addElements(array(
					//$id, 
					$type,
					$code,
					$brand,
					$cost,
					$price, 
					$finalPrice, 
					$description, 
					$origin, 
					$detailRowsNumber, 
					$submit));
		else
			$this->addElements(array(
					//$id,
					$type,
					$code,
					$brand,
					$color,
					$size,
					$availability, 
					$cost,
					$quantity,
					$price,
					$finalPrice,
					$description,
					$origin,
					$detailRowsNumber,
					$submit));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag', array('tag' => 'table')),
				'Form'
		));
		$this->setElementDecorators(array(
				'ViewHelper',
				'Errors',
				array(array('data' => 'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
		));
	}
	
	public function enableEditFormExtraConfig() {
		//$this->_elements['newCode']->addValidator( new App_CustomZendValidator_CodeExist("newCode") );
		
		
		//print_r($this->_elements);
		//$this->getElement("newCode")->setValue("otros");
		
		//$code->addValidator( new App_CustomZendValidator_CodeExist("code") );
		//$newCode->addValidator( new App_CustomZendValidator_CodeExist("newCode") );
		//$accountingCode->addValidator( new App_CustomZendValidator_CodeExist("accountingCode") );
	}
}