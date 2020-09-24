<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hannah Rogers | Home</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Navigation -->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/nav.php'; ?>
    <header>
        <h1>Welcome</h1>
    </header>
    <main>
        <h2>Hannah Rogers - CSE 341<h2>
        <a class="link" href="/intro.php">Intro</a>
        <a class="link" href="/assignments.php">Assignments</a>
    </main>
    <footer>
        <?php echo date("F j, Y"); ?>
    </footer>
</body>
</html>