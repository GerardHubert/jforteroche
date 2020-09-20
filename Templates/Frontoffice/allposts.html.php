<h2>Tous les épisodes</h2>
<?php foreach ($data['episode'] as $entry) {?>
    <article>
        <a href="index.php?action=post&id=<?=$entry['episode_id']?>">
            <h3 class='episode_title'>Episode <?=$entry['numero_episode']?>: <?=$entry['episode_title']?></h3>
        </a>
        <span class='post_date'>Posté le <?=$entry['episode_date']?></span>
        <p><?=htmlspecialchars_decode($entry['episode_content'])?>... <span id="read_next"><a href='index.php?action=post&id=<?=$entry['episode_id']?>'>Lire la suite</a></p>
    </article>
<?php
}?>

<div id="prev_next">
    <?php
    if ($data['currentPage'] > 1 && $data['currentPage'] <= $data['maxPages']) {
    ?>
    <span id="previous">
        <a href="index.php?action=get_all&page=<?=$data['currentPage'] - 1?>">
            <button>Page Précédente</button>
        </a>
    </span>
    <?php
    }
    if ($data['currentPage'] < $data['maxPages'] && $data['currentPage'] >= 1) {
    ?>
    <span id="next">
        <a href="index.php?action=get_all&page=<?=$data['currentPage'] + 1?>">
            <button>Page suivante</button>
        </a>
    </span>
    <?php
    }
    ?>
</div>