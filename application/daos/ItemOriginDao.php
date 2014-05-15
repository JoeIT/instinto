<?php
class App_Dao_ItemOriginDao {
	private $entityManager;
	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}
	
	public function save(App_Model_ItemOrigin $itemOrigin) {
		$this->entityManager->persist ( $itemOrigin );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_ItemOrigin $itemOrigin) {
		$this->entityManager->remove ( $itemOrigin );
		$this->entityManager->flush ();
	}
	
	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT iorigin FROM App_Model_ItemOrigin iorigin ORDER BY iorigin.name' );
		
		return $query->getResult ();
	}
	
	// Return the number of total item origins
	public function countAll() {
		$query = $this->entityManager->createQuery ( 'SELECT COUNT(iorigin) FROM App_Model_ItemOrigin iorigin' );
		
		$result = $query->getResult ();
		return $result [0] [1];
	}
	
	// ----------------------------------------------------------------
	public function getAllLimitOffset($limit, $offset) {
		$query = $this->entityManager->createQuery ( 'SELECT iorigin FROM App_Model_ItemOrigin iorigin ORDER BY iorigin.name' )->setFirstResult ( $offset )->setMaxResults ( $limit );
		
		return $query->getResult ();
	}
	
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT iorigin FROM App_Model_ItemOrigin iorigin WHERE iorigin.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
}
	