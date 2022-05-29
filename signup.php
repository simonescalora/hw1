<?php
    session_start();

    if(isset($_SESSION["username"])){
        // Vai alla index
        header("Location: index.php");
        exit;
    }
    
    // Verifica l'esistenza di dati POST
    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){
        $errors = array();
        $conn = mysqli_connect("localhost", "root", "", "hw1");

        # USERNAME
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        $query = "SELECT username FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $errors[] = "Username già utilizzato";
        }

        # PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $errors[] = "Caratteri password insufficienti";
        } 
        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $errors[] = "Email già utilizzata";
            }
        }

        # REGISTRAZIONE NEL DATABASE
        if (count($errors) == 0) {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(nome, cognome, username, email,  password) VALUES('$nome', '$cognome', '$username', '$email', '$password')";
            
            if (mysqli_query($conn, $query)) {
                // Imposta la variabile di sessione
                $_SESSION["username"] = $_POST["username"];
                // Vai alla pagina index.php
                header("Location: index.php");
                exit;
            } else 
            {
                $errors[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $errors[] = array("Riempi tutti i campi");
    }
?>

<html>
    <head>
        <title>
            Mobile E-Commerce
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="signup.css">
        <script src='signup.js' defer></script>
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
                        <a href="login.php"><img src="img/user.png"></a>
                        <a href="login.php"><img src="img/cart.png"></a>
                    </div>
                </div>
                <ul class="links-container">
                </ul>
                </nav>
                </header>
                <div class ='registrazione'>
                    <form name='signup' method = 'post'>
                        <img src="img/logo.png">
                        <h1>Sign up now!</h1>
                        <?php 
                            if(isset($errors)) 
                            {
                                foreach($errors as $error)
                                {
                                    echo $error;
                                    echo "<br>";
                                }
                            };
                        ?>
                        <div>
                            <input type="text" name="nome" placeholder="Name">
                            <label>Nome</label>
                          </div>

                          <div>
                            <input type="text" name="cognome" placeholder="Surname">
                            <label>Cognome</label>
                          </div>

                          <div>
                            <input type="text" name="username" placeholder="Username">
                            <label>Username</label>
                          </div>

                          <div>
                            <input type="password" name="password" placeholder="Password">
                            <label>Password</label>
                          </div>

                          <div>
                            <input type="email" name="email" placeholder="name@example.com">
                            <label>Email address</label>
                          </div>
                    
                        <div>
                            <p><input type="checkbox"> Accetto politica privacy</p>
                        </div>
                        <button type="submit">Sign up</button>
                        <div>

                          <p>Sei già registrato?
                          <a href = "login.php">Accedi</a>
                          </p>
                      </div>
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