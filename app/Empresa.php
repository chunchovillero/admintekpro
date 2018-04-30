<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	public function servicios(){
		return $this->belongsToMany('\App\Servicio');
	} 
}
