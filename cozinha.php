<?php
	session_start();
	require_once "connectionfactory.php";    

	if (! isset($_SESSION["funcao"])){
		header("Location: login.htm");	
		die();
	}

	if ($_SESSION['funcao'] == 2){ //Garçom
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

footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:80px;  

}

body {
	margin:0;
	padding:0;
	background:#4B311D;
	text-align:center; 
	}</style>

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1>Cozinha </h1>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<form id="form1" name="form1" method="post" action="">
		<input name="" type="button" onClick="irpara('menu.php')" value="Voltar">  <input name="" type="button" onClick="irpara('login.htm')" value="Sair"> 
<table width="" border="0" align="center">
    <tr>
      <td height="10" colspan="8" align="center" valign="middle"> </td>
    </tr>
    <tr>

    </tr>
    <tr>
      <td width="30" align="center" valign="middle" bgcolor="#FFF">Código</td>
      <td width="30" align="center" valign="middle" bgcolor="#FFF">Cód.Prato</td>
      <td width="350" align="center" valign="middle" bgcolor="#FFF">Descrição</td>
	  <td width="100" align="center" valign="middle" bgcolor="#FFF">Mesa</td>
      <td width="90" align="center" valign="middle" bgcolor="#FFF">Status</td>
      <td width="80" align="center" valign="middle" bgcolor="#FFF"></td>
    </tr>
    <tr></tr>
    <?php 
    
    
	if (isset ($_POST['altStatus'])){
		mysql_query("UPDATE PEDIDO SET V_STATUS = 'OK' WHERE N_CODIGO =".$_POST['altStatus']);
	}

	$consulta = mysql_query("SELECT PEDIDO.N_CODIGO,PEDIDO.N_COD_PRATO,PEDIDO.V_MESA,PEDIDO.V_STATUS,PRATO.V_DESCRICAO FROM PEDIDO,PRATO WHERE PEDIDO.N_COD_PRATO = PRATO.N_CODIGO AND V_STATUS = 'PEN' ORDER BY PEDIDO.N_CODIGO");


	while ($linha=mysql_fetch_array($consulta)){
		$codigo   = $linha['N_CODIGO'];
		$codPrato = $linha['N_COD_PRATO'];
		$status   = $linha['V_STATUS'];
		$mesa     = $linha['V_MESA'];
		$descricao= $linha['V_DESCRICAO'];

		if ($status == 'PEN') {
			$calcStatus = 'Pendente';
		} else {
			$calcStatus = 'Finalizado';
		}
		
	

	
	?>
	<form id="form1" name="form1" method="post" action="">
    <tr>
      <td align="center" valign="middle" bgcolor="#FFF"><?php echo str_pad($codigo, 2, "0", STR_PAD_LEFT); ?></td>
      <td align="center" valign="middle" bgcolor="#FFF"><?php echo str_pad($codPrato, 2, "0", STR_PAD_LEFT); ?></td>
      <td align="center" valign="middle" bgcolor="#FFF"><?php echo $descricao;?></td>
	  <td align="center" valign="middle" bgcolor="#FFF"><?php echo $mesa;?></td>
      <td align="center" valign="middle" bgcolor="#FFF"><?php echo $calcStatus;?></td>
      <td align="center" valign="middle" bgcolor="#FFF"><input type="submit" name="Pronto" id="Pronto" value="Pronto" /></td> 
      <input type='hidden' name="altStatus" id="altStatus" value="<?php echo $codigo;?>" >
 	</form>

     <?php } ?>
  </table>

   </tr> 
</body>

</html>
<footer>
<?php
	echo "<meta HTTP-EQUIV='refresh' CONTENT='10';URL='caixa.php'>";
?>
</footer>