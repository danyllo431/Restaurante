<?PHP
  session_start();
  require_once "connectionfactory.php";    

  if (! isset($_SESSION["codPratoAlt"])){
    header("Location: login.htm");  
    die();
  }

  if (! isset($_SESSION["funcao"])){
    header("Location: login.htm");  
    die();
  }

  if ($_SESSION['funcao'] <> 1){ //Adm
    header("Location: login.htm");  
    die();
  }

  $codigo = $descricao = $grupo = $valor = "";

  $codigo   = $_SESSION["codPratoAlt"];
  $consulta = mysql_query("SELECT * FROM PRATO WHERE N_CODIGO =".$codigo."");


  $linha=mysql_fetch_array($consulta);

  $codigo   = $linha['N_CODIGO'];
  $descricao= $linha['V_DESCRICAO'];
  $grupo    = $linha['V_GRUPO'];
  $valor    = $linha['F_VALOR'];

  if (isset ($_POST['cancelar'])){
    header("Location: pratos.php");      
    die();
  }
        
  if (isset ($_POST['altPrato'])){

    $descricao = $_POST['descricao'];
    $grupo     = $_POST['grupo'];
    $valor     = $_POST['valor'];

    if ($descricao == ""){
      echo "<script>alert('Preencha o campo Descrição');</script>";
    }else if ($grupo == ""){
      echo "<script>alert('Preencha o campo Grupo');</script>";
    }else if ($valor  == ""){
     echo "<script>alert('Preencha o campo Valor');</script>";
    }else if (! ctype_digit($valor)){
      $valor = ""; 
      echo "<script>alert('Campo Valor Inválido');</script>";
    }else if (ctype_digit($descricao)){
      $descricao = ""; 
      echo "<script>alert('Campo Descrição Inválido');</script>";
    }else{
      mysql_query("UPDATE PRATO SET V_DESCRICAO = '".$descricao."' , V_GRUPO ='".$grupo."' , F_VALOR ='".$valor."' WHERE N_CODIGO =".$codigo."");
      echo "<script>alert('Prato alterado com sucesso!');</script>";
      header("Location: pratos.php");      
      die();
    } 
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
  }
label{
  color:#FFF;

}
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<form action="" method="POST">
<table border="0" align="center"  >
	<h1>Prato</h1>
  <tr>
    <td><label> Código:</label></td>
	  <td><input type="text" name="codigo" id="codigo" value= '<?php echo $codigo;?>' disabled /></td>
  </tr>
  <tr>
    <td><label> Descrição:</label> </td>
    <td><input type="text" name="descricao" id="descricao" value= '<?php echo $descricao;?>'/></td>
  </tr>
  <tr>
  <tr>
    <td><label> Grupo:</label> </td>
    <td><input type="text" name="grupo" id="grupo" value= '<?php echo $grupo;?>'/>  </td>
  </tr>
  <tr>
  <tr>
    <td><label> Valor:</label> </td>
    <td><input type="text" name="valor" id="valor" value= '<?php echo $valor;?>' /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>

	  <td><input type="submit" name="cancelar" id="cancelar" value="Cancelar"/> <input type="submit" name="altPrato" id="altPrato" value="Salvar"/></td>
  </tr>
</table>
</form>
 
</body>
</html>


