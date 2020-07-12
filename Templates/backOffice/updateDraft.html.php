<section class="editor">
        
    <form class="comment_post" method='post'>
        <label for="episode">Episode</label>
        <input type='text' name='episode' value="Episode <?=$data[0]['episode']?>" />
        <label for='title'>Titre</label>
        <input type='text' name='title' value="<?=$data[0]['draft_title']?>" />
        <label for='episode_text'>Texte</label>
        <textarea id="tinymce" name='episode_text'><?=$data[0]['draft_content']?></textarea>
        <div class='buttons'>
            <input type='submit' formaction='index.php?action=save_updated_draft&draft_id=<?=$data[0]['draft_id']?>' name='save_draft' value='Mettre à jour le brouillon'/>
            <input type='submit' formaction='index.php?action=publish' name='publish' value='Publier'/>
        </div>
    </form>

</section>