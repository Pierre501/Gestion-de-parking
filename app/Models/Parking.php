<?php

namespace App\Models;

use CodeIgniter\Model;

class Parking extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'parking';
    protected $primaryKey       = 'idparking';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idparking', 'nomparking', 'lieuparking'];

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

    protected $idParking;
    protected $nomParking;
    protected $lieuParking;

    public function setIdParking($idParking)
    {
        $this->idParking = $idParking;
    }

    public function getIdParking()
    {
        return $this->idParking;
    }

    public function setNomParking($nomParking)
    {
        $this->nomParking = $nomParking;
    }

    public function getNomParking()
    {
        return $this->nomParking;
    }

    public function setLieuParking($lieuParking)
    {
        $this->lieuParking = $lieuParking;
    }

    public function getLieuParking()
    {
        return $this->lieuParking;
    }

    public function getAllParking()
    {
        $data = array();
        $sql = "select * from parking";
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $parking = new Parking();
            $parking->setIdParking($rows['idparking']);
            $parking->setNomParking($rows['nomparking']);
            $parking->setLieuParking($rows['lieuparking']);
            $data[] = $parking;
        }
        return $data;
    }
}
