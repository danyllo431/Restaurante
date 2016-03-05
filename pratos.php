<?php
	session_start();
	include "connectionfactory.php";

  if (! isset($_SESSION["funcao"])){
    header("Location: login.htm");  
    die();
  }

  if ($_SESSION['funcao'] <> 1){ 
    header("Location: login.htm");  
    die();
  }

  $countPedido =0;
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
  <form id="form1" name="form1" method="post" action="">
<table width="" border="0" align="center">
    <tr>
      <td height="50" colspan="8" align="center" valign="middle"> <label for="Descrição"> Descrição:</label> <input type="text" name="buscar" id="buscar" />  <input type="submit" name="buscarbotao" id="buscarbotao" value="buscar" />        <label for="buscar"></label></td>
    </tr>
    <tr>
      <h1> Pratos </h1>    <input name="" type="button" onClick="irpara('menu.php')" value="Voltar">  <input name="" type="button" onClick="irpara('login.htm')" value="Sair"> 

    </tr>
    <tr>
      <td width="52" align="center" valign="middle" bgcolor="#FFF">Código</td>
      <td width="400" align="center" valign="middle" bgcolor="#FFF">Descrição</td>
      <td width="200" align="center" valign="middle" bgcolor="#FFF">Grupo</td>
      <td width="30" align="center" valign="middle" bgcolor="#FFF">Valor</td>
      <td width="30" align="center" valign="middle" bgcolor="#FFF"></td>
      <td width="30" align="center" valign="middle" bgcolor="#FFF"></td>
      <td width="30" align="center" valign="middle" bgcolor="#FFF"></td>
    </tr>
    <?php 

    if (isset ($_POST['alterar'])){
      $_SESSION['codPratoAlt'] = $_POST['codigo'];
      header("Location: altPrato.php");      
      die();
    }

    if (isset ($_POST['excluir'])){
      mysql_query("DELETE FROM PRATO WHERE N_CODIGO =".$_POST['codigo']."");
      echo "<script>alert('Prato excluído com sucesso!');</script>";
    }

    if (isset ($_POST['inativar'])){

      if ($_POST['status'] == "T") {
        $status = "F";
      } else {
        $status = "T";
      }
      
      mysql_query("UPDATE PRATO SET B_ATIVO = '".$status."' WHERE N_CODIGO =".$_POST['codigo']."");
    }

    $consulta = mysql_query("SELECT * FROM PRATO");

    if (isset ($_POST['buscar'])){
      $consulta = mysql_query("SELECT * FROM PRATO where V_DESCRICAO like'%".$_POST['buscar']."%'");
	  }

	  while ($linha=mysql_fetch_array($consulta)){
	    $codigo   = $linha['N_CODIGO'];
	    $descricao= $linha['V_DESCRICAO'];
	    $grupo    = $linha['V_GRUPO'];
	    $valor    = $linha['F_VALOR'];
        $status   = $linha['B_ATIVO'];

      if ($status == "T") {
        $cor = "#FFF";
        $descStatus = "Inativar";
      } else {
        $cor = "#CD4F39";
        $descStatus = "Ativar";
      }
      
	?>
    <form id="form2" name="form2" method="post" action="">
    <tr>
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo str_pad($codigo, 2, "0", STR_PAD_LEFT); ?></td>
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $descricao;?></td>
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo $grupo;?></td>
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><?php echo number_format($valor, 2, ',', '.');?></td>
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><input type="submit" name="inativar" id="inativar" value="<?php echo $descStatus ?>" /></td> 
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><input type="submit" name="alterar"  id="alterar"   value="Alterar" /></td> 
      <td align="center" valign="middle" bgcolor="<?php echo $cor ?>"><input type="submit" name="excluir"  id="excluir"   value="Excluir" /></td> 
      <input type='hidden' name="codigo" id="codigo" value="<?php echo $codigo;?>" >
      <input type='hidden' name="status" id="status" value="<?php echo $status;?>" >
     </form> 
     <?php } ?>
  </table>

   </tr> 
</form>
</body>
</html>
<footer>

</footer>

