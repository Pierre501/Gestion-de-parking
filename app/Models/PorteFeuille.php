<?php

namespace App\Models;

use CodeIgniter\Model;

class PorteFeuille extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'portefeuille';
    protected $primaryKey       = 'idportefeuille';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idportefeuille', 'idutilisateur', 'montant', 'montantdepense', 'status', 'datedepot'];

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

    protected $idPorteFeuille;
    protected $idUtilisateur;
    protected $montant;
    protected $montantDepense;
    protected $status;
    protected $dateDepot;


    public function setIdPorteFeuille($idPorteFeuille)
    {
        $this->idPorteFeuille = $idPorteFeuille;
    }

    public function getIdPorteFeuille()
    {
        return $this->idPorteFeuille;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
    
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMonatnDepense($montantDepense)
    {
        $this->montantDepense = $montantDepense;
    }

    public function getMontantDepense()
    {
        return $this->montantDepense;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setDateDepot($dateDepot)
    {
        $this->dateDepot = $dateDepot;
    }

    public function getDateDepot()
    {
        return $this->dateDepot;
    }

    public function getDataPorteFeuille()
    {
        $data['idutilisateur'] = $this->getIdUtilisateur();
        $data['montant'] = $this->getMontant();
        $data['status'] = $this->getStatus();
        $data['montantdepense'] = 0;
        $data['datedepot'] = $this->getDateDepot();
        return $data;
    }

    public function insertionPortefeuille()
    {
        $sql = "insert into portefeuille values(default, %d, 0, 0, 'valide', current_date);";
        $sql = sprintf($sql, $this->getIdUtilisateur());
        $this->db->query($sql);
    }

    public function insertionNetApaye($idUtilisateur, $netApayer)
    {
        $sql = "insert into portefeuille values(default, %d, 0, %d, 'valide', current_date)";
        $sql = sprintf($sql, $idUtilisateur, $netApayer);
        $this->db->query($sql);
    }
}
