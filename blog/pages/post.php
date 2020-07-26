<?php

$post = get_post();
//si article id n'est pas trouvé = error
if ($post == false) {
    header("Location:index.php?page=error");
} else {
?>
    <!-- Fermeture de div en lien avec la div laissée ouverte en index.php -->
    </div>
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/posts/<?= $post->image ?>" alt="<?= $post->title ?>" />
        </div>
    </div>
    <div class="container">

        <h2><?= $post->title ?></h2>
        <hr />
        <h6>Par <?= $post->name ?> le <?= date("d/m/Y à H:i", strtotime($post->date)) ?></h6>
        <p><?= nl2br($post->content); ?></p>
    <?php
}
    ?>

    <head>
        <title>Haurren Bihotza | <?= $post->title ?></title>
    </head>
    <hr>
    <h4>Commentaires:</h4>
    <?php
    //on affiche tous les commentaires
    $responses = get_comments();
    if ($responses != false) {
        foreach ($responses as $response) {
    ?>
            <blockquote>
                <strong><?= $response->name ?> (<?= date("d/m/Y", strtotime($response->date)) ?>)</strong>
                <p><?= nl2br($response->comment); ?></p>
            </blockquote>
    <?php
        }
    } else echo "Aucun commentaire n'a été publié... Soyez le premier!";
    ?>
    <?php
    if (isLogged() == 1) {
    ?>
        <h4>Commenter:</h4>

        <?php
        //on va vérifier que l'utilisateur a appuyé sur submit
        if (isset($_POST['submit'])) {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $comment = htmlspecialchars(trim($_POST['comment']));
            $errors = [];

            //on vérifie ensuite que les champs ne sont pas vides
            if (empty($name) || empty($email) || empty($comment)) {
                $errors['empty'] = "Tous les champs n'ont pas été remplis";
            } else {
                //on vérifie que le mail est valide

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "L'adresse email n'est pas valide";
                }
            }

            //si jamais j'ai une erreur
            if (!empty($errors)) {
        ?>
                <div class="card red">
                    <div class="card-content white-text">
                        <?php
                        //afficher les erreurs
                        foreach ($errors as $error) {
                            echo $error . "<br/>";
                        }
                        ?>
                    </div>
                </div>
            <?php
            } else {
                comment($name, $email, $comment);
            ?>
                <!-- Donner la possibilité de voir le commentaire en temps réel mais non accepté par l'admin encore -->
                <script>
                    window.location.replace("index.php?page=post&id=<?= $_GET['id'] ?>");
                </script>
        <?php
            }
        }

        ?>
        <!-- Creation du formulaire de commentaire -->
        <form method="post">
            <div class="row">
                <div class="input-field col s12 m6">
                    <input type="text" name="name" id="name" />
                    <label for="name">Nom</label>
                </div>
                <div class="input-field col s12 m6">
                    <input type="email" name="email" id="email" />
                    <label for="email">Adresse email</label>
                </div>
                <div class="input-field col s12">
                    <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
                    <label for="comment">Commentaire</label>
                </div>

                <div class="col s12">
                    <button type="submit" name="submit" class="btn waves-effect">
                        Commenter ce post
                    </button>
                </div>
            </div>
        </form>
    <?php
    } else {
    ?>
        <p class="align-center">Vous devez être connecter pour pouvoir commenter ce post ! <a href="index.php?page=signin">Se connecter ?</a> ou <a href="index.php?page=register">S'inscrire ?</a></p><br /><br /><br /><br />
    <?php
    }
    ?>