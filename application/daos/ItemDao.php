<?php
class App_Dao_ItemDao {
	
	private $entityManager;
	private $_where = '';
	
	public function __construct() {
		/* Initialize action controller here */
		$registry = Zend_Registry::getInstance ();
		$this->entityManager = $registry->entityManager;
	}
	
	public function save(App_Model_Item $item) {
		$this->entityManager->persist ( $item );
		$this->entityManager->flush ();
	}
	
	public function remove(App_Model_Item $item) {
		$this->entityManager->remove($item);
		$this->entityManager->flush();
	}
	
	public function getAll() {
		$query = $this->entityManager->createQuery ( 'SELECT i FROM App_Model_Item i ORDER BY i.creationDate DESC' );
		
		return $query->getResult ();
	}

	// ----------------------------------------------------------------
	// Return the number of variety items
	public function countTotalAll() {
		$query = $this->entityManager->createQuery ( 'SELECT SUM(i.quantity) FROM App_Model_Item i' );
	
		$result = $query->getResult ();
		return $result [0][1];
	}
	
	// ----------------------------------------------------------------
	// Return the number of variety items
	public function countAll() {
		$query = $this->entityManager->createQuery ( 'SELECT COUNT(i) FROM App_Model_Item i' );

		$result = $query->getResult ();
		return $result [0][1];
	}
	
	public function getAllLimitOffset($limit, $offset) {
		$query = $this->entityManager->createQuery ( 'SELECT i FROM App_Model_Item i ORDER BY i.creationDate DESC' )->setFirstResult ( $offset )->setMaxResults ( $limit );
		
		return $query->getResult ();
	}
	
	// ----------------------------------------------------------------
	// Return the number of variety items from the search result
	public function countSearchAll() {
		$query = $this->entityManager->createQuery ( "SELECT COUNT(i) FROM App_Model_Item i " . $this->_where );	
		$result = $query->getResult ();
		
		return $result [0][1];
	}
	
	public function getSearchLimitOffset($limit, $offset) {
		$query = $this->entityManager->createQuery ( "SELECT i FROM App_Model_Item i ". $this->_where ." ORDER BY i.code ASC, i.size ASC, i.color ASC" )->setFirstResult ( $offset )->setMaxResults ( $limit );
		//$query = $this->entityManager->createQuery ( "SELECT i FROM App_Model_Item i WHERE i.type = '3'" )->setFirstResult ( $offset )->setMaxResults ( $limit );
		//$query = $this->entityManager->createQuery ( 'SELECT i FROM App_Model_Item i $where ORDER BY i.code, i.newCode, i.accountingCode' )->setFirstResult ( $offset )->setMaxResults ( $limit );
		
		return $query->getResult ();
	}
	
	public function createSearchWhere($brand, $type, $size, $color, $origin, $code) {
		$this->_where = '';
		
		if( !empty($brand) )
			$this->_where .= " AND i.brand = '$brand' ";
		if( !empty($type) )
			$this->_where .= " AND i.type = '$type' ";
		if( !empty($size) )
			$this->_where .= " AND i.size = '$size' ";
		if( !empty($color) )
			$this->_where .= " AND i.color = '$color' ";
		if( !empty($origin) )
			$this->_where .= " AND i.origin = '$origin' ";
		if( !empty($code) || $code == '0' )
			$this->_where .= " AND i.code LIKE '%$code%' ";
		
		if( !empty($this->_where) )
			$this->_where = ' WHERE ' . substr($this->_where, 4); // The substring is required to eliminate de first AND	
	}
	
	// ----------------------------------------------------------------
	public function getById($id) {
		$query = $this->entityManager->createQuery( "SELECT i FROM App_Model_Item i WHERE i.id = $id" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}
	
	public function getByCode($code) {
		$query = $this->entityManager->createQuery( "SELECT i FROM App_Model_Item i WHERE i.code = '$code'" );
		$arrayResult = $query->getResult();
		if(count($arrayResult) > 0)
			return $arrayResult[0];
		else
			return null;
	}	
}