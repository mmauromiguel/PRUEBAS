<?php

  class EstudianteController extends BackendController
  {
    protected function before_filter() {
      $this->estudiante = Load::model('site/estudiante');
    }
    public function index()
    {
      $this->estudiantes = $this->estudiante->find();
    }

    public function show($id = null)
    {
      $this->estudiante = $this->estudiante->find_by_id($id);
    }

    public function create()
    {
      $this->actionTitle = "Agregar un estudiante";
      View::select('form');
      if (Input::hasPost('estudiante')) {
        if ($this->estudiante->create(Input::post('estudiante'))) {
          Flash::valid('estudiante creado exitosamente');
          Router::toAction('index');
        }
      }
    }

    public function edit($id = null)
    {
      $this->actionTitle = "Actualizar un estudiante";
      View::select('form');
      if (Input::hasPost('estudiante')) {
        if ($this->estudiante->update(Input::post('estudiante'))) {
          Flash::valid('estudiante actualizado exitosamente');
          Router::toAction('index');
        } else {
          Flash::error('fue imposible actualizar el elemento');
        }
      }
      $this->estudiante = $this->estudiante->find_by_id($id);
    }
    public function destroy($id = null)
    {
      $item = $this->estudiante->find_by_id($id);
      if ($item->delete()){
        Flash::valid('estudiante eliminado exitosamente');
      } else {
        Flash::error('fue imposible actualizar el elemento');
      }
      Router::toAction('index');
    }
  }

 ?>
