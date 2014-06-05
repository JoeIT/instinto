<?php
/**
 * Item
*
* @Entity
* @Table(name="item")
*/
class App_Model_Item {
	/**
	 * @var integer
	 *
	 * @Column(name="id", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	// The custom format validator depends of this name
	/**
	 * @var string
	 *
	 * @Column(name="code", type="string", length=50, nullable=true)
	 */
	protected $code;
	
	/**
	 * @var App_Model_ItemType
	 *
	 * @ManyToOne(targetEntity="App_Model_ItemType")
	 * @JoinColumn(name="type_id", referencedColumnName="id")
	 */
	protected $type;
	
	/**
	 * @var App_Model_ItemBrand
	 *
	 * @ManyToOne(targetEntity="App_Model_ItemBrand")
	 * @JoinColumn(name="brand_id", referencedColumnName="id")
	 */
	protected $brand;
	
	/**
	 * @var App_Model_ItemSize
	 *
	 * @ManyToOne(targetEntity="App_Model_ItemSize")
	 * @JoinColumn(name="size_id", referencedColumnName="id")
	 */
	protected $size;
	
	/**
	 * @var App_Model_ItemColor
	 *
	 * @ManyToOne(targetEntity="App_Model_ItemColor")
	 * @JoinColumn(name="color_id", referencedColumnName="id")
	 * @OrderBy({"name" = "ASC"})
	 */
	protected $color;
	
	/**
	 * @var App_Model_ItemOrigin
	 *
	 * @ManyToOne(targetEntity="App_Model_ItemOrigin")
	 * @JoinColumn(name="origin_id", referencedColumnName="id")
	 */
	protected $origin;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="quantity", type="integer", nullable=false)
	 */
	protected $quantity;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="cost", type="decimal", scale=2, nullable=true)
	 */
	protected $cost;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="price", type="decimal", scale=2, nullable=true)
	 */
	protected $price;
	
	/**
	 * @var decimal
	 *
	 * @Column(name="final_price", type="decimal", scale=2, nullable=true)
	 */
	protected $finalPrice;
	
	/**
	 * @var string
	 *
	 * @Column(name="description", type="text", nullable=true)
	 */
	protected $description;
	
	/**
	 * @var string
	 *
	 * @Column(name="photo_dir", type="string", length=100, nullable=false)
	 */
	protected $photoDir;
	
	/**
	 * @var datetime
	 *
	 * @Column(name="creation_date", type="datetime", nullable=true)
	 */
	protected $creationDate;
	
	/**
	 * @var datetime
	 *
	 * @Column(name="modified_date", type="datetime", nullable=true)
	 */
	protected $modifiedDate;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getCode() {
		return utf8_encode($this->code);
	}

	public function setCode($code) {
		$this->code = $code;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setType(App_Model_ItemType $type) {
		$this->type = $type;
	}
	
	public function getBrand() {
		return $this->brand;
	}
	
	public function setBrand(App_Model_ItemBrand $brand) {
		$this->brand = $brand;
	}
	
	public function getSize() {
		return $this->size;
	}
	
	public function setSize(App_Model_ItemSize $size) {
		$this->size = $size;
	}
	
	public function getColor() {
		return $this->color;
	}
	
	public function setColor(App_Model_ItemColor $color) {
		$this->color = $color;
	}
	
	public function getOrigin() {
		return $this->origin;
	}
	
	public function setOrigin(App_Model_ItemOrigin $origin) {
		$this->origin = $origin;
	}
	
	public function getQuantity() {
		return $this->quantity;
	}
	
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}
	
	public function getCost() {
		return $this->cost;
	}
	
	public function setCost($cost) {
		$this->cost = $cost;
	}
	
	public function getPrice() {
		return $this->price;
	}
	
	public function setPrice($price) {
		$this->price = $price;
	}
	
	public function getFinalPrice() {
		return $this->finalPrice;
	}
	
	public function setFinalPrice($finalPrice) {
		$this->finalPrice = $finalPrice;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getPhotoDir() {
		return $this->photoDir;
	}
	
	public function setPhotoDir($photoDir) {
		$this->photoDir = $photoDir;
	}
	
	public function getCreationDate() {
		return $this->creationDate;
	}
	
	public function setCreationDate($creationDate) {
		$this->creationDate = $creationDate;
	}
	
	public function getModifiedDate() {
		return $this->modifiedDate;
	}
	
	public function setModifiedDate($modifiedDate) {
		$this->modifiedDate = $modifiedDate;
	}
	
	public function toArray() {
		return get_object_vars($this);
	}
}