<section id="backoffice_content">
    <h2 id='backoffice_title'>Ajouter un épisode</h2>
    <section class="editor">
            
        <form class="comment_post" method='post'>
            <label for="episode">Episode n°</label>
            <input type='text' name='episode'/>
            <label for='title'>Titre</label>
            <input type='text' name='title' />
            <label for='episode_text'>Texte</label>
            <textarea id="tinymce" name='episode_text'></textarea>
            <div class='buttons'>
                <input type='submit' formaction='index.php?action=save_draft' name='save_draft' value='Enregistrer le brouillon'/>
                <input type='submit' formaction='index.php?action=publish' name='publish' value='Publier'/>
                <input type='hidden' value='<?= $this->session->getToken(); ?>' name='hidden_input' />
            </div>
            <?php
                if (!empty($this->session->getFlashMessage())) { ?>
                    <p id="authentification_error_message"><?= $this->session->getFlashMessage(); ?></p>
                <?php    
                }
                ?>
        </form>

    </section>
</section