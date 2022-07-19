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
                    <div class="col-8" style="margin-left: 120px;">
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead style="background-color: cyan;">
                                <tr>
                                    <th>Tarif</th>
                                    <th>Dure</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <?php if(!empty($listeTarif)) { ?>
                                <tbody>
                                    <?php foreach($listeTarif as $tarif) { ?>
                                        <tr>
                                            <td><?php echo $tarif->getTarif(); ?></td>
                                            <td><?php echo $tarif->getDure(); ?></td>
                                            <td><?php echo number_format($tarif->getMontant(), 0, '.', ' '); ?> Ar</td>
                                        </tr>
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