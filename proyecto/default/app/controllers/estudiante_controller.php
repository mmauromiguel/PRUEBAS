<?php
	Load::models("estudiante", "usuario");
	class EstudianteController extends AppController
	{
		
				
		function index($page=1) {
			Redirect::toAction("listar");
		}
		
		function listar() {
			$estudiante = new Estudiante();
			$this->estudiantes = $estudiante->find();
		}
		
		function crear() {
			if (Input::hasPost('estudiante')) {
				//intentar crear el registro en la tabla
				$estudiante = new Estudiante(Input::post('estudiante'));
				
				//vamos a intentar crear usuario y estudiante como una instruccion atomica
				$estudiante->begin(); //iniciar transaccion
				
				
				try {
					$estudiante->create();
					$usuario = new Usuario();
					$nombreUsuario = Filter::get($estudiante->nombre, 'trim');
					$nombreUsuario .= ".";
					$nombreUsuario .= Filter::get($estudiante->apellido, 'trim');
					
					$estudiante->usuario_id = $usuario->crearUsuario($nombreUsuario);
					$estudiante->save();
					$estudiante->commit(); //si todo va bien tendremos usuario y estudiante
					Flash::valid("El estudiante a ingresadoso exitosamente");
					Redirect::toAction("listar");
				} catch(Exception $ex) {
					//si hay error hacer borron y cuenta nueva
					$estudiante->rollback();
					Flash::error("Error de creaci&oacute;n");
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
			Redirect::toAction("listar");
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
				Redirect::toAction("listar");
			} 
			if ($id != null) {
				$estudiante = new Estudiante();
				$this->estudiante = $estudiante->find($id);
			}
		}
	}
?>