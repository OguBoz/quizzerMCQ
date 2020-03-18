<?php include 'database.php'; ?>
<?php

    // Get total questions
    $total = $mysqli->query("SELECT * FROM questions")->num_rows or die($mysqli->error.__LINE__);
    
    // Get question number
    $num = !empty($_GET['n']) ? (int) $_GET['n'] : '';

    // Get question query
    $query  = "SELECT * FROM questions
                    WHERE question_number = '$num'";
    // Get result
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

    // Bring the result as an associative array
    $question = $result->fetch_assoc();

    // Get choices query
    $query  = "SELECT * FROM choices
                    WHERE question_number = '$num'";
    // Get choices
    $choices = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzer</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <header>
        <div class="container">
            <h1>PHP Quizzer</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="current">Question <?php echo $question['question_number'] . " of " . $total; ?></div>
            <p class="question">
                <?php echo $question['text']; ?>
            </p>
            <form action="process.php" method="post">
                <ul class="choices">
                    <?php 
                        while($row = $choices->fetch_assoc()) : ?>
                            <li><input type="radio" name="choice" value="<?php echo $row["id"]; ?>"><?php echo $row["text"]; ?></li>
                        <?php endwhile; ?>
                </ul>
                <input type="submit" value="Submit" name="submit">
                <input type="hidden" name="number" value="<?php echo $question['question_number']; ?>">
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2020, PHP Quizzer
        </div>
    </footer>
</body>
</html>