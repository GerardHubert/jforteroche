<article>
    <h3>Episode <?=$data['episode']['numero_episode']?> : <?=$data['episode']['episode_title']?></h3>
    <p><?=$data['episode']['episode_content']?></p>
</article>

<div id="prev_next">
    <?php
        if ($data['episode']['numero_episode'] > 1 && $data['episode']['numero_episode'] <= $data['totalEpisodes']) {
        ?>
        <span id="previous">
            <a href="index.php?action=previous_episode&numero=<?=$data['episode']['numero_episode']?>&id=<?=$data['episode']['episode_id']?>">
                Episode précédent
            </a>
        </span>
        <?php
        }
        if ($data['episode']['numero_episode'] < $data['totalEpisodes'] && $data['episode']['numero_episode'] >= 1) {
        ?>
        <span id="next">
            <a href="index.php?action=next_episode&numero=<?=$data['episode']['numero_episode']?>&id=<?=$data['episode']['episode_id']?>">
                Episode suivant
            </a>
        </span>
        <?php
        }
        ?>
</div>

<section class="commentaires">

    <h3>COMMENTAIRES</h3>

    <form class="comment_form" method="post" action="index.php?action=save_com&id=<?=$data['episode']['episode_id']?>">
        <label for="pseudo">Pseudonyme</label>
        <input id="pseudo" type="text" name="pseudo"/>
        <label for="comment">Commentaire</label>
        <textarea id="comment" name="comment" rows="10" cols="40"></textarea>
        <input class="hidden" type="hidden" name="hidden_input" value="<?=$this->session->getToken(); ?>" />
        <input class="submit" type="submit" value="Poster"/>
    </form>

    <p><?=$data['errorMessage']?></p>

    <div id='comments_container'>
        <?php
            foreach($data['comments'] as $commentsData) {
        ?>
        <div class='comments'>
            <div class='comment_header'>
                <h4>De <?=$commentsData['pseudo']?>, le <?=$commentsData['comment_date']?></h4>
                <?php
                switch ($commentsData['reported_comment']) {
                    case '0' :
                    ?>
                        <span class='report_comment'>
                            <a href="index.php?action=signal&id=<?=$data['episode']['episode_id']?>&comment_id=<?=$commentsData['comment_id']?>">
                            <i class="fas fa-flag"></i>Signaler ce commentaire</a>
                    </span>
                <?php
                    break;
                    case '1' :
                    ?>
                    <span class='waiting_moderation'>
                        <i class="fas fa-clock"></i>Commentaire signalé, modération en cours
                    </span>
                <?php
                    break;
                    case '2' :
                    ?>
                    <span class='validated_comment'>
                        <i class="fas fa-check"></i>Commentaire validé par le modérateur
                    </span>
                <?php
                    break;
                }
                ?>
            </div>
            <p class='comment_text'><?=$commentsData['comment']?></p>
            </div>

        <?php
        }
        ?>
    </div>

</section>