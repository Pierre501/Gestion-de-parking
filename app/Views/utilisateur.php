<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="easypark">
    <meta name="description" content="easypark">
    <meta name="robots" content="noindex,nofollow">
    <title>Utilisateur</title>
    <link href="<?php echo base_url(); ?>/assets/css/tooltip.css"  rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">

                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <span class="logo-text">GESTION DE PARKING</span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-md-block">Parking <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-bell font-24"></i>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">

                                        </div>
                                    </li>
                                </ul>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>/assets/images/1.jpg" alt="user" class="rounded-circle" width="31">
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>/pageAccueilUtilisateur" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Accueil</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>/pageAjoutPorteFeuille" aria-expanded="false"><i class="mdi mdi-plus-box"></i><span class="hide-menu">Ajout portefeuille</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>/pageAjoutVoiturePlace" aria-expanded="false"><i class="mdi mdi-plus-box"></i><span class="hide-menu">Ajout voiture sur une place</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>/pageEnleveVoiture" aria-expanded="false"><i class="mdi mdi-delete"></i><span class="hide-menu">Enlever voiture sur une place</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>/pageListeTarif" aria-expanded="false"><i class="mdi mdi-view-sequential"></i><span class="hide-menu">Détails tarif</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>/deconnexionUser" aria-expanded="false"><i class="mdi mdi-logout"></i><span class="hide-menu">Déconnexion</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
        <?php if($template == "ajoutPorteFeuille.php") { include($template); } else if($template == "detailsTarif.php") { include($template); } else if($template == "ajoutVoiturePlace.php") { include($template); } else if($template == "enlevePlace.php") { include($template); } else { ?>
            <div class="page-breadcrumb"></div>
            <div class="container-fluid">
            <h3 class="page-title text-center">Liste des places</h3>
            <?php foreach($tabStatistique as $statistique) { ?>
                <p><?php echo $statistique->getEtat(); ?> : <?php echo $statistique->getNbrPlace(); ?></p>
            <?php } ?>
                <div class="row" style="margin-top: 90px;">
                    <?php foreach($listePlace as $place) { ?>
                            <div class="col-md-6 col-lg-2 col-xlg-3 tooltips">
                                <div class="card card-hover">
                                    <div class="<?php echo $place->getCouleur(); ?>">
                                        <h1 class="font-light text-white"><i class="<?php echo $place->getIcons(); ?>"></i></h1>
                                        <?php if($place->getEtat() != "Libres") { ?>
                                            <h6 class="text-white"><?php echo $place->getMatricule(); ?></h6>
                                        <?php } if($place->getEtat() == "Libres") { ?>
                                            <h6 class="text-white">Libre</h6>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="tooltipstext">
                            <?php if($place->getEtat() == "Libres") { ?>
                                <div class="design">
                                    <label>PLACE N° <?php echo $place->getNumero(); ?></label>
                                    <br>
                                    <label>Etat <?php echo $place->getEtat(); ?></label>
                                    <br>
                                    <label>Heure d’arrivée : </label>
                                    <br>
                                    <label>Durée prévue : </label>
                                    <br>
                                    <label>Délai de départ : </label>
                                    <br>
                                    <a href="<?php echo base_url(); ?>/pageAjoutVoiturePlace"><i class="mdi mdi-plus-box"></i></a>
                                </div>
                            <?php } else if($place->getEtat() != "Libres") { ?>
                                <div class="design">
                                    <label>PLACE N° <?php echo $place->getNumero(); ?></label>
                                    <br>
                                    <label>Etat <?php echo $place->getEtat(); ?></label>
                                    <br>
                                    <label>Heure d’arrivée : <?php echo $place->getHeureFin(); ?></label>
                                    <br>
                                    <label>Durée prévue : <?php echo $place->getDure(); ?></label>
                                    <br>
                                    <label>Délai de départ : <?php echo $place->getDelais(); ?></label>
                                    <br>
                                </div>
                            <?php } ?>
                            </div>
                            </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
            <footer class="footer text-center">Application gestion de parking</footer>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>/assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(); ?>/assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="<?php echo base_url(); ?>/assets/js/excanvas.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery.flot.crosshair.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/chart-page-init.js"></script>

</body>

</html>