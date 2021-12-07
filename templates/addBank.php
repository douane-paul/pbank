<?php 

require 'class\Html.php';
require 'class\Auth.php';
require 'class\Data.php';
require 'class\User.php';
require 'class\Bank.php';

$data = new Data();
$users = new User();
$user = $users->getUser($bdd, $_SESSION['session_id']);

$bank = new Bank();

$login = new Auth;

$login->authenticate();

$html = new Html();

$html->generate($html->header());
$html->generate($html->beginBody());

include 'navbar.php';

var_dump($currentRequest);
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
                      <div class="card-header">Ajouter une banque</div>
                      <div class="card-body">
                          <form method="GET" class="was-validated">
                              <div class="form-group row">
                                  <label for="name" class="col-md-4 col-form-label text-md-right">Nom de la banque</label>
                                  <div class="col-md-6">
                                      <input type="text" id="name" class="form-control" name="name" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="surname" class="col-md-4 col-form-label text-md-right">Solde du compte</label>
                                  <div class="col-md-6">
                                      <input type="number" id="balance" class="form-control" name="balance" required>
                                  </div>
                              </div>

                              <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="btn-submit">
                                    Ajouter
                                    </button>
                                </div>
                          </form>
                          <?php
                            if ($_GET != []) {
                                echo $bank->addBank($_SESSION['session_id'],$_GET,$bdd);
                            }
                          ?>
                      </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
$html->generate($html->endBody());
?>