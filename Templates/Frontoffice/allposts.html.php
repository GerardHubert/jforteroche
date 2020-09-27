<h2>Tous les épisodes</h2>
<?php foreach ($data['episode'] as $entry) {?>
    <article>
        <a href="index.php?action=post&id=<?=$entry['episode_id']?>">
            <h3 class='episode_title'>Episode <?=$entry['numero_episode']?>: <?=$entry['episode_title']?></h3>
        </a>
        <span class='post_date'>Posté le <?=$entry['episode_date']?></span><br/>
        <?=htmlspecialchars_decode($entry['episode_content'])?>... <span class="read_next"><a href='index.php?action=post&id=<?=$entry['episode_id']?>'>Lire la suite</a></span>
    </article>
<?php
}?>

<div id="prev_next">
    <?php
    if ($data['currentPage'] > 1 && $data['currentPage'] <= $data['maxPages']) {
    ?>
    <span id="previous">
        <a href="index.php?action=get_all&page=<?=$data['currentPage'] - 1?>">
            Page Précédente
        </a>
    </span>
    <?php
    }
    if ($data['currentPage'] < $data['maxPages'] && $data['currentPage'] >= 1) {
    ?>
    <span id="next">
        
            <a href="index.php?action=get_all&page=<?=$data['currentPage'] + 1?>">
                Page suivante
            </a>
        
    </span>
    <?php
    }
    ?>
</div>