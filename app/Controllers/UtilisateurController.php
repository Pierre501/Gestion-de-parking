<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\BaseUserController;
use App\Models\Amende;
use App\Models\HeureParametre;
use App\Models\Parametre;
use App\Models\Payement;
use App\Models\PorteFeuille;
use App\Models\Place;
use App\Models\Stationnement;
use App\Models\TarifParking;
use App\Models\ViewsUtilisateur;
use App\Models\Voiture;
use App\Models\InfosPlace;
use App\Models\VoitureSortant;
use App\Models\Statistique;

class UtilisateurController extends BaseUserController
{   
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent:: initController($request, $response, $logger);
    }

    public function pageAccueilUtilisateur()
    {
        $data['template'] = "";
        $infos = new InfosPlace();
        $data['listePlace'] = $infos->getAllInfosPlace();
        $statistique = new Statistique();
        $statistique = new Statistique();
        $data['tabStatistique'] = $statistique->getDataStatistique();
        return view('utilisateur', $data);
    }

    public function pageEnleveVoiture()
    {
        $data['template'] = "enlevePlace.php"; 
        $session = \Config\Services::session();
        $amende = new Amende();
        $amende->setIdAmende(1);
        $infos = new InfosPlace();
        $infos->setIdUtilisateur($session->get('idUser'));
        $data['infosPlace'] = $infos->getAllInfosPlaceByIdUser();
        return view('utilisateur', $data);
    }

    public function enleveVoiture()
    {
        $data = array();
        $data['template'] = "enlevePlace.php";
        $matricule = $this->request->getGet('matricule');
        $session = \Config\Services::session();
        $payement = new Payement();
        $infos = new InfosPlace();
        $infos->setMatricule($matricule);
        $infosPlace = $infos->getSimpleInfosPlace();
        $voitureSortant = new VoitureSortant();
        if($infosPlace->getEtat() == "En infraction")
        {
            $utilisateur = new ViewsUtilisateur();
            $utilisateur->setIdUtilisateur($session->get('idUser'));
            $amende = new Amende();
            $amende->setIdAmende(1);
            if($infosPlace->getMontantAmande() <= $utilisateur->getSolde())
            {
                $porteFeuille = new PorteFeuille();
                $porteFeuille->insertionNetApaye($session->get('idUser'),$amende->getSimpleAmande()->getMontant());
                $payement->setIdUtilisateur($session->get('idUser'));
                $payement->setIdTarifParking($infosPlace->getIdTarifParking());
                $payement->setIdPlace($infosPlace->getIdPlace());
                $payement->setMontant($infosPlace->getMontantAmande());
                $payement->setMotif("Amende");
                $payement->insertionPayement();
                $stationnement = new Stationnement();
                $stationnement->setIdStationnement($infosPlace->getIdStationnement());
                $stationnement->deleteStationnement();
            }
            else
            {
                $data['messages'] = "Votre solde est insuffisant pour payer cet amende";
            }
        }
        else
        {
            $voitureSortant->setIdVoiture($infosPlace->getIdVoiture());
            $voitureSortant->setIdPlace($infosPlace->getIdPlace());
            $voitureSortant->insertionVoitureSortant();
            $stationnement = new Stationnement();
            $stationnement->setIdStationnement($infosPlace->getIdStationnement());
            $stationnement->deleteStationnement();
        }
        $amende = new Amende();
        $amende->setIdAmende(1);
        $data['amende'] = $amende->getSimpleAmande();
        $data['infosPlace'] = $infos->getAllInfosPlaceByIdUser();
        return view('utilisateur', $data);
    }

    public function pageListeTarif()
    {
        $data['template'] = "detailsTarif.php";
        $tarif = new TarifParking();
        $data['listeTarif'] = $tarif->getAllTarifParking();
        return view('utilisateur', $data);
    }

    public function ticket()
    {
        $session = \Config\Services::session();
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true,'isRemoteEnabled', true);
        $payement = new Payement();
        $payement->setIdUtilisateur($session->get('idUser'));
        $condition = $payement->verifierUtilisateur();
        if($condition == true)
        {
            $tarifParking = new TarifParking();
            $dompdf->loadHtml($tarifParking->getPageHtml($session->get('idUser')));
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('ticket');
        }
        else
        {
            $data['template'] = "ajoutVoiturePlace.php";
            $voiture = new Voiture();
            $data['listeVoiture'] = $voiture->getAllVoiture();
            $tarif = new TarifParking();
            $data['listeTarif'] = $tarif->getAllTarifParking();
            $place = new Place();
            $data['listePlace'] = $place->getAllPlaceDisponible();
            return view('utilisateur', $data);
        }
    }

    public function pageAjoutVoiturePlace()
    {
        $data['template'] = "ajoutVoiturePlace.php";
        $voiture = new Voiture();
        $data['listeVoiture'] = $voiture->getAllVoiture();
        $tarif = new TarifParking();
        $data['listeTarif'] = $tarif->getAllTarifParking();
        $place = new Place();
        $data['listePlace'] = $place->getAllPlaceDisponible();
        return view('utilisateur', $data);
    }

    public function ajoutPorteFeuille()
    {
        $data = array();
        $montant = $this->request->getPost('montant');
        $date = $this->request->getPost('date');
        if(!empty($montant) && !empty($date))
        {
            $session = \Config\Services::session();
            $porteFeuille = new PorteFeuille();
            $porteFeuille->setIdUtilisateur($session->get('idUser'));
            $porteFeuille->setMontant($montant);
            $porteFeuille->setStatus('Non valide');
            $porteFeuille->setDateDepot($date);
            $dataPorteFeuille = $porteFeuille->getDataPorteFeuille();
            $porteFeuille->save($dataPorteFeuille);
        }
        else
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        $data['template'] = "ajoutPorteFeuille.php";
        $utilisateur = new ViewsUtilisateur();
        $utilisateur->setIdUtilisateur($session->get('idUser'));
        $data['solde'] = $utilisateur->getSolde();
        return view('utilisateur', $data);
    }

    public function pageAjoutPorteFeuille()
    {
        $data['template'] = "ajoutPorteFeuille.php";
        $session = \Config\Services::session();
        $utilisateur = new ViewsUtilisateur();
        $utilisateur->setIdUtilisateur($session->get('idUser'));
        $data['solde'] = $utilisateur->getSolde();
        return view('utilisateur', $data);
    }

    public function deconnexionUser()
    {
        $session = \Config\Services::session();
        $session->remove('idUser');
        return view('loginUser');
    }

    public function ajoutVoiture()
    {
        $matricule = $this->request->getVar('matricule');
        $model = $this->request->getVar('model');
        $marque = $this->request->getVar('marque');
        $type = $this->request->getVar('type');
        $rules['matricule'] = "trim|required|is_unique[voiture.matricule]";
        $rules['model'] = "trim|required";
        $rules['marque'] = "trim|required";
        $rules['type'] = "required";

        $messages['matricule']['required'] = "Matricule is required";
        $messages['matricule']['is_unique'] = "Matricule is unique";
        $messages['model']['required'] = "Model is required";
        $messages['marque']['required'] = "Marque is required";
        $messages['type']['required'] = "Type is required";
        if (!$this->validate($rules, $messages))
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        else
        {
            $session = \Config\Services::session();
            $voiture = new Voiture();
            $voiture->setIdUtilisateur($session->get('idUser'));
            $voiture->setModel($model);
            $voiture->setMarque($marque);
            $voiture->setMatricule($matricule);
            $voiture->setType($type);
            $dataVoiture = $voiture->getDataVoiture();
            $voiture->save($dataVoiture);
        }
        $data['template'] = "ajoutVoiturePlace.php";
        $voiture = new Voiture();
        $data['listeVoiture'] = $voiture->getAllVoiture();
        $tarif = new TarifParking();
        $data['listeTarif'] = $tarif->getAllTarifParking();
        $place = new Place();
        $data['listePlace'] = $place->getAllPlaceDisponible();
        return view('utilisateur', $data);
    }

    public function stationne()
    {
        $idPlace = $this->request->getVar('idplace');
        $idVoiture = $this->request->getVar('idvoiture');
        $idTarif = $this->request->getVar('idtarifparking');
        $rules['idvoiture'] = "is_unique[stationnement.idvoiture]";
        $messages['idvoiture']['is_unique'] = "Cars is unique";
        $tarif = new TarifParking();
        if (!$this->validate($rules, $messages))
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        else
        {
            $tarif->setIdTarifParking($idTarif);
            $utilisateur = new ViewsUtilisateur();
            $session = \Config\Services::session();
            $utilisateur->setIdUtilisateur($session->get('idUser'));
            if($tarif->getSimpleTarifParking()->getMontant() <= $utilisateur->getSolde())
            {
                $parametre = new Parametre();
                $parametre->setIdParametre(1);
                $stationne = new Stationnement();
                $stationne->setIdVoiture($idVoiture);
                $stationne->setIdPlace($idPlace);
                $stationne->setIdTarifParking($idTarif);
                $stationne->setIdParametre(1);
                if($parametre->getSimpleParametre()->getOptions() == "Normale")
                {
                    $stationne->setDateDebut($parametre->getSimpleParametre()->getDateEncours());
                    $stationne->setHeureDebut($parametre->getSimpleParametre()->getHeureEncours());
                }
                else
                {   
                    $stationne->setDateDebut($parametre->getSimpleParametre()->getDateParametre());
                    $stationne->setHeureDebut($parametre->getSimpleParametre()->getHeureParametre());
                }
                $tarifParking = new TarifParking();
                $tarifParking->setIdTarifParking($idTarif);
                $heure = new HeureParametre();
                $dateHeure = $heure->getDateHeureFin($tarifParking->getSimpleTarifParking()->getDure());
                $stationne->setDateFin($dateHeure->dateFormate());
                $stationne->setHeureFin($dateHeure->heureFormate());
                $dataStationnement = $stationne->getDataStationnement();
                $stationne->save($dataStationnement);
                $payement = new Payement();
                $payement->setIdUtilisateur($session->get('idUser'));
                $payement->setIdTarifParking($idTarif);
                $payement->setIdPlace($idPlace);
                $payement->setMontant($tarif->getSimpleTarifParking()->getMontant());
                $payement->setMotif("Parking");
                $payement->insertionPayement();
                $porteFeuille = new PorteFeuille();
                $porteFeuille->insertionNetApaye($session->get('idUser'), $tarif->getSimpleTarifParking()->getMontant());
            }
            else
            {
                $data['messages'] = "Oups! Votre solde est epuisé!";
            }
        }
        $data['template'] = "ajoutVoiturePlace.php";
        $voiture = new Voiture();
        $data['listeVoiture'] = $voiture->getAllVoiture();
        $data['listeTarif'] = $tarif->getAllTarifParking();
        $place = new Place();
        $data['listePlace'] = $place->getAllPlaceDisponible();
        return view('utilisateur', $data);
    }
}















