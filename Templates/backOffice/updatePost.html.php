<section id="backoffice_content">
    <h2 id='backoffice_title'>Modifier un épisode</h2>
    <section class="editor">
            
        <form class="comment_post" method='post'>
            <label for="episode">Episode n°</label>
            <input type='text' name='episode' value=<?=$data[0]['numero_episode']?> />
            <label for='title'>Titre</label>
            <input type='text' name='title' value="<?=$data[0]['episode_title']?>" />
            <input type='hidden' name='hidden_input' value='<?= $this->session->getToken(); ?>' />
            <label for='episode_text'>Texte</label>
            <textarea id="tinymce" name='episode_text'><?=$data[0]['episode_content']?></textarea>
            <div class='buttons'>
                <input type='submit' formaction='index.php?action=save_updated_post&episode_id=<?=$data[0]['episode_id']?>' name='save_updated_post' value='Mettre à jour' />
            </div>

            <?php
                if (!empty($this->session->getFlashMessage())) { ?>
                    <p id="authentification_error_message"><?= $this->session->getFlashMessage(); ?></p>
                <?php    
                }
                ?>
        </form>

    </section>
</section>