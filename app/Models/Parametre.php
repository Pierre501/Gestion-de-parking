<?php

namespace App\Models;

use CodeIgniter\Model;

class Parametre extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'parametre';
    protected $primaryKey       = 'idparametre';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idparametre', 'dateparametre', 'heureparametre', 'options'];

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

    protected $idParametre;
    protected $dateParametre;
    protected $heureParametre;
    protected $options;
    protected $dateEncours;
    protected $heureEncours;


    public function setIdParametre($idParametre)
    {
        $this->idParametre = $idParametre;
    }

    public function getIdParametre()
    {
        return $this->idParametre;
    }

    public function setDateParametre($dateParametre)
    {
        $this->dateParametre = $dateParametre;
    }

    public function getDateParametre()
    {
        return $this->dateParametre;
    }

    public function setHeureParametre($heureParametre)
    {
        $this->heureParametre = $heureParametre;
    }

    public function getHeureParametre()
    {
        return $this->heureParametre;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setDateEncours($dateEncours)
    {
        $this->dateEncours = $dateEncours;
    }

    public function getDateEncours()
    {
        return $this->dateEncours;
    }

    public function setHeureEncours($heureEncours)
    {
        $this->heureEncours = $heureEncours;
    }

    public function getHeureEncours()
    {
        return $this->heureEncours;
    }

    public function getOptionsParametre($options)
    {
        $parametre = "";
        $data[] = "Normale";
        $data[] = "Avance";
        for($i = 0; $i < count($data); $i++)
        {
            if($data[$i] != $options)
            {
                $parametre = $data[$i];
                break;
            }
        }
        return $parametre;
    }

    public function formatHeureNormale($heure)
    {
        $heureParametre = strval($heure);
        $dataHeure = explode('.', $heureParametre);
        return $dataHeure[0];
    }

    public function upDateParametre()
    {
        $sql = "update parametre set dateparametre = %s , heureparametre = %s, options = %s where idparametre = %d";
        $sql = sprintf($sql, $this->db->escape($this->getDateParametre()), $this->db->escape($this->getHeureParametre()), $this->db->escape($this->getOptions()), $this->getIdParametre());
        $this->db->query($sql);
    }

    public function upDateParametreV2()
    {
        $sql = "update parametre set options = %s where idparametre = %d";
        $sql = sprintf($sql, $this->db->escape($this->getOptions()), $this->getIdParametre());
        $this->db->query($sql);
    }

    public function getSimpleParametre()
    {
        $sql = "select * from viewsparametre where idparametre = %d";
        $sql = sprintf($sql, $this->getIdParametre());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $parametre = new Parametre();
        $parametre->setIdParametre($rows['idparametre']);
        $parametre->setDateParametre($rows['dateparametre']);
        $parametre->setOptions($rows['options']);
        $parametre->setHeureParametre($rows['heureparametre']);
        $parametre->setDateEncours($rows['dateencours']);
        $parametre->setHeureEncours($rows['heureencours']);
        return $parametre;
    }
}


