<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hannah Rogers | Intro</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
    <script src="script.js"></script>
</head>
<body>
    <!-- Navigation -->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/nav.php'; ?>
    <header>
        <h1>About Me</h1>
    </header>
    <main id="intro-main">
        <image src="images/me.jpg" alt="Hannah">
        <div>
            <a href="#" class="intro" id="location" onclick="populate(this.id)">+ Where I am From</a>
            <div class="hide" id="location-output"><p>Payson, UT</p></div>

            <a href="#" class="intro" id="food" onclick="populate(this.id)">+ My Favorite Food</a>
            <div class="hide" id="food-output"><p>Potato Chips</p></div>

            <a href="#" class="intro" id="major" onclick="populate(this.id)">+ My Major</a>
            <div class="hide" id="major-output"><p>Applied Technology</p></div>

            <a href="#" class="intro" id="hobbies" onclick="populate(this.id)">+ My Hobbies</a>
            <div class="hide" id="hobbies-output"><p>Hiking, biking, learning fun facts, traveling, and cooking.</div>

            <a href="#" class="intro" id="countries" onclick="populate(this.id)">+ Countries I've Been To</a>
            <div class="hide" id="countries-output"><p>Canada, England, Belgium, France, Spain, Portugal, Italy, Croatia, and China.</p></div>

            <a href="#" class="intro" id="family" onclick="populate(this.id)">+ My Family</a>
            <div class="hide" id="family-output"><p>Four brothers, 5 sisters, 11 nieces, and 4 nephews.</p></div>
        </div>
    </main>
    <footer>
        <?php echo date("F j, Y"); ?>
    </footer>
</body>
</html>
