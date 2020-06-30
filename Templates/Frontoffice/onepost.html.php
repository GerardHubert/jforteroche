<article>
    <h3>Episode <?=$data['episode']['episode_id']?> : <?=$data['episode']['episode_title']?></h3>
    <p><?=$data['episode']['episode_content']?></p>
</article>

<section class="commentaires">

    <h3>COMMENTAIRES</h3>

    <form class="comment_form" method="post" action="index.php?action=post&id=<?=$data['episode']['episode_id']?>">
        <label for="pseudo">Pseudonyme</label>
        <input class="input_name" type="text" name="pseudo"/>
        <label for="comment">Commentaire</label>
        <textarea class="comment_area" name="comment" rows="10" cols="40">Votre commentaire ici</textarea>
        <input class="submit" type="submit" value="Poster"/>
    </form>

    <?php
        foreach($data['comments'] as $commentsData) {
    ?>
        <h4>De <?=$commentsData['pseudo']?>, le <?=$commentsData['comment_date']?></h4>
        <p><?=$commentsData['comment']?></p>
        <?php
        }
        ?>

</section>