<?php


class Bank
{
    public function addBank($session_id,$post,$bdd)
    {
        $stmt = $bdd->prepare("SELECT id FROM users WHERE session_id=?");
        $stmt->execute([$session_id]); 
        $user = $stmt->fetch();

        $sql = 'INSERT INTO `bank_account` (`bank`, `balance`, `user_id`) VALUES (?, ?, ?);';
        $stmt= $bdd->prepare($sql);
        $stmt->execute([$post['name'], $post['balance'], $user['id']]);

        return "<div class='alert alert-success' role='alert'>
           Votre banque à bien été ajouté à votre compte !
        </div>";
    }

    public function getAllBankByUser($bdd, $session_id)
    {
        $stmt = $bdd->prepare("SELECT DISTINCT b.id, b.bank, b.balance FROM users u INNER JOIN bank_account b ON b.user_id=u.id AND u.session_id=?");
        $stmt->execute([$session_id]); 
        $bank = $stmt->fetchAll();
        return $bank;
    }

    public function getBankById($bdd, $bank_id)
    {
        $stmt = $bdd->prepare("SELECT * FROM bank_account WHERE id=?");
        $stmt->execute([$bank_id]); 
        $bank = $stmt->fetchAll();
        return $bank;
    }
}