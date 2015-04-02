<?php

  class Academia extends ActiveRecord
  {
    public function initialize() {
      $this->validates_presence_of('nombre');
      $this->has_many('estudiante');
    }
  }


 ?>
