<?php
require __DIR__ . '/../vendor/autoload.php';

class Auth {
  public function authenticate()
  {
    if(!isset($_SESSION['session_id'])){
      header('Location: http://localhost:8000/login');
      exit();
    }
  }

  public function register($bdd, $post)
  {
    $sql = 'INSERT INTO `users` (`id`, `name`, `surname`, `birthday`, `nation`, `cp`, `email`, `password`, `currency`, `session_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, NULL);';
    $stmt= $bdd->prepare($sql);
    $stmt->execute([$post['name'], $post['surname'], $post['birthday'], $post['country'], $post['zip'], $post['email'], base64_encode($post['password']), $post['currency']]);
    return "<div class='alert alert-success' role='alert'>
      L'inscription à bien été effectué, <a href='http://localhost:8000/login'>Redirection vers login</a>
    </div>";
  }

  public function isEmailUSe($bdd, $post)
  {
    $sql = 'SELECT id, email
    FROM users WHERE email=?';

    $isEmailUse = false;

    $stmt = $bdd->prepare("SELECT id, email
    FROM users");
    $stmt->execute(); 
    $users = $stmt->fetchAll();
      
    if ($users) {
      foreach ($users as $key => $user) {
        if ($post['email'] == $user['email']) {
            $isEmailUse  = true;
            break;
        }
      }

      return $isEmailUse;
    } else {
      return $isEmailUse;
    }
  }

  public function login($bdd, $post)
  {

    $stmt = $bdd->prepare("SELECT email,password FROM users WHERE email=?");
    $stmt->execute([$post['email']]); 
    $user = $stmt->fetch();
    if ($user != []) {
      if (base64_decode($user['password']) == $post['password']) {
        $session_id = rand(100000000, 999999999);
        $_SESSION['session_id'] = $session_id;
        $stmt = $bdd->prepare("UPDATE users SET session_id=? WHERE email=?");
        $stmt->execute([$session_id, $post['email']]); 
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
