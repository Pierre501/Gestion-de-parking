<div class="page-breadcrumb"></div>
    <div class="container-fluid">
            <h3 class="page-title text-center">Liste des voiture que vous avez stationne</h3>
                <div class="row" style="margin-top: 90px;">
                    <?php foreach($infosPlace as $infos) { ?>
                            <div class="col-md-6 col-lg-2 col-xlg-3 tooltips">
                                <div class="card card-hover">
                                    <div class="<?php echo $infos->getCouleur(); ?>">
                                        <h1 class="font-light text-white"><i class="<?php echo $infos->getIcons(); ?>"></i></h1>
                                        <?php if(!empty($infos->getMatricule())) { ?>
                                            <h6 class="text-white"><?php echo $infos->getMatricule(); ?></h6>
                                        <?php } else { ?>
                                            <h6 class="text-white">Libre</h6>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="tooltipstext">
                                <div class="design">
                                    <label>PLACE N° <?php echo $infos->getNumero(); ?></label>
                                    <br>
                                    <label>Etat <?php echo $infos->getEtat(); ?></label>
                                    <br>
                                    <label>Délai de départ : <?php echo $infos->getDelais(); ?></label>
                                    <?php if($infos->getEtat() == "En infraction") { ?>
                                        <br>
                                        <label>Amende : <?php echo number_format($infos->getMontantAmande(), 0, '.', ' '); ?> Ar</label>
                                    <?php } ?>
                                    <br>
                                    <a href="<?php echo base_url(); ?>/enleveVoiture?matricule=<?php echo $infos->getMatricule(); ?>"><i class="mdi mdi-delete"></i></a>
                                </div>
                            </div>
                            </div>
                    <?php } ?>
                </div>
                <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
        </div>