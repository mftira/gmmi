<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $file = '../collection/newsletter.txt';
        if (!file_exists($file)) {
            // If the file doesn't exist, create it
            $handle = fopen($file, 'w') or die("Impossible de créer le fichier newsletter.");
            fclose($handle);
        }
        // Read the existing emails
        $existing_emails = file($file, FILE_IGNORE_NEW_LINES);
        if (!in_array($email, $existing_emails)) {
            // If the email doesn't exist, append it to the file
            file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX);
            echo "Merci pour votre inscription!";
        } else {
            echo "Votre adresse e-mail est déjà inscrite.";
        }
    } else {
        echo "Adresse e-mail invalide.";
    }
} else {
    echo "Méthode de requête non valide.";
}
?>
