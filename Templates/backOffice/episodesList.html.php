<section id="backoffice_content">
    <h2 id='backoffice_title'>Liste des épisodes publiés</h2>
    <table id='episodes_table'>
        <thead>
            <tr>
                <th>Episode</th>
                <th>Titre</th>
                <th colspan='2'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $entry) {?>
            <tr>
                <td><?=$entry['numero_episode']?></td>
                <td id='episodes_col'><?=$entry['episode_title']?></td>
                <td><a href='index.php?action=update_post&post_id=<?=$entry['episode_id']?>'><button>Modifier</button></a></td>
                <td><a href='index.php?action=delete_post&post_id=<?=$entry['episode_id']?>'><button>Supprimer</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</section>