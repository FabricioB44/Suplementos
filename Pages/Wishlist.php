<?php 
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['submit'][]  = $_POST['submit'];
 }
 
$submitValues = isset($_SESSION['submit']) ? $_SESSION['submit'] : "no var";

//unset($submitValues[0]);

if($submitValues!="no var"){

$sortedArray = "";

foreach($submitValues as $array) {
    $sortedArray .= implode($array);
}

$sortedArray = str_split($sortedArray);


$vals = array_count_values($sortedArray);


$isThereOdd = false;
foreach($vals as $value)
{
  if($value%2==0)
  {
    $a2 = (array_keys($vals, "$value"));
    $sortedArray=array_diff($sortedArray,$a2);
    $sortedArray = array_unique($sortedArray, SORT_REGULAR);
    //echo array_search($value,$vals);
  }
  else
  {
    $sortedArray = array_unique($sortedArray, SORT_REGULAR);
    $isThereOdd = true;
  }

}
}

if($submitValues!="no var" && $isThereOdd == true){
include('../config/db_connect.php');

$sql = "SELECT * FROM productos WHERE id IN (".implode(',', $sortedArray).")";

$result = mysqli_query($conn, $sql);

$productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

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
    <link rel="stylesheet" href="../CSS/Style.css">
    <link rel="stylesheet" href="../CSS/NavbarStyle.css">
    <link rel="stylesheet" href="../CSS/WishlistStyle.css">
    <title>Wishlist</title>
</head>
<body>

    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

    <header id="navbar">
        <div id="logotipo">
        <a href="../index.php"><img src="../Images/Misc/LogoIA.jpeg" alt="Logo"></a>
        </div>

        <div class="search-container">
            <form action="" method="POST">
              <input class="searchbar" type="text" placeholder="Buscar Producto" name="search">
              <button type="submit" name="submit" onclick="test()"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <nav class="botonera">
            <ul>
                <li><a href="ShoppingCart.php"><button type="submit"><i class="fa fa-shopping-cart"></i></button></a></li>
                <li><a href="#0"><button type="submit"><i class="fa fa-heart"></i></button></a></li>
            </ul>
        </nav>
    </header>

<div class="content">
    <p class="path"><a href="../index.php">Home</a> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#0">Favoritos<a></p>

<?php if($submitValues!="no var" && $isThereOdd == true): ?>
    <section class="wishlist-details">
    <p id="test"></p>    
        <?php foreach($productos as $producto): ?>
            <div class="wishlist-card" id="card<?php echo $producto['id']?>">
                <a href="../Pages/Product.php?id=<?php echo $producto['id']?>">
                    <div class="wishlistHover">
                        <img class="wishlistImage" src="../Images/Bolsas/<?php echo ($producto['imagen']); ?>" alt="">
                        <div class="wishlistInfo">
                            <p class="wishlistName"><?php echo htmlspecialchars($producto['nombre']); ?></p>
                            <p class="wishlistStock">Disponible en: <br><?php if ($producto['stock50gr'] != 0) {
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
                        <div class="wishlistPriceInfo">
                            <p class="wishlistOffer" <?php if($producto['oferta'] == NULL or $producto['oferta'] == 0) { ?> style="display: none;"; <?php } ?>><?php echo htmlspecialchars($producto['oferta']); ?>% OFF</p>
                            <p class="wishlistPrice">Desde: <br>$
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
                                        }?> </p>
                        </div>
                    </div>
                </a>
                <form method="POST" action="/Pages/Wishlist.php" target="dummyframe" id="forma<?php echo $producto['id']?>">
                    <div class="bar-toggle<?php echo $producto['id']?>">
                        <span><button class="wishlistDelete" type="submit" name="submit[]" value="<?php echo $producto['id']?>" id="<?php echo $producto['id']?>">Eliminar</button></span>
                    </div>
                    <input type='hidden' name='product_id' value="<?php echo $producto['id']?>">
                </form>
                
            </div>
        <?php endforeach; ?>
    </section>
    <?php else: ?>
    <section class="wishlist-nothing">
        <div class="wishlist-card">
            <p id="nothingInWishlist">No se han añadido productos a la lista de favoritos</p>
            <p id="nothingInWishlist2">Preciona el boton <i class="fa fa-heart-o" aria-hidden="true"></i>
            en la imagen de tu producto para agregarlo a la lista</p>
        </div>
    </section>
    <?php endif; ?>
</div>

    <div class="pieDePaginaFondo">
        <footer class="pieDePagina" <?php if($submitValues=="no var" || $isThereOdd == false) echo 'id="marginLeft"'; ?>>
          <div class="redes">
            <h5 class="darken"><a href="#"><i style="color: rgb(37, 211, 102);" class="fa fa-whatsapp"></i> 11 4426-4525</h5></a>
          </div>
    
          <div class="recruitment">
            <h5 class="darken"><a href="#"><i style="color: rgb(219, 68, 55);" class="fa fa-envelope"></i> Suplelifeargentina@gmail.com</h5></a>
          </div>
    
          <div class="advertisement">
            <h5 class="pieDePaginaTitulo">SupleLife® - SupleSeeds®</h5>
          </div>
          <p style="font-size: 12; <?php if($submitValues=="no var" || $isThereOdd == false) echo "margin-left: 250px;" ?>">SupleLife® y SupleSeeds® son marcas registradas y únicamente pueden ser comercializadas y distribuidas a través de la web oficial www.Suplelife.com.ar y del punto de retiro ubicado en el barrio Parque Chacabuco. Así como tampoco pueden ser vendidos ni distribuidos por ninguna otra plataforma de ventas online que no sea la correspondiente a la cuenta oficial de Mercado Libre Suplelifesuplementosdietarios. SupleLife® y SupleSeeds® no poseen sucursales fuera del punto de retiro Capital Federal. SupleLife® y SupleSeeds® no se responsabilizan por réplicas y duplicados de nuestros productos.</p>
        </footer>
    </div>

    <a href="https://api.whatsapp.com/send?phone=541144264525" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

function favFunc(event){
    <?php foreach($productos as $producto): ?>
        $.post("/index.php", $("#forma<?php echo $producto['id']?>").serialize(), function(data){
            $(document).ready(() => {
                const button = $('#<?php echo $producto['id']?>');
                button.click(() => {
                    sessionStorage.setItem('nombre','<?php echo htmlspecialchars($producto['nombre']); ?>')                                        
                });       
            });
        });
    <?php endforeach; ?>
  }

  <?php foreach($productos as $producto): ?>
  $(document).on('click', '#forma<?php echo $producto['id']?>', favFunc);
  <?php endforeach; ?>








  <?php foreach($productos as $producto): ?>
    $('#container1<?php echo $producto['id']?>').toggleClass(localStorage.toggled<?php echo $producto['id']?>);
    <?php endforeach; ?>


  <?php foreach($productos as $producto): ?>
        /* Toggle */
        $('.bar-toggle<?php echo $producto['id']?>').on('click',function(){    
    
    //localstorage values are always strings (no booleans)  

    localStorage.toggled<?php echo $producto['id']?> = "";
    document.getElementById('card<?php echo $producto['id']?>').style.display = 'none'
    });
    <?php endforeach; ?>
    </script>

</body>
</html>