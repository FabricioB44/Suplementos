<?php
include('../config/db_connect.php');

//$sql = "SELECT * FROM productos WHERE id IN (".implode(',', $sortedArray).")";

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
    <link rel="stylesheet" href="../CSS/CheckoutStyle.css">
    <link rel="stylesheet" href="../CSS/Style.css">
    <link rel="stylesheet" href="../CSS/NavbarStyle.css">
    <title>Checkout</title>
</head>

<body>

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

    <p class="path">
        <a href="../index.php">Home</a> 
        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
        <a href="ShoppingCart.php">Carrito</a>
        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
        <a href="#0">Checkout</a>
    </p>

    <div class="steps">
        <div class="individualSteps">
        <input class="size_radio_btn" type="button" name="restar" value="1" id="primerpaso">
        Retiro/Envío
        </div>
        <div class="individualSteps">
        <input class="size_radio_btn" type="button" name="restar" value="2" id="segundopaso">
        Detalles de Facturacion
        </div>
        <div class="individualSteps">
        <input class="size_radio_btn" type="button" name="restar" value="3" id="tercerpaso">
        Metodo de Pago
        </div>
    </div>



    <div class="sections">
        <div class="checkout-step checkout-step-1">
        <div class="checkout-card">
                <div>
                    <label class="container">Envío a domicilio a CABA
                    <input id="flip1" type="radio" name="radio" onclick="enableButton(); disablePagoEnSucursal()">
                    <span class="checkmark"></span>
                </div>
                <div id="panel1" style="display: none;">

                    <div class="separator">
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Calle/Avenida" name="Calle/Avenida" placeholder="Calle/Avenida">
                            </div>
                        </div>
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Número" name="Número" placeholder="Número">
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Piso/Departamento" name="Piso/Departamento" placeholder="Piso/Departamento (opcional)">
                            </div>
                        </div>
                    </div>
                    <div class="search_categories_TestArea">
                        <div>
                        <textarea class="hola" id="w3review" name="w3review" rows="4" cols="50" placeholder="Indicaciones adicionales de entrega (opcional)"></textarea>
                        </div>
                    </div>

                    <p class="tiempoDeEntrega">Tiempo de entrega: Para pedidos realizados antes de las 12hs, mismo día habil. <br>  Para pedidos realizados después de las 12hs, el siguiente día habil. <br> Días habiles: Lunes a Viernes. Las entregas se realizan de 14 a 21hs.</p>
                </div>
            </div>
            <div class="checkout-card">
                <div>
                    <label class="container">Envío a domicilio al resto del país
                    <input id="flip2" type="radio" name="radio" onclick="enableButton(); disablePagoEnSucursal()">
                    <span class="checkmark"></span>
                </div>
                <div id="panel2" style="display: none;">
                
                    <div class="separator">
                        <div class="search_categories">
                            <div class="select">
                                <select name="search_categories" id="search_categories" required>
                                    <option value="" selected disabled>Provincia</option>
                                    <option value="Buenos Aires">Buenos Aires</option>
                                    <option value="Catamarca">Catamarca</option>
                                    <option value="Chaco">Chaco</option>
                                    <option value="Chubut">Chubut</option>
                                    <option value="Córdoba">Córdoba</option>
                                    <option value="Corrientes">Corrientes</option>
                                    <option value="Entre Ríos">Entre Ríos</option>
                                    <option value="Formosa">Formosa</option>
                                    <option value="Jujuy">Jujuy</option>
                                    <option value="La Pampa">La Pampa</option>
                                    <option value="La Rioja">La Rioja</option>
                                    <option value="Mendoza">Mendoza</option>
                                    <option value="Misiones">Misiones</option>
                                    <option value="Neuquén">Neuquén</option>
                                    <option value="Río Negro">Río Negro</option>
                                    <option value="Salta">Salta</option>
                                    <option value="San Juan">San Juan</option>
                                    <option value="San Luis">San Luis</option>
                                    <option value="Santa Cruz">Santa Cruz</option>
                                    <option value="Santa Fe">Santa Fe</option>
                                    <option value="Santiago del Estero">Santiago del Estero</option>
                                    <option value="Tierra del Fuego">Tierra del Fuego</option>
                                    <option value="Tucumán">Tucumán</option>
                                </select>
                            </div>
                        </div>
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Ciudad/Localidad" name="Ciudad/Localidad" placeholder="Ciudad/Localidad">
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Calle/Avenida" name="Calle/Avenida" placeholder="Calle/Avenida">
                            </div>
                        </div>
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Número" name="Número" placeholder="Número">
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="CódigoPostal" name="CódigoPostal" placeholder="Código postal">
                            </div>
                        </div>
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Piso/Departamento" name="Piso/Departamento" placeholder="Piso/Departamento (opcional)">
                            </div>
                        </div>
                    </div>
                    <div class="search_categories_TestArea">
                        <div>
                        <textarea class="hola" id="w3review" name="w3review" rows="4" cols="50" placeholder="Indicaciones adicionales de entrega (opcional)"></textarea>
                        </div>
                    </div>

                    <p class="tiempoDeEntrega">Tiempo de entrega: Entre 3 y 6 días hábiles. <br> Días habiles: Lunes a Viernes. <br> Finalizada la compra recibirá un código para el seguimiento del envio.</p>
                </div>
            </div>
            <div class="checkout-card">
                <div>
                    <label class="container">Retiro en Sucursal
                    <input id="flip3" type="radio" name="radio" onclick="enableButton(); enablePagoEnSucursal()">
                    <span class="checkmark"></span>
                </div>
                <div id="panel3" style="display: none;">El retiro estara habilitado de 9 a 12hs y de 14:30 a 17hs en el barrio de Parque Chacabuco, finalizada la compra se coordinará para el retiro del producto.
                </div>
            </div>
        </div>





        <div class="checkout-step checkout-step-2" style="display: none;">
            <div class="checkout-card">
                    <div class="separator">
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Nombre" name="Nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Apellido" name="Apellido" placeholder="Apellido">
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="dni" name="dni" placeholder="DNI">
                            </div>
                        </div>
                        <div class="search_categories">
                            <div>
                                <input class="hola" type="text" id="Telefono" name="Telefono" placeholder="Numero de Telefono">
                            </div>
                        </div>
                    </div>
                    <div class="search_categories_TestArea">
                        <div>
                            <input class="hola" type="text" id="Email" name="Email" placeholder="E-mail">
                        </div>
                    </div>
            </div>
        </div>






        <div class="checkout-step checkout-step-3" style="display: none;">
            <div class="checkout-card">
                <div>
                    <label class="container">Transferencia bancaria directa
                    <input id="flip4" type="radio" name="radio2">
                    <span class="checkmark"></span>
                </div>
                <div id="panel4" style="display: none;">En el paso siguiente verás los datos de nuestra cuenta bancaria.
                <br> Realiza el deposito o transferencia y luego envíanos el comprobante a nuestro WhatsApp 11 4426-4525</div>
                </div>

                <div class="checkout-card">
                <div>
                    <label class="container">Pago con tarjetas de débito y crédito
                    <input id="flip5" type="radio" name="radio2">
                    <span class="checkmark"></span>
                </div>
            
                <div id="panel5" style="display: none;">Una vez realizado el pedido recibirás un link de Mercado Pago en tu celular.</div>
                </div>

                <div class="checkout-card" id="pagoEnSucursal">
                <div>
                    <label class="container">Pago en efectivo al retirar
                    <input id="flip6" type="radio" name="radio2">
                    <span class="checkmark"></span>
                </div>
                <div id="panel6" style="display: none;">Si seleccionaste retirar en sucursal podrás realizar la transacción en efectivo al retirar el producto.</div>
                </div>
            </div>
        </div>

        
        
        <section>
            <div class="totalContainer">
                <div class="subtotalInfo">
                <p style="float: left;">Subtotal:</p><p style="float: right;">$3000</p>
                </div>
                <br>
                <div class="subtotalInfo">
                <p style="float: left;">Envío:</p><p style="float: right;">$200</p>
                </div>
                <br>
                <div class="totalInfo" >
                <p style="float: left;">Total:</p><p style="float: right;">$2800</p>
                </div>
                <button id="btn1" class="btn continuar-btn button-next-step checkout-step checkout-step-1" disabled>Continuar</button>
                <button id="btn2" class="btn continuar-btn button-next-step checkout-step checkout-step-2" style="display: none;">Continuar</button>
                <a id="btn3link"><button id="btn3" class="btn continuar-btn button-next-step checkout-step checkout-step-3" style="display: none;">Finalizar Pedido</button></a>
                <a href="ShoppingCart.php"><button id="btn4" class="btn volver-btn button-prev-step checkout-step checkout-step-1">Volver al Carrito</button></a>
                <button id="btn5" class="btn volver-btn button-prev-step checkout-step checkout-step-2" style="display: none;">Volver</button>
                <button id="btn6" class="btn volver-btn button-prev-step checkout-step checkout-step-3" style="display: none;">Volver</button>
            </div>
        </section>
    </div>
</div>


    <div class="pieDePaginaFondo">
        <footer class="pieDePagina">
          <div class="redes">
            <h5 class="darken"><a href="#"><i style="color: rgb(37, 211, 102);" class="fa fa-whatsapp"></i> 11 4426-4525</h5></a>
          </div>
    
          <div class="recruitment">
            <h5 class="darken"><a href="#"><i style="color: rgb(219, 68, 55);" class="fa fa-envelope"></i> Suplelifeargentina@gmail.com </h5></a>
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












<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 



$(document).ready(function(){
  $("#flip1").click(function(){
    $("#panel1").slideDown("slow");
    $("#panel2").slideUp("slow");
    $("#panel3").slideUp("slow");
  });
});

$(document).ready(function(){
  $("#flip2").click(function(){
    $("#panel2").slideDown("slow");
    $("#panel1").slideUp("slow");
    $("#panel3").slideUp("slow");
  });
});

$(document).ready(function(){
  $("#flip3").click(function(){
    $("#panel3").slideDown("slow");
    $("#panel1").slideUp("slow");
    $("#panel2").slideUp("slow");
  });
});

$(document).ready(function(){
  $("#flip4").click(function(){
    $("#panel4").slideDown("slow");
    $("#panel5").slideUp("slow");
    $("#panel6").slideUp("slow");
    var link = document.getElementById("btn3link");
        link.setAttribute("href", "TransferenciaBancaria.php");
  });
});

$(document).ready(function(){
  $("#flip5").click(function(){
    $("#panel5").slideDown("slow");
    $("#panel4").slideUp("slow");
    $("#panel6").slideUp("slow");
    var link = document.getElementById("btn3link");
        link.setAttribute("href", "PagoConTarjetas.php");
  });
});

$(document).ready(function(){
  $("#flip6").click(function(){
    $("#panel6").slideDown("slow");
    $("#panel4").slideUp("slow");
    $("#panel5").slideUp("slow");
    var link = document.getElementById("btn3link");
        link.setAttribute("href", "EfectivoAlRetirar.php");
  });
});




function enableButton(){
    document.getElementById("btn1").disabled = false;
};



function enablePagoEnSucursal(){
    document.getElementById("pagoEnSucursal").style.display = 'block';
};

function disablePagoEnSucursal(){
    document.getElementById("pagoEnSucursal").style.display = 'none';
};



var checkoutSteps = 3;
var currentStep = 1;

$('.button-next-step').click(function() {
    if(currentStep < checkoutSteps){
    $(".checkout-step-"+currentStep+"").hide();
    currentStep++;
    $(".checkout-step-"+currentStep+"").show();
    }
});
$('.button-prev-step').click(function() {
    if(currentStep > 1){
    $(".checkout-step-"+currentStep+"").hide();
    currentStep--;
    $(".checkout-step-"+currentStep+"").show();
    }
});


function codeAddress() {
    document.getElementById('primerpaso').style.backgroundColor = '#0ecfbc';
    document.getElementById('primerpaso').style.color = 'white';
        }
        window.onload = codeAddress;


document.getElementById('btn1').addEventListener('click', function onClick() {
    document.getElementById('primerpaso').style.backgroundColor = 'white';
    document.getElementById('primerpaso').style.color = 'black';
    document.getElementById('segundopaso').style.backgroundColor = '#0ecfbc';
    document.getElementById('segundopaso').style.color = 'white';
});

document.getElementById('btn2').addEventListener('click', function onClick() {
    document.getElementById('segundopaso').style.backgroundColor = 'white';
    document.getElementById('segundopaso').style.color = 'black';
    document.getElementById('tercerpaso').style.backgroundColor = '#0ecfbc';
    document.getElementById('tercerpaso').style.color = 'white';
});

document.getElementById('btn6').addEventListener('click', function onClick() {
    document.getElementById('tercerpaso').style.backgroundColor = 'white';
    document.getElementById('tercerpaso').style.color = 'black';
    document.getElementById('segundopaso').style.backgroundColor = '#0ecfbc';
    document.getElementById('segundopaso').style.color = 'white';
});

document.getElementById('btn5').addEventListener('click', function onClick() {
    document.getElementById('segundopaso').style.backgroundColor = 'white';
    document.getElementById('segundopaso').style.color = 'black';
    document.getElementById('primerpaso').style.backgroundColor = '#0ecfbc';
    document.getElementById('primerpaso').style.color = 'white';
});

</script>










</body>
</html>