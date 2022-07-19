<?php

namespace App\Models;

use CodeIgniter\Model;

class TarifParking extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tarifparking';
    protected $primaryKey       = 'idtarifparking';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idtarifparking', 'tarif', 'dure', 'montant'];

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

    protected $idTarifParking;
    protected $tarif;
    protected $dure;
    protected $montant;


    public function setIdTarifParking($idTarifParking)
    {
        $this->idTarifParking = $idTarifParking;
    }

    public function getIdTarifParking()
    {
        return $this->idTarifParking;
    }

    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    public function getTarif()
    {
        return $this->tarif;
    }

    public function setDure($dure)
    {
        $this->dure = $dure;
    }

    public function getDure()
    {
        return $this->dure;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function getDataTarif()
    {
        $data['tarif'] = $this->getTarif();
        $data['dure'] = $this->getDure();
        $data['montant'] = $this->getMontant();
        return $data;
    }

    public function verifierTarif()
    {
        
    }

    public function getSimpleDure($idvoiture)
    {
        $builder = $this->db->table('tarifparking');
        $builder->select('tarifparking.dure');
        $builder->join('stationnement', 'tarifparking.idtarifparking = stationnement.idtarifparking');
        $builder->where('stationnement.idvoiture', $idvoiture);
        $query = $builder->get();
        $rows = $query->getRowArray();
        $dure = $rows['dure'];
        return $dure;
    }

    public function getSimpleTarifParking()
    {
        $sql = "select * from tarifparking where idtarifparking = %d";
        $sql = sprintf($sql, $this->getIdTarifParking());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $tarif = new TarifParking();
        $tarif->setIdTarifParking($rows['idtarifparking']);
        $tarif->setTarif($rows['tarif']);
        $tarif->setDure($rows['dure']);
        $tarif->setMontant($rows['montant']);
        return $tarif;
    }

    public function getAllTarifParking()
    {
        $data = array();
        $sql = "select * from tarifparking";
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $tarif = new TarifParking();
            $tarif->setIdTarifParking($rows['idtarifparking']);
            $tarif->setTarif($rows['tarif']);
            $tarif->setDure($rows['dure']);
            $tarif->setMontant($rows['montant']);
            $data[] = $tarif;
        }
        return $data;
    }

    public function updateTarifParking()
    {
        $sql = "update tarifparking set tarif = %s, dure = %s, montant = %d where idtarifparking = %d";
        $sql = sprintf($sql, $this->db->escape($this->getTarif()), $this->db->escape($this->getDure()), $this->getMontant(), $this->getIdTarifParking());
        $this->db->query($sql);
    }


    public function deleteTarifParking()
    {
        $sql = "delete from tarifparking where idtarifparking = %d";
        $sql = sprintf($sql, $this->getIdTarifParking());
        $this->db->query($sql);
    }

    public function getPageHtml($idUtilisateur)
    {
        $payement = new Payement();
        $payement->setIdUtilisateur($idUtilisateur);
        $stationnement = new Stationnement();
        $stationnement->setIdPlace($payement->getSimplePayement()->getIdPlace());
        $voiture = new Voiture();
        $voiture->setIdVoiture($stationnement->getSimpleStationnement()->getIdVoiture());
        $heureDebut = explode('.', $stationnement->getSimpleStationnement()->getHeureDebut());
        $place = new Place();
        $place->setIdPlace($payement->getSimplePayement()->getIdPlace());
        $html = "<!DOCTYPE html>
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Ticket</title>
        </head>
        <body>
            <h2 style=\"margin-left: 80px;\">Ticket parking voiture</h2>
            <fieldset style=\"width: 380px; height: 200px;\">
            <div style=\"margin-left: 290px;\">
                <img src=\"assets/images/logo.png\">
            </div>
            <div style=\"margin-top: -65px;\">
                <h2>EASY PARK</h2>
            </div>
            <div>
                <label><b>Numéro place : </b>".$place->getSimplePlace()->getNumero()."</label>
            </div>
            <div>
                <label><b>Immatriculation : </b>".$voiture->getSimpleVoiture()->getMatricule()."</label>
            </div>
            <div>
                <label><b>Marque : </b>".$voiture->getSimpleVoiture()->getMarque()."</label>
            </div>
            <div>
                <label><b>Montant : </b>".number_format($payement->getSimplePayement()->getMontant(), 0, '.', ' ')." Ar</label>
            </div>
            <div>
                <label><b>Date et Heure début : </b>".$stationnement->getSimpleStationnement()->getDateDebut()." ".$heureDebut[0]."</label>
            </div>
            <div>
                <label><b>Date et Heure fin : </b>".$stationnement->getSimpleStationnement()->getDateFin()." ".$stationnement->getSimpleStationnement()->getHeureFin()."</label>
            </div>
            </fieldset>
        </body>
        </html>
        ";
        return $html;
    }
}



