<?php
include 'db.php'; // On utilise toujours $conn

$habitant = null;
$erreur = "";

// 1. LOGIQUE DE RECHERCHE
if (isset($_GET['recherche'])) {
    $critere = mysqli_real_escape_string($conn, $_GET['critere']);
    
    // On cherche par numéro de registre 
    $sql = "SELECT * FROM habitants WHERE num_registre = '$critere'";
    $resultat = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultat) > 0) {
        $habitant = mysqli_fetch_assoc($resultat);
    } else {
        $erreur = "Aucun acte trouvé pour le numéro : " . $critere;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande d'Extrait - Mairie de Sacré-Cœur</title>
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
            <div class="col-lg-10">
                
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> Rechercher un acte de naissance
                    </div>
                    <div class="card-body p-4">
                        <form method="GET" class="row g-2">
                            <div class="col-md-9">
                                <input type="text" name="critere" class="form-control form-control-lg" 
                                       placeholder="Entrez le numéro de registre (ex: 005/2026)" 
                                       value="<?php echo $_GET['critere'] ?? ''; ?>" required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" name="recherche" class="btn btn-navy btn-lg w-100">Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if ($erreur): ?>
                    <div class="alert alert-warning text-center shadow-sm">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $erreur; ?>
                    </div>
                <?php endif; ?>

                <?php if ($habitant): ?>
                    <div class="card shadow border-0 animate-fade-in">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">Acte N° <?php echo $habitant['num_registre']; ?></span>
                            <span class="text-white small">Enregistré le <?php echo date('d/m/Y', strtotime($habitant['date_enregistrement'])); ?></span>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="fw-bold border-bottom pb-2 mb-3">
                                        <i class="fa-solid fa-child me-2" style="color: var(--primary);"></i>Identité de l'enfant
                                    </h5>
                                    <p class="mb-2"><strong>Prénom :</strong> <?php echo $habitant['prenom']; ?></p>
                                    <p class="mb-2"><strong>Nom :</strong> <?php echo strtoupper($habitant['nom']); ?></p>
                                    <p class="mb-2"><strong>Sexe :</strong> <?php echo $habitant['sexe']; ?></p>
                                    <p class="mb-2"><strong>Né(e) le :</strong> <?php echo date('d/m/Y', strtotime($habitant['date_naissance'])); ?> à <?php echo $habitant['heure_naissance']; ?></p>
                                    <p class="mb-2"><strong>Lieu :</strong> <?php echo $habitant['lieu_naissance']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold border-bottom pb-2 mb-3">
                                        <i class="fa-solid fa-people me-2" style="color: var(--primary);"></i>Filiation
                                    </h5>
                                    <p class="mb-2"><strong>Père :</strong> <?php echo $habitant['prenom_pere'] . " " . $habitant['nom_pere']; ?></p>
                                    <p class="mb-2"><strong>Mère :</strong> <?php echo $habitant['prenom_mere'] . " " . $habitant['nom_mere']; ?></p>
                                </div>
                            </div>
                          <div class="bg-light-navy p-4 rounded-3 shadow-sm">
    <h6 class="text-center text-muted mb-3 text-uppercase small fw-bold">Options de délivrance</h6>
    
    <div class="d-flex flex-wrap gap-3 justify-content-center">
        
        <a href="generer_pdf.php?num=<?php echo $habitant['num_registre']; ?>" class="btn btn-primary px-4" target="_blank">
            <i class="fa-solid fa-eye me-2"></i> Visualiser
        </a>

        <a href="generer_pdf.php?num=<?php echo $habitant['num_registre']; ?>&action=download" class="btn btn-danger px-4">
            <i class="fa-solid fa-file-arrow-down me-2"></i> Télécharger PDF
        </a>

        <a href="envoyer_mail.php?num=<?php echo $habitant['num_registre']; ?>" class="btn btn-warning px-4">
            <i class="fa-solid fa-envelope me-2"></i> Mail
        </a>

        <a href="https://wa.me/?text=Bonjour, l'extrait de <?php echo $habitant['prenom']; ?> est prêt. Vous pouvez le retirer à la Mairie de Sacré-Cœur." class="btn btn-success px-4" target="_blank">
            <i class="fa-brands fa-whatsapp me-2"></i> WhatsApp
        </a>

    </div>
</div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>