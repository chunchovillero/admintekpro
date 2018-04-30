<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function permisos(){
		return $this->belongsToMany('\Caffeinated\Shinobi\Models\Permission');
	} 
}
