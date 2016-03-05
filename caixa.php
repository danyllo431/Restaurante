<?php
	session_start();
	include "connectionfactory.php";

	if (! isset($_SESSION["funcao"])){
		header("Location: login.htm");	
		die();
	}

	if ($_SESSION['funcao'] <> 1){ //Adm
		header("Location: login.htm");	
		die();
	}

	function faturamento(){    
    		$consulta_2 = mysql_query("SELECT SUM(PRATO.F_VALOR) AS VALOR_TOTAL FROM PEDIDO,PRATO WHERE PEDIDO.B_PAGO = 'T' AND PEDIDO.N_COD_PRATO = PRATO.N_CODIGO ");
			$linha = mysql_fetch_array($consulta_2);
    		$valorTotal = $linha['VALOR_TOTAL']; 
    		return number_format($valorTotal, 2, ',', '.');
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


}

body {
	margin:0;
	padding:0;
	background:#4B311D;
	text-align:center; 
	}
label{
  color:#FFF;

}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	
  <form id="form1" name="form1" method="post" action="">
<table width="" border="0" align="center">
    <tr>
    </tr> 
    <tr>
      <h1> Caixa</h1>    <input name="" type="button" onClick="irpara('menu.php')" value="Voltar">  <input name="" type="button" onClick="irpara('login.htm')" value="Sair"> 
	<p></p><p></p><p></p>
	<label> Faturamento:  <?php echo faturamento();	?> 
	</label>
    </tr>
    <tr>
      <td width="100" align="center" valign="middle" bgcolor="#eee">Mesa</td>
      <td width="100" align="center" valign="middle" bgcolor="#eee">Quant. Pedidos</td>
	  <td width="50" align="center" valign="middle" bgcolor="#eee">Valor</td>
      <td width="30" align="center" valign="middle" bgcolor="#eee"></td>
    </tr>
    <?php 
    
    if (isset ($_POST['Pago'])){
		mysql_query("UPDATE PEDIDO SET B_PAGO = 'T' WHERE PEDIDO.V_STATUS = 'OK' AND  V_MESA ='".$_POST['mesa']."'");	
	}

	$consulta   = mysql_query("SELECT PEDIDO.V_MESA, SUM(PRATO.F_VALOR) AS VALOR, count(PEDIDO.N_CODIGO) AS QUANT_PEDIDO FROM PEDIDO,PRATO WHERE PEDIDO.B_PAGO = 'F' AND PEDIDO.V_STATUS = 'OK' AND PEDIDO.N_COD_PRATO = PRATO.N_CODIGO  GROUP BY V_MESA");
	
	while ($linha=mysql_fetch_array($consulta)){
	$mesa= $linha['V_MESA'];
	$valor= $linha['VALOR'];
	$quantPedidos= $linha['QUANT_PEDIDO'];
	
	
	?>
    <form id="form2" name="form2" method="post" action="">
    <tr>
      <td align="center" valign="middle" bgcolor="#eee"><?php echo $mesa ?></td>
      <td align="center" valign="middle" bgcolor="#eee"><?php echo $quantPedidos ?></td>
	  <td align="center" valign="middle" bgcolor="#eee"><?php echo number_format($valor, 2, ',', '.');?></td>

    
      <td align="center" valign="middle" bgcolor="#eee"><input type="submit" name="Pago" id="Pago" value="Pago" /></td> 
      <input type='hidden' name="mesa" id="mesa" value="<?php echo $mesa?>" >
     </form> 
     <?php } ?>
  </table>

   </tr> 

</form>
</body>
</html>
<footer>
<?php
	echo "<meta HTTP-EQUIV='refresh' CONTENT='10';URL='caixa.php'>";
?>
</footer>

