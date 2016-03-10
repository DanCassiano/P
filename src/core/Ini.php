<?php 
	namespace Core;

	/**
	* Ini
	* @package Core
	* @author Jordan Cassiano <jordan_gnr@hotmail.com>
	*/
	class Ini
	{
		private $arquivo;

		private $dados;

		function __construct( $arquivo )
		{
			$this->arquivo = $arquivo;

			if( file_exists($this->arquivo))
				$this->dados = parse_ini_file( $this->arquivo, true);
			else
				die("Arquivo nao encontrado");
		}

		public function __get( $chave ){
			return $this->dados[ $chave ];
		}

		public function edit( array $dados ){
			$this->dados = $dados;
		}

		public function save(){
			$this->put_ini_file( $this->arquivo, $this->dados );
		}

		private function put_ini_file($file, $array, $i = 0){
			$str="";
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					$str.=str_repeat(" ",$i*2)."[$k]".PHP_EOL; 
					$str.=$this->put_ini_file("",$v, $i+1);
				}
				else
					$str.=str_repeat(" ",$i*2)."$k = $v".PHP_EOL; 
			}
			
			if($file)
				return file_put_contents($file,$str);
			else
				return $str;
		}
	}