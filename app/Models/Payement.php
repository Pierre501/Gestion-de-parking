<?php

namespace App\Models;

use CodeIgniter\Model;

class Payement extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payement';
    protected $primaryKey       = 'ididpayement';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idpayement', 'idutilisateur', 'idtarifparking', 'idplace', 'montant', 'motif', 'datepayement', 'heurepayement'];

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

    protected $idPayement;
    protected $idutilisateur;
    protected $idTarifParking;
    protected $idPlace;
    protected $montant;
    protected $motif;
    protected $datePayement;
    protected $heurePayement;


    public function setIdPayement($idPayement)
    {
        $this->idPayement = $idPayement;
    }

    public function getIdPayement()
    {
        return $this->idPayement;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function setIdTarifParking($idTarifParking)
    {
        $this->idTarifParking = $idTarifParking;
    }

    public function getIdTarifParking()
    {
        return $this->idTarifParking;
    }

    public function setIdPlace($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    public function getMotif()
    {
        return $this->motif;
    }

    public function setDatePayement($datePayement)
    {
        $this->datePayement = $datePayement;
    }

    public function getDatePayement()
    {
        return $this->datePayement;
    }

    public function setHeurePayement($heurePayement)
    {
        $this->heurePayement = $heurePayement;
    }

    public function getHeurePayement()
    {
        return $this->heurePayement;
    }

    public function insertionPayement()
    {
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        $sql = "insert into payement values(default, %d, %d, %d, %d, %s, %s, %s)";
        if($parametre->getSimpleParametre()->getOptions() == "Normale")
        {
            $sql = sprintf($sql, $this->getIdUtilisateur(), $this->getIdTarifParking(), $this->getIdPlace(), $this->getMontant(), $this->db->escape($this->getMotif()), $this->db->escape($parametre->getSimpleParametre()->getDateEncours()), $this->db->escape($parametre->getSimpleParametre()->getHeureEncours()));
        }
        else
        {
            $sql = sprintf($sql, $this->getIdUtilisateur(), $this->getIdTarifParking(), $this->getIdPlace(), $this->getMontant(), $this->db->escape($this->getMotif()), $this->db->escape($parametre->getSimpleParametre()->getDateParametre()), $this->db->escape($parametre->getSimpleParametre()->getHeureParametre()));
        }
        $this->db->query($sql);
    }

    public function verifierUtilisateur()
    {
        $verifier = false;
        $sql = "select count(*) ligne from payement where idutilisateur = %d and datepayement = current_date";
        $sql = sprintf($sql, $this->getIdUtilisateur());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        if($rows['ligne'] >= 1)
        {
            $verifier = true;
        }
        return $verifier;
    }

    public function getSimplePayement()
    {
        $sql = "select * from payement where idpayement = (select max(idpayement) as id from payement where idutilisateur = %d)";
        $sql = sprintf($sql, $this->getIdUtilisateur());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $payement = new Payement();
        $payement->setIdPayement($rows['idpayement']);
        $payement->setIdUtilisateur($rows['idutilisateur']);
        $payement->setIdTarifParking($rows['idtarifparking']);
        $payement->setIdPlace($rows['idplace']);
        $payement->setMontant($rows['montant']);
        $payement->setMotif($rows['motif']);
        $payement->setDatePayement($rows['datepayement']);
        $payement->setHeurePayement($rows['heurepayement']);
        return $payement;
    }
}
