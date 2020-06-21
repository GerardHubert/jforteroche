<article>
    <a href='index.php?action=post&id=<?=$data['home'][0]['episode_id']?>'>
        <h3 class='episode_title'>Episode <?=$data['home'][0]['episode_id']?>: <?=$data['home'][0]['episode_title']?></h3>
    </a>
    <span class='post_date'>Posté le <?=$data['home'][0]['episode_date']?></span>
    <p><?=$data['home'][0]['episode_content']?></p>
</article>

<article>
    <a href='index.php?action=post&id=<?=$data['home'][1]['episode_id']?>'>
        <h3 class='episode_title'>Episode <?=$data['home'][1]['episode_id']?>: <?=$data['home'][1]['episode_title']?></h3>
    </a>
    <span class='post_date'>Posté le <?=$data['home'][1]['episode_date']?></span>
    <p><?=$data['home'][1]['episode_content']?></p>
</article>

<article>
    <a href='index.php?action=post&id=<?=$data['home'][2]['episode_id']?>'>
        <h3 class='episode_title'>Episode <?=$data['home'][2]['episode_id']?>: <?=$data['home'][2]['episode_title']?></h3>
    </a>
    <span class='post_date'>Posté le <?=$data['home'][2]['episode_date']?></span>
    <p><?=$data['home'][2]['episode_content']?></p>
</article>