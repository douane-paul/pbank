<?php
require 'class\Html.php';
require 'class\Data.php';
require 'class\Auth.php';

$controller = $controller['controller'][0];
$auth = new Auth();
$data = new Data();

$html = new Html();

$html->generate($html->header());
$html->generate($html->beginBody());

?>

<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>


<main class="my-form">
    <div class="container-fluid">
        <div class="justify-content-center row">
            <div class="col-md-8">
                  <div class="card">
                      <div class="card-header">Register</div>
                      <div class="card-body">
                          <form method="GET" class="was-validated">
                              <div class="form-group row">
                                  <label for="name" class="col-md-4 col-form-label text-md-right">Prénom</label>
                                  <div class="col-md-6">
                                      <input type="text" id="name" class="form-control" name="name" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="surname" class="col-md-4 col-form-label text-md-right">Nom</label>
                                  <div class="col-md-6">
                                      <input type="text" id="surname" class="form-control" name="surname" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="birthday" class="col-md-4 col-form-label text-md-right">Anniversaire</label>
                                  <div class="col-md-6">
                                      <input type="date" id="birthday" class="form-control" name="birthday" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="country-select" class="col-md-4 col-form-label text-md-right">Nationnalité</label>
                                  <div class="col-md-6">
                                    <select name="country" id="country-select" class="form-select" required>
                                      <?= $data->country() ?>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="zip" class="col-md-4 col-form-label text-md-right">Code postal</label>
                                  <div class="col-md-6">
                                      <input type="text" id="zip" class="form-control" name="zip" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                  <div class="col-md-6">
                                      <input type="text" id="email_address" class="form-control" name="email" required>
                                      <?php 
                                        if ($_GET != []) {
                                            if ($auth->isEmailUSe($bdd,$_GET)) {
                                                ?>
                                                    <div class="invalid-feedback">L'adresse e-mail est déja utilisé !</div>
                                                <?php
                                            }
                                        }
                                      ?>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="user_name" class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                                  <div class="col-md-6">
                                      <input type="password" id="password" class="form-control" name="password" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="currency-select" class="col-md-4 col-form-label text-md-right">Monnaie</label>
                                  <div class="col-md-6">
                                    <select name="currency" id="currency-select" class="form-select" required>
                                      <?= $data->currency() ?>
                                    </select>
                                  </div>
                              </div>

                                  <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary" id="btn-submit">
                                      Register
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                    <?php
                        if ($_GET != []) {
                            if (!$auth->isEmailUSe($bdd,$_GET)) {
                                echo $auth->register($bdd,$_GET);
                            }
                        }
                    ?>
                  </div>
            </div>
        </div>
    </div>
</main>

