<?php 
$conn = mysqli_connect('localhost', 'root', 'Superbrowin08', 'suplementos');
if(!$conn){
  echo 'Connection error: ' . mysqli_connect_error();
}
?>