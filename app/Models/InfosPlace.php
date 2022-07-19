<?php

namespace App\Models;

use CodeIgniter\Model;

class InfosPlace extends Model
{
    protected $idVoiture;
    protected $idPlace;
    protected $idStationnement;
    protected $idTarifParking;
    protected $idUtilisateur;
    protected $model;
    protected $marque;
    protected $matricule;
    protected $type;
    protected $dateDebut;
    protected $heureDebut;
    protected $dateFin;
    protected $heureFin;
    protected $dure;
    protected $delais;
    protected $numero;
    protected $couleur;
    protected $icons;
    protected $etat;
    protected $montantAmende;


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

    public function setIdStationnement($idStationnement)
    {
        $this->idStationnement = $idStationnement;
    }

    public function getIdStationnement()
    {
        return $this->idStationnement;
    }

    public function setIdTarifParking($idTarifParking)
    {
        $this->idTarifParking = $idTarifParking;
    }

    public function getIdTarifParking()
    {
        return $this->idTarifParking;
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
    public function setDure($dure)
    {
        $this->dure = $dure;
    }

    public function getDure()
    {
        return $this->dure;
    }

    public function setDelais($delais)
    {
        $this->delais = $delais;
    }

    public function getDelais()
    {
        return $this->delais;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    public function getCouleur()
    {
        return $this->couleur;
    }

    public function setIcons($icons)
    {
        $this->icons = $icons;
    }

    public function getIcons()
    {
        return $this->icons;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setMontantAmande($montantAmende)
    {
        $this->montantAmende = $montantAmende;
    }

    public function getMontantAmande()
    {
        return $this->montantAmende;
    }

    public function getSimpleInfosPlace()
    {
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        $sql = "select * from viewsetatparking where matricule = %d";
        $sql = sprintf($sql, $this->getMatricule());
        $query = $this->db->query($sql);
        $rows = $query->getRowArray();
        $infos = new InfosPlace();
        $infos->setIdVoiture($rows['idvoiture']);
        $infos->setIdPlace($rows['idplace']);
        $infos->setIdStationnement($rows['idstationnement']);
        $infos->setIdTarifParking($rows['idtarifparking']);
        $infos->setIdUtilisateur($rows['idutilisateur']);
        $infos->setModel($rows['model']);
        $infos->setMarque($rows['marque']);
        $infos->setMatricule($rows['matricule']);
        $infos->setType($rows['type']);
        $infos->setDateDebut($rows['datedebut']);
        $infos->setHeureDebut($rows['heuredebut']);
        $infos->setDateFin($rows['datefin']);
        $infos->setHeureFin($rows['heurefin']);
        $infos->setDure($rows['dure']);
        $infos->setDelais($rows['delais']);
        $infos->setNumero($rows['numero']);
        if($parametre->getSimpleParametre()->getOptions() == "Normale")
        {
            $infos->setEtat($rows['etatencours']);
            if($rows['etatencours'] == "Occupés")
            {
                $infos->setCouleur("box bg-warning text-center");
                $infos->setIcons("mdi mdi-car");
            }
            else if($rows['etatencours'] == "En infraction")
            {
                $heure = new HeureParametre();
                $infos->setMontantAmande($heure->getAmande($rows['delais']));
                $infos->setCouleur("box bg-danger text-center");
                $infos->setIcons("mdi mdi-alert");
            }
            else
            {
                $infos->setCouleur("box bg-success text-center");
                $infos->setIcons("mdi mdi-road-variant");
            }
        }
        else
        {
            $infos->setEtat($rows['etatparametre']);
            if($rows['etatparametre'] == "Occupés")
            {
                $infos->setCouleur("box bg-warning text-center");
                $infos->setIcons("mdi mdi-car");
            }
            else if($rows['etatparametre'] == "En infraction")
            {
                $heure = new HeureParametre();
                $infos->setMontantAmande($heure->getAmande($rows['delais']));
                $infos->setCouleur("box bg-danger text-center");
                $infos->setIcons("mdi mdi-alert");
            }
            else
            {
                $infos->setCouleur("box bg-success text-center");
                $infos->setIcons("mdi mdi-road-variant");
            }
        }
        return $infos;
    }

    public function getAllInfosPlace()
    {
        $data = array();
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        $sql = "select * from viewsetatparking";
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $infos = new InfosPlace();
            $infos->setIdVoiture($rows['idvoiture']);
            $infos->setIdPlace($rows['idplace']);
            $infos->setIdStationnement($rows['idstationnement']);
            $infos->setIdUtilisateur($rows['idutilisateur']);
            $infos->setModel($rows['model']);
            $infos->setMarque($rows['marque']);
            $infos->setMatricule($rows['matricule']);
            $infos->setType($rows['type']);
            $infos->setDateDebut($rows['datedebut']);
            $infos->setHeureDebut($rows['heuredebut']);
            $infos->setDateFin($rows['datefin']);
            $infos->setHeureFin($rows['heurefin']);
            $infos->setDure($rows['dure']);
            $infos->setDelais($rows['delais']);
            $infos->setNumero($rows['numero']);
            if($parametre->getSimpleParametre()->getOptions() == "Normale")
            {
                $infos->setEtat($rows['etatencours']);
                if($rows['etatencours'] == "Occupés")
                {
                    $infos->setCouleur("box bg-warning text-center");
                    $infos->setIcons("mdi mdi-car");
                }
                else if($rows['etatencours'] == "En infraction")
                {
                    $heure = new HeureParametre();
                    $infos->setMontantAmande($heure->getAmande($rows['delais']));
                    $infos->setCouleur("box bg-danger text-center");
                    $infos->setIcons("mdi mdi-alert");
                }
                else
                {
                    $infos->setEtat($rows['etatparametre']);
                    $infos->setCouleur("box bg-success text-center");
                    $infos->setIcons("mdi mdi-road-variant");
                }
            }
            else
            {
                $infos->setEtat($rows['etatparametre']);
                if($rows['etatparametre'] == "Occupés")
                {
                    $infos->setCouleur("box bg-warning text-center");
                    $infos->setIcons("mdi mdi-car");
                }
                else if($rows['etatparametre'] == "En infraction")
                {
                    $heure = new HeureParametre();
                    $infos->setMontantAmande($heure->getAmande($rows['delais']));
                    $infos->setCouleur("box bg-danger text-center");
                    $infos->setIcons("mdi mdi-alert");
                }
                else
                {
                    $infos->setCouleur("box bg-success text-center");
                    $infos->setIcons("mdi mdi-road-variant");
                }
            }
            $data[] = $infos;
        }
        return $data;
    }

    public function getAllInfosPlaceByIdUser()
    {
        $data = array();
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        $sql = "select * from viewsetatparking where idutilisateur = %d";
        $sql = sprintf($sql, $this->getIdUtilisateur());
        $query = $this->db->query($sql);
        foreach($query->getResultArray() as $rows)
        {
            $infos = new InfosPlace();
            $infos->setIdVoiture($rows['idvoiture']);
            $infos->setIdPlace($rows['idplace']);
            $infos->setIdStationnement($rows['idstationnement']);
            $infos->setIdUtilisateur($rows['idutilisateur']);
            $infos->setModel($rows['model']);
            $infos->setMarque($rows['marque']);
            $infos->setMatricule($rows['matricule']);
            $infos->setType($rows['type']);
            $infos->setDateDebut($rows['datedebut']);
            $infos->setHeureDebut($rows['heuredebut']);
            $infos->setDateFin($rows['datefin']);
            $infos->setHeureFin($rows['heurefin']);
            $infos->setDure($rows['dure']);
            $infos->setDelais($rows['delais']);
            $infos->setNumero($rows['numero']);
            if($parametre->getSimpleParametre()->getOptions() == "Normale")
            {
                $infos->setEtat($rows['etatencours']);
                if($rows['etatencours'] == "Occupés")
                {
                    $infos->setCouleur("box bg-warning text-center");
                    $infos->setIcons("mdi mdi-car");
                }
                else if($rows['etatencours'] == "En infraction")
                {
                    $heure = new HeureParametre();
                    $infos->setMontantAmande($heure->getAmande($rows['delais']));
                    $infos->setCouleur("box bg-danger text-center");
                    $infos->setIcons("mdi mdi-alert");
                }
                else
                {
                    $infos->setCouleur("box bg-success text-center");
                    $infos->setIcons("mdi mdi-road-variant");
                }
            }
            else
            {
                $infos->setEtat($rows['etatparametre']);
                if($rows['etatparametre'] == "Occupés")
                {
                    $infos->setCouleur("box bg-warning text-center");
                    $infos->setIcons("mdi mdi-car");
                }
                else if($rows['etatparametre'] == "En infraction")
                {
                    $heure = new HeureParametre();
                    $infos->setMontantAmande($heure->getAmande($rows['delais']));
                    $infos->setCouleur("box bg-danger text-center");
                    $infos->setIcons("mdi mdi-alert");
                }
                else
                {
                    $infos->setCouleur("box bg-success text-center");
                    $infos->setIcons("mdi mdi-road-variant");
                }
            }
            $data[] = $infos;
        }
        return $data;
    }
}
