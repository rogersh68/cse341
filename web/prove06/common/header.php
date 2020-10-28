<header>
        <nav>
            <ul>
                <li><a title="Home" href="./">Home</a></li>
                <li><a title="Account" href="account.php">Account</a></li>
                <li><a title="About" href="about.php">About</a></li>
                <li><a title="Commission" href="commission.php">Commission</a></li>
            </ul>
        </nav>
        <div class="logo_header_div">
            <img class="logo" src="images/logo.svg" alt="logo">
            <h1>Christina's Creations</h1>
        </div>
        <?php
        if (!$_SESSION['logged_in'] or empty($_SESSION['logged_in'])) {
            echo "<a class='account_header_link' href='account.php'>My Account</a>";
        }
        else {
            $stmt = $db->prepare('SELECT userimg FROM public.user WHERE userid = :userid');
            $stmt->bindValue(':userid', $_SESSION['user_info']['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $profImg = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<a class='logout_header_link' href='logout.php'><img width='80px' height='auto' src='".$profImg['userimg']."'>Logout</a>";
        }
        ?>
</header>