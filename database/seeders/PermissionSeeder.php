<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = ['list', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
        $models = ['users', 'categories', 'publications', 'images'];

        foreach($actions as $action) {
            foreach($models as $model) {
                Permission::create(['name' => "$action $model"]);
            }
        }
    }
}
