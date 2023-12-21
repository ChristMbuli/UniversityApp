<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=university;charset=utf8', 'root', '');
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Condition pour vérifier si le bouton "addcourse" a été appuyé
if (isset($_POST['addcourse'])) {
    // Section pour vérifier si les champs du formulaire pour ajouter un nouveau cours ne sont pas vides
    if (!empty($_POST['program']) && !empty($_POST['teacher']) && !empty($_POST['namecourse']) && !empty($_FILES['picture']['name'])) {

        // Stocker les informations entrées dans le formulaire dans des variables
        $program = htmlspecialchars($_POST['program']);
        $teacher = htmlspecialchars($_POST['teacher']);
        $namecourse = htmlspecialchars($_POST['namecourse']);

        $date = $_SESSION['year'];

        // Insérer l'image du cours
        $picture = $_FILES['picture']['name'];
        $picture_tmp = $_FILES['picture']['tmp_name'];
        $picture_path = 'images/' . $picture;
        move_uploaded_file($picture_tmp, $picture_path);

        // Requête pour insérer les données du formulaire dans la table
        $InsertCourses = $conn->prepare('INSERT INTO courses (name_course, images_course, program, name_teacher, session_year) VALUES(?, ?, ?, ?, ?)');
        $InsertCourses->execute(array($namecourse, $picture_path, $program, $teacher, $date));

        $SuccessMsg = "Course registered successfully";
    } else {
        $msgError = "Please fill in all fields.";
    }
}
?>


