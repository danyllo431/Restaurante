<?PHP
  session_start();
  require_once "connectionfactory.php";    

  if (! isset($_SESSION["funcao"])){
    header("Location: login.htm");  
    die();
  }

  if ($_SESSION['funcao'] <> 1){ //Adm
    header("Location: login.htm");  
    die();
  }

  $descricao = $grupo = $valor = "";

  function ultimoCodigo(){    
    $sql = "SHOW TABLE STATUS LIKE 'PRATO'"; 
    $resultado = mysql_query($sql);
    $linha = mysql_fetch_array($resultado);
    $codigo = $linha['Auto_increment']; 
    return $codigo;
  }

  if (isset ($_POST['cancelar'])){
    header("Location: menu.php");      
    die();
  }

  if (isset ($_POST['insertPrato'])){

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
      mysql_query("INSERT INTO PRATO (V_DESCRICAO,V_GRUPO,F_VALOR) VALUES ('".$descricao."','".$grupo."','".$valor."')");
      echo "<script>alert('Prato cadastrado com sucesso!');</script>";
      $descricao = $grupo = $valor = "";
      ultimoCodigo();
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
label{
  color:#FFF;
}

footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:80px;  

}


input[type="text"]{  
     width: 170px;  
     height: 25px;  
     margin:0;
   
   
   
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



<form action="" method="POST">
<table border="0" align="center"  >

	<h1>Prato</h1>
  <tr height="10" colspan="8" align="center" valign="middle">
    </tr>
  <tr>
    <td><label> Código:</label> </td>
	  <td><input type="text" name="codigo" id="codigo" value= '<?php echo ultimoCodigo();?>' disabled /></td>
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

	  <td> <input type="submit" name="cancelar" id="cancelar" value="Cancelar"/> <input type="submit" name="insertPrato" id="insertPrato" value="Salvar"/></td>
  </tr>
</table>
</form>
 
</body>
</html>

