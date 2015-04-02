<?php
  class AcademiaController extends BackendController
  {
    protected function before_filter() {
      $this->academia = Load::model('site/academia');
    }
    public function index()
    {
      $this->academias = $this->academia->find();
    }

    public function show($id = null)
    {
      $this->academia = $this->academia->find_by_id($id);
    }

    public function create()
    {
      $this->actionTitle = "Agregar una Academia";
      View::select('form');
      if (Input::hasPost('academia')) {
        if ($this->academia->create(Input::post('academia'))) {
          Flash::valid('academia creado exitosamente');
          Router::toAction('index');
        } else {
          Flash::error('academia no pudo crearse');
        }
      }
    }

    public function edit($id = null)
    {
      $this->actionTitle = "Actualizar una academia";
      View::select('form');
      if (Input::hasPost('academia')) {
        if ($this->academia->update(Input::post('academia'))) {
          Flash::valid('academia actualizado exitosamente');
          Router::toAction('index');
        } else {
          Flash::error('fue imposible actualizar el elemento');
        }
      }
      $this->academia = $this->academia->find_by_id($id);
    }
    public function destroy($id = null)
    {
      $item = $this->academia->find_by_id($id);
      if ($item->delete()){
        Flash::valid('academia eliminado exitosamente');
      } else {
        Flash::error('fue imposible actualizar el elemento');
      }
      Router::toAction('index');
    }
  }

 ?>
