<?php
class App_Dao_SaleTypeDao {
	
	private $entityManager;
	
	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}
	
	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT sType FROM App_Model_SaleType sType' );
	
		return $query->getResult ();
	}
	
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT sType FROM App_Model_SaleType sType WHERE sType.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
}