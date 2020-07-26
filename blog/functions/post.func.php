<?php
// A la différence des autres get_posts ici on veut seulement en récupérer 1 seul.
function get_post(){
    global $db;

    $req = $db->query("
        SELECT  posts.id,
                posts.title,
                posts.image,
                posts.content,
                posts.date,
                admins.name
        FROM posts
        JOIN admins
        ON posts.writer = admins.email 
        WHERE posts.id='{$_GET['id']}'
        AND posts.posted = '1'
    ");
//Attention : dans la requête sql, si post.posted n'existe pas, il peut y avoir une possiblité de voir l'article crée mais non publié.
    $result = $req->fetchObject();
    return $result;

}

//Crétation de la fonction commentaire qui sera inséré dans post.php
function comment($name,$email,$comment){

    global $db;

    $c = array(
        'name'      => $name,
        'email'     => $email,
        'comment'   => $comment,
        'post_id'   => $_GET["id"]

    );

    $sql = "INSERT INTO comments(name,email,comment,post_id,date) VALUES(:name, :email, :comment, :post_id, NOW())";
    $req = $db->prepare($sql);
    $req->execute($c);

}

//Recupération de tous les commentaires exitants pour les afficher.
function get_comments(){

    global $db;
    $req = $db->query("SELECT * FROM comments WHERE post_id = '{$_GET['id']}' ORDER BY date DESC");
    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }

    return $results;


}