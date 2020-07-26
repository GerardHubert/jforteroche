<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/css/style.css" />
        <link rel="stylesheet" href="../public/fontawesome/css/all.css" />
        <script src="https://cdn.tiny.cloud/1/97xujt63v02pi5q8baozxw48t8ryhh838n540l6bholq34p2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script>
        <title>Backoffice</title>
    </head>

    <header class='backoffice_header'>
        <span id='login_welcome'>Bienvenue Jean Forteroche</span>
        <div id='front_link'>
            <a href='index.php'>
                <span>Retour au blog</span>
            </a>
        </div>
        <div id='logout_link'>
            <a href='index.php?action=logout'>
                <i class='fas fa-sign-out-alt'></i>
                <span>Se déconnecter</span>
            </a>
        </div>
    </header>

    <body>

        <main class="backoffice">

            <nav id='back_nav'>
                <ul>
                    <li><a href='index.php?action=episodes_list'>Episodes</a></li>
                    <li><a href='index.php?action=new_post'>Ajouter un épisode</a></li>
                    <li><a href='index.php?action=drafts'>Brouillons</a></li>
                    <li><a href='index.php?action=reported_comments'>Modérer les Commentaires</a></li>
                    <li><a href='index.php?action=comments_list'>Tous les commentaires</a></li>
                </ul>
            </nav>

            <?=$content?>
            
        </main>

    </body>

</html>