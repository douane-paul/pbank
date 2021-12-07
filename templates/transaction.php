<?php 

require 'class\Html.php';
require 'class\Auth.php';
require 'class\Data.php';
require 'class\User.php';
require 'class\Bank.php';
require 'class\Transaction.php';

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

$banks = $bank->getAllBankByUser($bdd, $_SESSION['session_id']);
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
                      <div class="card-header">Ajouter une transaction</div>
                      <div class="card-body">
                          <form method="GET" class="was-validated">
                                <div class="form-group row">
                                  <label for="bank-select" class="col-md-4 col-form-label text-md-right">Banque</label>
                                  <div class="col-md-6">
                                    <select name="bank" id="bank-select" class="form-select" required>
                                      <?php
                                        foreach ($banks as $key => $value) {
                                      ?>
                                            <option value='<?= $value['id'] ?>'><?= $value['bank'] ?></option>
                                      <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>

                              <div class="form-group row">
                                  <label for="amount" class="col-md-4 col-form-label text-md-right">Montant de la transaction</label>
                                  <div class="col-md-6">
                                      <input type="number" id="amount" class="form-control" name="amount" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="date" class="col-md-4 col-form-label text-md-right">Date de la transaction</label>
                                  <div class="col-md-6">
                                      <input type="date" id="date" class="form-control" name="date" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="category" class="col-md-4 col-form-label text-md-right">Catégorie de la transaction</label>
                                  <div class="col-md-6">
                                      <input type="text" id="category" class="form-control" name="category" required>
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
                                $transaction = new Transaction();
                                echo $transaction->add($bdd, $_GET, $_GET['bank'], $bank->getBankById($bdd, $_GET['bank']));
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