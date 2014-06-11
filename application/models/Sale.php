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
	 * @JoinColumn(name="item_id", referencedColumnName="id")
	 */
	protected $itemId;
	
	/**
	 * @var datetime
	 *
	 * @Column(name="sale_date", type="datetime", nullable=false)
	 */
	protected $saleDate;
	
	/**
	 * @var App_Model_SaleType
	 *
	 * @ManyToOne(targetEntity="App_Model_SaleType")
	 * @JoinColumn(name="type_id", referencedColumnName="id")
	 */
	protected $type;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="quantity", type="integer", nullable=false)
	 */
	protected $quantity;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="price", type="decimal", scale=2, nullable=false)
	 */
	protected $price;
	
	/**
	 * @var string
	 *
	 * @Column(name="observation", type="text", nullable=true)
	 */
	protected $observation;
	
	/**
	 * @var string
	 *
	 * @Column(name="client_name", type="string", length=50, nullable=true)
	 */
	protected $clientName;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="anticipated_payment", type="decimal", scale=2, nullable=true)
	 */
	protected $anticipatedPayment;
	
	
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function getItemId() {
		return $this->itemId;
	}
	
	public function setItemId($itemId) {
		$this->itemId = $itemId;
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
	
	public function getQuantity() {
		return $this->quantity;
	}
	
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}
	
	public function getPrice() {
		return $this->price;
	}
	
	public function setPrice($price) {
		$this->price = $price;
	}
	
	public function getObservation() {
		return $this->observation;
	}
	
	public function setObservation($observation) {
		$this->observation = $observation;
	}
	
	public function getClientName() {
		return $this->clientName;
	}
	
	public function setClientName($clientName) {
		$this->clientName = $clientName;
	}
	
	public function getAnticipatedPayment() {
		return $this->anticipatedPayment;
	}
	
	public function setAnticipatedPayment($anticipatedPayment) {
		$this->anticipatedPayment = $anticipatedPayment;
	}

	public function toArray() {
		return get_object_vars($this);
	}
}