<?php

namespace App\Models;

use CodeIgniter\Model;

class Amende extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'amende';
    protected $primaryKey       = 'idamende';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idamende', 'nomamende', 'montant'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    protected $idAmende;
    protected $nomAmende;
    protected $tranche;
    protected $montant;


    public function setIdAmende($idAmende)
    {
        $this->idAmende = $idAmende;
    }

    public function getIdAmende()
    {
        return $this->idAmende;
    }

    public function setNomAmende($nomAmende)
    {
        $this->nomAmende = $nomAmende;
    }

    public function getNomAmende()
    {
        return $this->nomAmende;
    }

    public function setTranche($tranche)
    {
        $this->tranche = $tranche;
    }

    public function getTranche()
    {
        return $this->tranche;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function getSimpleAmande()
    {
        $sql = "select * from amende where idamende = %d";
        $sql = sprintf($sql, $this->getIdAmende());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $amende = new Amende();
        $amende->setIdAmende($rows['idamende']);
        $amende->setNomAmende($rows['nomamende']);
        $amende->setTranche($rows['tranche']);
        $amende->setMontant($rows['montant']);
        return $amende;
    }
}
