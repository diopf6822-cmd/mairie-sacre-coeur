<?php
include 'db.php';
require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_GET['num'])) {
    $num = mysqli_real_escape_string($conn, $_GET['num']);
    
    // Récupération des données
    $requete = mysqli_query($conn, "SELECT * FROM habitants WHERE num_registre = '$num'");
    $donnees = mysqli_fetch_assoc($requete);

    if ($donnees) {
        // --- PRÉPARATION DU DOSSIER ---
        $dossier = "Extrait";
        if (!is_dir($dossier)) {
            mkdir($dossier, 0777, true); // Crée le dossier s'il n'existe pas
        }

        // --- CONTENU HTML ---
        $html = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .cadre { border: 3px double #000; padding: 30px; min-height: 800px; }
                .entete { text-align: center; margin-bottom: 40px; }
                .titre { text-align: center; font-size: 24px; font-weight: bold; text-decoration: underline; margin-bottom: 30px; }
                .info { margin-bottom: 15px; font-size: 16px; }
                .footer { margin-top: 50px; text-align: right; font-style: italic; }
            </style>
        </head>
        <body>
            <div class='cadre'>
                <div class='entete'>
                    <strong>REPUBLIQUE DU SENEGAL</strong><br>
                    Un Peuple - Un But - Une Foi<br><br>
                    REGION DE DAKAR<br>
                    VILLE DE SACRÉ-CŒUR
                </div>

                <div class='titre'>EXTRAIT DE NAISSANCE</div>

                <div class='info'>Registre N° : <strong>".$donnees['num_registre']."</strong></div>
                <div class='info'>Prénom : <strong>".$donnees['prenom']."</strong></div>
                <div class='info'>Nom : <strong>".strtoupper($donnees['nom'])."</strong></div>
                <div class='info'>Sexe : <strong>".$donnees['sexe']."</strong></div>
                <div class='info'>Né(e) le : <strong>".date('d/m/Y', strtotime($donnees['date_naissance']))."</strong> à <strong>".$donnees['heure_naissance']."</strong></div>
                <div class='info'>Lieu : <strong>".$donnees['lieu_naissance']."</strong></div>
                
                <hr>
                <div class='info'>Père : ".$donnees['prenom_pere']." ".$donnees['nom_pere']."</div>
                <div class='info'>Mère : ".$donnees['prenom_mere']." ".$donnees['nom_mere']."</div>

                <div class='footer'>
                    Fait à Sacré-Cœur, le ".date('d/m/Y')."<br>
                    L'officier d'État-Civil
                </div>
            </div>
        </body>
        </html>";

        // --- GÉNÉRATION DOMPDF ---
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // --- SAUVEGARDE PHYSIQUE DANS LE DOSSIER ---
        $nom_fichier = "Extrait_" . str_replace('/', '-', $donnees['num_registre']) . ".pdf";
        $chemin_complet = $dossier . "/" . $nom_fichier;
        
        $output = $dompdf->output();
        file_put_contents($chemin_complet, $output); // Enregistre le fichier sur le disque

        // Si l'URL contient action=download, on télécharge. Sinon, on affiche.
$mode = (isset($_GET['action']) && $_GET['action'] == 'download') ? 1 : 0;

$dompdf->stream($nom_fichier, array("Attachment" => $mode));
    }
}
?>