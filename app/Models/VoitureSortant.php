<?php

namespace App\Models;

use CodeIgniter\Model;

class VoitureSortant extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'voituresortant';
    protected $primaryKey       = 'idvoituresortant';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idvoituresortant', 'idvoiture', 'idplace', 'datesortant', 'heuresortant'];

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

    protected $idVoitureSortant;
    protected $idVoiture;
    protected $idPlace;
    protected $dateSortant;
    protected $heureSortant;

    public function setIdVoitureSortant($idVoitureSortant)
    {
        $this->idVoitureSortant = $idVoitureSortant;
    }

    public function getIdVoitureSortant()
    {
        return $this->idVoitureSortant;
    }

    public function setIdVoiture($idVoiture)
    {
        $this->idVoiture = $idVoiture;
    }

    public function getIdVoiture()
    {
        return $this->idVoiture;
    }

    public function setIdPlace($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function setDateSortant($dateSortant)
    {
        $this->dateSortant = $dateSortant;
    }

    public function getDateSortant()
    {
        return $this->dateSortant;
    }

    public function setHeureSortant($heureSortant)
    {
        $this->heureSortant = $heureSortant;
    }

    public function getHeureSortant()
    {
        return $this->heureSortant;
    }

    public function insertionVoitureSortant()
    {
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        $sql = "insert into voituresortant values(default, %d, %d, %s, %s)";
        if($parametre->getSimpleParametre()->getOptions() == "Normale")
        {
            $sql = sprintf($sql, $this->getIdVoiture(), $this->getIdPlace(), $this->db->escape($parametre->getSimpleParametre()->getDateEncours()), $this->db->escape($parametre->getSimpleParametre()->getHeureEncours()));
        }
        else
        {
            $sql = sprintf($sql, $this->getIdVoiture(), $this->getIdPlace(), $this->db->escape($parametre->getSimpleParametre()->getDateParametre()), $this->db->escape($parametre->getSimpleParametre()->getHeureParametre()));
        }
        $this->db->query($sql);
    }
}

