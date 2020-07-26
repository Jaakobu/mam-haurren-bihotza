<?php
	if(isLogged() == 1){
		header("Location:index.php?page=membres");
	}
?>

<head>
    <title>Haurren Bihotza | S'inscrire</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div class="container">
<h2>S'inscrire</h2>
<hr/>

<?php
//je vérifie que la variable est différente de null
	if(isset($_POST['submit'])){
		$name = htmlspecialchars(trim($_POST['name']));
		$email = htmlspecialchars(trim($_POST['email']));
		$password = sha1(htmlspecialchars(trim($_POST['password'])));

		if(email_token($email) == 1){
			$error_email = "L'adresse email est déjà utiliser...";
		}else{
			register($name, $email, $password);
			$_SESSION['tchat'] = $email;
			header("Location:index.php?page=home");
		}
	}

?>

<form method="post" id="regForm">
	<div class="field">
		<label class="field-label" for="name">Votre nom</label>
		<input class="field-input" type="text" name="name" id="name"></input>
	</div>

	<div class="field">
		<label class="field-label" for="email">Votre adresse email</label>
		<input class="field-input" type="email" name="email" id="email"></input>
	</div>

	<div class="field">
		<label class="field-label" for="password">Votre mot de passe</label>
		<input class="field-input" type="password" name="password" id="password"></input>
	</div><br/>
	<p class="error"><?php echo (isset($error_email)) ? $error_email : ''; ?></p>
	<button class="btn waves-effect light-blue waves-light white-text" type="submit" name="submit">S'inscrire</button>
</form>