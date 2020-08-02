<h2>Les derniers épisodes publiés</h2>
<?php foreach ($data as $entry) {?>
    <article>
        <a href='index.php?action=post&id=<?=$entry['episode_id']?>'>
            <h3 class='episode_title'>Episode <?=$entry['numero_episode']?>: <?=$entry['episode_title']?></h3>
        </a>
        <span class='post_date'>Posté le <?=$entry['episode_date']?></span>
        <p><?=$entry['episode_content']?>...<span id='read_next'><a href="index.php?action=post&id=<?=$entry['episode_id']?>"> Lire la suite</a></span></p>
    </article>
<?php
}?>
