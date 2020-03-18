
<?php include 'database.php'; ?>
<?php session_start();?>
<?php
    // See if score is set_error_handler
    if(!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }

    if($_POST) {
        $num = $_POST['number'];
        $choice_made = $_POST['choice'];
        $next = $num+1;

        // Reset score
        if($num == 1) {
            $_SESSION['score'] = 0;
        }

        // Get total questions
        $total = $mysqli->query("SELECT * FROM questions")->num_rows or die($mysqli->error.__LINE__);

        // Get correct choice from DB
        $query = "SELECT * FROM choices
                  WHERE question_number = '$num' AND is_correct = 1";

        // Get result
        $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

        // Get row
        $row = $result->fetch_assoc();

        // Set correct choice
        $correct_choice = $row['id'];

        // Compare if choice made is right
        if($correct_choice == $choice_made) {
            $_SESSION['score'] = $_SESSION['score'] + 1;
        }

        if($num == $total) {
            header("location:final.php");
            exit();
        } else {
            header("location:question.php?n=".$next);
        }

    }