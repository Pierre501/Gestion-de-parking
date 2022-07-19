<?php

namespace App\Models;

use App\Models\DateParametre;

class HeureParametre extends DateParametre
{

    protected $heure;
    protected $minute;
    protected $seconde;


    public function setHeure($heure)
    {
        $this->heure = intval($heure);
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function setMinute($minute)
    {
        $this->minute = intval($minute);
    }

    public function getMinute()
    {
        return $this->minute;
    }

    public function setSeconde($seconde)
    {
        $this->seconde = intval($seconde);
    }

    public function getSeconde()
    {
        return $this->seconde;
    }

    public function heureFormate()
    {
        $heure = strval($this->getHeure()).":".strval($this->getMinute()).":".strval($this->getSeconde());
        return $heure;
    }

    public function sommeHeure($heure1, $heure2)
    {
        $minute = 0;
        $sommeHeure = new HeureParametre();
        $sommeMinute = $heure1->getMinute() + $heure2->getMinute();
        if($sommeMinute >= 60)
        {
            while(60 <= $sommeMinute)
            {
                $sommeMinute -= 60;
                $minute++;
            }
        }
        $sommeHeure->setHeure($heure1->getHeure()+$heure2->getHeure()+$minute);
        $sommeHeure->setMinute($sommeMinute);
        $sommeHeure->setSeconde($heure1->getSeconde()+$heure2->getSeconde());
        return $sommeHeure;
    }

    public function convertierHeureEnMinute()
    {
        $heure = abs($this->getHeure()) * 60;
        $minute = $this->getMinute();
        $minuteFin = $heure + $minute;
        return $minuteFin;
    }

    public function arrandissementValuer($valeur)
    {
        $reste = 0;
        $resteStr = strval($valeur);
        $tabReste = explode('.',$resteStr);
        if(count($tabReste) == 1)
        {
            $reste = intval($tabReste[0]);
        }
        else
        {
            $reste = intval($tabReste[0]) + 1;
        }
        return $reste;
    }

    public function formatHeureParametre($heure)
    {
        $tabHeure = explode(':', $heure);
        $formatHeure = new HeureParametre();
        $formatHeure->setHeure($tabHeure[0]);
        $formatHeure->setMinute($tabHeure[1]);
        $formatHeure->setSeconde($tabHeure[2]);
        return $formatHeure;
    }

    public function sommeDelais($reste, $amende)
    {
        $retour = 1;
        if($reste == 1)
        {
            $retour = $amende;
        }
        else if($reste >= 2)
        {
            for($i = 2; $i <= $reste; $i++)
            {
                $retour = $amende * 2;
                $amende = $retour;
            }
        }
        return $retour;
    }

    public function getAmande($delais)
    {
        $amende = new Amende();
        $amende->setIdAmende(1);
        $heureFormat = $this->formatHeureParametre($delais);
        $minute = $heureFormat->convertierHeureEnMinute();
        $modulo = $minute / $amende->getSimpleAmande()->getTranche();
        $reste = $this->arrandissementValuer($modulo);
        $amendeFinal = $this->sommeDelais($reste, $amende->getSimpleAmande()->getMontant());
        return $amendeFinal;
    }

    public function calculDateEtHeureFin($date, $heure)
    {
        $jour = 0;
        $heureParametre = $heure->getHeure();
        if($heureParametre >= 24)
        {
            while(24 <= $heureParametre)
            {
                $heureParametre -= 24;
                $jour++;
            }
        }
        $heureFin = new HeureParametre();
        $heureFin->setAnnee($date->getAnnee());
        $heureFin->setMois($date->getMois());
        $heureFin->setJour($date->getJour()+$jour);
        $heureFin->setHeure($heureParametre);
        $heureFin->setMinute($heure->getMinute());
        $heureFin->setSeconde($heure->getSeconde());
        return $heureFin;
    }

    public function getDateHeureFin($dure)
    {
        $heureDateFin = null;
        $dureFormate = $this->formatHeureParametre($dure);
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        if($parametre->getSimpleParametre()->getOptions() == "Normale")
        {
            $heureEncours = explode('.', $parametre->getSimpleParametre()->getHeureEncours());
            $dateEncours = $this->formatDateParametre($parametre->getSimpleParametre()->getDateEncours());
            $sommeHeure = $this->sommeHeure($dureFormate, $this->formatHeureParametre($heureEncours[0]));
            $heureDateFin = $this->calculDateEtHeureFin($dateEncours, $sommeHeure);
        }
        else
        {
            $dateAvance = $this->formatDateParametre($parametre->getSimpleParametre()->getDateParametre());
            $heureAvance = $this->formatHeureParametre($parametre->getSimpleParametre()->getHeureParametre());
            $sommeHeure = $this->sommeHeure($dureFormate, $heureAvance);
            $heureDateFin = $this->calculDateEtHeureFin($dateAvance, $sommeHeure);
        }
        return $heureDateFin;
    }
}
