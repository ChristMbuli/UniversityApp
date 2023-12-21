<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=university;charset=utf8;', 'root', '');
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Récupérer le nom du cours
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $IdTheCourse = $_GET['id'];

    // Récupérer toutes les leçons qui appartiennent au cours avec l'ID de l'URL
    $getAllLessons = $conn->prepare('SELECT id_lesson, name_lesson, lessons FROM lessons WHERE id_courses = ?');
    $getAllLessons->execute(array($IdTheCourse));

    // Vérifier s'il y a des leçons disponibles
    if ($getAllLessons->rowCount() > 0) {
        $lessonsAvailable = true;
        $lessons = array();

        while ($lessonsData = $getAllLessons->fetch()) {
            // Obtenir l'extension du fichier
            $extension = pathinfo($lessonsData['lessons'], PATHINFO_EXTENSION);

            // Déterminer l'image correspondante à l'extension du fichier
            $image = '';
            switch ($extension) {
                case 'pdf':
                    $image = 'pdf.png';
                    break;
                case 'pptx':
                    $image = 'pptx.png';
                    break;
                case 'docx':
                    $image = 'word.png';
                    break;
                default:
                    $image = 'default.png'; // Image par défaut pour les autres types de fichiers
                    break;
            }

            // Ajouter les données de la leçon à un tableau
            $lesson = array(
                'id' => $lessonsData['id_lesson'],
                'name' => $lessonsData['name_lesson'],
                'image' => $image,
                'extension' => $extension
            );

            $lessons[] = $lesson;
        }
    } else {
        $lessonsAvailable = false;
    }
}
?>


