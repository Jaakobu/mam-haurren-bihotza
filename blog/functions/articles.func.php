<?php
//fonction récupérant les posts qui sont "actifs" de manière décroissante
function get_posts(){

    global $db;

    $req = $db->query("SELECT * FROM posts WHERE posted='1' ORDER BY date DESC");
// création de tableau résultats
    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows; //je mets les résultats dans un tableau
    }

    return $results; // retour des résultats


}