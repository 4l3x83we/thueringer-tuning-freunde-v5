<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'write']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'destroy']);

        $role = Role::create(['name' => 'silent_member']);
        $role->givePermissionTo('write');

        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'super_admin']);
        $role->givePermissionTo(Permission::all());

        $this->call(TeamAlexSeeder::class);
    }
}
