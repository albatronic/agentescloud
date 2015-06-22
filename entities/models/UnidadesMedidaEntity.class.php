<?php
/**
 * @copyright ALBATRONIC
 * @date 22.06.2015 22:34:01
 */

/**
 * @orm:Entity(UnidadesMedida)
 */
class UnidadesMedidaEntity extends EntityComunes {
	/**
	 * @orm GeneratedValue
	 * @orm Id
	 * @var integer
	 * @assert NotBlank(groups="AgtUnidadesMedida")
	 */
	protected $Id;
	/**
	 * @var string
	 * @assert NotBlank(groups="AgtUnidadesMedida")
	 */
	protected $UnidadMedida;
	/**
	 * Nombre de la conexion a la BD
	 * @var string
	 */
	protected $_conectionName = 'datos';
	/**
	 * Nombre de la tabla física
	 * @var string
	 */
	protected $_tableName = 'AgtUnidadesMedida';
	/**
	 * Nombre de la PrimaryKey
	 * @var string
	 */
	protected $_primaryKeyName = 'Id';
	/**
	 * Array con las columnas de la primarykey
	 * @var array
	 */
	protected $_arrayPrimaryKeys = array('Id');
	/**
	 * Relacion de entidades que dependen de esta
	 * @var string
	 */
	protected $_parentEntities = array(
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'UMB'),            
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'UMC'),            
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'UMA'),            
        array('SourceColumn' => 'Id', 'ParentEntity' => 'Articulos', 'ParentColumn' => 'UMV'),            
		);
	/**
	 * Relacion de entidades de las que esta depende
	 * @var string
	 */
	protected $_childEntities = array(
			'ValoresSN',
		);
	/**
	 * GETTERS Y SETTERS
	 */
	public function setId($Id) {
		$this->Id = $Id;
	}
	public function getId() {
		return $this->Id;
	}

	public function setUnidadMedida($UnidadMedida) {
		$this->UnidadMedida = trim($UnidadMedida);
	}
	public function getUnidadMedida() {
		return $this->UnidadMedida;
	}

} // END class AgtUnidadesMedida

