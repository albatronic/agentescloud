<?php

/**
 * Description of EntityComunes
 *
 * Definicion de propiedades y métodos comunes a todas las entidades de datos
 *
 * @date 03-08-2012
 * @author Sergio Perez <sergio.perez@albatronic.com>
 * @copyright (c) Informática ALBATRONIC, SL
 */
class EntityComunes extends Entity {

    /**
     * @orm Column(type="string")
     * @var text
     */
    protected $Observations;

    /**
     * @orm Column(type="string")
     * @var string(100)
     */
    protected $PrimaryKeyMD5;

    /**
     * @orm Column(type="tinyint")
     * @var entities\ValoresSN
     */
    protected $Publish = '1';

    /**
     * @orm Column(type="tinyint")
     * @var entities\ValoresSN
     */
    protected $IsDefault = '0';

    /**
     * @orm Column(type="tinyint")
     * @var entities\ValoresSN
     */
    protected $IsSuper = '0';

    /**
     * @orm Column(type="int")
     * @var integer(11)
     */
    protected $BelongsTo = '0';
    
    protected $NivelJerarquico = 1;

    /**
     * @orm Column(type="integer")
     * @var entities\Agentes
     */
    protected $CreatedBy = '0';

    /**
     * @orm Column(type="datetime")
     * @assert:NotBlank
     * @var datetime
     */
    protected $CreatedAt = '0000-00-00 00:00:00';

    /**
     * @orm Column(type="integer")
     * @var entities\Agentes
     */
    protected $ModifiedBy = '0';

    /**
     * @orm Column(type="datetime")
     * @assert:NotBlank
     * @var datetime
     */
    protected $ModifiedAt = '0000-00-00 00:00:00';

    /**
     * @orm Column(type="tinyint")
     * @var entities\ValoresSN
     */
    protected $Deleted = '0';

    /**
     * @orm Column(type="integer")
     * @var entities\Agentes
     */
    protected $DeletedBy = '0';

    /**
     * @orm Column(type="datetime")
     * @var datetime
     */
    protected $DeletedAt = '0000-00-00 00:00:00';

    /**
     * @orm Column(type="integer")
     * @var entities\Agentes
     */
    protected $PrintedBy = '0';

    /**
     * @orm Column(type="datetime")
     * @var datetime
     */
    protected $PrintedAt = '0000-00-00 00:00:00';

    /**
     * @orm Column(type="integer")
     * @var entities\Agentes
     */
    protected $EmailedBy = '0';

    /**
     * @orm Column(type="datetime")
     * @var datetime
     */
    protected $EmailedAt = '0000-00-00 00:00:00';

    /**
     * GETERS Y SETERS
     */
    public function setObservations($Observations) {
        $this->Observations = trim($Observations);
    }

    public function getObservations() {
        return $this->Observations;
    }

    public function setPrimaryKeyMD5($PrimaryKeyMD5) {
        $this->PrimaryKeyMD5 = trim($PrimaryKeyMD5);
    }

    public function getPrimaryKeyMD5() {
        return $this->PrimaryKeyMD5;
    }

    public function setPublish($Publish) {
        $this->Publish = $Publish;
    }

    public function getPublish() {
        if (!($this->Publish instanceof ValoresSN))
            $this->Publish = new ValoresSN($this->Publish);
        return $this->Publish;
    }
    
    public function setIsDefault($IsDefault) {
        $this->IsDefault = $IsDefault;
    }

    public function getIsDefault() {
        if (!($this->IsDefault instanceof ValoresSN))
            $this->IsDefault = new ValoresSN($this->IsDefault);
        return $this->IsDefault;
    }

    public function setIsSuper($IsSuper) {
        $this->IsSuper = $IsSuper;
    }

    public function getIsSuper() {
        if (!($this->IsSuper instanceof ValoresSN))
            $this->IsSuper = new ValoresSN($this->IsSuper);
        return $this->IsSuper;
    }

    public function setBelongsTo($BelongsTo) {
        $this->BelongsTo = $BelongsTo;
    }

    public function getBelongsTo() {
        if (!is_object($this->BelongsTo)) {
            $clase = $this->getClassName();
            $this->BelongsTo = new $clase($this->BelongsTo);
        }
        return $this->BelongsTo;
    }

    public function setNivelJerarquico($NivelJerarquico) {
        $this->NivelJerarquico = $NivelJerarquico;
    }

    public function getNivelJerarquico() {
        return $this->NivelJerarquico;
    }

    public function setCreatedBy($CreateBy) {
        $this->CreatedBy = $CreateBy;
    }

    public function getCreatedBy() {
        if (!($this->CreatedBy instanceof Usuarios))
            $this->CreatedBy = new Usuarios($this->CreatedBy);

        return $this->CreatedBy;
    }

    public function setCreatedAt($CreatedAt) {
        $this->CreatedAt = $CreatedAt;
    }

    public function getCreatedAt() {
        return date_format(date_create($this->CreatedAt), 'd-m-Y H:i:s');
    }

    public function setModifiedBy($ModifiedBy) {
        $this->ModifiedBy = $ModifiedBy;
    }

    public function getModifiedBy() {
        if (!($this->ModifiedBy instanceof Usuarios))
            $this->ModifiedBy = new Usuarios($this->ModifiedBy);
        return $this->ModifiedBy;
    }

    public function setModifiedAt($ModifiedAt) {
        $this->ModifiedAt = $ModifiedAt;
    }

    public function getModifiedAt() {
        return date_format(date_create($this->ModifiedAt), 'd-m-Y H:i:s');
    }

    public function setDeleted($Deleted) {
        $this->Deleted = $Deleted;
    }

    public function getDeleted() {
        if (!($this->Deleted instanceof ValoresSN))
            $this->Deleted = new ValoresSN($this->Deleted);
        return $this->Deleted;
    }

    public function setDeletedBy($DeletedBy) {
        $this->DeletedBy = $DeletedBy;
    }

    public function getDeletedBy() {
        if (!($this->DeletedBy instanceof Usuarios))
            $this->DeletedBy = new Usuarios($this->DeletedBy);

        return $this->DeletedBy;
    }

    public function setDeletedAt($DeletedAt) {
        $this->DeletedAt = $DeletedAt;
    }

    public function getDeletedAt() {
        return date_format(date_create($this->DeletedAt), 'd-m-Y H:i:s');
    }

    public function setPrintedBy($PrintedBy) {
        $this->PrintedBy = $PrintedBy;
    }

    public function getPrintedBy() {
        if (!($this->PrintedBy instanceof Usuarios))
            $this->PrintedBy = new Usuarios($this->PrintedBy);
        return $this->PrintedBy;
    }

    public function setPrintedAt($PrintedAt) {
        $this->PrintedAt = $PrintedAt;
    }

    public function getPrintedAt() {
        return date_format(date_create($this->PrintedAt), 'd-m-Y H:i:s');
    }

    public function setEmailedBy($EmailedBy) {
        $this->EmailedBy = $EmailedBy;
    }

    public function getEmailedBy() {
        if (!($this->EmailedBy instanceof Usuarios))
            $this->EmailedBy = new Usuarios($this->EmailedBy);
        return $this->EmailedBy;
    }

    public function setEmailedAt($EmailedAt) {
        $this->EmailedAt = $EmailedAt;
    }

    public function getEmailedAt() {
        return date_format(date_create($this->EmailedAt), 'd-m-Y H:i:s');
    }

}
