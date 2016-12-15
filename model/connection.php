<?php

session_start();

/* PDO Connection */
$ClassPDO = new PDO_Connection();
$ClassPDO->SetConnection();
$pdo = $ClassPDO->GetConnection();

/* Display */
$display = new Display();

/* User */
$user = new User();

// Criando Settings - Usada no Login
$settings = new Settings();

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


class PDO_Connection
{
	public $pdo;
	
	/*public $_hostname = 'mysql.hostinger.com.br',
			$_username = 'u286200890_usr',
			$_password = 'lenovo',
			$_database = 'u286200890_erp';*/

	
	public $_hostname = 'localhost',
			$_username = 'root',
			$_password = '',
			$_database = 'kikmidia';

	function SetConnection()
	{
		$this->pdo = new PDO('mysql:host='.$this->_hostname.';dbname='.$this->_database.'', $this->_username, $this->_password);
	}
	
	function GetConnection()
	{
		if(!empty($this->pdo))
		{
			return $this->pdo;
		} else {
			return false;
		}
	}
}

class Settings
{
	public function GetData($Data)
	{
		global $pdo;
		
		$stmt = $pdo->prepare('SELECT * FROM merchant');
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row[$Data];
	}
		
	public function url()
	{
		return sprintf(
			"%s://%s%s",
			isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			$_SERVER['SERVER_NAME'],
			dirname($_SERVER["REQUEST_URI"])
		);
	}
	
	public function forceRedirect($url, $delay = 0) {
		try {
			if (!headers_sent() && $delay == 0) {
				header("Location: " . $url);
			}
			if (!headers_sent() && $delay != 0) {
				header("refresh:".$delay."url=".$url.";");
			}
			// Performs a redirect once headers have been sent
			echo "<meta http-equiv=\"Refresh\" content=\"" . $delay . "; URL=" . $url . "\">";
			exit();
			
			if(!headers_sent)
				ob_end_clean();
		} catch (Exception $err) {
			return $err->getMessage();
		}
	}
}

class User
{
	public function GetData($Data)
	{
		global $pdo;
		
		if(isset($_SESSION['auth'])) {
			$UserID = $_SESSION['auth'];
			
			$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario_id = :usuario_id');
			$stmt->bindParam(':usuario_id', $UserID);
			$stmt->execute();
			
			if($stmt->rowCount() > 0) {
				$row = $stmt->fetch();
				return $row[$Data];
			} else {
				return false;
			}
		}
	}
	
	public function IsLogged()
	{
		if(!isset($_SESSION['auth'])) {
			header('Location: /login.php');
			exit();
		}
	}
	
	public function IsBanned()
	{
		if($this->GetData('banido') == 'S') {
			unset($_SESSION['auth']);
			
			header('Location: /login.php');
			exit();
		}
	}
	
	public function GetDataID($ID, $Data)
	{
		global $pdo;
		
		$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario_id = :usuario_id');
		$stmt->bindParam(':usuario_id', $ID);
		$stmt->execute();
		
		if($stmt->rowCount() > 0) {
			$row = $stmt->fetch();
			return $row[$Data];
		} else {
			return false;
		}
	}
	
	public function GetImage($UserID = false, $ImageWidth = false, $ImageHeight = false)
	{
		if(empty($this->GetData('UserImage'))) {
			echo '<img id="user-avatar" src="images/lock_thumb.jpg" alt=""/>';
		} else {
			$img = base64_encode(stripslashes($this->GetData('UserImage')));
			echo '<img id="user-avatar" width="'.$ImageWidth.'px;" height="'.$ImageHeight.'px;" src="data:image/jpg;charset=utf8;base64, '.$img.'"/>';
		}
		
		if(!empty($UserID)) {
			if(empty($this->GetDataID($UserID, 'UserImage'))) {
				echo '<img id="user-avatar" src="images/lock_thumb.jpg" alt=""/>';
			} else {
				$img = base64_encode(stripslashes($this->GetDataID($UserID, 'UserImage')));
				echo '<img id="user-avatar" width="'.$ImageWidth.'px;" height="'.$ImageHeight.'px;" src="data:image/jpg;charset=utf8;base64, '.$img.'"/>';
			}
		}
	}
}

class Category
{
	public function GetData($CategoryID, $Data)
	{
		global $pdo;
		
		$stmt = $pdo->prepare('SELECT * FROM categories WHERE CategoryID = :CategoryID');
		$stmt->bindParam(':CategoryID', $CategoryID);
		$stmt->execute();
		
		if($stmt->rowCount() > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $row[$Data];
		} else {
			return false;
		}
	}
}

class Product
{
	public function GetData($ProductID, $Data)
	{
		global $pdo;
		
		$stmt = $pdo->prepare('SELECT * FROM products WHERE ProductID = :ProductID');
		$stmt->bindParam(':ProductID', $ProductID);
		$stmt->execute();
		
		if($stmt->rowCount() > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $row[$Data];
		} else {
			return false;
		}
	}
	
	/* Тука си изчислявам цената а-у ;д */
	
	public function DeclarePrice($ProductPrice, $ProductDefaultQuantity, $ProductQuantity)
	{
		$ProductValue = $ProductPrice / $ProductDefaultQuantity;
		
		return $ProductValue * $ProductQuantity;
	}
}

class Display
{
	function ReturnSuccess($Message)
	{
		$html = '<div class="alert alert-success fade in">';
        $html .= '<button data-dismiss="alert" class="close close-sm" type="button">';
        $html .= '<i class="fa fa-times"></i>';
        $html .= '</button>';
        $html .= '<strong>Success!</strong> '.$Message;
        $html .= '</div>';
		
		echo $html;
	}
	
	function ReturnInfo($Message)
	{
		$html = '<div class="alert alert-info fade in">';
        $html .= '<button data-dismiss="alert" class="close close-sm" type="button">';
        $html .= '<i class="fa fa-times"></i>';
        $html .= '</button>';
        $html .= $Message;
        $html .= '</div>';
		
		echo $html;
	}
	
	function ReturnError($Message)
	{
		$html = '<div class="alert alert-danger fade in">';
        $html .= '<button data-dismiss="alert" class="close close-sm" type="button">';
        $html .= '<i class="fa fa-times"></i>';
        $html .= '</button>';
        $html .= '<strong>Error!</strong> '.$Message;
        $html .= '</div>';
		
		echo $html;
	}
}