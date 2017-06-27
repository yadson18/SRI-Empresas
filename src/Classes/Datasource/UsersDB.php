<?php  
	class UsersDB extends Connection{
		static $dsn = 'firebird:dbname=/BD/SRICASH.FDB';
		static $user = 'SYSDBA';
		static $password = 'masterkey';
		
		public function __construct(){
			parent::__construct(self::$dsn , self::$user , self::$password);

			if(!$this->getConnection()){
				return false;
			}
		}
	}
?>