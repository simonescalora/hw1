<?php

    // Avvia la sessione
    session_start();
    // Verifica l'accesso
    if(isset($_SESSION["username"]))
    {
        // Vai alla index
        header("Location: index.php");
        exit;
    }
    // Verifica l'esistenza di dati POST
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        // Connetti al database
        $conn = mysqli_connect("localhost", "root", "", "hw1");
        // Cerca utenti con quelle credenziali
        $query = "SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
		$res = mysqli_query($conn, $query);
        // Verifica la correttezza delle credenziali
        if(mysqli_num_rows($res) > 0)
        {
            // Imposta la variabile di sessione
            $_SESSION["username"] = $_POST["username"];
            // Vai alla pagina index.php
            header("Location: index.php");
            exit;
        }
        else
        {
            // Flag di errore
            $errore = true;
        }
    }

?>

<html>
    <head>
        <title>
            Mobile E-Commerce
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login.css">
        <script src='login.js' defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;1,400&display=swap" rel="stylesheet">
    </head>

    <body>
            <nav class="navbar">
                <div class="nav">
                    <a href="index.php"><img src="img/logo.png" class="brand-logo"></a>
                    <div class="nav-items">
                        <div class="search">
                            <input type="text" class="search-box" placeholder="Cerca">
                            <button class="search-btn">Search</button>
                        </div>
                        <a href="signup.php"><img src="img/user.png"></a>
                        <a href="#"><img src="img/cart.png"></a>
                    </div>
                </div>
                <ul class="links-container">
                </ul>
                </nav>
                </header>
                <div class ='accedi'>
                    <form name = 'nome_form' method = 'post'>
                        
                        <img src="img/logo.png">
                        <h1>Please sign in</h1>

                        <div>
                        <input type="text" name="username" placeholder="Username">
                        <label>Username</label>
                        </div>
                        <div>
                        <input type="password" name="password" placeholder="Password">
                        <label>Password</label>
                        </div>
                    
                        <div>
                            <p>Non hai ancora un account?
                            <a href = "signup.php">Registrati</a>
                            </p>

                        <?php
                            // Verifica la presenza di errori
                            if(isset($errore))
                            {
                                echo "<p class='errore'>";
                                echo "Credenziali non valide.";
                                 echo "</p>";
                            }
                        ?>
                        </div>
                        <button type="submit">Sign in</button>
                    </form>
                </div>

      <footer>
        <div class="footer">
            <div id="elem1"><p><a><img class="img3" src="img/map.png"></a><br><p>Vieni a trovarci nel punto<br> vendita piu' vicino</p></div>
            <div id="elem1"><p><a><img class="img3" src="img/time.png"></a><br><p>Spedizione gratuita e veloce!<br> In sole 24h il vostro ordine <br>sara' gia' processato</p></div>
            <div id="elem1"><p><a><img class="img3" src="img/card.png"></a><br><p>Accettiamo tutti i metodi di pagamento!</p></div>
            <div id="elem1"><p><a><img class="img3" src="img/chat.png"></a><br><p>Serve qualche info? Non esitare a <br> contattare il nostro servizio clienti</p></div>
            
        </div>
        <div class="footer1">
            <p>Simone Scalora<br>1000002068</p>
        </div>
      </footer>
    </body>
</html>