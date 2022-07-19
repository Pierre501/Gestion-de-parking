<?php

namespace App\Models;

use CodeIgniter\Model;

class Place extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'place';
    protected $primaryKey       = 'idplace';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idplace', 'idparking', 'numero'];

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

    protected $idPlace;
    protected $idParking;
    protected $numero;


    public function setIdPlace($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function setIdParking($idParking)
    {
        $this->idParking = $idParking;
    }

    public function getIdParking()
    {
        return $this->idParking;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getDataPlace()
    {
        $data['idparking'] = $this->getIdParking();
        $data['numero'] = $this->getNumero();
        return $data;
    }

    public function getAllPlace()
    {
        $data = array();
        $sql = "select * from place";
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $place = new Place();
            $place->setIdPlace($rows['idplace']);
            $place->setIdParking($rows['idparking']);
            $place->setNumero($rows['numero']);
            $data[] = $place;
        }
        return $data;
    }

    public function getAllPlaceById($idParking)
    {
        $data = array();
        $sql = "select * from place where idparking = %d";
        $sql = sprintf($sql, $idParking);
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $place = new Place();
            $place->setIdPlace($rows['idplace']);
            $place->setIdParking($rows['idparking']);
            $place->setNumero($rows['numero']);
            $data[] = $place;
        }
        return $data;
    }

    public function getSimplePlace()
    {
        $sql = "select * from place where idplace = %d";
        $sql = sprintf($sql, $this->getIdPlace());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $place = new Place();
        $place->setIdPlace($rows['idplace']);
        $place->setIdParking($rows['idparking']);
        $place->setNumero($rows['numero']);
        return $place;
    }

    public function getLastNumeroPlace()
    {
        $lastNum = 0;
        $sql = "select max(numero) as numero from place where idparking = %d";
        $sql = sprintf($sql, $this->getIdParking());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $lastNum = $rows['numero'];
        return $lastNum;
    }

    public function getAllNumero($nombrePlace)
    {
        $data = array();
        $lastNum = intval($this->getLastNumeroPlace());
        for($i = 0; $i < $nombrePlace; $i++)
        {
            $lastNum = $lastNum + 1;
            $data[] = strval($lastNum);
        }
        return $data;
    }

    public function insertPlace($nombrePlace)
    {
        $dataNum = $this->getAllNumero($nombrePlace);
        foreach($dataNum as $num)
        {
            $place = new Place();
            $place->setIdParking($this->getIdParking());
            $place->setNumero($num);
            $dataPlace = $place->getDataPlace();
            $place->save($dataPlace);
        }
    }

    public function getAllPlaceDisponible()
    {
        $data = array();
        $sql = "select * from viewplacedisponible";
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $place = new Place();
            $place->setIdPlace($rows['idplace']);
            $place->setIdParking($rows['idparking']);
            $place->setNumero($rows['numero']);
            $data[] = $place;
        }
        return $data;
    }
}





