<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Liste des tarif du parking</h4>
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
                    <div class="col-10" style="margin-left: 80px;">
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tarif</th>
                                    <th>Dure</th>
                                    <th>Montant</th>
                                    <th colspan="2">Options</th>
                                </tr>
                            </thead>
                            <?php if(!empty($listeTarif)) { ?>
                                <tbody>
                                    <?php foreach($listeTarif as $tarif) { ?>
                                        <tr>
                                            <td><?php echo $tarif->getTarif(); ?></td>
                                            <td><?php echo $tarif->getDure(); ?></td>
                                            <td><?php echo number_format($tarif->getMontant(), 0, '.', ' '); ?> Ar</td>
                                            <td><a href="<?php echo base_url(); ?>/pageModifierTarif?id=<?php echo $tarif->getIdTarifParking(); ?>" class="btn btn-primary form-control-md"><i class="mdi mdi-pencil"></i> Modifier</a></td>
                                            <td><a href="<?php echo base_url(); ?>/deleteTarif?id=<?php echo $tarif->getIdTarifParking(); ?>" class="btn btn-danger form-control-md"><i class="mdi mdi-delete"></i> Supprimer</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="col-10" style="margin-left: 80px;">
                        <a href="<?php echo base_url(); ?>/pageAjoutTarif" class="btn btn-success  form-control-md"><i class="mdi mdi-plus"></i> Ajouter</a>   
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>