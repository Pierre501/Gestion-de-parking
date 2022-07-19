<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Ajout de voiture sur une place de parking</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="col-12">
                <div class="row">
                    <div class="col-4" style="margin-left: 60px;">
                    <br>
                    <h4 class="page-title">Réservation place</h4>
                    <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
                        <form action="<?php echo base_url(); ?>/stationne" method="post">
                            <div class="form-group">
                                <label>Numéro de place</label>
                                <select name="idplace" class="form-control">
                                    <option>Choix numéro</option>
                                <?php foreach($listePlace as $place) { ?>
                                    <option value="<?php echo $place->getIdPlace(); ?>"><?php echo $place->getNumero(); ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Matricule voiture</label>
                                <select name="idvoiture" class="form-control">
                                    <option>Choix matricule</option>
                                <?php foreach($listeVoiture as $voiture) { ?>
                                    <option value="<?php echo $voiture->getIdVoiture(); ?>"><?php echo $voiture->getMatricule(); ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type du tarif</label>
                                <select name="idtarifparking" class="form-control">
                                    <option>Choix tarif</option>
                                <?php foreach($listeTarif as $tarif) { ?>
                                    <option value="<?php echo $tarif->getIdTarifParking(); ?>"><?php echo $tarif->getTarif(); ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block form-control form-control-md"><i class="mdi mdi-plus"></i> Ajouter</button>
                            </div>
                            <div class="form-group">
                                <a href="<?php echo base_url(); ?>/ticket" class="btn btn-success btn-lg btn-block form-control form-control-md"><i class="mdi mdi-file-pdf"></i> Ticket</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-4" style="margin-left: 580px; margin-top: -410px">
                        <br>
                        <h4 class="page-title">Ajout voiture</h4>
                        <p></p>
                        <form action="<?php echo base_url(); ?>/ajoutVoiture" method="post">
                            <div class="form-group">
                                <label>Numéro matricule</label>
                                <input type="text" name="matricule" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Modèle</label>
                                <input type="text" name="model" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Marque</label>
                                <input type="text" name="marque" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option>Choix type</option>
                                    <option value="Legèrs">Legèrs</option>
                                    <option value="Lourds">Lourds</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block form-control form-control-md"><i class="mdi mdi-plus"></i> Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>