<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Ajout place de parking</h4>
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
                        <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
                        <form action="<?php echo base_url(); ?>/ajoutPlace" method="post">
                            <div class="form-group">
                                <label>Parking</label>
                                <select name="idparking" class="form-control">
                                    <option>Choix de parking</option>
                                <?php foreach($listeParking as $parking) { ?>
                                    <option value="<?php echo $parking->getIdParking(); ?>"><?php echo $parking->getNomParking(); ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nombre de place</label>
                                <input type="number" name="nombreplace" class="form-control">
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