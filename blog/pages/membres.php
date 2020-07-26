<?php
    if(isLogged() == 0){
        header("Location:index.php?page=signin");
    }
?>
<head>
    <title>Haurren Bihotza | Membres</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div class="container">
<h2>Tous les membres</h2>
<hr/>

<?php
    foreach(get_membres() as $membre){
        if($membre->email != $_SESSION['tchat']){
            ?>
                <div class="membre">
                    <strong><?= $membre->name ?></strong><br/>
                    <br/>
                    <a class="select" href="index.php?page=tchat&user=<?= $membre->email ?>"><span class="i-user"></span></a>
                </div>

            <?php
        }

    }
?>