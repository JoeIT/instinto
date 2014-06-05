<?php
class App_Dao_ItemSizeDao {

	private $entityManager;

	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}

	public function save(App_Model_ItemSize $item) {
		$this->entityManager->persist ( $item );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_ItemSize $item) {
		$this->entityManager->remove($item);
		$this->entityManager->flush();
	}

	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT isize FROM App_Model_ItemSize isize' );

		return $query->getResult ();
	}
	
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT isize FROM App_Model_ItemSize isize WHERE isize.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
}