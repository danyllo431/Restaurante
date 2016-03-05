<?php
	session_start();

	if (! isset($_SESSION["funcao"])){
		header("Location: login.htm");	
		die();
	}

	if ($_SESSION['funcao'] <> 1){ //Adm
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
	<script language="javascript">
function showTimer() {
var time=new Date();
var hour=time.getHours();
var minute=time.getMinutes();
var second=time.getSeconds();
if(hour<10) hour ="0"+hour;
if(minute<10) minute="0"+minute;
if(second<10) second="0"+second;
var st=hour+":"+minute+":"+second;
document.getElementById("timer").innerHTML=st; 
}
function initTimer() {
// O metodo nativo setInterval executa uma determinada funcao em um determinado tempo 
setInterval(showTimer,1000);
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

input {  
     width: 600px;  
     height: 60px;  
     background-color: #E77116;
	 color: #FFF;
	 border-radius: 10px;
	  font-size:100%;
   
     }
input:hover{
    background:#D57A35;
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
    font-family:'Open Sans',sans-serif;
	text-align:center; 
	}

footer{
  color:#FFF;
}
</style>

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1>Menu </h1>
		<input name="" type="button" onClick="irpara('cadPrato.php')" value="Cadastrar Um Novo Prato">
		<p> </p>
		<input name="" type="button" onClick="irpara('pratos.php')" value="Lista de Pratos">
		<p> </p>
		<input name="" type="button" onClick="irpara('pedido.php')" value="Fazer um Pedido">
		<p> </p>
		<input name="" type="button" onClick="irpara('cozinha.php')" value="Ir para Cozinha">
		<p> </p>
		<input name="" type="button" onClick="irpara('caixa.php')" value="Caixa">
		<p> </p> <p> </p><p> </p><p> </p><p> </p><p> </p>
  		<input name="" type="button" onClick="irpara('login.htm')" value="Sair"> 
</body>

</html>
<footer>
<?php
	echo "<br>";
	echo "<br>";
	echo "Usuário: ";
	echo $_SESSION["login"];
	echo "<br>";
	echo " Data: ";
	echo date("d/m/y"); 
	echo " Versão: 1.0";
	//<body onLoad="initTimer();">
	//echo date("H:i", mktime(gmdate("H")-3, gmdate("i"), gmdate("s")));
?>
</footer>
