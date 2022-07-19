<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseAdminController;
use App\Models\HeureParametre;
use App\Models\Parametre;
use App\Models\TarifParking;
use App\Models\Place;
use App\Models\Parking;
use App\Models\InfosPlace;
use App\Models\Stationnement;
use App\Models\Statistique;
use App\Models\Voiture;
use App\Models\ViewsUtilisateur;


class AdminController extends BaseAdminController
{

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent:: initController($request, $response, $logger);
    }

    public function pageAccueilAdmin()
    {
        $data['template'] = "";
        $infos = new InfosPlace();
        $data['listePlace'] = $infos->getAllInfosPlace();
        return view('admin', $data);
    }

    public function pageTarif()
    {
        $data['template'] = "tarif.php";
        $tarif = new TarifParking();
        $data['listeTarif'] = $tarif->getAllTarifParking();
        return view('admin', $data);
    }

    public function pageAjoutTarif()
    {
        $data['template'] = "crudTarif.php";
        $data['condition'] = "ajouter";
        return view('admin', $data);
    }

    public function pageModifierTarif()
    {
        $idTarif = $this->request->getGet('id');
        $tarif = new TarifParking();
        $tarif->setIdTarifParking($idTarif);
        $data['tarif'] = $tarif->getSimpleTarifParking();
        $data['template'] = "crudTarif.php";
        $data['condition'] = "modifier";
        return view('admin', $data);
    }

    public function statistique()
    {
        $statistique = new Statistique();
        $data['dataEtat'] = $statistique->getAllEtat();
        $data['dataNbrPlace'] = $statistique->getAllNbrPlace();
        return view('statistique.php', $data);
    }

    public function updateHeureDebut()
    {
        $data = array();
        $idVoiture = $this->request->getVar('idvoiture');
        $heureDebut = $this->request->getVar('heuredebut');
        if(!empty($idVoiture) && !empty($heureDebut))
        {
            $stationnnement = new Stationnement();
            $stationnnement->setIdVoiture($idVoiture);
            $stationnnement->setHeureDebut($heureDebut);
            $stationnnement->updateHeureDebut();
            $heureParametre = new HeureParametre();
            $tarif = new TarifParking();
            $heure = $heureDebut.":00";
            $dure = $heureParametre->formatHeureParametre($tarif->getSimpleDure($idVoiture));
            $heureFin = $heureParametre->sommeHeure($dure, $heureParametre->formatHeureParametre($heure));
            $stationnnement->setHeureFin($heureFin->heureFormate());
            $stationnnement->updateHeureFin();
        }
        else
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        $data['template'] = "parametre.php";
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        if($parametre->getSimpleParametre()->getOptions() == "Avance")
        {
            $data['date'] = $parametre->getSimpleParametre()->getDateParametre();
            $data['heure'] = $parametre->getSimpleParametre()->getHeureParametre();
            $data['options'] = $parametre->getSimpleParametre()->getOptions();
            $data['autre'] = $parametre->getOptionsParametre($parametre->getSimpleParametre()->getOptions());
        }
        else
        {
            $data['date'] = $parametre->getSimpleParametre()->getDateEncours();
            $data['heure'] = $parametre->formatHeureNormale($parametre->getSimpleParametre()->getHeureEncours());
            $data['options'] = $parametre->getSimpleParametre()->getOptions();
            $data['autre'] = $parametre->getOptionsParametre($parametre->getSimpleParametre()->getOptions());
        }
        $voiture = new Voiture();
        $data['listeVoiture'] = $voiture->getAllVoiture();
        return view('admin', $data);
    }

    public function ajoutTarif()
    {
        $data = array();
        $tarifs = $this->request->getVar('tarif');
        $dure = $this->request->getVar('dure');
        $montant = $this->request->getVar('montant');
        $tarif = new TarifParking();
        $views = "";
        if(!empty($tarifs) && !empty($dure) && !empty($montant))
        {
            $tarif->setTarif($tarifs);
            $tarif->setDure($dure);
            $tarif->setMontant($montant);
            $dataTarif = $tarif->getDataTarif();
            $tarif->save($dataTarif);
            $views = "tarif.php";
        }
        else
        {
            $views = "crudTarif.php";
            $data['condition'] = "ajouter";
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        $data['template'] = $views;
        $data['listeTarif'] = $tarif->getAllTarifParking();
        return view('admin', $data);
    }

    public function upDateTarif()
    {
        $data = array();
        $idTarif = $this->request->getVar('idtarifparking');
        $tarifs = $this->request->getVar('tarif');
        $dure = $this->request->getVar('dure');
        $montant = $this->request->getVar('montant');
        $tarif = new TarifParking();
        $views = "";
        if(!empty($tarifs) && !empty($dure) && !empty($montant))
        {
            $tarif->setIdTarifParking($idTarif);
            $tarif->setTarif($tarifs);
            $tarif->setDure($dure);
            $tarif->setMontant($montant);
            $tarif->updateTarifParking();
            $views = "tarif.php";
        }
        else
        {
            $views = "crudTarif.php";
            $data['condition'] = "ajouter";
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        $data['template'] = $views;
        $data['listeTarif'] = $tarif->getAllTarifParking();
        return view('admin', $data);
    }

    public function deleteTarif()
    {
        $idTarif = $this->request->getGet('id');
        $tarif = new TarifParking();
        $tarif->setIdTarifParking($idTarif);
        $tarif->deleteTarifParking();
        $data['template'] = "tarif.php";
        $data['listeTarif'] = $tarif->getAllTarifParking();
        return view('admin', $data);
    }

    public function pageParametre()
    {
        $data['template'] = "parametre.php";
        $parametre = new Parametre();
        $parametre->setIdParametre(1);
        if($parametre->getSimpleParametre()->getOptions() == "Avance")
        {
            $data['date'] = $parametre->getSimpleParametre()->getDateParametre();
            $data['heure'] = $parametre->getSimpleParametre()->getHeureParametre();
            $data['options'] = $parametre->getSimpleParametre()->getOptions();
            $data['autre'] = $parametre->getOptionsParametre($parametre->getSimpleParametre()->getOptions());
        }
        else
        {
            $data['date'] = $parametre->getSimpleParametre()->getDateEncours();
            $data['heure'] = $parametre->formatHeureNormale($parametre->getSimpleParametre()->getHeureEncours());
            $data['options'] = $parametre->getSimpleParametre()->getOptions();
            $data['autre'] = $parametre->getOptionsParametre($parametre->getSimpleParametre()->getOptions());
        }
        $voiture = new Voiture();
        $data['listeVoiture'] = $voiture->getAllVoiture();
        return view('admin', $data);
    }

    public function upDateParametre()
    {
        $data = array();
        $dateParametre = $this->request->getVar('dateparametre');
        $heureParametre = $this->request->getVar('heureparametre');
        $options = $this->request->getVar('options');
        if(!empty($dateParametre) && !empty($heureParametre) && !empty($options))
        {
            $parametre = new Parametre();
            if($options == "Normale")
            {
                $parametre->setIdParametre(1);
                $parametre->setOptions($options);
                $parametre->upDateParametreV2();
                $data['date'] = $parametre->getSimpleParametre()->getDateEncours();
                $data['heure'] = $parametre->formatHeureNormale($parametre->getSimpleParametre()->getHeureEncours());
                $data['options'] = $parametre->getSimpleParametre()->getOptions();
                $data['autre'] = $parametre->getOptionsParametre($parametre->getSimpleParametre()->getOptions());
            }
            else
            {
                $parametre->setIdParametre(1);
                $parametre->setOptions($options);
                $parametre->setDateParametre($dateParametre);
                $parametre->setHeureParametre($heureParametre);
                $parametre->upDateParametre();
                $data['date'] = $parametre->getSimpleParametre()->getDateParametre();
                $data['heure'] = $parametre->getSimpleParametre()->getHeureParametre();
                $data['options'] = $parametre->getSimpleParametre()->getOptions();
                $data['autre'] = $parametre->getOptionsParametre($parametre->getSimpleParametre()->getOptions());
            }
        }
        else
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        $data['template'] = "parametre.php";
        $voiture = new Voiture();
        $data['listeVoiture'] = $voiture->getAllVoiture();
        return view('admin', $data);
    }

    public function pageValidationPorteFeuille()
    {
        $data['template'] = "validationPorteFeuille.php";
        $utilisateur = new ViewsUtilisateur();
        $data['listePorteFeuille'] = $utilisateur->getAllPorteFeuille('Non valide');
        return view('admin', $data);
    }

    public function validationPorteFeuille()
    {
        $dateDepot = $this->request->getPost('datedepot');
        $session = \Config\Services::session();
        $idUtilisateur = $session->get('idUser');
        $utilisateur = new ViewsUtilisateur();
        $utilisateur->setIdUtilisateur($idUtilisateur);
        $utilisateur->setDateDepot($dateDepot);
        $utilisateur->updateAllPorteFeuille();
        $data['template'] = "validationPorteFeuille.php";
        $utilisateur = new ViewsUtilisateur();
        $data['listePorteFeuille'] = $utilisateur->getAllPorteFeuille('Non valide');
        return view('admin', $data);
    }

    public function pageAjoutPlace()
    {
        $data['template'] = "ajoutPlace.php";
        $parking = new Parking();
        $data['listeParking'] = $parking->getAllParking();
        return view('admin', $data);
    }

    public function deconnexionAdmin()
    {
        $session = \Config\Services::session();
        $session->remove('idAdmin');
        return view('loginAdmin');
    }

    public function ajoutPlace()
    {
        $data = array();
        $idParking = $this->request->getPost('idparking');
        $nombrePlace = $this->request->getPost('nombreplace');
        if(!empty($idParking) && !empty($nombrePlace))
        {
            $place = new Place();
            $place->setIdParking($idParking);
            $place->insertPlace($nombrePlace);
        }
        else
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        $data['template'] = "ajoutPlace.php";
        $parking = new Parking();
        $data['listeParking'] = $parking->getAllParking();
        return view('admin', $data);
    }
}
