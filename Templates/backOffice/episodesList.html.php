<table>
    <thead>
        <tr>
            <th>Liste des épisodes en ligne</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $entry) {?>
        <tr>
            <td>Episode <?=$entry['numero_episode']?></td>
            <td><?=$entry['episode_title']?></td>
            <td><a href='index.php?action=update_post&post_id=<?=$entry['episode_id']?>'><button>Modifier</button></td>
            <td><a href='index.php?action=delete_post&post_id=<?=$entry['episode_id']?>'><button>Supprimer</button></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>