<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewsUtilisateur extends Model
{
    protected $idUtilisateur;
    protected $nom;
    protected $prenom;
    protected $username;
    protected $motDePasse;
    protected $adresse;
    protected $montant;
    protected $status;
    protected $dateDepot;

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setMotDepasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function getMontant()
    {
        return $this->montant;
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

    public function getAllPorteFeuille($status)
    {
        $data = array();
        $sql = "select * from viewsutilisateur where status = %s";
        $sql = sprintf($sql, $this->db->escape($status));
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $views = new ViewsUtilisateur();
            $views->setIdUtilisateur($rows['idutilisateur']);
            $views->setNom($rows['nom']);
            $views->setUsername($rows['username']);
            $views->setMotDepasse($rows['motdepasse']);
            $views->setMontant($rows['montant']);
            $views->setStatus($rows['status']);
            $views->setDateDepot($rows['dateencours']);
            $data[] = $views;
        }
        return $data;
    }

    public function getAllIdPorteFeuille()
    {
        $data = array();
        $sql = "select *from portefeuille where idutilisateur = %d and datedepot = %s";
        $sql = sprintf($sql, $this->getIdUtilisateur(), $this->db->escape($this->getDateDepot()));
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $data[] = $rows['idportefeuille'];
        }
        return $data;
    }

    public function updatePorteFeuille($idPorteFeuille)
    {
        $sql = "update portefeuille set status = 'valide' where idportefeuille = %d";
        $sql = sprintf($sql, $idPorteFeuille);
        $this->db->query($sql);
    }

    public function updateAllPorteFeuille()
    {
        $tabIdPorteFeuille = $this->getAllIdPorteFeuille();
        for($i = 0; $i < count($tabIdPorteFeuille); $i++)
        {
            $this->updatePorteFeuille($tabIdPorteFeuille[$i]);
        }
    }

    public function getSolde()
    {
        $solde = 0;
        $sql = "select solde from viewsutilisateur where idutilisateur = %d and status = 'valide'";
        $sql = sprintf($sql, $this->getIdUtilisateur());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $solde = $rows['solde'];
        return $solde;
    }
}
