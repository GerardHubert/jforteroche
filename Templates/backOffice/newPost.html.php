<section class="editor">
        
    <form class="comment_post" method='post'>
        <label for='title'>Titre</label>
        <input type='text' name='title'>
        <label for='episode_text'>Texte</lalbel>
        <textarea id="tinymce" name='episode_text'></textarea>
        <input type='submit' formaction='index.php?action=save_draft' name='save_draft' value='Enregistrer le brouillon'/>
        <input type='submit' formaction='index.php?action=save_and_publish' name='publish' value='Publier'/>
    </form>

</section>