<?php

namespace App\Models;

use CodeIgniter\Model;

class Statistique extends Model
{

    protected $etat;
    protected $nbrPlace;


    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;
    }

    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    public function getDataStatistique()
    {
        $data = array();
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        $sql = "";
        if($parametre->getSimpleParametre()->getOptions() == "Normale")
        {
            $sql = "select count(idplace) as nbrplace, etatencours from viewsetat group by etatencours";
        }
        else
        {
            $sql = "select count(idplace) as nbrplace, etatparametre from viewsetat group by etatparametre";
        }
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $statistique = new Statistique();
            if($parametre->getSimpleParametre()->getOptions() == "Normale")
            {
                $statistique->setEtat($rows['etatencours']);
                $statistique->setNbrPlace($rows['nbrplace']);
            }
            else
            {
                $statistique->setEtat($rows['etatparametre']);
                $statistique->setNbrPlace($rows['nbrplace']);
            }
            $data[] = $statistique;
        }
        return $data;
    }

    public function getAllEtat()
    {
        $data = array();
        $tabSate = $this->getDataStatistique();
        foreach($tabSate as $state)
        {
            $data[] = $state->getEtat();
        }
        return $data;
    }

    public function getAllNbrPlace()
    {
        $data = array();
        $tabSate = $this->getDataStatistique();
        foreach($tabSate as $state)
        {
            $data[] = $state->getNbrPlace();
        }
        return $data;
    }
}
