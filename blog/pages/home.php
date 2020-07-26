<head>
    <title>Haurren Bihotza | Accueil</title>
</head>
<div class="container">
<h2>Accueil</h2>
<hr/>
<div class="row">
<?php

$posts = get_posts();
foreach ($posts as $post){
	?>
		<div class="col l6 m6 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="grey-text text-darken-2"><?= $post->title ?></h5>
					<h6 class="grey-text">Le <?= date("d/m/Y à H:i", strtotime($post->date)); ?> Par <?= $post->name ?></h6>
				</div>
				<div class="card-image waves-effect waves-block waves-light">
					<img class="activator" src="img/posts/<?= $post->image ?>" alt="<?= $post->title ?>">
				</div>
				<div class="card-content">
					<span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
					<p><a href="index.php?page=post&id=<?= $post->id ?>">Voir l'article complet</a></p>
				</div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4"><?= $post->title ?><i class="material-icons right">close</i></span>
					<p><?= substr(nl2br($post->content),0,502); ?>...</p>
				</div>
			</div>
		</div>
	<?php
}
?>
</div>