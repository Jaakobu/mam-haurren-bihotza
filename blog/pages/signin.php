<?php
    if(isLogged() == 1){
        header("Location:index.php?page=membres");
    }
?>
<head>
    <title>Haurren Bihotza | Se connecter</title>
</head>
<div class="container">
<h2>Se connecter</h2>
<hr/>

<?php
//je  détermine que la varible existe
    if(isset($_POST['sig'])){
        $email = htmlspecialchars(trim($_POST['email']));
        $password = sha1(htmlspecialchars(trim($_POST['password'])));

        if(user_exist($email,$password) == 1){
            $_SESSION['tchat'] = $email;
            header("Location:index.php?page=home");
        }else{
            $error_user_not_found = "L'adresse email ou le mot de passe est incorrect";
        }


    }

?>

<div class="row">
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">perm_identity</i>
                <input id="email" type="email" name="email">
                <label for="email">Votre adresse email</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" type="password" name="password">
                <label for="password">Votre mot de passe</label>
            </div>
            <p class="error"><?php echo (isset($error_user_not_found)) ? $error_user_not_found : ''; ?></p>
            <button class="btn waves-effect light-blue" type="submit" name="sig">Se connecter</button> 
            <button class="btn waves-effect light-blue"><a class="white-text" href="admin/index.php?page=login">Panel d'aministration</a></button>
        </div>
    </form>
</div>