<?php

namespace App\Models;

use CodeIgniter\Model;

class Voiture extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'voiture';
    protected $primaryKey       = 'idvoiture';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idvoiture', 'idutilisateur', 'model', 'marque', 'matricule', 'type'];

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

    protected $idVoiture;
    protected $idUtilisateur;
    protected $model;
    protected $marque;
    protected $matricule;
    protected $type;

    public function setIdVoiture($idVoiture)
    {
        $this->idVoiture = $idVoiture;
    }

    public function getIdVoiture()
    {
        return $this->idVoiture;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    public function getMatricule()
    {
        return $this->matricule;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDataVoiture()
    {
        $data['idutilisateur'] = $this->getIdUtilisateur();
        $data['model'] = $this->getModel();
        $data['marque'] = $this->getMarque();
        $data['matricule'] = $this->getMatricule();
        $data['type'] = $this->getType();
        return $data;
    }

    public function getAllVoiture()
    {
        $data = array();
        $sql = "select * from voiture";
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $voiture = new Voiture();
            $voiture->setIdVoiture($rows['idvoiture']);
            $voiture->setIdUtilisateur($rows['idutilisateur']);
            $voiture->setModel($rows['model']);
            $voiture->setMarque($rows['marque']);
            $voiture->setMatricule($rows['matricule']);
            $voiture->setType($rows['type']);
            $data[] = $voiture;
        }
        return $data;
    }

    public function getSimpleVoiture()
    {
        $sql = "select * from voiture where idvoiture = %d";
        $sql = sprintf($sql, $this->getIdVoiture());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $voiture = new Voiture();
        $voiture->setIdVoiture($rows['idvoiture']);
        $voiture->setIdUtilisateur($rows['idutilisateur']);
        $voiture->setModel($rows['model']);
        $voiture->setMarque($rows['marque']);
        $voiture->setMatricule($rows['matricule']);
        $voiture->setType($rows['type']);
        return $voiture;
    }
}
