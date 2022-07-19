<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Ajout de monnaie dans le porte feuille</h4>
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
                    <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
                        <form action="<?php echo base_url(); ?>/ajoutPorteFeuille" method="post">
                            <br>
                            <div class="form-group">
                                <label>Montant</label>
                                <input type="number" name="montant" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block form-control form-control-md"><i class="mdi mdi-plus"></i> Ajouter</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-4" style="margin-left: 600px; margin-top: -215px">
                            <label>Votre solde</label>
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Solde</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo number_format($solde, 0, '.', ' '); ?> Ar</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>