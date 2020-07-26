<?php
    include 'functions/main-functions.php';

    //récupération de toutes les pages

    $pages = scandir('pages/');
    if(isset($_GET['page']) && !empty($_GET['page'])){
        if(in_array($_GET['page'].'.php',$pages)){
            $page = $_GET['page'];
        }else{
            $page = "error";
        }
    }else{
        $page = "home";
    }
    //scan du dossier fonctions
    $pages_functions = scandir('functions/');
    //Si la page demandée existe on charge les fonctions
    if(in_array($page.'.func.php',$pages_functions)){
        include 'functions/'.$page.'.func.php';
    }

?>

<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:500,700,400' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" type="image/png" href="img/logo.png" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script>
            (function($){
                $(window).load(function(){
                    $("body").mCustomScrollbar({
                        theme:'minimal-dark', 
                        scrollInertia:200
                    });
                });
            })(jQuery);
        </script>
    </head>
    <body>
        <?php
            include 'body/topbar.php';
        ?>
            <?php
                include 'pages/'.$page.'.php';
            ?>
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <?php
        //Scan et chargement des pages si elles existent. 
            $pages_js = scandir('js/');
            if(in_array($page.'.func.js',$pages_js)){
                ?>
                    <script type="text/javascript" src="js/<?= $page ?>.func.js"></script>
                <?php
            }

        ?>

    </body>
</html>