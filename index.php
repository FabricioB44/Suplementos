<?php 
session_set_cookie_params([
    'lifetime' => 0,
  ]);

session_start();

include('config/db_connect.php');

$sql = 'SELECT * FROM productos';

$result = mysqli_query($conn, $sql);

$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <link id="theme" rel="stylesheet" type="text/css" href="light-theme.css" />
    <link rel="stylesheet" href="CSS/Style.css">
    <link rel="stylesheet" href="CSS/NavbarStyle.css">
    <title>SupleLife.com</title>
</head>
<body>

    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

    <header id="navbar">
        <div id="logotipo">
            <img src="Images/Misc/LogoIA.jpeg" alt="Logo">
        </div>

        <div class="search-container">
            <form action="" method="POST">
              <input class="searchbar" type="text" placeholder="Buscar Producto" name="search">
              <button type="submit" name="submit" onclick="test()"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <nav class="botonera">
            <ul>
                <li><a href="Pages/ShoppingCart.php"><button type="submit"><i class="fa fa-shopping-cart"></i></button></a></li>
                <li><a href="Pages/Wishlist.php"><button type="submit"><i class="fa fa-heart"></i></button></a></li>
            </ul>
        </nav>
    </header>
<div class="content">
    <section>
        <div class="banner">
            <img id="logo1" src="Images/Misc/Logo1Transparente.png" alt="Logo1">
            <img id="logo2" src="Images/Misc/Logo2Transparente.png" alt="Logo2">
        </div>
    </section>

    <div class="centradoFotos">
        <section class="cards searched">
        <?php
    function php_func(){
        include('config/db_connect.php');

        if(isset($_POST['search'])) {
        $search = $_POST['search'];        

        $sql = "SELECT * FROM productos WHERE nombre like '%$search%'";

        $result = $conn->query($sql);
        
        if ($result->num_rows > 0){
            ?><h1>Resultados: </h1><?php
        while($producto = $result->fetch_assoc() ){?>
                        <article class="tarjeta searched">
                            <a href="Pages/Product.php?id=<?php echo $producto['id']?>">
                                <figure class="thumbnail">
                                    <img src="Images/Bolsas/<?php echo ($producto['imagen']); ?>" alt="img1">
                                    <h4 <?php if($producto['oferta'] == NULL or $producto['oferta'] == 0) { ?> style="display: none;"; <?php } ?>> <?php echo htmlspecialchars($producto['oferta']); ?>% OFF</h4>
                                </figure>
                                <div class="tarjetaContent">
                                    <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                                    <h3>Desde $
                                    <?php if ($producto['stock50gr'] != 0) {
                                            echo htmlspecialchars($producto['precio50gr']);
                                        }
                                        elseif ($producto['stock100gr'] != 0) {
                                            echo htmlspecialchars($producto['precio100gr']);
                                        }
                                        elseif ($producto['stock150gr'] != 0) {
                                            echo htmlspecialchars($producto['precio150gr']);
                                        }
                                        elseif ($producto['stock200gr'] != 0) {
                                            echo htmlspecialchars($producto['precio200gr']);
                                        }
                                        elseif ($producto['stock250gr'] != 0) {
                                            echo htmlspecialchars($producto['precio250gr']);
                                        }
                                        elseif ($producto['stock500gr'] != 0) {
                                            echo htmlspecialchars($producto['precio500gr']);
                                        }
                                        elseif ($producto['stock1kg'] != 0) {
                                            echo htmlspecialchars($producto['precio1kg']);
                                        }?> </h3>
                                    <p>Gramaje disponible: <br>
                                        <?php if ($producto['stock50gr'] != 0) {
                                            echo " 50gr";
                                        }
                                        if ($producto['stock100gr'] != 0) {
                                            echo " 100gr";
                                        }
                                        if ($producto['stock150gr'] != 0) {
                                            echo " 150gr";
                                        }
                                        if ($producto['stock200gr'] != 0) {
                                            echo " 200gr";
                                        }
                                        if ($producto['stock250gr'] != 0) {
                                            echo " 250gr";
                                        }
                                        if ($producto['stock500gr'] != 0) {
                                            echo " 500gr";
                                        }
                                        if ($producto['stock1kg'] != 0) {
                                            echo " 1kg";
                                        } ?></p>
                                </div>
                            </a>
                        </article> 
            <?php
         }
         ?><h1>Seguir Buscando: </h1> <?php
        } else {
         ?><h1>No se ha encontrado ningún resultado. </h1> 
         <h1>Seguir Buscando: </h1> <?php
        }
        }
        $conn->close();
    }
    php_func();
    ?>
        </section>
        <section class="cards">
            <?php foreach($productos as $producto): ?>
                <article class="tarjeta">
                    <a href="Pages/Product.php?id=<?php echo $producto['id']?>">
                        <figure class="thumbnail">
                            <img src="Images/Bolsas/<?php echo ($producto['imagen']); ?>" alt="img1">
                            <a>
                                <form method="POST" action="/Pages/Wishlist.php" target="dummyframe" id="forma<?php echo $producto['id']?>">
                                        <button class="heartBTN" type="submit" name="submit[]" value="<?php echo $producto['id']?>" id="<?php echo $producto['id']?>">
                                            <div class="bar-toggle<?php echo $producto['id']?>">
                                                <div class="heartBTNshow">
                                                    <i id="container1<?php echo $producto['id']?>" class="fa fa-lg fa-heart-o"></i>
                                                    <i id="container2<?php echo $producto['id']?>" class="fa fa-lg fa-heart"></i>
                                                </div>
                                            </div>
                                        </button>
                                    <input type='hidden' name='product_id' value="<?php echo $producto['id']?>">
                                </form>
                            </a>
                            

                            <h4 <?php if($producto['oferta'] == NULL or $producto['oferta'] == 0) { ?> style="display: none;"; <?php } ?>> <?php echo htmlspecialchars($producto['oferta']); ?>% OFF</h4>
                        </figure>
                        <div class="tarjetaContent">
                            <h2 class="valorNombre"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                            <h3>Desde $
                            <?php if ($producto['stock50gr'] != 0) {
                                    echo htmlspecialchars($producto['precio50gr']);
                                }
                                elseif ($producto['stock100gr'] != 0) {
                                    echo htmlspecialchars($producto['precio100gr']);
                                }
                                elseif ($producto['stock150gr'] != 0) {
                                    echo htmlspecialchars($producto['precio150gr']);
                                }
                                elseif ($producto['stock200gr'] != 0) {
                                    echo htmlspecialchars($producto['precio200gr']);
                                }
                                elseif ($producto['stock250gr'] != 0) {
                                    echo htmlspecialchars($producto['precio250gr']);
                                }
                                elseif ($producto['stock500gr'] != 0) {
                                    echo htmlspecialchars($producto['precio500gr']);
                                }
                                elseif ($producto['stock1kg'] != 0) {
                                    echo htmlspecialchars($producto['precio1kg']);
                                }?> </h3>

                            <p>Gramaje disponible: <br>
                                <?php if ($producto['stock50gr'] != 0) {
                                    echo " 50gr";
                                }
                                if ($producto['stock100gr'] != 0) {
                                    echo " 100gr";
                                }
                                if ($producto['stock150gr'] != 0) {
                                    echo " 150gr";
                                }
                                if ($producto['stock200gr'] != 0) {
                                    echo " 200gr";
                                }
                                if ($producto['stock250gr'] != 0) {
                                    echo " 250gr";
                                }
                                if ($producto['stock500gr'] != 0) {
                                    echo " 500gr";
                                }
                                if ($producto['stock1kg'] != 0) {
                                    echo " 1kg";
                                } ?></p>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/AcidoMalico.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Acido Malico</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/AcidoNicotinico.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Acido Nicotinico</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Ajo.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Ajo</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Almendras.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Almendras</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Arginina.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Arginina</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Cacao.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Cacao</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/ColagenoHidrolizado.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Colageno Hidrolizado</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Dextrosa.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Dextrosa</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Eritritol.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Eritritol</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Fenogreco.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Fenogreco</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/HarinaDeCoco.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Harina de Coco</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Jengibre.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Jengibre</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/MagnesioAleman.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Magnesio Aleman</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/MagnesioClorudo.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Magnesio Clorudo</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/MagnesioSulfato.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>MagnesioSulfato</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Maltodextrina.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Maltodextrina</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Matcha.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Matcha</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/MSM.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>MSM</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/PotasioAlumbre.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Potasio Alumbre</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/PotasioCitrato.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Potacio Citrato</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Psyllium.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Psyllium</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/SalDeHimalaya.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Sal de Himalaya</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/SalMarinaFina.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Sal Marina Fina</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/SalMarinaGruesa.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Sal Marina Gruesa</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Sodio.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Sodio</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Spirulina.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Spirulina</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Zeolita.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Zeolita</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Bolsas/Zinc.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Zinc</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/AceiteDeCoco500gr.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Acido de Coco</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/AloeVera.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>AloeVera</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/Colageno.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Colageno</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/CurcumaConcentrada.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Curcuma Concentrada</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/CurcumaPimientaNegra.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Curcuma Pimienta Negra</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/Magnesio.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Magnesio</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/Resveratrol.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Resveratrol</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/StressKiller.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Stress Killer</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/VitaminaB12.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Vitamina B12</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/VitaminaC.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Vitamina C</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

            <article class="tarjeta">
                <a href="Product.html">
                    <figure class="thumbnail">
                        <img src="Images/Botellas/VitaminaD3.jpeg" alt="img1">
                    </figure>
                    <div class="tarjetaContent">
                        <h2>Vitamina D3</h2>
                        <h3>Desde $200</h3>
                        <p>Gramaje disponible: 250gr / 500gr / 1Kilo</p>
                    </div>
                </a>
            </article>

        </section>
    </div>
</div>

    <div class="pieDePaginaFondo">      
        <footer class="pieDePagina">
          <div class="redes">
            <h5 class="darken"><a href="#"><i style="color: rgb(37, 211, 102);" class="fa fa-whatsapp"></i> 11 4426-4525</h5></a>
          </div>
    
          <div class="recruitment">
            <h5 class="darken"><a href="#"><i style="color: rgb(219, 68, 55);" class="fa fa-envelope"></i> Suplelifeargentina@gmail.com</h5></a>
          </div>
    
          <div class="advertisement">
            <h5 class="pieDePaginaTitulo">SupleLife® - SupleSeeds®</h5>
          </div>
          <p style="font-size: 12;">SupleLife® y SupleSeeds® son marcas registradas y únicamente pueden ser comercializadas y distribuidas a través de la web oficial www.Suplelife.com.ar y del punto de retiro ubicado en el barrio Parque Chacabuco. Así como tampoco pueden ser vendidos ni distribuidos por ninguna otra plataforma de ventas online que no sea la correspondiente a la cuenta oficial de Mercado Libre Suplelifesuplementosdietarios. SupleLife® y SupleSeeds® no poseen sucursales fuera del punto de retiro Capital Federal. SupleLife® y SupleSeeds® no se responsabilizan por réplicas y duplicados de nuestros productos.</p>
        </footer>
    </div>

    <a href="https://api.whatsapp.com/send?phone=541144264525" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="https://malsup.github.io/jquery.form.js"></script> 
    


    <script>

        
    function test(){
        $.ajax({url:"echo.php", success:function(result){
        $("div").text(result);}
    })
    }

   function favFunc(event){
    <?php foreach($productos as $producto): ?>
        $.post("/index.php", $("#forma<?php echo $producto['id']?>").serialize(), function(data){
            $(document).ready(() => {
                const button = $('#<?php echo $producto['id']?>');
                button.click(() => {
                    if (localStorage.toggled<?php echo $producto['id']?> == "" )  {
                    sessionStorage.setItem('nombre','<?php echo htmlspecialchars($producto['nombre']); ?>')
                    document.getElementById('test').innerText = sessionStorage.getItem('nombre');
                    } else {
                    document.getElementById('test').innerText = "test"
                    } 
                });       
            });
        });
    <?php endforeach; ?>
  }

  <?php foreach($productos as $producto): ?>
  $(document).on('click', '#forma<?php echo $producto['id']?>', favFunc);
  <?php endforeach; ?>







 //retrieve current state
 $('#containerPri').toggleClass(localStorage.toggled1);


    $(window).bind("load", function() {
        // code goes here
        if (localStorage.toggled1 == "Pri" ) {
            $('#containerPri2').toggleClass("with_toggle", true);
        } else  {
        $('#containerPri1').toggleClass("with_toggle", true );
        } 
    });


    /* Toggle */
    $('.bar-togglePri').on('click',function(){

       //localstorage values are always strings (no booleans)  

       if (localStorage.toggled1 == "Pri" ) {
          $('#containerPri1').toggleClass("with_toggle", true );
          $('#containerPri2').toggleClass("with_toggle", false);
          localStorage.toggled1 = "with_togglePri";
       } else {
          $('#containerPri1').toggleClass("with_toggle", false );
          $('#containerPri2').toggleClass("with_toggle", true);
          localStorage.toggled1 = "Pri";
       }

    });





$('#containerSeg').toggleClass(localStorage.toggled2);


    $(window).bind("load", function() {
        // code goes here
        if (localStorage.toggled2 == "Seg" ) {
            $('#containerSeg2').toggleClass("with_toggle", true);
        } else {
        $('#containerSeg1').toggleClass("with_toggle", true );
        } 
    });

        /* Toggle */
        $('.bar-toggleSeg').on('click',function(){

    //localstorage values are always strings (no booleans)  

    if (localStorage.toggled2 == "Seg" ) {
    $('#containerSeg1').toggleClass("with_toggle", true );
    $('#containerSeg2').toggleClass("with_toggle", false);
    localStorage.toggled2 = "with_toggleSeg";
    } else {
    $('#containerSeg1').toggleClass("with_toggle", false );
    $('#containerSeg2').toggleClass("with_toggle", true);
    localStorage.toggled2 = "Seg";
    }

    });





    <?php foreach($productos as $producto): ?>
    $('#container1<?php echo $producto['id']?>').toggleClass(localStorage.toggled<?php echo $producto['id']?>);
    <?php endforeach; ?>


    $(window).bind("load", function() {
        <?php foreach($productos as $producto): ?>
        // code goes here
        if (localStorage.toggled<?php echo $producto['id']?> == "" ) {
            $('#container2<?php echo $producto['id']?>').toggleClass("with_toggle", true);
        } else {
        $('#container1<?php echo $producto['id']?>').toggleClass("with_toggle", true );
        }

        <?php endforeach; ?>
    });

    <?php foreach($productos as $producto): ?>
        /* Toggle */
        $('.bar-toggle<?php echo $producto['id']?>').on('click',function(){    

    
    //localstorage values are always strings (no booleans)  

    if (localStorage.toggled<?php echo $producto['id']?> == "" ) {
    $('#container1<?php echo $producto['id']?>').toggleClass("with_toggle", true );
    $('#container2<?php echo $producto['id']?>').toggleClass("with_toggle", false);
    localStorage.toggled<?php echo $producto['id']?> = "with_toggle";
    } else {
    $('#container1<?php echo $producto['id']?>').toggleClass("with_toggle", false );
    $('#container2<?php echo $producto['id']?>').toggleClass("with_toggle", true);
    localStorage.toggled<?php echo $producto['id']?> = "";
    }

    

    });
    <?php endforeach; ?>

    </script>

</body>
</html>