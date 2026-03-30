<?php
include 'db.php';

$message_succes = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $motif = mysqli_real_escape_string($conn, $_POST['motif']);

    // Préparation de la requête pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO rendezvous (date_rdv, motif) VALUES (?, ?)");
    $stmt->bind_param("ss", $date, $motif);

    if ($stmt->execute()) {
        $message_succes = "Rendez-vous enregistré avec succès !";
    } else {
        $message_succes = "Erreur : " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous - Mairie de Sacré-Cœur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fa-solid fa-landmark me-2"></i> MAIRIE DE SACRÉ-CŒUR</a>
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
                        <h2 class="h5 mb-0 text-center fw-bold">PRENDRE RENDEZ-VOUS</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            
                            <div class="mb-4">
                                <label class="form-label">Date et Heure du Rendez-vous</label>
                                <input type="datetime-local" name="date" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Motif du Rendez-vous</label>
                                <select name="motif" class="form-select form-select-lg" required>
                                    <option value="">Sélectionnez un motif...</option>
                                    <option value="Déclaration de naissance">Déclaration de naissance</option>
                                    <option value="Demande d'extrait">Demande d'extrait de naissance</option>
                                    <option value="Consultation">Consultation administrative</option>
                                    <option value="Autre">Autre motif</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-navy w-100 py-3 fw-bold">
                                <i class="fa-solid fa-calendar-check me-2"></i> CONFIRMER LE RENDEZ-VOUS
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 mt-5 text-white small">
        &copy; 2026 Mairie de Sacré-Cœur - République du Sénégal
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>