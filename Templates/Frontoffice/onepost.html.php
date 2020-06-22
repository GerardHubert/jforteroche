<article>
    <h3>Episode <?=$data['onepost']['episode_id']?>: <?=$data['onepost']['episode_title']?></h3>
    <p><?=$data['onepost']['episode_content']?></p>
</article>

<form class="comment_form" method="post" action="post.php">
    <label for="pseudo">Pseudonyme</label>
    <input type="text" name="pseudo"/>
    <label for="comment">Commentaire</label>
    <textarea class="comment_area" name="comment" rows="10" cols="40">Votre commentaire ici</textarea>
    <input type="submit" value="Envoyer"/>
</form>

<h3>COMMENTAIRES</h3>