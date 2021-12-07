<?php
require 'class\Html.php';
require 'class\Auth.php';

$controller = $controller['controller'][0];
$auth = new Auth();

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
                      <div class="card-header">Login</div>
                      <div class="card-body">
                          <form method="GET" class="was-validated">
                              <div class="form-group row">
                                  <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                  <div class="col-md-6">
                                      <input type="text" id="email_address" class="form-control" name="email" required>
                                      <?php 
                                        if ($_GET != []) {
                                            if (!$auth->login($bdd,$_GET)) {
                                                ?>
                                                    <div class="invalid-feedback">L'adresse e-mail ou le mot de passe est incorect</div>
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
                                      <?php 
                                        if ($_GET != []) {
                                            if (!$auth->login($bdd,$_GET)) {
                                                ?>
                                                    <div class="invalid-feedback">L'adresse e-mail ou le mot de passe est incorect</div>
                                                <?php
                                            }
                                        }
                                      ?>
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
                            if ($auth->login($bdd,$_GET)) {
                                ?>
                                    <div class='alert alert-success' role='alert'>
                                      La connexion à été effectué, <a href='http://localhost:8000'>Redirection vers la page principal</a>
                                    </div>
                                <?php
                            }
                        }
                      ?>
                      <a href="http://localhost:8000/register">Inscrivez-vous !</a>
                  </div>
            </div>
        </div>
    </div>
</main>