<?php
/**
 * Sale
*
* @Entity
* @Table(name="sales")
*/
class App_Model_Sale {
	/**
	 * @var integer
	 *
	 * @Column(name="id", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	/**
	 * @var App_Model_Item
	 *
	 * @ManyToOne(targetEntity="App_Model_Item")
	 * @JoinColumn(name="item_code", referencedColumnName="id")
	 */
	protected $item_code;
	
	/**
	 * @var datetime
	 *
	 * @Column(name="sale_date", type="datetime", nullable=true)
	 */
	protected $saleDate;
	
	/**
	 * @var App_Model_SaleType
	 *
	 * @ManyToOne(targetEntity="App_Model_SaleType")
	 * @JoinColumn(name="type_id", referencedColumnName="id")
	 */
	protected $type;
	
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function getSaleDate() {
		return $this->modifiedDate;
	}
	
	public function setSaleDate($saleDate) {
		$this->saleDate = $saleDate;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setType(App_Model_SaleType $type) {
		$this->type = $type;
	}

	public function toArray() {
		return get_object_vars($this);
	}
}