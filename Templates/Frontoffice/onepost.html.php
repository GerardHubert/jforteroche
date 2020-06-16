<article>
    <h3>Episode <?=$data['onepost']['id']?>: <?=$data['onepost']['title']?></h3>
    <p><?=$data['onepost']['content']?></p>
</article>

<form class="comment_form" method="post" action="post.php">
    <label for="pseudo">Pseudonyme</label>
    <input type="text" name="pseudo"/>
    <label for="commentaire">Commentaire</label>
    <input type="text" name="commentaire"/>
    <input type="submit" value="Envoyer"/>
</form>

<h3>COMMENTAIRES</h3>