<?php  
	class IbgeController{
		public static function getStates(){
			$ibge = new CompaniesDB();
			$states = $ibge->select("DISTINCT ESTADO, SIGLA", "IBGE");

			return $states;
		}
		public function getCities(){
			$ibge = new CompaniesDB();
			$cities = $ibge->select("NOME_MUNICIPIO", "IBGE", "WHERE SIGLA=?", [$_POST["sigla"]]);
			
			echo json_encode($cities);
		}
	}
?>