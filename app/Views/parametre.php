<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Paramètre et modification heure début</h4>
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
                        <form action="<?php echo base_url(); ?>/upDateParametre" method="post">
                            <div class="form-group">
                                <label>Date paramètre</label>
                                <input type="date" name="dateparametre" value="<?php echo $date; ?>" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Heure paramètre</label>
                                <input type="text" name="heureparametre" value="<?php echo $heure; ?>" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Options</label>
                                <select name="options" class="form-control">
                                    <option value="<?php echo $options; ?>"><?php echo $options; ?></option>
                                    <option value="<?php echo $autre; ?>"><?php echo $autre; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block form-control form-control-md"><i class="mdi mdi-update"></i> Modifier</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-4" style="margin-left: 500px; margin-top: -315px;">
                        <br>
                        <form action="<?php echo base_url(); ?>/updateHeureDebut" method="post">
                            <div class="form-group">
                                <label>Matricule</label>
                                <select name="idvoiture" class="form-control">
                                    <option>Choix matricule</option>
                                    <?php foreach($listeVoiture as $voiture) { ?>
                                        <option value="<?php echo $voiture->getIdVoiture(); ?>"><?php echo $voiture->getMatricule(); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Heure début</label>
                                <input type="time" name="heuredebut" class="form-control" />
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
</div>