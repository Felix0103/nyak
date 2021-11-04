<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([ 'name' => 'Admin' ]);

        Permission::create(['name' => 'admin.home','description' =>'See dashboard' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.options.securies','description' =>'Security Header' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.options.reports','description' =>'Reports Header' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.users.index','description' =>'See usuarios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.create','description' =>'Create usuarios' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit','description' =>'can assing roles' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.roles.index','description' =>'See roles' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.create','description' =>'Create roles' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.edit','description' =>'Edit roles' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.destroy','description' =>'Delete roles' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.zipcodes.index','description' =>'See Zip Codes' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.zipcodes.create','description' =>'Create Zip Codes' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.zipcodes.edit','description' =>'Edit Zip Codes' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.zipcodes.destroy','description' =>'Delete Zip Codes' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.drivers.index','description' =>'See drivers' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.drivers.create','description' =>'Create drivers' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.drivers.edit','description' =>'Edit drivers' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.drivers.destroy','description' =>'Delete drivers' ])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.files.index','description' =>'See files' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.files.create','description' =>'Create files' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.files.edit','description' =>'Edit files' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.files.destroy','description' =>'Delete files' ])->syncRoles([$admin]);

        //Reports
        Permission::create(['name' => 'admin.report.sales.purchases','description' =>'See sales and purchase report' ])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.report.sales.earnings','description' =>'See earnings report' ])->syncRoles([$admin]);

    }
}
