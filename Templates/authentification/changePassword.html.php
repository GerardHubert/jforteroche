<h1>Modifier mon mot de passe</h1>

<form id='authentification' action='index.php?action=change_password' method='post'>
    <label for='new_password'>Nouveau mot de passe</label>
    <input type='password' name='new_password' />

    <label for='confirm_password'>Confirmez le nouveau mot de passe</label>
    <input type='password' name='confirm_password' />
    <input type='hidden' value='<?= $this->session->getToken(); ?>' name='hidden_input' />

    <input type='submit' value='Modifier' />

    <?php
    if (!empty($this->session->getFlashMessage())) { ?>
        <p id="authentification_error_message"><?= $this->session->getFlashMessage(); ?></p>
    <?php    
    }
    ?>
</form>

