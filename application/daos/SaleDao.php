<?php
class App_Dao_SaleDao {
	
	private $entityManager;
	private $_where = '';
	
	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}
	
	public function save(App_Model_Sale $item) {
		$this->entityManager->persist ( $item );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_Sale $item) {
		$this->entityManager->remove($item);
		$this->entityManager->flush();
	}
	
	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT s FROM App_Model_Sale s ORDER BY s.saleDate DESC' );
		
		return $query->getResult ();
	}
	
	public function getQuantity($saleType, $itemId) {
		$itemDao = new App_Dao_ItemDao();
		$quantity = $itemDao->getById($itemId);		
	}
}