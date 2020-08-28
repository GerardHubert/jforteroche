<section id="backoffice_content">
    <h2 id='backoffice_title'>Liste des brouillons</h2>
    <table id='drafts_table'>
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
                <td id='draft_col'><?=$entry['episode_title']?></td>
                <td><a href='index.php?action=update_draft&episode=<?=$entry['numero_episode']?>'><button>Modifier</button></a></td>
                <td><a href='index.php?action=delete_draft&episode=<?=$entry['numero_episode']?>'><button>Supprimer</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</section>