<?php
class Academia extends ActiveRecord
{
	public $logger = true;

	public function initialize()
	{
        //Para establecer la relacion entre las dos tablas
		$this->has_many('estudiante'); // tiene muchos

    }

    // Retorna la academia para ser paginados

    public function getAcademia($page, $ppage = 5)

    {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: nombres desc');

    }

		public function crearAcademia($estudianteId, $datosAcademia)
		{
			$item = new Academia($datosAcademia);
			$item->estudiante_id = $estudanteId; //clave foranea
			return $item->create();
		}
		
		public function listar() {
    	 		$columnas = "academia.*,  estudiante.nombre as estudiante";
    	 		$joins = "LEFT OUTER JOIN academia ON acedemia.estudiante ";
    			return $this->find("columns: $columnas", "join: $joins");
    	}
		
}
