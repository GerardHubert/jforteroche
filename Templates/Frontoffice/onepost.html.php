<article>
    <h3>Episode <?=$data['episode'][0]['episode_id']?> : <?=$data['episode'][0]['episode_title']?></h3>
    <p><?=$data['episode'][0]['episode_content']?></p>
</article>

<section class="commentaires">

    <h3>COMMENTAIRES</h3>

    <form class="comment_form" method="post" action="index.php?action=post&id=<?=$data['episode'][0]['episode_id']?>">
        <label for="pseudo">Pseudonyme</label>
        <input type="text" name="pseudo"/>
        <label for="comment">Commentaire</label>
        <textarea class="comment_area" name="comment" rows="10" cols="40">Votre commentaire ici</textarea>
        <input type="submit" value="Envoyer"/>
    </form>

    <?php
        foreach($data['comments'] as $commentsData) {
    ?>
        <h4>De <?=htmlspecialchars($commentsData['pseudo'])?>, le <?=$commentsData['comment_date']?></h4>
        <p><?=htmlspecialchars($commentsData['comment'])?></p>
        <?php
        }
        ?>

</section>