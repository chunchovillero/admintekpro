<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//users
    	
        Permission::create([
        	'name'	=>'Navegar usuarios',
        	'slug'	=>'user.index',
        	'description' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
        	'name'	=>'Ver detalle del usuario',
        	'slug'	=>'user.show',
        	'description' => 'Ver en detalle cada usuario del sistema',
        ]);

        Permission::create([
        	'name'	=>'Edicion de usuarios',
        	'slug'	=>'user.edit',
        	'description' => 'Edita cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
        	'name'	=>'Eliminar usuario',
        	'slug'	=>'user.destroy',
        	'description' => 'Eliminar cualquier usuario del sistema',
        ]);

        //Roles
        Permission::create([
        	'name'	=>'Navegar roles',
        	'slug'	=>'roles.index',
        	'description' => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
        	'name'	=>'Ver detalle del rol',
        	'slug'	=>'roles.show',
        	'description' => 'Ver en detalle cada rol del sistema',
        ]);

        Permission::create([
        	'name'	=>'Creacion de roles',
        	'slug'	=>'roles.create',
        	'description' => 'Edita cualquier dato de un rol del sistema',
        ]);

        Permission::create([
        	'name'	=>'Edicion de roles',
        	'slug'	=>'roles.edit',
        	'description' => 'Edita cualquier dato de un rol del sistema',
        ]);

        Permission::create([
        	'name'	=>'Eliminar roles',
        	'slug'	=>'roles.destroy',
        	'description' => 'Eliminar cualquier rol del sistema',
        ]);

          //Productos
        Permission::create([
        	'name'	=>'Navegar Productos',
        	'slug'	=>'products.index',
        	'description' => 'Lista y navega todos los Productos del sistema',
        ]);

        Permission::create([
        	'name'	=>'Ver detalle del producto',
        	'slug'	=>'products.show',
        	'description' => 'Ver en detalle cada producto del sistema',
        ]);

        Permission::create([
        	'name'	=>'Creacion de Productos',
        	'slug'	=>'products.create',
        	'description' => 'Edita cualquier dato de un producto del sistema',
        ]);

        Permission::create([
        	'name'	=>'Edicion de Productos',
        	'slug'	=>'products.edit',
        	'description' => 'Edita cualquier dato de un producto del sistema',
        ]);

        Permission::create([
        	'name'	=>'Eliminar Productos',
        	'slug'	=>'products.destroy',
        	'description' => 'Eliminar cualquier producto del sistema',
        ]);
    }
}
