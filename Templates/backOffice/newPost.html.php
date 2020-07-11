<section class="editor">
        
    <form class="comment_post" method='post'>
        <label for="episode">Episode</label>
        <input type='text' name='episode' />
        <label for='title'>Titre</label>
        <input type='text' name='title ' />
        <label for='episode_text'>Texte</label>
        <textarea id="tinymce" name='episode_text'></textarea>
        <div class='buttons'>
            <input type='submit' formaction='index.php?action=save_draft' name='save_draft' value='Enregistrer le brouillon'/>
            <input type='submit' formaction='index.php?action=publish' name='publish' value='Publier'/>
        </div>
    </form>

</section>