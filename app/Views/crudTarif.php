<?php if($condition == "ajouter") { ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Gestion de tarif</h4>
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
                        <form action="<?php echo base_url(); ?>/ajoutTarif" method="post">
                            <br>
                            <h4 class="page-title">Ajout tarif</h4>
                            <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
                            <div class="form-group">
                                <label>Nom tarif</label>
                                <input type="text" name="tarif" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Duré</label>
                                <input type="time" name="dure" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Montant</label>
                                <input type="number" name="montant" class="form-control">
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
<?php } else { ?>
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Gestion de tarif</h4>
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
                        <form action="<?php echo base_url(); ?>/upDateTarif" method="post">
                            <br>
                            <h4 class="page-title">Modifier tarif</h4>
                            <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
                            <input type="hidden" name="idtarifparking" value="<?php echo $tarif->getIdTarifParking(); ?>">
                            <div class="form-group">
                                <label>Nom tarif</label>
                                <input type="text" name="tarif" value="<?php echo $tarif->getTarif(); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Duré</label>
                                <input type="time" name="dure" value="<?php echo $tarif->getDure(); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Montant</label>
                                <input type="number" name="montant" value="<?php echo $tarif->getMontant(); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block form-control form-control-md"><i class="mdi mdi-update"></i> Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>