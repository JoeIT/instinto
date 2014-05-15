<?php
class App_CustomDecorator_InputData extends Zend_Form_Decorator_Abstract
{
	protected $_format = '<label for="%s">%s</label> <input id="%s" name="%s" type="text" value="%s" /><br/><br/>';
	 
	public function render($content)
	{
		$element = $this->getElement();
		
		$type	= str_replace("zend_form_element_", "", strtolower($element->getType()));
		$name	= htmlentities($element->getFullyQualifiedName());
		$label	= htmlentities($element->getLabel());
		$id		= htmlentities($element->getId());
		$value	= htmlentities($element->getValue());
		
		$markup  = sprintf($this->_format, $name, $label, $id, $name, $value);
		return $markup;
	}
}