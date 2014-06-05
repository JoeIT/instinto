<?php 

class App_Util_ItemUtils
{
	public function buildSelectArray($fullTypeArray) {
		$result = array();
	
		foreach($fullTypeArray as $type)
		{
			$result[$type->getId()] = $type->getName();
		}
	
		return $result;
	}
	
	public function buildSelectFromArray( $htmlId, $fullDataArray, $thisSelected, $htmlClass, $allowAllOption=false)
	{
		$class = '';
		if(!empty($htmlClass))
			$class = " class='$htmlClass' ";
	
		$selectHtml = "<select id='$htmlId' name='$htmlId' $class >";
	
		if($allowAllOption == true)
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
}