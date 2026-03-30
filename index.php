<?php
include 'db.php';

// --- LOGIQUE DE GÉNÉRATION DU NUMÉRO DE REGISTRE ---
$annee_actuelle = date('Y');

// On cherche le dernier numéro enregistré pour l'année en cours
$requete_dernier = "SELECT num_registre FROM habitants 
                    WHERE num_registre LIKE '%/$annee_actuelle' 
                    ORDER BY id DESC LIMIT 1";

$resultat_dernier = mysqli_query($conn, $requete_dernier);

if (mysqli_num_rows($resultat_dernier) > 0) {
    $ligne = mysqli_fetch_assoc($resultat_dernier);
    $dernier_num_complet = $ligne['num_registre']; // Ex: "015/2026"
    
    // On sépare pour récupérer juste le chiffre avant le slash
    $parties = explode('/', $dernier_num_complet);
    $nombre = (int)$parties[0]; // Transforme "015" en 15
    $prochain_nombre = $nombre + 1;
} else {
    // Si c'est le premier bébé de l'année
    $prochain_nombre = 1;
}

// On formate avec des zéros devant (ex: 1 devient 001)
$nouveau_registre = str_pad($prochain_nombre, 3, "0", STR_PAD_LEFT) . "/" . $annee_actuelle;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mairie de Sacré-Cœur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fa-solid fa-landmark me-2"></i> MAIRIE DE SACRÉ-CŒUR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="declaration_naissance.php">Déclarations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="demande_extrait.php">Recherches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rendezvous.php">Rendez-vous</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="text-center">
        <div class="container">
            <h1 class="fw-bold">Portail de l'État-Civil</h1>
            <p class="fw-light">Sélectionnez le service administratif souhaité</p>
        </div>
    </header>

    <main class="container py-5">
        <div class="row g-4 justify-content-center">
            
            <div class="col-md-4">
                <a href="declaration_naissance.php" class="text-decoration-none">
                    <div class="card card-stat">
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="fa-solid fa-baby-carriage fa-4x"></i>
                            </div>
                            <h3 class="h4 fw-bold">Déclarer Naissance</h3>
                            <p class="mb-0 small">Enregistrer un nouvel acte de naissance au registre.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="demande_extrait.php" class="text-decoration-none">
                    <div class="card card-stat">
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="fa-solid fa-file-invoice fa-4x"></i>
                            </div>
                            <h3 class="h4 fw-bold">Extraits de Naissance</h3>
                            <p class="mb-0 small">Rechercher et délivrer un extrait certifié conforme.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="rendez_vous.php" class="text-decoration-none">
                    <div class="card card-stat">
                        <div class="card-body text-center p-5">
                            <div class="mb-3">
                                <i class="fa-solid fa-calendar-check fa-4x"></i>
                            </div>
                            <h3 class="h4 fw-bold">Prendre Rendez-vous</h3>
                            <p class="mb-0 small">Planifier une rencontre avec un officier de la mairie.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <
    </main>

    <footer class="text-center py-4 mt-5 text-white small">
        &copy; 2026 Mairie de Sacré-Cœur - République du Sénégal
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>