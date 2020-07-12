<article>
    <h3>Episode <?=$data['episode']['numero_episode']?> : <?=$data['episode']['episode_title']?></h3>
    <p><?=$data['episode']['episode_content']?></p>
</article>

<section class="commentaires">

    <h3>COMMENTAIRES</h3>

    <form class="comment_form" method="post" action="index.php?action=save_com&id=<?=$data['episode']['episode_id']?>">
        <label for="pseudo">Pseudonyme</label>
        <input class="input_name" type="text" name="pseudo"/>
        <label for="comment">Commentaire</label>
        <textarea class="comment_area" name="comment" rows="10" cols="40"></textarea>
        <input class="submit" type="submit" value="Poster"/>
    </form>

    <?php
        foreach($data['comments'] as $commentsData) {
    ?>
        <h4 id="comment_header">De <?=$commentsData['pseudo']?>, le <?=$commentsData['comment_date']?></h4>
        <a href="index.php?action=signal&id=<?=$data['episode']['episode_id']?>&comment_id=<?=$commentsData['comment_id']?>">
            Signaler ce commentaire
        </a>
        <p><?=$commentsData['comment']?></p>
        <?php
        }
        ?>

</section>