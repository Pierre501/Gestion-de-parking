<?php

namespace App\Controllers;

use App\Models\Administrateur;
use App\Models\InfosPlace;
use App\Models\PorteFeuille;
use App\Models\Utilisateur;
use App\Models\Statistique;

class AccueilController extends RootController
{
    public function index()
    {
        return view('loginAdmin');
    }

    public function pageLoginUser()
    {
        return view('loginUser'); 
    }

    public function pageInscription()
    {
        return view('inscription');
    }

    public function loginAdmin()
    {
        $data = array();
        $view = "loginAdmin";
        $username = $this->request->getVar('username');
        $motDePasse = $this->request->getVar('motdepasse');
        if(!empty($username) && !empty($motDePasse))
        {
            $admin = new Administrateur();
            $admin->setUsername($username);
            $admin->setMotDePasse($motDePasse);
            $condition = $admin->verificationLogin();
            if($condition == true)
            {
                $userData['idAdmin'] = 1;
                $session = \Config\Services::session();
                $session->set($userData);
                $infos = new InfosPlace();
                $data['listePlace'] = $infos->getAllInfosPlace();
                $view = "admin";
                $data['template'] = "";
            }
            else
            {
                $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
            }
        }
        else
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        return view($view, $data);
    }

    public function loginUtilisateur()
    {
        $data = array();
        $view = "loginUser";
        $username = $this->request->getVar('username');
        $motDePasse = $this->request->getVar('motdepasse');
        if(!empty($username) && !empty($motDePasse))
        {
            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($username);
            $utilisateur->setMotDePasse($motDePasse);
            $condition = $utilisateur->verificationUtilisateur();
            if($condition == true)
            {
                $idUtilisateur = $utilisateur->getSimpleUtilisateur()->getIdUtilisateur();
                $userData['idUser'] = $idUtilisateur;
                $session = \Config\Services::session();
                $session->set($userData);
                $infos = new InfosPlace();
                $data['listePlace'] = $infos->getAllInfosPlace();
                $view = "utilisateur";
                $data['template'] = "";
                $statistique = new Statistique();
                $data['tabStatistique'] = $statistique->getDataStatistique();
            }
            else
            {
                $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
            }
        }
        else
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        return view($view, $data);
    }

    public function ajoutUtilisateur()
    {

        $rules['nom'] = "required|trim";
        $rules['username'] = "required|trim|valid_email|is_unique[utilisateur.username]|min_length[6]";
        $rules['motdepasse'] = "required|trim|min_length[8]";

        $messages['nom']['required'] = "Nom is required";
        $messages['username']['required'] = "Username is required";
        $messages['username']['valid_email'] = "Username is not format email";
        $messages['username']['is_unique'] = "Username is already exist";
        $messages['username']['min_length'] = "Username minimum length is 6";
        $messages['motdepasse']['required'] = "Password is required";
        $messages['motdepasse']['min_length'] = "Password minimum length is 8";

        $data = array();
        $nom = $this->request->getVar('nom');
        $username = $this->request->getVar('username');
        $motDePasse = $this->request->getVar('motdepasse');
        $motDePasseConfirme = $this->request->getPost('motdepasseconfirme');
        if($motDePasse != $motDePasseConfirme)
        {
            $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
        }
        else
        {
            if(!$this->validate($rules, $messages))
            {
                $data['messages'] = "Oups! Veiullez réessayez s'il vous plait!";
            }
            else
            {
                $utilisateur = new Utilisateur();
                $utilisateur->setNom($nom);
                $utilisateur->setUsername($username);
                $utilisateur->setMotDePasse($motDePasse);
                $dataUtilisateur = $utilisateur->getDataUtilisateur();
                $utilisateur->save($dataUtilisateur);
                $idUtilisateur = $utilisateur->getSimpleUtilisateur()->getIdUtilisateur();
                $porteFeuille = new PorteFeuille();
                $porteFeuille->setIdUtilisateur($idUtilisateur);
                $porteFeuille->insertionPortefeuille();
            }
        }
        return view('inscription', $data);
    }
}
