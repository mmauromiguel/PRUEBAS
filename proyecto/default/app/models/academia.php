<?php
class Academia extends ActiveRecord
{

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
}