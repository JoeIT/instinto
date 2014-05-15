<?php
class App_Dao_ItemColorDao {

	private $entityManager;

	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}

	public function save(App_Model_ItemColor $itemColor) {
		$this->entityManager->persist ( $itemColor );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_ItemColor $itemColor) {
		$this->entityManager->remove ( $itemColor );
		$this->entityManager->flush ();
	}

	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT icolor FROM App_Model_ItemColor icolor ORDER BY icolor.name' );

		return $query->getResult ();
	}
	
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT icolor FROM App_Model_ItemColor icolor WHERE icolor.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
}