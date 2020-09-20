<section id="backoffice_content">
    <h2 id='backoffice_title'>Liste des commentaires</h2>
    <table id='comments_table'>
        <thead>
            <tr>
                <th>Laissé par</th>
                <th>Episode</th>
                <th>Commentaire</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['comments'] as $entry) {?>
            <tr>
                <td id='pseudo_col'><?=$entry['pseudo']?></td>
                <td><?=$entry['numero_episode'] ?></td>
                <td id='comment_col'><?=$entry['comment']?></td>
                <td><a href='index.php?action=delete_comment&id=<?=$entry['comment_id']?>'><button>Supprimer le commentaire</button></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div id="prev_next">
        
        <?php
            if ($data['currentPage'] <= $data['maxPages'] && $data['currentPage'] > 1) { ?>
                <span id="previous">
                    <a href="index.php?action=comments_list&page=<?=$data['currentPage'] - 1; ?>">
                        <button>Comentaires précédents</button>
                    </a>
                </span>
            <?php
            }
        ?>

        <?php
            if ($data['currentPage'] < $data['maxPages'] && $data['currentPage'] >= 1) { ?>
                <span id="next">
                    <a href="index.php?action=comments_list&page=<?=$data['currentPage'] + 1; ?>">
                        <button>Commentaires suivants</button>
                    </a>
                </span>
            <?php
            }
        ?>

    </div>
    
            
</section>