<?php
include '../functions/main-functions.php';

$pages = scandir('pages/');
if(isset($_GET['page']) && !empty($_GET['page'])){
    if(in_array($_GET['page'].'.php',$pages)){
        $page = $_GET['page'];
    }else{
        $page = "error";
    }
}else{
    $page = "dashboard";
}

$pages_functions = scandir('functions/');
if(in_array($page.'.func.php',$pages_functions)){
    include 'functions/'.$page.'.func.php';
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:500,700,400' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" type="image/png" href="../img/logo.png" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
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

if($page != 'login' && $page != 'new' && !isset($_SESSION['admin'])){
    header("Location:index.php?page=login");
}

include "body/topbar.php";
?>
<div class="container">
    <?php
    include 'pages/'.$page.'.php';
    ?>
</div>


<!--Import jQuery before materialize.js-->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="../js/materialize.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
<?php
$pages_js = scandir('js/');
if(in_array($page.'.func.js',$pages_js)){
    ?>
    <script type="text/javascript" src="js/<?= $page ?>.func.js"></script>
<?php
}

?>

</body>
</html>