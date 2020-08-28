<section id="backoffice_content">
    <h2 id='backoffice_title'>Commentaires signalés</h2>
    <table id='comments_table'>
        <thead>
            <tr>
                <th>Laissé par</th>
                <th>Commentaire</th>
                <th colspan='2'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $entry) {?>
            <tr>
                <td id='pseudo_col'><?=$entry['pseudo']?></td>
                <td id='comment_col'><?=$entry['comment']?></td>
                <td><a href='index.php?action=delete_comment&id=<?=$entry['comment_id']?>'><button>Supprimer le commentaire</button></a></td>
                <td><a href='index.php?action=validate_comment&id=<?=$entry['comment_id']?>'><button>Autoriser le commentaire</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</section>