<section class="editor">
        
    <form class="comment_post" method='post'>
        <label for="episode">Episode</label>
        <input type='text' name='episode' value="<?=$data['numero_episode']?>" />
        <label for='title'>Titre</label>
        <input type='text' name='title' value="<?=$data['episode_title']?>" />
        <label for='episode_text'>Texte</label>
        <textarea id="tinymce" name='episode_text'><?=$data['episode_content']?></textarea>
        <div class='buttons'>
        <input type='submit' formaction='index.php?action=save_draft' name='save_draft' value='Enregistrer le brouillon'/>
            <input type='submit' formaction='index.php?action=publish' name='publish' value='Publier'/>
        </div>
    </form>
    <span id="error_message">Un brouillon avec le même numéro d'épisode est déjà enregistré. Veuillez le mettre à jour ou enregistrer ce brouillon sous un autre numéro</span>

</section>