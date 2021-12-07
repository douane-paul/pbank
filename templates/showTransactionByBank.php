<?php 

require 'class\Html.php';
require 'class\Auth.php';
require 'class\User.php';
require 'class\Bank.php';
require 'class\Transaction.php';


$login = new Auth;
$user = new User();
$bank = new Bank();

$login->authenticate();

// Par défaut, on imagine qu'aucun id n'a été précisé
$id = $currentRequest['id'];

$balance = $bank->getBankById($bdd, $id);

// Si aucun id n'est passé ou que l'id n'existe pas dans
// la liste des tâches, on arrête tout !
if (!$id || $bank->getBankById($bdd, $id) == []) {
    throw new Exception("La banque demandée n'existe pas !");
}

$bank = new Bank();

$html = new Html();

$html->generate($html->header());
$html->generate($html->beginBody());

include 'navbar.php';

?>
<style>
.balance{
    height: 8vh;
}

.p-title{
  margin-bottom: 0px;
  margin-left: 10px;
  color: black;
}

.p-balance{
  color: #A0D194;
  margin-right: 10px;
}

.balance-title{
  margin-bottom: 0px;
}

.date{
  background-color: #EBEFF5;
  color: #F6C25B;
  height: 5vh;
  font-size: 15px;
}

.bank{
  height: 56px;
}

.link-bank :hover{
  background-color: #F7F9FC;
}

.hr-bank{
  width: 80%;
  color: #EBEFF5;
  padding: 0px;
  margin: auto;
}

.banks{
  height:78vh;
  overflow-y: scroll;
}

.right-side-container{
  height: 84vh;
}
</style>

<div class="container-fluid">
  <div class="row">
    <div class="d-flex card justify-content-center text-center w-100">
      <h3 class="balance-title"><?= $balance[0]['balance'] ?> €</h3>
      <p class="p-title">Solde total</p>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row d-flex">
    <div class="col-4 p-0 border">
      <div class="container p-0 overflow-auto banks">
        <?php 
        $transactions = new Transaction();
        $transactions = $transactions->getTransactionsByBankId($bdd, $id);
        for ($i=0; $i < count($transactions); $i++) { 
          if ($i == 0) {
            ?>
            <div class="col-12 date d-flex justify-content-end align-items-center">
              <p class="p-title"><?= $transactions[$i]['date'] ?></p>
            </div>
            <?php
          }elseif($transactions[$i]['date'] != $transactions[$i -1]['date']) {
              ?>
              <div class="col-12 date d-flex justify-content-end align-items-center">
                <p class="p-title"><?= $transactions[$i]['date'] ?></p>
              </div>
              <?php
            }
        ?>
          <a href="http://localhost:8000/show/<?= $id ?>/transaction/<?= $transactions[$i]['id'] ?>" class="link-bank">
            <div class="col-12 bank d-flex align-items-center justify-content-between p-0">
              <p class="p-title"><?= $transactions[$i]['category'] ?></p>
              <p class="p-title p-balance"><strong><?= $transactions[$i]['amount']?> €</strong></p>
            </div>
          </a>
          <hr class="hr-bank">
        <?php
        } 
        ?>
      </div>  
    </div>
    <div class="col-8 right-side-container d-flex justify-content-center text-center align-items-center">
      <h3>Ici vous pouvez voir toutes vos transactions !</h3>
    </div>
  </div>
</div>
<?php
$html->generate($html->endBody());
?>