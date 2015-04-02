<?php

  class Estudiante extends ActiveRecord
  {
    public function initialize() {
      $this->validates_presence_of('nombres');
      $this->validates_presence_of('apellidos');

      $this->belongs_to('academia', 'model: site/academia');
    }
  }


 ?>
