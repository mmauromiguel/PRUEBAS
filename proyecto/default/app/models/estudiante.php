<?php
class Estudiante extends ActiveRecord
{
	public $logger = true;
	
	public function index($page=1) {
    $estudiante = new Estudiante();
    $this->listEstudiante = $estudiante->getEstudiante ($page);
    
    }
    public function initialize(){
    	$this->has_many('academia');
    	$this->belongs_to('academia');

    	
    }
    public function listar() {
    	 		$columnas = "estudiante.*, academia.seleccion as academia";
    	 		$joins = "LEFT OUTER JOIN academia ON estudiante.academia_id = academia.id";
    			return $this->find("columns: $columnas", "join: $joins");
    	}

	public function validar (){
		
	   $this->validates_presence_of('cedula');
	}
}



?>