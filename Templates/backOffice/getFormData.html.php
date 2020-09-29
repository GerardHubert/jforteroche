<section id="backoffice_content"><h2 id='backoffice_title'>Ajouter un épisode</h2>
<section class="editor">
        
    <form class="comment_post" method='post'>
        <label for="episode">Episode n°</label>
        <input type='text' name='episode' value=<?=$data['numero_episode']?> />
        <label for='title'>Titre</label>
        <input type='text' name='title' value="<?=$data['episode_title']?>" />
        <label for='episode_text'>Texte</label>
        <textarea id="tinymce" name='episode_text'><?=$data["episode_content"]?></textarea>
        <div class='buttons'>
            <input type='submit' formaction='index.php?action=save_draft' name='save_draft' value='Enregistrer le brouillon'/>
            <input type='submit' formaction='index.php?action=publish' name='publish' value='Publier'/>
            <input type='hidden' value='<?= $this->session->getToken(); ?>' name='hidden_input' />
        </div>
    </form>
    <span id='error_message'>Un épisode avec le même numéro existe déjà. Veuillez le publier avec un autre numéro</span>

</section>
</section>