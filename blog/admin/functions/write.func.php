<?php
//creation de la fonction Post en vue d'inserer en base le post
function post($title,$content,$posted){
    global $db;

    $p = [
        'title'     =>  $title,
        'content'   =>  $content,
        'writer'    =>  $_SESSION['admin'], // stocké dans la session de l'admin
        'posted'    =>  $posted

    ];

    $sql = "
      INSERT INTO posts(title,content,writer,date,posted)
      VALUES(:title,:content,:writer,NOW(),:posted)
    ";

    $req = $db->prepare($sql);
    $req->execute($p);

}

function post_img($tmp_name, $extension){
    global $db;
    //recupération du dernier id inséré en base avec LastInsertId
    $id = $db->lastInsertId();
    $i = [
        'id'    =>  $id,
        'image' =>  $id.$extension      //$id = 25 , $extension = .jpg      $id.$extension = "25".".jpg" = 25.jpg
    ];

    $sql = "UPDATE posts SET image = :image WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($i);
    move_uploaded_file($tmp_name,"../img/posts/".$id.$extension);
    //redirection vers une page pour qu'il puisse voir son article
    header("Location:index.php?page=post&id=".$id);
}