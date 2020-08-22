<body>
    <form method="post" id="authentification">
        <label for='identifiant'>Identifiant</label>
        <input type='text' name='identifiant' />
        <label for='password'>Mot de passe</label>
        <input type='password' name='password' />

        <div id="submit">
        <input id='login' type='submit' formaction='index.php?action=check_user' value='Se connecter' name='submit' />
        <input type="submit" id="new_user" formaction='index.php?action=new_user' value='Enregistrer un nouvel utilisateur' name='submit' />
        </div>

        <a href="index.php?action=new_password">Mot de passe oublié?</a>
        <a href="index.php?action=modify_id">Modifier identifiant et mot de passe</a>
    </form>

    

</body>
