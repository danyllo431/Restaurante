<?PHP
	session_start();
	include "connectionfactory.php";

	if (! isset($_POST['login'])){
		header("Location: login.htm");	
		die();
	}

		$login = $_POST['login'];
		$senha = $_POST['senha'];

		if (empty($login)) {
			echo "<script>alert('Preencha todos os campos para ter acesso.'); history.back();</script>";
		}elseif (empty($senha)) {
			echo "<script>alert('Preencha todos os campos para ter acesso.'); history.back();</script>";
		}else{
			$queryUsuario = "SELECT * FROM USUARIO WHERE V_LOGIN = '$login' AND V_SENHA = '$senha'";

			$consulta = mysql_num_rows(mysql_query($queryUsuario));

			if ($consulta == 1) {

				$_SESSION['login'] = $login;
				$_SESSION['senha'] = $senha;
			
				$consulta = mysql_query($queryUsuario);

				while($registro = mysql_fetch_assoc($consulta)){
					$_SESSION['funcao'] = $registro["V_FUNCAO"];
				}

				if ($_SESSION['funcao'] == 1){ //Adm
					header("Location: menu.php");
				}else if ($_SESSION['funcao'] == 2){ //Garçom
					header("Location: pedido.php");
    			}else if ($_SESSION['funcao'] == 3){ //Cozinherio 
					header("Location: cozinha.php");		
				} else {
					header("Location: login.htm");	
				}
				
				die();

			}else{
				echo "<script>alert('Usuário ou senha não correspondem.'); history.back();</script>";
			}
		}

?>