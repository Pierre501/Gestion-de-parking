<?php

namespace App\Models;

use CodeIgniter\Model;

class DateParametre extends Model
{

    protected $annee;
    protected $mois;
    protected $jour;


    public function setAnnee($annee)
    {
        $this->annee = intval($annee);
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setMois($mois)
    {
        $this->mois = intval($mois);
    }

    public function getMois()
    {
        return $this->mois;
    }

    public function setJour($jour)
    {
        $this->jour = intval($jour);
    }

    public function getJour()
    {
        return $this->jour;
    }

    public function dateFormate()
    {
        $date = strval($this->getAnnee())."-".strval($this->getMois())."-".strval($this->getJour());
        return $date;
    }

    public function formatDateParametre($date)
    {
        $tabDate = explode('-', $date);
        $formatDate = new DateParametre();
        $formatDate->setAnnee($tabDate[0]);
        $formatDate->setMois($tabDate[1]);
        $formatDate->setJour($tabDate[2]);
        return $formatDate;
    }
}
