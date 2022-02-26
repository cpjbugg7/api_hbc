<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin      = Role::create([ 'name' => 'admin', 'guard_name' => 'web' ]);
        $operations = Role::create([ 'name' => 'operations', 'guard_name' => 'web' ]);


        $airports_create = Permission::create(['name' => 'create_airports']);
        $airports_read   = Permission::create(['name' => 'read_airports']);
        $airports_update = Permission::create(['name' => 'update_airports']);
        $airports_delete = Permission::create(['name' => 'delete_airports']);


        $airline_create = Permission::create(['name' => 'create_airline']);
        $airline_read   = Permission::create(['name' => 'read_airline']);
        $airline_update = Permission::create(['name' => 'update_airline']);
        $airline_delete = Permission::create(['name' => 'delete_airline']);


        $flight_create = Permission::create(['name' => 'create_flight']);
        $flight_read   = Permission::create(['name' => 'read_flight']);
        $flight_update = Permission::create(['name' => 'update_flight']);
        $flight_delete = Permission::create(['name' => 'delete_flight']);

        $admin->givePermissionTo('create_flight');
        $admin->givePermissionTo('read_flight');
        $admin->givePermissionTo('update_flight');
        $admin->givePermissionTo('delete_flight');
    }
}
