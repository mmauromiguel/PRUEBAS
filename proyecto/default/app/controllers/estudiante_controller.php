<?php

	Load::model("estudiante");
	class EstudianteController extends AppController
	{
		 function index($page=1) {
			Router::toAction("listar");
		}
		
		function listar() {
			$estudiante = new Estudiante();
			$this->estudiante = $estudiante->find();
		}
		
		public function create() {
			if (Input::hasPost('estudiante')) {
				//intentar crear el registro en la tabla
				$estudiante = new Estudiante(Input::post('estudiante'));
				if ($estudiante->create()){
					Flash::valid("El estudiante a ingresadoso exitosamente");
					Router::toAction("listar");
				} else {
					Flash::error("Error de creación");
				}
			}
			//solo dibujar el formulario
		}
		
		function borrar($id) {
			if ($id != null) {
				//intentar borrar
				$estudiante = new Estudiante();
				$item = $estudiante->find($id);
				
				if ($item->delete()) {
					Flash::valid("El estudiante a ingresado con exito");
				} else {
					Flash::error("Imposible borrar");
				}
			}
			Router::toAction("listar");
		}
		
		function editar($id) {
			if (Input::hasPost('estudiante')) {
				//intentar actualizar
				$estudiante = new Estudiante();
				$item = $estudiante->find($id);
				
				if ($item->update(Input::post('estudiante'))) {
					Flash::valid("El estudiante  actualizado exitosamente");
				} else {
					Flash::error("Imposible actualizar");
				}
				Router::toAction("listar");
			} 
			if ($id != null) {
				$estudiante = new Estudiante();
				$this->estudiante = $estudiante->find($id);
			}
		}
	}