<?php
class User
{
    public function getUser($bdd, $session_id)
    {
        $stmt = $bdd->prepare("SELECT * FROM users WHERE session_id=?");
        $stmt->execute([$session_id]); 
        $user = $stmt->fetch();
        return $user;
    }

    public function updateUser($bdd, $user, $email)
    {
        try {
            if ($user['password'] != "") {
                $stmt = $bdd->prepare("UPDATE users SET name=?, surname=?, password=?, currency=? WHERE email=?");
                $stmt->execute([$user['name'], $user['surname'], base64_encode($user['password']), $user['currency'], $email]);
            } else {
                $stmt = $bdd->prepare("UPDATE users SET name=?, surname=?, currency=? WHERE email=?");
                $stmt->execute([$user['name'], $user['surname'], $user['currency'], $email]);
            }
            return "<div class='alert alert-success' role='alert'>
                    Votre utilisateur à bien été modifié.
            </div>";
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function getBalanceByUser($session_id, $bdd)
    {
        $results = 0;
        $stmt = $bdd->prepare("SELECT DISTINCT b.balance FROM users u INNER JOIN bank_account b ON b.user_id=u.id AND u.session_id=?");
        $stmt->execute([$session_id]); 
        $bank = $stmt->fetchAll();
        for ($i=0; $i < count($bank); $i++) { 
           $results += (int)$bank[$i]['balance'];
        }
        return $results;
    }
}
?>