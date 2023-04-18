<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = Role::create(['name' => 'super admin']);
        $operator = Role::create(['name' => 'operator']);
        $dekan = Role::create(['name' => 'dekan']);
        $kaprodi = Role::create(['name' => 'kaprodi']);
        $dosen = Role::create(['name' => 'dosen']);

        Permission::create(['name' => 'access documents']);
        Permission::create(['name' => 'store document']);
        Permission::create(['name' => 'update document']);
        Permission::create(['name' => 'delete document']);
        Permission::create(['name' => 'verify document']);

        Permission::create(['name' => 'access subs']);
        Permission::create(['name' => 'store sub']);
        Permission::create(['name' => 'update sub']);
        Permission::create(['name' => 'delete sub']);

        Permission::create(['name' => 'access users']);
        Permission::create(['name' => 'store user operator']);
        Permission::create(['name' => 'store user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'access standards']);
        Permission::create(['name' => 'store standard']);
        Permission::create(['name' => 'update standard']);
        Permission::create(['name' => 'delete standard']);

        $superAdmin->givePermissionTo([
            'access documents',
            'store document',
            'update document',
            'delete document',
            'verify document',

            'access subs',
            'update sub',
            'store sub',
            'delete sub',

            'store user operator',
            'access users',
            'store user',
            'update user',
            'delete user',

            'access standards',
            'store standard',
            'update standard',
            'delete standard'
        ]);

        $operator->givePermissionTo([
            'access documents',
            'store document',
            'delete document',
            'verify document',

            'access subs',
            'store sub',
            'update sub',
            'delete sub',

            'access standards',
            'store standard',
            'update standard',
            'delete standard'
        ]);

        $dekan->givePermissionTo([
            'access documents',
            'store document',
            'verify document',

            'access subs',

            'access users',

            'access standards',
        ]);

        $kaprodi->givePermissionTo([
            'access documents',
            'store document',
            'delete document',
            'verify document',

            'access subs',

            'access standards',
        ]);

        $dosen->givePermissionTo([
            'access documents',
            'store document',
        ]);
    }
}
