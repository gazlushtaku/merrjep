<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publisher = Role::where('name', 'publisher')->first();
        $publisher->givePermissionTo([
            'list publications', 
            'create publications', 
            'store publications', 
            'show publications', 
            'edit publications', 
            'update publications', 
            'destroy publications'
        ]);

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo([
            'list users',  
            'destroy users',
            'list publications', 
            'create publications', 
            'store publications', 
            'show publications', 
            'edit publications', 
            'update publications', 
            'destroy publications',
        ]);
    }
}
