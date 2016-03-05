<?php
	session_start();
	include "connectionfactory.php";

  if (! isset($_SESSION["funcao"])){
    header("Location: login.htm");  
    die();
  }

  if ($_SESSION['funcao'] == 3){ //Se fro Cozinherio 
    header("Location: login.htm");  
    die();
  }
?>

<html>
<head>
	<script>
		function irpara(pagina){
			location.href=pagina;
   	}
	</script>  

	<style type="text/css">

h1{
    background:#E77116;
    padding:20px 0;
    font-size:180%;
    text-align:center;
    color:#FFF;
}
label{
  color:#FFF;
}



footer {
   position:absolute;
   bottom:0;
   width:100%;


}

body {
	margin:0;
	padding:0;
	background:#4B311D;
	text-align:center; 
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	
  <form id="form1" name="form1" method="post" action="">
<table width="" border="0" align="center">
    <tr>
      <td height="50" colspan="8" align="center" valign="middle"> <label for="Descrição"> Descrição:</label> <input type="text" name="buscar" id="buscar" />  <input type="submit" name="buscarbotao" id="buscarbotao" value="buscar" />        <label for="buscar"></label></td>
    </tr>
    <tr>
      <h1> Lista de Pedidos</h1>    <input name="" type="button" onClick="irpara('menu.php')" value="Voltar">  <input name="" type="button" onClick="irpara('login.htm')" value="Sair"> 

    </tr>
    <tr>
      <td width="52" align="center" valign="middle" bgcolor="#eee">Código</td>
      <td width="350" align="center" valign="middle" bgcolor="#eee">Descrição</td>
      <td width="200" align="center" valign="middle" bgcolor="#eee">Grupo</td>
      <td width="30" align="center" valign="middle" bgcolor="#eee">Valor</td>
	  <td width="80" align="center" valign="middle" bgcolor="#eee">Mesa</td>
      <td width="30" align="center" valign="middle" bgcolor="#eee"></td>
    </tr>
    <?php 
     $pedido = 'F';
    $consulta = mysql_query("SELECT * FROM PRATO WHERE B_ATIVO = 'T' ");
	if (isset ($_POST['buscar'])){
    $consulta = mysql_query("SELECT * FROM PRATO where B_ATIVO = 'T' AND V_DESCRICAO like'%".$_POST['buscar']."%'");
	}

  if (isset ($_POST['inserirPedido'])){
	if ($_POST['mesa'] <> "" ){
		mysql_query("INSERT INTO PEDIDO (N_CODIGO, N_COD_PRATO, V_STATUS,V_MESA) VALUES (NULL, '".$_POST['inserirPedido']."', 'PEN','".$_POST['mesa']."') ");		
    echo "<script>alert('Enviado com sucesso!');</script>";
   }
  }

	while ($linha=mysql_fetch_array($consulta)){
	$codigo= $linha['N_CODIGO'];
	$descricao= $linha['V_DESCRICAO'];
	$grupo= $linha['V_GRUPO'];
	$valor= $linha['F_VALOR'];

	
	?>
    <form id="form2" name="form2" method="post" action="">
    <tr>
      <td align="center" valign="middle" bgcolor="#eee"><?php echo str_pad($codigo, 2, "0", STR_PAD_LEFT); ?></td>
      <td align="center" valign="middle" bgcolor="#eee"><?php echo $descricao;?></td>
      <td align="center" valign="middle" bgcolor="#eee"><?php echo $grupo;?></td>
      <td align="center" valign="middle" bgcolor="#eee"><?php echo number_format($valor, 2, ',', '.');?></td>
	  <td align="center" valign="middle" bgcolor="#eee"><input type="text" name="mesa" id="mesa" size = 10/></td>
      <td align="center" valign="middle" bgcolor="#eee"><input type="submit" value="Enviar p/Cozinha" /></td>
      <input type='hidden' name="inserirPedido" id="inserirPedido" value="<?php echo $codigo;?>" >
     </form> 
     <?php } ?>
  </table>

   </tr> 

</form>
</body>
</html>
<footer>
<?php
	//echo "<br>";
	//echo "<br>";
	//echo "Usuário: ";
	//echo $_SESSION["login"];
	//echo "<br>";
	//echo " Data: ";
	//echo date("d/m/y"); 
	//echo " Hora: ";
	//echo date("H:i", mktime(gmdate("H")-3, gmdate("i"), gmdate("s")));
?>
</footer>

