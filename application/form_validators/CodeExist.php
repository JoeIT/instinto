<?php 
class App_CustomZendValidator_CodeExist extends Zend_Validate_Abstract
{
	const MSG_CODE_EXIST = 'msgCode';
	
	private $codeDBType;
	private $itemId;
	
	protected $_messageTemplates = array(
		self::MSG_CODE_EXIST => "'%value%' ya se encuentra registrado."
    );
	
	public function __construct($itemId, $codeType){
		$this->itemId = $itemId;
		$this->codeDBType = $codeType;
	}
	
	public function isValid($value) {
		$this->_setValue($value);
		
		$itemDao = new App_Dao_ItemDao();
		
		switch($this->codeDBType)
		{
			case 'code':
				$item = $itemDao->getByCode($value);
				break;
			case 'newCode':
				$item = $itemDao->getByNewCode($value);
				break;
			case 'accountingCode':
				$item = $itemDao->getByAccountingCode($value);
				break;
			default:
				break;
		}
		
		if( $item != null )
		{
			///// COMPROBAR SI EL ITEM EXISTENTE NO ES EL MISMO Q EL Q SE QIERE COMPROBAR
			
			$this->_error(self::MSG_CODE_EXIST);
			return false;
		}
		
		return true;
    }
}