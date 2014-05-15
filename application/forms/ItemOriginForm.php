<?php
class App_Form_ItemOriginForm extends Zend_Form
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setMethod('post');		
		$this->getView()->setEscape('stripslashes');
				
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel("Nombre (*):");
		$name->setRequired(true);
		$name->setAttrib('class', 'css-input_text_form');
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'GUARDAR'));
		
		$this->addElements(array(
				$name, 
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
}