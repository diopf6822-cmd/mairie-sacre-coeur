Gemini a dit
C'est une excellente idée. Voici un récapitulatif technique complet de ton projet "État-Civil Sacré-Cœur" tel qu'il est construit actuellement. C'est ta "feuille de route" pour l'examen de mercredi.

🗄️ 1. La Base de Données (mairie)
La structure est optimisée avec le numéro de registre en Clé Primaire pour garantir l'unicité.

Table : habitants

Colonnes :

num_registre : Ex: "001/2026"

nom, prenom, sexe, date_naissance, heure_naissance, lieu_naissance

prenom_pere, nom_pere, prenom_mere, nom_mere

date_enregistrement (TIMESTAMP) : Date de saisie automatique.

📂 2. Structure des Fichiers du Projet
Ton dossier C:\wamp64\www\projet\ doit contenir :

📂 dompdf/ (Dossier de la bibliothèque PDF) permet la creation du pdf

📂 Extrait/ (Dossier où sont sauvegardés les PDF générés)

📄 db.php : Connexion à la base avec la variable $conn.

📄 style.css : Charte graphique (Arial, Navy Blue, Cartes modernes).

📄 index.php : Accueil avec les 3 services (Déclaration, Extrait, RDV).

📄 declaration_naissance.php : Formulaire avec numéro de registre automatique.

📄 demande_extrait.php : Moteur de recherche par numéro de registre.

📄 generer_pdf.php : Script qui crée le PDF, l'enregistre dans /Extrait et l'affiche.




