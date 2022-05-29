<?php

    // Avvia la sessione
    session_start();
    // Verifica se l'utente è loggato
    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: login.php");
        exit;
    }

    $connect = mysqli_connect("localhost", "root", "", "hw1");

if(isset($_POST['add_to_cart']))
{
    if (isset($_SESSION['cart']))
    {
        $session_array_id = array_column($_SESSION['cart'], "id");

        if (!in_array($_GET['id'], $session_array_id))
        {
            $session_array = array(
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
            );
    
            $_SESSION['cart'][] = $session_array;
        }

    }
    else
    {
        $session_array = array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
        );

        $_SESSION['cart'][] = $session_array;
    }
}

?>

<html>
    <head>
        <title>
            Mobile E-Commerce
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css">
        <script src = "index.js" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;1,400&display=swap" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar">
            <div class="nav">
                <a href="index.php"><img src="img/logo.png" class="brand-logo"></a>
                <div class="nav-items">
                    <div class="search">
                        <form id="telefono">
                        <input type="search" class="search-box" placeholder="Cerca" id = "phone_name">
                        <input type ="submit" id = "submit" class="search-btn" value = "Search">
                        </form>
                    </div>
                    <a href="logout.php"><img src="img/user.png"></a>
                    <a href=".resoconto"><img src="img/cart.png"></a>
                </div>
            </div>
            <ul class="links-container">
                <li class="link-item"><a href="#" class="link">Smartphone</a></li>
                <li class="link-item"><a href="#" class="link">Iphone</a></li>
                <li class="link-item"><a href="#" class="link">Tablet</a></li>
                <li class="link-item"><a href="#" class="link">Ipad</a></li>
                <li class="link-item"><a href="#" class="link">Accessori</a></li>
            </ul>
        </nav>
            <h1>Benvenuto <?php echo $_SESSION["username"]; ?>!</h1>
            <h2>Login/registrazione avvenuta con successo!</h2>
            <header class="hero-section">
                <div class="content">
                    <img src="img/logo.png" class="logo">
                     <p class="sub-heading">Best deals on Mobile Phone</p>
                </div>
            </header>

            <div class ="shop">
                    <h3>Prodotti Selezionabili</h3>
                    <div class ="product-container">
                        <?php

                            $query = "SELECT * FROM cart_item";
                            $result = mysqli_query($connect, $query);

                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <div class ="product-card">
                            <form method ="post" action="index.php?id=<?=$row['id'] ?>">
                                <img src="img/<?php echo $row['image'] ?>" class ="product-img">
                                <h2 class ="product-brand"><?php echo $row['name']; ?></h2>
                                <p class ="product-des"><?php echo $row['description']; ?></p>
                                <span class ="price">€<?php echo number_format($row['price'],2); ?></span>
                                <input type="hidden" name="name" value ="<?= $row['name'] ?>">
                                <input type="hidden" name="price" value ="<?= $row['price'] ?>">
                                <input type="number" name="quantity" value ="1" class ="form-control">
                                <input type="submit" name="add_to_cart" class ="card-btn" value ="Aggiungi al Carrello"> 
                            </form>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                <div class ="resoconto">
                    <h3>Prodotti Selezionati</h3>
                        <div class ="carrello">
                            <table class = 'table'>
                            <?php

                            $total = 0;
                            $output = "";

                            $output = "
                            <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Prezzo</th>
                            <th>Quantità</th>
                            <th>Prezzo Totale</th>
                            <th>Action</th>
                            </tr>";
                            if(!empty($_SESSION['cart']))  //se cart non è vuoto
                            {
                                foreach ($_SESSION['cart'] as $key => $value)
                                {
                                    $output .= "
                                    <tr>
                                        <td>".$value['id']."</td>
                                        <td>".$value['name']."</td>
                                        <td>".number_format($value['price'],2)."</td>
                                        <td>".$value['quantity']."</td>
                                        <td>€".number_format($value['price'] * $value['quantity'],2)."</td>
                                        <td>
                                            <a href = 'index.php?action=remove&id=".$value['id']."'>
                                            <button class = 'btn-remove'>Rimuovi</button>
                                            </a>
                                        </td>
                                    ";
                                    $total = ($total + ($value['quantity']*$value['price']));
                                }


                                $output .= "
                                <tr>
                                    <td colspan ='2'></b>Prezzo Finale</b></td>
                                    <td colspan ='3'>€".number_format($total,2)."</td>
                                    <td>
                                        <button id = 'btn-checkout'>Checkout</button>
                                    </td>
                                </tr>
                                ";
                            }
                            echo $output;
                            ?>
                        </div>
                </div>
            </div>


        <?php 
            if (isset($_GET['action']))
            {
                if ($_GET['action'] == 'remove')
                {
                    foreach ($_SESSION['cart'] as $key => $value)
                            {
                                if($value['id'] == $_GET['id'])
                                {
                                    unset($_SESSION['cart'][$key]);
                                }
                            }
                }

            }
        ?>
    </body>
</html>