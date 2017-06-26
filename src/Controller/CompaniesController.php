<?php  
	class CompaniesController extends Controller{
		private static $companiesDB;

		public function __construct(){
			self::$companiesDB = new CompaniesDB();
		}

		public function getCompanie($columns, $values){
			if(is_array($values)){
				$columnsValues = "";
				for($i = 0; $i < sizeof($columns); $i++){
					if($i < (sizeof($columns) - 1)){
						$columnsValues .= $columns[$i] . ", ";
					}
					else{
						$columnsValues .= $columns[$i];
					}
				}

				return self::$companiesDB->select(
					$columnsValues, 
					"CADASTRO", 
					"WHERE RAZAO=? OR CNPJ=?",
					$values
				);
			}
		}

		public function createCompanieDb(){
			$companie = $this->getCompanie(
				[
					"COD_CADASTRO",
					"RAZAO",
					"FANTASIA",
					"CNPJ",
					"ESTADUAL",
					"MUNICIPAL",
					"CAE",
					"ENDERECO",
					"BAIRRO",
					"CEP",
					"CIDADE",
					"ESTADO",
					"TELEFONE",
					"CELULAR",
					"CONTATO",
					"COD_REG_TRIB"
				], 
				[
					$_POST["razao"], 
					replace($_POST["cnpj"])
				]
			);

			foreach($companie[key($companie)] as $index => $value){
				if(is_null($value)){
					$companie[key($companie)][$index] = "";
				}
				if(strcmp($index, "COD_REG_TRIB") == 0){
					$companie[key($companie)][$index] = toInteger($value);
				}
			}

			$webservice = Webservice::getInstance();
			$fileName = "{$_SERVER['DOCUMENT_ROOT']}/JsonFiles/{$companie[key($companie)]['COD_CADASTRO']}.json";
			if(!file_exists($fileName)){
				$file = fopen($fileName, "a");
				$result = fwrite($file, json_encode($companie[key($companie)]));
				fclose($file);
			}
			$arguments = [file_get_contents($fileName)];

			if(is_callable($webservice, "__soapCall")){
			  	$result = $webservice->__soapCall('criaAmbiente', $arguments, NULL);

			  	if(!empty($result)){
				  	if(empty($result["erro"]) && $result["return"] == 1){
				  		return true;
				  	}
			  	}
			}
		  	return false;
		}

		public function add(){
			if($this->requestMethodIs("POST")){
				if(!empty($this->getCompanie(["RAZAO", "CNPJ"], [$_POST["razao"], replace($_POST["cnpj"])]))){
					$this->flashError("Erro, a Razão ou CNPJ já foi cadastrado.");
					return $this->redirectTo(["controller" => "Companies", "view" => "add"]);
				}
				else{
					if($this->save(self::$companiesDB, "CADASTRO", $_POST)){
						if($this->createCompanieDb()){
							$this->flashSuccess("Empresa e base de dados cadastrados com sucesso.");
							return $this->redirectTo(["controller" => "Companies", "view" => "add"]);
						}
						$this->flashWarning("Empresa cadastrada com sucesso, porém, não foi possível criar a base de dados.");
						return $this->redirectTo(["controller" => "Companies", "view" => "add"]);
					}
					$this->flashError("Não foi possível cadastrar.");
					return $this->redirectTo(["controller" => "Companies", "view" => "add"]);
				}
			} 
		  	$this->serializeData([
		  		"Estados" => IbgeController::getStates(), 
		  		"Title" => "Cadastrar Empresa"
		  	]);
		}
	}
?>