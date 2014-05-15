<?php
class App_Dao_ItemTypeDao {
	
	private $entityManager;
	
	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}
	
	public function save(App_Model_ItemType $itemType) {
		$this->entityManager->persist ( $itemType );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_ItemType $itemType) {
		$this->entityManager->remove ( $itemType );
		$this->entityManager->flush ();
	}
	
	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT itype FROM App_Model_ItemType itype ORDER BY itype.name' );
	
		return $query->getResult ();
	}
	
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT itype FROM App_Model_ItemType itype WHERE itype.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
}