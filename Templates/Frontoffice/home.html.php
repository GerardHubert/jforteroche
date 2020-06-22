<article>
    <?php foreach ($data['home'] as $entry) {?>
        <a href='index.php?action=post&id=<?=$entry['episode_id']?>'>
            <h3 class='episode_title'>Episode <?=$entry['episode_id']?>: <?=$entry['episode_title']?></h3>
        </a>
        <span class='post_date'>Posté le <?=$entry['episode_date']?></span>
        <p><?=$entry['episode_content']?></p>
    <?php
    }?>
</article>