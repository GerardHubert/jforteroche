<section id="backoffice_content">
    <h2 id='backoffice_title'>Modifier un brouillon</h2>
    <section class="editor">
            
        <form class="comment_post" method='post'>
            <label for="episode">Episode</label>
            <input type='text' name='episode' value="<?=$data[0]['numero_episode']?>" />
            <label for='title'>Titre</label>
            <input type='text' name='title' value="<?=$data[0]['episode_title']?>" />
            <label for='episode_text'>Texte</label>
            <textarea id="tinymce" name='episode_text'><?=$data[0]['episode_content']?></textarea>
            <div class='buttons'>
                <input type='submit' formaction='index.php?action=save_updated_draft&episode_id=<?=$data[0]['episode_id']?>' name='save_draft' value='Mettre à jour le brouillon'/>
                <input type='submit' formaction='index.php?action=publish_draft&id=<?=$data[0]['episode_id']?>' name='publish' value='Publier'/>
            </div>
        </form>

    </section>
</section>