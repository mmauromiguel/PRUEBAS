<?php
class Usuario extends ActiveRecord
{
	public function initialize(){
		$this->belongs_to("estudiante");
	}
	
	function crearUsuario($nombre = null) {
		$this->login = $nombre;
		$this->password = 123456;
		if ($this->create()) {
			return $this->id;
		} else {
			return 0;
		}
		
	}
}