<?php 
session_set_cookie_params([
  'lifetime' => 0,
]);

session_start();

include('../config/db_connect.php');

if(isset($_GET['id'])){
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT * FROM productos WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  $productos = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);
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
    <link rel="stylesheet" href="../CSS/ProductStyle.css">
    <title><?php echo htmlspecialchars($productos['nombre']); ?></title>
</head>
<body <?php if($productos['stock50gr'] != 0) { ?> 
        onload="sssSizeFunc()"; <?php
        }
        elseif($productos['stock100gr'] != 0) { ?> 
          onload="ssSizeFunc()"; <?php
        } 
        elseif($productos['stock150gr'] != 0) { ?> 
          onload="sSizeFunc()"; <?php
        } 
        elseif($productos['stock200gr'] != 0) { ?> 
          onload="mSizeFunc()"; <?php
        } 
        elseif($productos['stock250gr'] != 0) { ?> 
          onload="lSizeFunc()"; <?php
        } 
        elseif($productos['stock500gr'] != 0) { ?> 
          onload="xlSizeFunc()"; <?php
        }
        elseif($productos['stock1kg'] != 0) { ?> 
          onload="xxlSizeFunc()"; <?php
        } ?>
      >
    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>


    <header id="navbar">
        <div id="logotipo">
            <a href="../index.php"><img src="../Images/Misc/LogoIA.jpeg" alt="Logo"></a>
        </div>

        <div class="search-container">
            <form action="/action_page.php">
              <input class="searchbar" type="text" placeholder="Buscar Producto" name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>

        <nav class="botonera">
            <ul>
                <li><a href="ShoppingCart.php"><button type="submit"><i class="fa fa-shopping-cart"></i></button></a></li>
                <li><a href="Wishlist.php"><button type="submit"><i class="fa fa-heart"></i></button></a></li>
            </ul>
        </nav>
    </header>
    
    <p class="path"><a href="../index.php">Home</a> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#0"><?php echo htmlspecialchars($productos['nombre']); ?></a></p>
    <section class="product-details">
        <div class="figure">
          <img class="imageSlider magnifiedImg" src="../Images/Bolsas/<?php echo ($productos['imagen']); ?>">
          <form method="POST" action="/Pages/ShoppingCart.php" target="dummyframe" id="forma<?php echo $producto['id']?>">
            <button class="heartBTN" type="submit" name="submit[]" value="<?php echo $productos['id']?>" id="<?php echo $productos['id']?>">
              <div class="heartBTNshow">
                <div class="bar-toggle<?php echo $productos['id']?>">
                  <i id="container1<?php echo $productos['id']?>" class="fa fa-lg fa-heart-o"></i>
                  <i id="container2<?php echo $productos['id']?>" class="fa fa-lg fa-heart"></i>
                </div>
              </div>
            </button>
          </form>
        </div>

        <div class="details">
            <h2 id="product-brand"><?php echo htmlspecialchars($productos['nombre']); ?></h2>
            <span id="product-price"></span>
            <span id="product-actual-price"></span>
            <span id="product-discount">(<?php echo ($productos['oferta']); ?>% off)</span>
    
            <p class="product-sub-heading">Gramaje:</p>
            
            <input class="size_radio_btn" type="button" name="size" value="50gr" id="50gr" <?php if($productos['stock50gr'] == 0) { ?> disabled="disabled"; <?php } ?>>
            <input class="size_radio_btn" type="button" name="size" value="100gr" id="100gr" <?php if($productos['stock100gr'] == 0) { ?> disabled="disabled"; <?php } ?>>
            <input class="size_radio_btn" type="button" name="size" value="150gr" id="150gr" <?php if($productos['stock150gr'] == 0) { ?> disabled="disabled"; <?php } ?>>
            <input class="size_radio_btn" type="button" name="size" value="200gr" id="200gr" <?php if($productos['stock200gr'] == 0) { ?> disabled="disabled"; <?php } ?>>
            <br>
            <input class="size_radio_btn" type="button" name="size" value="250gr" id="250gr" <?php if($productos['stock250gr'] == 0) { ?> disabled="disabled"; <?php } ?>>
            <input class="size_radio_btn" type="button" name="size" value="500gr" id="500gr" <?php if($productos['stock500gr'] == 0) { ?> disabled="disabled"; <?php } ?>>
            <input class="size_radio_btn" type="button" name="size" value="1 kilo" id="1kg" <?php if($productos['stock1kg'] == 0) { ?> disabled="disabled"; <?php } ?>>

            <div class="contCantidad">
            <p class="product-sub-heading2">Cantidad:</p>
            
            <select name="cantidad" id="cantidad" onchange="actualizarPrecio()">
            </select>

            <span id="stock-disponible"></span>
            </div>
            
            <div class="totales">
              <span id="total" class="product-sub-heading" style="font-weight: bold;"></span>
              <span id="totalabsoluto" class="product-sub-heading" style="font-weight: bold;"></span>
            </div>

            <div class="buttons">
              <form method="POST" action="ShoppingCart.php" target="dummyframe" id="formaCart<?php echo $producto['id']?>">
                <button class="btn cart-btn" type="submit" name="submitCart[]" value="<?php echo $producto['id']?>" id="<?php echo $producto['id']?>">Añadir al Carro <i class="fa fa-cart-plus"></i></button>
                <input type='hidden' name='product_id' value="<?php echo $producto['id']?>">
              </form>
              
              <button class="btn buy-btn">Comprar</button>
            </div>
        </div>
    </section>

    <section class="detail-des">
        <h2 class="heading">Instrucciones de uso</h2>
        <p class="des">Consulte a su medico antes de consumir. 
          Mantener fuera del alcance de los niños. Conservar en un lugar fresco y seco.
        <br>SupleLife™ y SupleSeeds™ no se hacen responsable de daños causados debido al uso inadecuado 
            de los mismos.
            Prohibida la reventa.</p>
    </section>
    <br>

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
    <script src="../JS/ProductChange.js"></script>

  
    <script>
function sssSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio50gr']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?>% off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock50gr']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio50gr']) - ($productos['precio50gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt

    var number = <?php echo ($productos['stock50gr']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
        $("select#cantidad").html(optionList);
    
    document.getElementById('50gr').classList.add('selected');
  }

  $(document).on('click', '#50gr', sssSizeFunc);


  function ssSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio100gr']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?>% off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock100gr']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio100gr']) - ($productos['precio100gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt

    var number = <?php echo ($productos['stock100gr']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
        $("select#cantidad").html(optionList);
    
    document.getElementById('100gr').classList.add('selected');
  }

  $(document).on('click', '#100gr', ssSizeFunc);


  function sSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio150gr']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?>% off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock150gr']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio150gr']) - ($productos['precio150gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt

    var number = <?php echo ($productos['stock150gr']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
        $("select#cantidad").html(optionList);
    
    document.getElementById('150gr').classList.add('selected');
  }

  $(document).on('click', '#150gr', sSizeFunc);


  function mSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio200gr']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?>% off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock200gr']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio200gr']) - ($productos['precio200gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt
    
    var number = <?php echo ($productos['stock200gr']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
       $("select#cantidad").html(optionList);
    
    document.getElementById('200gr').classList.add('selected');
  }

    $(document).on('click', '#200gr', mSizeFunc);

  function lSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio250gr']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?>% off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock250gr']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio250gr']) - ($productos['precio250gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt

    var number = <?php echo ($productos['stock250gr']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
       $("select#cantidad").html(optionList);

    document.getElementById('250gr').classList.add('selected');
  }

    $(document).on('click', '#250gr', lSizeFunc);

  function xlSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio500gr']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?> off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock500gr']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio500gr']) - ($productos['precio500gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt
    
    var number = <?php echo ($productos['stock500gr']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
       $("select#cantidad").html(optionList);

    document.getElementById('500gr').classList.add('selected');
  } 

    $(document).on('click', '#500gr', xlSizeFunc);

  function xxlSizeFunc(event){
    document.getElementById('product-actual-price').innerText = "$<?php echo ($productos['precio1kg']); ?>"
    document.getElementById('product-discount').innerText = "(<?php echo ($productos['oferta']); ?>% off)"
    document.getElementById('stock-disponible').innerText = "(<?php echo ($productos['stock1kg']); ?> en stock)"
    document.getElementById("total").style.display = '';
    document.getElementById("totalabsoluto").style.display = 'none';

    const total = <?php echo round(($productos['precio200gr']) - ($productos['precio200gr']) / ($productos['oferta']), 2);?>;
    if (total % 1 == 0){
      var totaltxt = total+".00"
    }
    else{
      var totaltxt = total
    };
    document.getElementById('product-price').innerText = "$"+totaltxt
    document.getElementById('total').innerText = "Total: $"+totaltxt

    var number = <?php echo ($productos['stock1kg']); ?>;
    var optionList = "";
        for (var x=1; x<=number; x++) {
          optionList += "<option>"+x+"</option>";
        }
       $("select#cantidad").html(optionList);
    
    document.getElementById('1kg').classList.add('selected');
  }

    $(document).on('click', '#1kg', xxlSizeFunc);

    $('input').on('click', function(){
      $('input').removeClass('selected');
      $(this).addClass('selected'); 
  });

  function actualizarPrecio() {
  var cantidad = $("#cantidad option:selected").text();
  var textoPrecio = document.getElementById("total").innerText;
  if (textoPrecio.indexOf('.') == 1){
    precioAct = textoPrecio+"00"
  }else{
    precioAct = textoPrecio
  }
  var numeroPrecio = precioAct.replace(/\D/g,'');
  var precio = Number(numeroPrecio)
  var precioDecimal = precio / 100;
  var valorTotal = (precioDecimal * cantidad).toFixed(2);
  document.getElementById("total").style.display= 'none';
  document.getElementById("totalabsoluto").style.display= '';
  document.getElementById("totalabsoluto").innerHTML = "Total: $"+valorTotal; 
}












function favFuncCart(event){
        $.post("/index.php", $("#formaCart<?php echo $productos['id']?>").serialize(), function(data){
            $(document).ready(() => {
                const button = $('#<?php echo $productos['id']?>');
                button.click(() => {
                    
                    sessionStorage.setItem('nombre','<?php echo htmlspecialchars($productos['nombre']); ?>')
    
                });       
            });
        });
  }

  $(document).on('click', '#formaCart<?php echo $productos['id']?>', favFuncCart);













    $('#container1<?php echo $productos['id']?>').toggleClass(localStorage.toggled<?php echo $productos['id']?>);


    $(window).bind("load", function() {
        // code goes here
        if (localStorage.toggled<?php echo $productos['id']?> == "" ) {
            $('#container2<?php echo $productos['id']?>').toggleClass("with_toggle", true);
        } else {
        $('#container1<?php echo $productos['id']?>').toggleClass("with_toggle", true );
        }

    });

        /* Toggle */
        $('.bar-toggle<?php echo $productos['id']?>').on('click',function(){    

    
    //localstorage values are always strings (no booleans)  

    if (localStorage.toggled<?php echo $productos['id']?> == "" ) {
    $('#container1<?php echo $productos['id']?>').toggleClass("with_toggle", true );
    $('#container2<?php echo $productos['id']?>').toggleClass("with_toggle", false);
    localStorage.toggled<?php echo $productos['id']?> = "with_toggle";
    } else {
    $('#container1<?php echo $productos['id']?>').toggleClass("with_toggle", false );
    $('#container2<?php echo $productos['id']?>').toggleClass("with_toggle", true);
    localStorage.toggled<?php echo $productos['id']?> = "";
    }
    });
    </script>

</body>
    

</html>