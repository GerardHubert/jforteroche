<form method="post" id="authentification">
    <label for='identifiant'>Identifiant</label>
    <input type='text' name='identifiant' />
    <label for='password'>Mot de passe</label>
    <input type='password' name='password' />

    <div id="submit">
    <input id='login' type='submit' formaction='index.php?action=log_in' value='Se connecter' name='submit' />
    <input type="submit" id="new_user" formaction='index.php?action=new_user' value='Enregistrer un nouvel utilisateur' name='submit' />
    </div>

    <a href="index.php?action=modify_username">Modifier identifiant et mot de passe</a>
</form>
