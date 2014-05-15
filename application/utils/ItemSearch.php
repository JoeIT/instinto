<?php 

class App_Util_ItemSearch
{
	private $_where = '';
	
	private $_itemTypeDao;
	private $_itemBrandDao;
	private $_itemOriginDao;
	private $_itemLocationDao;
	
	public function __construct()
	{
		$this->_itemTypeDao = new App_Dao_ItemTypeDao();
		$this->_itemBrandDao = new App_Dao_ItemBrandDao();
		$this->_itemOriginDao = new App_Dao_ItemOriginDao();
		$this->_itemLocationDao = new App_Dao_ItemLocationDao();
	}
	
	public function searchPanel()
	{
		$panel = '';
		$this->_itemTypeDao->getAll();
		
		$panel .= "
				<table align='center'>
					<tr>
						<th colspan='2'>Buscador</th>
					</tr>
					<tr>
						<th>Codigo</th>
						<td><input type='text'/></td>
					</tr>
					<tr>
						<th>Tipo</th>
						<td>". $this->_buildSelectArray( 'searchType', $this->_itemTypeDao->getAll() ) ."</td>
					</tr>
					<tr>
						<th>Nombre</th>
						<td><input type='text'/></td>
					</tr>
					<tr>
						<th>Marca</th>
						<td>". $this->_buildSelectArray( 'searchBrand', $this->_itemBrandDao->getAll() ) ."</td>
					</tr>
					<tr>
						<th>Procedencia</th>
						<td>". $this->_buildSelectArray( 'searchOrigin', $this->_itemOriginDao->getAll() ) ."</td>
					</tr>
					<tr>
						<th>Ubicacion</th>
						<td>". $this->_buildSelectArray( 'searchLocation', $this->_itemLocationDao->getAll() ) ."</td>
					</tr>
					<tr>
						<td colspan='2' align='center'><input type='button' id='search' value='BUSCAR'/></td>
					</tr>
				</table>
				";
		
		return $panel;
	}
	
	public function getWhereQuery()
	{
		return $this->_where;
	}
	
	public function setWhereQuery($newWhere)
	{
		$this->_where = $newWhere;
	}
	
	public function resetWhere()
	{
		$this->_where = '';
	}
	
	private function _buildQuery()
	{
	}
	
	private function _buildSelectArray( $htmlId, $fullDataArray)
	{
		$select = "<select id='$htmlId'>";
		$select .= "<option value=''>TODOS</option>";
		
		foreach($fullDataArray as $type)
		{
			$select .= "<option value='". $type->getId() ."'>". $type->getName() ."</option>";
		}
		
		$select .= "</select>";
		
		return $select;
	}
}

?>