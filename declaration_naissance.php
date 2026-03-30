<?php
include 'db.php'; // Connexion via $conn

$message_succes = "";

// 1. CALCUL DU PROCHAIN NUMÉRO (Affichage dynamique)
$annee_actuelle = date('Y');
$requete_dernier = mysqli_query($conn, "SELECT num_registre FROM habitants WHERE num_registre LIKE '%/$annee_actuelle' ORDER BY num_registre DESC LIMIT 1");

if (mysqli_num_rows($requete_dernier) > 0) {
    $ligne = mysqli_fetch_assoc($requete_dernier);
    $parties = explode('/', $ligne['num_registre']);
    $prochain_nombre = (int)$parties[0] + 1;
} else {
    $prochain_nombre = 1;
}
$nouveau_registre = str_pad($prochain_nombre, 3, "0", STR_PAD_LEFT) . "/" . $annee_actuelle;


// 2. TRAITEMENT DE L'ENREGISTREMENT
if (isset($_POST['enregistrer'])) {
    // Sécurisation des données
    $nom_enfant      = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom_enfant   = mysqli_real_escape_string($conn, $_POST['prenom']);
    $genre_enfant    = mysqli_real_escape_string($conn, $_POST['sexe']);
    $date_naiss      = mysqli_real_escape_string($conn, $_POST['date_n']);
    $heure_naiss     = mysqli_real_escape_string($conn, $_POST['heure_n']);
    $lieu_naiss      = mysqli_real_escape_string($conn, $_POST['lieu_n']);
    $pere_prenom     = mysqli_real_escape_string($conn, $_POST['p_pere']);
    $pere_nom        = mysqli_real_escape_string($conn, $_POST['n_pere']);
    $mere_prenom     = mysqli_real_escape_string($conn, $_POST['p_mere']);
    $mere_nom        = mysqli_real_escape_string($conn, $_POST['n_mere']);

    // On utilise le numéro généré automatiquement
    $requete_insertion = "INSERT INTO habitants 
    (num_registre, nom, prenom, sexe, date_naissance, heure_naissance, lieu_naissance, prenom_pere, nom_pere, prenom_mere, nom_mere) 
    VALUES 
    ('$nouveau_registre', '$nom_enfant', '$prenom_enfant', '$genre_enfant', '$date_naiss', '$heure_naiss', '$lieu_naiss', '$pere_prenom', '$pere_nom', '$mere_prenom', '$mere_nom')";

    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déclaration de Naissance - Mairie de Sacré-Cœur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fa-solid fa-landmark me-2"></i> MAIRIE DE SACRÉ-CŒUR</a>
        </div>
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
                        <a class="nav-link" href="rendez_vous.php">Rendez-vous</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <?php if($message_succes): ?>
                    <div class="alert alert-success shadow-sm">
                        <i class="fa-solid fa-circle-check me-2"></i> <?php echo $message_succes; ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow border-0">
                    <div class="card-header">
                        <h2 class="h5 mb-0 text-center fw-bold">NOUVELLE DÉCLARATION</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mx-auto text-center">
                                    <label class="form-label fw-bold">Numéro de Registre attribué :</label>
                                    <input type="text" class="form-control form-control-lg text-center fw-bold text-primary bg-light" 
                                           value="<?php echo $nouveau_registre; ?>" readonly>
                                </div>
                            </div>

                            <h6 class="fw-bold border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-child me-2"></i>Informations Enfant
                            </h6>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6"><label class="form-label">Prénom(s)</label><input type="text" name="prenom" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label">Nom</label><input type="text" name="nom" class="form-control" required></div>
                                <div class="col-md-4">
                                    <label class="form-label">Sexe</label>
                                    <select name="sexe" class="form-select"><option>Masculin</option><option>Féminin</option></select>
                                </div>
                                <div class="col-md-4"><label class="form-label">Date</label><input type="date" name="date_n" class="form-control" required></div>
                                <div class="col-md-4"><label class="form-label">Heure</label><input type="time" name="heure_n" class="form-control" required></div>
                                <div class="col-md-12"><label class="form-label">Lieu de Naissance</label><input type="text" name="lieu_n" class="form-control" required></div>
                            </div>

                            <h6 class="fw-bold border-bottom pb-2 mb-3 mt-4">
                                <i class="fa-solid fa-people me-2"></i>Filiation
                            </h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6"><label class="form-label">Prénom Père</label><input type="text" name="p_pere" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label">Nom Père</label><input type="text" name="n_pere" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label">Prénom Mère</label><input type="text" name="p_mere" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label">Nom Mère</label><input type="text" name="n_mere" class="form-control" required></div>
                            </div>

                            <button type="submit" name="enregistrer" class="btn btn-navy w-100 py-3 fw-bold">
                                <i class="fa-solid fa-save me-2"></i> VALIDER L'ENREGISTREMENT
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>