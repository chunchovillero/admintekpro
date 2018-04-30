<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
	public function empresas(){
		return $this->belongsToMany('\App\Empresa');
	} 
}
