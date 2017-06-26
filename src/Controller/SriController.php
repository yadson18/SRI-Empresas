<?php  
	class SriController extends Controller{
		public function home(){
			$this->serializeData(["Title" => "Home"]);
		}
	}
?>