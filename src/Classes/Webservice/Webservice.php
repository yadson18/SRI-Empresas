<?php
    class Webservice{
        private static $instance;

        private function __construct(){}
        
        public static function getInstance(){
            try {
                if(!isset(self::$instance)){
                    $contextOptions = [
                        "ssl"=>[
                            "verify_peer"=>false,
                            "verify_peer_name"=>false,
                            "crypto_method" => STREAM_CRYPTO_METHOD_TLS_CLIENT
                        ]
                    ];

                    $options = [
                        'soap_version'=>'SOAP_1_2',
                        'exceptions'=>true,
                        'trace'=>1,
                        'cache_wsdl'=>'WSDL_CACHE_NONE',
                        'stream_context' => stream_context_create($contextOptions)
                    ];
                    // http://sriservicos.com.br/integrasri/IntegraSRI.dll/wsdl/ISRI
                    // http://192.168.0.142:8080/wsdl/ISRI
                    self::$instance = new SoapClient('http://sriservicos.com.br/integrasri/IntegraSRI.dll/wsdl/ISRI', $options);
                }
                return self::$instance;
            } 
            catch (Exception $e) {
                echo "Não foi possível conectar-se ao Webservice.";
            }
        }
    }
?>