<p>Veuillez saisir votre nom d'utilisateur</p>
<form method="post" id="authentification">
    <label for='identifiant'>Identifiant</label>
    <input type='text' name='identifiant' />
    <input id='login' type='submit' formaction='index.php?action=change_password' value='Valider' name='submit' />

    <?php
        if (!empty($this->session->getFlashMessage())) { ?>
            <p>
                <?php
                echo $this->session->getFlashMessage();
                ?>
            </p>
        <?php
        }
        ?>
</form>