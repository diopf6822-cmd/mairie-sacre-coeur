<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $motif = $_POST['motif'];

    // Préparation de la requête pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO rendezvous (date_rdv, motif) VALUES (?, ?)");
    $stmt->bind_param("ss", $date, $motif);

    if ($stmt->execute()) {
        echo 'Rendez-vous enregistré avec succès !';
    } else {
        echo 'Erreur : ' . $conn->error;
    }
    $stmt->close();
}
?>

<form method='post'>
    Date : <input name='date' type='datetime-local' required><br>
    Motif : <input name='motif' type='text' required><br>
    <button type='submit'>Enregistrer</button>
</form>