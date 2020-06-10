<!DOCTYPE html>
<html lang="fr">

	<head>
        <meta charset="utf-8" />
		<link rel="icon" type="image.png" href="../../public/images/encrier.ico" />
		<link rel="stylesheet" href="../../public/css/style.css" />
		<link rel="stylesheet" href="../../public/fontawesome/css/all.css" />
		<title>Billet simple pour l'Alaska</title>
	</head>
	
	<body>
		
		<header>

			<div class="headband">
				<a class="logo">Billet simple pour l'Alaska</a>
				<nav>
					<div class="menu_container">
						<ul class="menu">
							<li><a href="index.php"><i class="fas fa-home"></i>Accueil</a></li>
							<li><a href="episodes.html"><i class="fas fa-pen-fancy"></i></i>Episodes</a></li>
							<li><a href="bibliographie.html"><i class="fas fa-book"></i>Bibliographie</a></li>
							<li><a href="contact.html"><i class="fas fa-envelope"></i>Contact</a></li>
							<li><a href="admin.html"><i class="fas fa-user-lock"></i>Administrateur</a></li>
						</ul>
					</div>
				</nav>
			</div>
			<img class="header_img" src="../../public/images/landscape_01.jpg" alt="aurore boréale en alaska" />
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

		<main>

			<section class="last_episodes">
				<!--<article>
					<img id="thumbnail" src="public/images/landscape_01.jpg" alt="paysage de montagne" />
					<div id="title_extract">
						<h3>Episode 3: Le titre du dernier épisode ici</h3>
						<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum hic eius odit nihil, ab cupiditate vitae! Alias nemo voluptatum, at, asperiores beatae quidem cum placeat architecto eum animi, enim cumque?</p>
					</div>
				</article>
				<article>
					<img id="thumbnail" src="public/images/landscape_02.jpg" alt="paysage de montagne" />
					<div id="title_extract">
						<h3>Episode 2: Le titre de l'épisode 2 ici</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores laborum inventore aliquid quisquam voluptate aliquam omnis corrupti eius in enim. Obcaecati reprehenderit tempore nostrum pariatur praesentium quo quidem dicta perferendis?</p>
					</div>
				</article>
				<article>
					<img id="thumbnail" src="public/images/landscape_01.jpg" alt="paysage de montagne" />
					<div id="title_extract">
						<h3>Episode 1: Le titre du premier episode ici</h3>
						<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum hic eius odit nihil, ab cupiditate vitae! Alias nemo voluptatum, at, asperiores beatae quidem cum placeat architecto eum animi, enim cumque?</p>
					</div>
				</article>-->
				<?=$content?>
			</section>

			<aside class="about_me">
				<h3>A propos de l'auteur</h3>
				<figure>
					<img class="portrait" src="../../public/images/portrait.jpg" alt="Portrait de Jean Forteroche" />
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
				<a href="contact.html">Contact</a>
			</div>
		</footer>

		
	</body>

</html>