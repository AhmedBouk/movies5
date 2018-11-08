<?php

//======================================================================
//  CONSIDERATIONS TECHNIQUES
//======================================================================

	 // La base de données est dans le fichier .sql joint. La table se nomme « all_movies »
	 // Les images se trouvent dans le dossier posters sont au format .jpg, et sont nommées comme l’id des films. Vous pouvez les hotlinker directement. Elles ont toutes la même largeur, mais des hauteurs différentes.
   // Faire en sorte d'ignorer le dossier "poster" pour éviter de le versionner, ainsi que votre fichier pdo.php qui contient des informations sensible, ainsi que le dossier vendor dans le cas d'une utilisation de composer.

   // ORGANISATION +++ , Partage des taches, ordres des taches etc....
   // Lisez bien tout avant de vous lancer

//======================================================================
//  ETAPE 1
//======================================================================

// Vous devez créer une application web : vos recommandations, en tant qu’expert cinéphile, des meilleurs films du monde. Elle permet aux internautes de consulter cette liste de films, et d’obtenir des informations détaillées sur ceux-ci.

//Dans sa première version, cette application tourne principalement autour des deux pages suivantes :
/////////////////// - La page d’accueil
// Sa principale fonction est d’afficher des affiches de films, au hasard.
// En cliquant sur l’affiche d’un film, on est amené sur la page de détail sur celui-ci.
//////////////////  -  La page de détail
// l’affiche du film et son titre, toutes les données présentes en base de données sont affichées.

// Voici plus de détails sur chacune de ces pages :
////////////////////////// PAGE D’ACCUEIL

/////// Création d'un Bouton « + de films ! »
// Très simple, ce bouton recharge la page pour afficher de nouveaux films. Il se trouve au bas de la page.

//////// Filtres
//// Ce site n’est pas un site de recherche de films, mais nous pouvons tout de même laisser l’internaute manipuler le hasard. Nous souhaitons en effet lui laisser la possibilité de filtrer selon les critères suivants :
	// -	Catégorie (plusieurs checkboxes)
	// -  Années (de xxxx à xxxx)

///////////////////////////  PAGE DE DETAILS
// Outre l’affichage du poster et de tous les détails du film, les éléments suivants doivent être présents :
	// - Pretty Url
		// - L’url de ces pages de détails devrait contenir la version normalisée du titre du film (slug). Et tant qu’à y être, faites tout votre possible pour référencer au mieux cette page par rapport au titre du film et de son année de réalisation.


//======================================================================
//  ETAPE 2
//======================================================================

//////////////////////    INSCRIPTION/CONNEXION
//Vous devez créer un système d’inscription et de connexion au site. Vous pouvez bien sûr réutiliser du code que vous auriez précédemment codé pour une telle tâche.
//Notez qu’il n’est utile que de demander le strict minimum à l’utilisateur : un pseudo, un email et un mot de passe.
// ne pas oublier dans la table créé (token, role, created_at)
//Toutefois, n’oubliez pas d’inclure un bouton pour permettre de récupérer un mot de passe oublié, ainsi qu'une case à cocher « se souvenir de moi ».
// Ce système d’inscription permettra aux internautes de sauvegarder de manière durable les films qu’ils souhaitent voir en base de données, et éventuellement plusieurs autres fonctionnalités interactives.

/////////////////////////    PAGE DÉTAILS
///// Pour les utilisateurs connectés
// - Bouton « à voir »
	// Un bouton devrait également permettre d’ajouter ce film à une liste des « films à voir ».
	// Bien sûr, cela implique également un nouvel item dans le menu principal, menant à la liste de ces films à voir classé en fonction de la date d'ajout

//  - Bouton Retrait
	// Lorsqu'un film est déjà présent dans la liste des films à voir, le bouton servant à ajouter ce film à la liste devrait maintenant permettre de le retirer.

/////////////////////  SYSTÈME DE NOTATION
// Note du film
// Aussi, la note sur 100 du film devrait s'afficher de manière graphique, en plus du chiffre. À vous de voir comment.

//////////////////////// Bouton de notation
// Il est maintenant temps de permettre à l'utilisateur de donner une note à chacun des films.  Cette note doit être stockée en base de données sur 100. Lorsqu'un film a déjà été noté, cette note doit s'afficher à la place du bouton.
////////////////////////  Page des films notés
// Une nouvelle page doit permettre de voir les films notés par l'utilisateur. Les films doivent être présentés par ordre de date de la note, et un système de pagination doit donc nécessairement être mis en place.
// Faire une jointure pour recuperer toutes les infos des films déjà notés

//======================================================================
//  ETAPE 3
//======================================================================

//  BACK-OFFICE
// En tant qu'administrateur, vous souhaitez pouvoir gérer facilement ce site. Vous décidez donc de développer un back-office.
// Vous seule en tant que role 'admin' pouvez accéder au back-office.
// Le back-office doit bien sûr être sécurisé, et accessible que par vous-seul.

//Celui-ci aura les fonctionnalités suivantes :
	// -	Statistiques (page d'accueil du BO)
	// -	Consultation/Ajout/Modification/Supression de films
	// -  Consultation/Modification/Supression d'utilisateurs

// Côté design, assurez-vous qu'il soit différent du front.
//////////////////////////
// Films
//////////////////////////
// Films | consultation
// Une page affiche, sous forme de tableau, la liste des films présents en base de données (un peu comme dans phpMyAdmin). Chaque ligne du tableau affiche donc des informations sur un seul film, ainsi que quelques actions reliées à ce film. Voici plus de détails :
// •	Colonnes à afficher : id, title, year, rating, actions
// •	La colonne actions comportent 3 icônes : « voir sur le site », « modifier », « effacer »
// •	Affichez 100 films par page, avec un système complet de pagination
// Films | ajout et modification
// En cliquant sur l'icône de modification, l'administrateur est amené sur la page de modification d'un film. Cette page comporte un formulaire complet permettant de modifier tous les champs de la base de données.
// Ce même formulaire est utilisé sur la page d'ajout de film (page accessible par le menu principal).
// Films | suppression
///////////////////////
// Utilisateurs
///////////////////////
// Le principe est exactement le même pour les utilisateurs que pour les films, à la différence qu'il n'est pas possible d'ajouter manuellement des utilisateurs.
/////////////////////////////
// Statistiques
/////////////////////////////
// La page « statistiques » vous permet de voir en un coup d'oeil l'état du site. Elle ferait d'ailleurs une bonne page d'accueil pour le BO.
// Elle affiche les données suivantes :
// •	Nombre de films en base de données
// •	Nombre d'utilisateurs total
// •	Les 30 films étant les plus ajoutés à des listes de films à voir
