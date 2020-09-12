<form method="post" id="authentification">
    <label for='identifiant'>Identifiant</label>
    <input type='text' name='identifiant' />
    <label for='password'>Mot de passe</label>
    <input type='password' name='password' />

    <div id="submit">
        <input id='login' type='submit' formaction='index.php?action=log_in' value='Se connecter' name='submit' />
    </div>
    
    <?php
        if(!empty($this->session->getFlashMessage())) { ?>
        <p id="authentification_error_message"><?php echo $this->session->getFlashMessage(); ?></p>
        <?php
        }
        ?>
</form>
