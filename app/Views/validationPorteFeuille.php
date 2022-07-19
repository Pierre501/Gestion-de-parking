<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Liste des portefeuille non validé</h4>
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
                    <div class="col-8" style="margin-left: 120px;">
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nom et Prénom</th>
                                    <th>Montant</th>
                                    <th>Date du dépot</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <?php if(!empty($listePorteFeuille)) { ?>
                                <tbody>
                                    <?php foreach($listePorteFeuille as $views) { ?>
                                        <form action="<?php echo base_url(); ?>/validationPorteFeuille" method="post">
                                            <input type="hidden" name="datedepot" value="<?php echo $views->getDateDepot(); ?>" />
                                            <tr>
                                                <td><?php echo $views->getNom(); ?></td>
                                                <td><?php echo number_format($views->getMontant(), 0, '.', ' '); ?> Ar</td>
                                                <td><?php echo $views->getDateDepot(); ?></td>
                                                <td><button type="submit" class="btn btn-primary btn-lg btn-block"><i class="mdi mdi-check"></i> valider</button></td>
                                            </tr>
                                        </form>
                                    <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>