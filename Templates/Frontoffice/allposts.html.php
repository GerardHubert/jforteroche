<h2>Tous les épisodes</h2>
<?php foreach ($data as $entry) {?>
    <article>
        <a href='index.php?action=post&id=<?=$entry['episode_id']?>'>
            <h3 class='episode_title'>Episode <?=$entry['numero_episode']?>: <?=$entry['episode_title']?></h3>
        </a>
        <span class='post_date'>Posté le <?=$entry['episode_date']?></span>
        <p><?=$entry['episode_content']?></p>
    </article>
<?php
}?>
