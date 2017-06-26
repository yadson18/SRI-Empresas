<?php  
	class UsersController extends Controller{
		private $usersDB;

		public function __construct(){
			$this->usersDB = new UsersDB();
		}

		public function UsersController(){}

		public function login(){
			if($this->requestMethodIs("POST")){
				$condition = "WHERE LOGIN = ? AND SENHA = ?";
				$result = $this->usersDB->select("*", "COLABORADOR", $condition, [$_POST['login'], $_POST['senha']]);
				
				if(!empty($result)){
					$this->isAuthorized();
					$this->serializeData(["User" => $result]);
					return $this->redirectTo(["controller" => "Sri", "view" => "home"]);
				}
				$this->flashError("Usuário ou senha incorreto, tente novamente.");
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}

			$this->serializeData(["Title" => "Login"]);
		}

		public function logout(){
			if($this->requestMethodIs("GET")){
				$this->isNotAuthorized();
				return $this->redirectTo(["controller" => "Users", "view" => "login"]);
			}
		}

		public function isAuthorized(){
			$this->serializeData(["Logged" => true]);
		}


		public function isNotAuthorized(){
			$this->sessionDestroy();
		}

		public static function checkLoggedUser(){
			if(isset($_SESSION["logged"])){
				if($_SESSION["logged"] === false){
					self::isNotAuthorized();
				}
			}
			else{
				self::isNotAuthorized();
			}
		}
	}
?>