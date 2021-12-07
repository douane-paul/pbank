<?php

class Transaction{
    public function add($bdd, $post, $bank_id, $bank)
    {
        $sql = 'INSERT INTO `transaction` (`amount`, `date`, `category`, `bank_id`) VALUES (?, ?, ?, ?);';
        $stmt= $bdd->prepare($sql);
        $stmt->execute([$post['amount'], $post['date'], $post['category'], $bank_id]);

        $sql = 'UPDATE bank_account SET balance=? WHERE id=?';
        $stmt= $bdd->prepare($sql);
        $stmt->execute([$bank[0]['balance'] - $post['amount'], $bank_id]);

        return "<div class='alert alert-success' role='alert'>
           La transaction à bien été ajouté !
        </div>";
    }

    public function getTransactionsByBankId($bdd, $bank_id)
    {
        $stmt = $bdd->prepare("SELECT DISTINCT t.id, t.category, t.amount, t.date FROM bank_account b INNER JOIN transaction t ON t.bank_id=b.id AND b.id=? ORDER BY t.date DESC");
        $stmt->execute([$bank_id]); 
        $transaction = $stmt->fetchAll();
        return $transaction;
    }

    public function getTransactionsById($bdd, $id,$bank_id)
    {
        $stmt = $bdd->prepare("SELECT DISTINCT * FROM bank_account b INNER JOIN transaction t ON t.bank_id=b.id AND b.id=? AND t.id=?");
        $stmt->execute([$bank_id, $id]); 
        $transaction = $stmt->fetchAll();
        return $transaction;
    }
}