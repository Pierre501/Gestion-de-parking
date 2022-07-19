<?php

namespace App\Models;

use CodeIgniter\Model;

class Utilisateur extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'utilisateur';
    protected $primaryKey       = 'idutilisateur';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idutilisateur', 'nom', 'username', 'motdepasse'];

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



    protected $idUtilisateur;
    protected $nom;
    protected $username;
    protected $motDePasse;


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

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function getDataUtilisateur()
    {
        $data['nom'] = $this->getNom();
        $data['username'] = $this->getUsername();
        $data['motdepasse'] = sha1($this->getMotDePasse());
        return $data;
    }

    public function verificationUtilisateur()
    {
        $verifiaction = false;
        $sql = "select count(*) as ligne from utilisateur where username = %s and motdepasse = %s";
        $sql = sprintf($sql, $this->db->escape($this->getUsername()), $this->db->escape(sha1($this->getMotDePasse())));
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        if($rows['ligne'] == 1)
        {
            $verifiaction = true;
        }
        return $verifiaction;
    }

    public function getSimpleUtilisateur()
    {
        $sql = "select * from utilisateur where username = %s and motdepasse = %s";
        $sql = sprintf($sql, $this->db->escape($this->getUsername()), $this->db->escape(sha1($this->getMotDePasse())));
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $utilisateur = new Utilisateur();
        $utilisateur->setIdUtilisateur($rows['idutilisateur']);
        $utilisateur->setNom($rows['nom']);
        $utilisateur->setUsername($rows['username']);
        $utilisateur->setMotDePasse($rows['motdepasse']);
        return $utilisateur;
    }
}
