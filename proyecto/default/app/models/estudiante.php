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

    	//**$this->validates_presence_of('cedula'); //
    }
}
?>