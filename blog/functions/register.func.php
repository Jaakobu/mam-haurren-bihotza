<?php
//Verification si l'email n'est pas déjà utilisé
function email_token($email){
    global $db;
    $e = array('email' => $email);
    $sql = 'SELECT * FROM users WHERE email = :email';
    $req = $db->prepare($sql);
    $req->execute($e);
    
    //vérification si l'email n'est pas pris via un compteur
    $free = $req->rowCount($sql);

    return $free;
}

function register($name, $email, $password){
    global $db;
    $r = array(
        'name'=>$name,
        'email'=>$email,
        'password'=>$password
    );
    $sql = "INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
    $req = $db->prepare($sql);
    $req->execute($r);
}