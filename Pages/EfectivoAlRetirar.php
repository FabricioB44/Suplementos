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
    <link rel="stylesheet" href="../CSS/TransferenciaBancariaStyle.css">
    <title>Pedido Realizado</title>
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
                <li><a href="Wishlist.php"><button type="submit"><i class="fa fa-heart"></i></button></a></li>
            </ul>
        </nav>
    </header>

<div class="content">
    <p class="path"><a href="../index.php">Home</a> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="#0">Pedido Registrado<a></p>

    <section class="bank-nothing">
        <div class="bank-card" style="height: 340px;">
            <p id="nothingInbank">Pedido Registrado</p>
            <p id="nothingInbank2">Su pedido está listo para ser retirado en Av. Jose Maria Moreno 1781 de 9 a 12hs y 14:30 a 17hs <br> Para retirar será necesario coordinar el día y hora a través de nuestro WhatsApp 11 4426-4525 <br> En caso de no presentarse por más de una semana su pedido será automáticamente cancelado <br> Total a pagar: $5000.99 </p>
            <p id="nothingInbank3">Ante cualquier duda o inconveniente puede ponerse en contacto vía 11 4426-4525 o Suplelifeargentina@gmail.com </p>
        </div>
    </section>

</div>

    <div class="pieDePaginaFondo">
        <footer class="pieDePagina" id="marginLeft">
          <div class="redes">
            <h5 class="darken"><a href="#"><i style="color: rgb(37, 211, 102);" class="fa fa-whatsapp"></i> 11 4426-4525</h5></a>
          </div>
    
          <div class="recruitment">
            <h5 class="darken"><a href="#"><i style="color: rgb(219, 68, 55);" class="fa fa-envelope"></i> Suplelifeargentina@gmail.com</h5></a>
          </div>
    
          <div class="advertisement">
            <h5 class="pieDePaginaTitulo">SupleLife® - SupleSeeds®</h5>
          </div>
          <p style="font-size: 12; margin-left: 250px;">SupleLife® y SupleSeeds® son marcas registradas y únicamente pueden ser comercializadas y distribuidas a través de la web oficial www.Suplelife.com.ar y del punto de retiro ubicado en el barrio Parque Chacabuco. Así como tampoco pueden ser vendidos ni distribuidos por ninguna otra plataforma de ventas online que no sea la correspondiente a la cuenta oficial de Mercado Libre Suplelifesuplementosdietarios. SupleLife® y SupleSeeds® no poseen sucursales fuera del punto de retiro Capital Federal. SupleLife® y SupleSeeds® no se responsabilizan por réplicas y duplicados de nuestros productos.</p>
        </footer>
    </div>

    <a href="https://api.whatsapp.com/send?phone=541144264525" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

</body>
</html>