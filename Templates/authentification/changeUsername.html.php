<h1>Modifier mon nom d'utilisateur</h1>

<form id='authentification' action='index.php?action=change_username' method='post'>
    <label for='new_username'>Nouveau nom d'utilisateur</label>
    <input type='text' name='new_username' />

    <label for='confirm_username'>Confirmez le nouveau nom d'utilisateur</label>
    <input type='text' name='confirm_username' />
    <input type='hidden' name='hidden_input' value='<?= $this->session->getToken(); ?>' />

    <input type='submit' value='Modifier' />
    <?php
    if (!empty($this->session->getFlashMessage())) { ?>
        <p id="authentification_error_message"><?= $this->session->getFlashMessage(); ?></p>
    <?php    
    }
    ?>
</form>

