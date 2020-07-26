<?php
if (admin() != 1) {
    header("Location:index.php?page=dashboard");
}

?>

<head>
    <title>Haurren Bihotza | Nouveau post</title>
</head>

<h2>Poster un article</h2>

<?php
//si la variable existe, je peux afficher le post
if (isset($_POST['post'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    //si jamais la checkbox est activée je poste sinon non.
    $posted = isset($_POST['public']) ? "1" : "0";

    $errors = [];
    //tous les champs doivent être remplis sinon j'alerte
    if (empty($title) || empty($content)) {
        //creation de tableau ou on met l'erreur
        $errors['empty'] = "Veuillez remplir tous les champs";
    }
    //check que le champ image n'est pas vide si jamais pas vide, je commence le traitement des images.
    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image']['name'];
        $extensions = ['.jpg', '.jpeg', '.JPG', '.JPEG'];
        $extension = strrchr($file, '.');

        //check si les extensions du fichier figurent dans le tableau extensions
        if (!in_array($extension, $extensions)) {
            $errors['image'] = "Cette image n'est pas valable";
        }
    }
 // creation d'un encart avec le message d'erreur. 
    if (!empty($errors)) {
?>
        <div class="card red">
            <div class="card-content white-text">
                <?php
                foreach ($errors as $error) {
                    echo $error . "<br/>";
                }
                ?>
            </div>
        </div>
<?php
//si je n'ai pas d'erreur,je peux poster un article avec ou sans image.
    } else {
        post($title, $content, $posted);
        if (!empty($_FILES['image']['name'])) {
            post_img($_FILES['image']['tmp_name'], $extension);
        } else {
            $id = $db->lastInsertId();
            header("Location:index.php?page=post&id=" . $id);
        }
    }
}


?>


<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title" />
            <label for="title">Titre de l'article</label>
        </div>

        <div class="input-field col s12">
            <textarea name="content" id="content" class="materialize-textarea"></textarea>
            <label for="content">Contenu de l'article</label>
        </div>
        <div class="col s12">
            <div class="input-field file-field">
                <div class="btn">
                    <span>Image</span>
                    <input type="file" name="image" class="col s12" />
                </div>
                <div>
                    <input type="text" class="file-path validate" readonly />
                </div>
            </div>
        </div>

        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public" />
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>

        <div class="col s6 right-align">
            <br /><br />
            <button class="btn" type="submit" name="post">Publier</button>
        </div>

    </div>



</form>