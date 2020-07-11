<table class='list'>
    <thead>
        <tr>
            <th>Brouillons enregistrés</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $entry) {?>
        <tr>
            <td><?=$entry['episode']?></td>
            <td><?=$entry['draft_title']?></td>
            <td><?=$entry['draft_content']?></td>
            <td><a href='index.php?action=update_draft&draft_id=<?=$entry['draft_id']?>'><button>Modifier</button></a></td>
            <td><a href='index.php?action=delete_draft&draft_id=<?=$entry['draft_id']?>'><button>Supprimer</button></a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>