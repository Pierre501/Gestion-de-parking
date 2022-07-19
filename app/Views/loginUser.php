<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Utilisateur</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>/assets/images/favicon.png">
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <h4 class="mb-4">Se connecter</h4>
            <p style="color: red;"><?php if(isset($messages)) { echo $messages; } ?></p>
            <form action="<?php echo base_url() ?>/connexionUser" method="post">
              <div class="form-outline mb-4">
                <input type="email" name="username" id="typeEmailX-2" class="form-control form-control-md" />
                <label class="form-label" for="typeEmailX-2">Nom d'utilisateur</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="motdepasse" id="typePasswordX-2" class="form-control form-control-md" />
                <label class="form-label" for="typePasswordX-2">Mot de passe</label>
              </div>
              <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                <label class="form-check-label" for="form1Example3">Mot de passe oublié ?</label>
              </div>
              <div>
                <input type="submit" class="btn btn-primary btn-lg btn-block form-control form-control-md" value="Connexion" />
              </div>
            </form>
            <br>
            <div>
                <a href="<?php echo base_url(); ?>/inscription" class="btn btn-success btn-lg btn-block form-control form-control-md">Créer un compte</a>
            </div>
            <hr class="my-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>