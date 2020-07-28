<!DOCTYPE html>
<html lang="fr">

	<head>
        <meta charset="utf-8" />
		<link rel="icon" type="image.png" href="/images/encrier.ico" />
		<link rel="stylesheet" href="/css/style.css" />
		<link rel="stylesheet" href="fontawesome/css/all.css" />

		<title>Billet simple pour l'Alaska</title>
	</head>
	
	<body>
		
		<header>

			<div class="headband">
				<a class="logo" href="index.php">Billet simple pour l'Alaska</a>
				<nav class='front_nav'>
					<div class="menu_container">
						<ul class="menu">
							<li><a href="index.php"><i class="fas fa-home"></i>Accueil</a></li>
							<li><a href="index.php?action=get_all"><i class="fas fa-pen-fancy"></i>Episodes</a></li>
							<li><a href="index.php?action=backoffice"><i class="fas fa-user-lock"></i>Administrateur</a></li>
						</ul>
					</div>
				</nav>
			</div>
			<img class="header_img" src="/images/landscape_01.jpg" alt="aurore boréale en alaska" />
			<h1>Bienvenue sur le blog de Jean Forteroche</h1>


		</header>

		<section class="welcoming_text">

			<h2>Bonjour, je suis Jean Forteroche et vous souhaite la bienvenue sur mon blog.</h2>
			<p>Afin de sortir des sentiers balisés de l'édition classique, j'y publierai, chaque semaine, un nouvel épisode de mon prochain roman, 
				<span id="titre">Billet simple pour l'Alaska</span>.
				N'hésitez pas à me laisser vos avis en commentaires ou à me contacter. Je lis tout! Et le roman peut évoluer avec vos remarques et suggestions!
				Bonne lecture!
			</p>
        
		</section>

		<main class='front_content'>

			<section class="last_episodes">
				<?=$content?>
			</section>

			<aside class="about_me">
				<h3>A propos de l'auteur</h3>
				<figure>
					<img class="portrait" src="/images/portrait.jpg" alt="Portrait de Jean Forteroche" />
					<figcaption>Portrait de Jean Forteroche</figcaption>
				</figure>
				<p>Jean Forteroche est connu pour quelques grands rôles au cinéma, mais il est avant tout un auteur de romans d'aventure. 
					Rien de plus normal lorsqu'on sait qu'il est l'enfant d'une mère enseignante de littérature et d'un père aventurier.</p>
				<p>L'Illiade et l'Ile au trésor sont ses livres de chevet et l'auteur James Rollins un modèle. C'est donc l'esprit nourri de toutes
					ces grandes aventures qu'il décide de prendre la plume à l'année de ses 20 ans.</p>
				<p>Aujourd'hui, après 30 ans de carrière et une vingtaine d'ouvrage, il joue également le personnage principal de l'adaptation de son premier livre. Une consécration.</p>
			</aside>

		</main>

		<footer>
			<div class="footer_links">
				<a href="mentions.html">Mentions Légales</a>
				<a href="site_plan.html">Plan du site</a>
			</div>
		</footer>

		
	</body>

</html>