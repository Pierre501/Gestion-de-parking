<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AccueilController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AccueilController::index');
$routes->get('/inscription', 'AccueilController::pageInscription');
$routes->get('/loginUser', 'AccueilController::pageLoginUser');
$routes->get('/pageTarif', 'AdminController::pageTarif');
$routes->get('/pageAccueilAdmin', 'AdminController::pageAccueilAdmin');
$routes->get('/pageAjoutTarif', 'AdminController::pageAjoutTarif');
$routes->get('/pageModifierTarif', 'AdminController::pageModifierTarif');
$routes->get('/pageAjoutPlace', 'AdminController::pageAjoutPlace');
$routes->get('/pageValidationPorteFeuille', 'AdminController::pageValidationPorteFeuille');
$routes->get('/pageParametre', 'AdminController::pageParametre');
$routes->get('/deleteTarif', 'AdminController::deleteTarif');
$routes->get('/statistique', 'AdminController::statistique');
$routes->get('/deconnexionAdmin', 'AdminController::deconnexionAdmin');
$routes->get('/pageAccueilUtilisateur', 'UtilisateurController::pageAccueilUtilisateur');
$routes->get('/pageAjoutPorteFeuille', 'UtilisateurController::pageAjoutPorteFeuille');
$routes->get('/pageListeTarif', 'UtilisateurController::pageListeTarif');
$routes->get('/pageAjoutVoiturePlace', 'UtilisateurController::pageAjoutVoiturePlace');
$routes->get('/statistique', 'UtilisateurController::statistique');
$routes->get('/ticket', 'UtilisateurController::ticket');
$routes->get('/pageEnleveVoiture', 'UtilisateurController::pageEnleveVoiture');
$routes->get('/enleveVoiture', 'UtilisateurController::enleveVoiture');
$routes->get('/deconnexionUser', 'UtilisateurController::deconnexionUser');


$routes->post('/connexionAdmin', 'AccueilController::loginAdmin');
$routes->post('/connexionUser', 'AccueilController::loginUtilisateur');
$routes->post('/ajoutUtilisateur', 'AccueilController::ajoutUtilisateur');
$routes->post('/validationPorteFeuille', 'AdminController::validationPorteFeuille');
$routes->post('/ajoutPlace', 'AdminController::ajoutPlace');
$routes->post('/ajoutTarif', 'AdminController::ajoutTarif');
$routes->post('/upDateParametre', 'AdminController::upDateParametre');
$routes->post('/updateHeureDebut', 'AdminController::updateHeureDebut');
$routes->post('/upDateTarif', 'AdminController::upDateTarif');
$routes->post('/ajoutPorteFeuille', 'UtilisateurController::ajoutPorteFeuille');
$routes->post('/ajoutVoiture', 'UtilisateurController::ajoutVoiture');
$routes->post('/stationne', 'UtilisateurController::stationne');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
