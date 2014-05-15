<?php
class App_Dao_ItemBrandDao {

	private $entityManager;

	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}

	public function save(App_Model_ItemBrand $itemBrand) {
		$this->entityManager->persist ( $itemBrand );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_ItemBrand $itemBrand) {
		$this->entityManager->remove ( $itemBrand );
		$this->entityManager->flush ();
	}

	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT ibrand FROM App_Model_ItemBrand ibrand ORDER BY ibrand.name' );

		return $query->getResult ();
	}
	
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT ibrand FROM App_Model_ItemBrand ibrand WHERE ibrand.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
}