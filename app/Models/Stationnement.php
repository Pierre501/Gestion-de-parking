<?php

namespace App\Models;

use CodeIgniter\Model;

class Stationnement extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stationnement';
    protected $primaryKey       = 'idstationnement';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idstationnement', 'idvoiture', 'idplace', 'idtarifparking', 'idparametre', 'datedebut', 'heuredebut', 'datefin', 'heurefin'];

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

    protected $idStationnement;
    protected $idVoiture;
    protected $idPlace;
    protected $idTarifParking;
    protected $idParametre;
    protected $dateDebut;
    protected $heureDebut;
    protected $dateFin;
    protected $heureFin;


    public function setIdStationnement($idStationnement)
    {
        $this->idStationnement = $idStationnement;
    }

    public function getIdStationnement()
    {
        return $this->idStationnement;
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

    public function setIdTarifParking($idTarifParking)
    {
        $this->idTarifParking = $idTarifParking;
    }

    public function getIdTarifParking()
    {
        return $this->idTarifParking;
    }

    public function setIdParametre($idParametre)
    {
        $this->idParametre = $idParametre;
    }

    public function getIdParametre()
    {
        return $this->idParametre;
    }

    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    }

    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

    public function getHeureFin()
    {
        return $this->heureFin;
    }

    public function getDataStationnement()
    {
        $data['idvoiture'] = $this->getIdVoiture();
        $data['idplace'] = $this->getIdPlace();
        $data['idtarifparking'] = $this->getIdTarifParking();
        $data['idparametre'] = $this->getIdParametre();
        $data['datedebut'] = $this->getDateDebut();
        $data['heuredebut'] = $this->getHeureDebut();
        $data['datefin'] = $this->getDateFin();
        $data['heurefin'] = $this->getHeureFin();
        return $data;
    }

    public function deleteStationnement()
    {
        $sql = "delete from stationnement where idstationnement = %d";
        $sql = sprintf($sql, $this->getIdStationnement());
        $this->db->query($sql);
    }

    public function updateHeureDebut()
    {
        $sql = "update stationnement set heuredebut = %s where idvoiture = %d";
        $sql = sprintf($sql, $this->db->escape($this->getHeureDebut()), $this->getIdVoiture());
        $this->db->query($sql);
    }

    public function updateHeureFin()
    {
        $sql = "update stationnement set heurefin = %s where idvoiture = %d";
        $sql = sprintf($sql, $this->db->escape($this->getHeureFin()), $this->getIdVoiture());
        $this->db->query($sql);
    }

    public function getSimpleStationnement()
    {
        $sql = "select * from stationnement where idplace = %d and datedebut = current_date";
        $sql = sprintf($sql, $this->getIdPlace());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $stationnement = new Stationnement();
        $stationnement->setIdStationnement($rows['idstationnement']);
        $stationnement->setIdVoiture($rows['idvoiture']);
        $stationnement->setIdPlace($rows['idplace']);
        $stationnement->setIdParametre($rows['idparametre']);
        $stationnement->setDateDebut($rows['datedebut']);
        $stationnement->setHeureDebut($rows['heuredebut']);
        $stationnement->setDateFin($rows['datefin']);
        $stationnement->setHeureFin($rows['heurefin']);
        return $stationnement;
    }
}
