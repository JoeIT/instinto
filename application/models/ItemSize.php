<?php
/**
 * ItemSize
*
* @Entity
* @Table(name="item_size")
*/
class App_Model_ItemSize {
	/**
	 * @var integer
	 *
	 * @Column(name="id", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @Column(name="name", type="string", length=50, nullable=false)
	 */
	protected $name;
	
	/**
	 * @var string
	 *
	 * @Column(name="description", type="text", nullable=true)
	 */
	protected $description;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function toArray() {
		return get_object_vars($this);
	}
}