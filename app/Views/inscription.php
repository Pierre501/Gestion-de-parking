<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Utilisateur</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/assets/images/favicon.png">
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: -25px;">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center" style="margin-top: -35px;">
            <h4 class="mb-4">Inscription utilisateur</h4>
            <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
            <form action="<?php echo base_url() ?>/ajoutUtilisateur" method="post">
             <div class="form-outline mb-4">
                <input type="text" name="nom" id="typeEmailX-2" class="form-control form-control-md" />
                <label class="form-label" for="typeEmailX-2">Nom et Prénom</label>
              </div>
              <div class="form-outline mb-4">
                <input type="email" name="username" id="typeEmailX-2" class="form-control form-control-md" />
                <label class="form-label" for="typeEmailX-2">Nom d'utilisateur</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="motdepasse" id="typePasswordX-2" class="form-control form-control-md" />
                <label class="form-label" for="typePasswordX-2">Mot de passe</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="motdepasseconfirme" id="typePasswordX-2" class="form-control form-control-md" />
                <label class="form-label" for="typePasswordX-2">Confirme mot de passe</label>
              </div>
              <div>
                <input type="submit" class="btn btn-success btn-lg btn-block form-control form-control-md" value="Créer" />
              </div>
            </form>
            <br>
            <div>
                <a href="<?php echo base_url(); ?>/loginUser" class="btn btn-primary btn-lg btn-block form-control form-control-md">Connexion</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>