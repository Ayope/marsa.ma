<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        $permissions = [

            'buy_product',

            'view_commands',
            'command_show',
            'command_cancel',

            'view_ratings',
            'rating_create',
            'rating_edit',
            'rating_show',
            'rating_delete',

            'view_products',
            'product_create',
            'product_edit',
            'product_show',
            'product_delete',

            'view_users',
            'user_modify',
            'user_show',
            'user_delete',

            'deliveryMan_create',
            'deliveryMan_edit',
            'deliveryMan_show',
            'deliveryMan_delete',
            'edit_user_deliveryMan',

            'view_genres',
            'genre_create',
            'genre_edit',
            'genre_show',
            'genre_delete',
            'genre_filter',

        ];

        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }

        // Create roles and assign it permissions to it

        Role::create(['name' => 'admin']);

        Role::create(['name' => 'client']);
            // ->givePermissionTo(['view_books' , 'book_show' , 'genre_filter']);

        Role::create(['name' => 'fisher']);
            // ->givePermissionTo(['view_books', 'book_create', 'book_edit', 'book_show', 'book_delete', 'genre_filter']);

        Role::create(['name' => 'deliveryMan']);
            // ->givePermissionTo(['view_genres', 'genre_create', 'genre_edit', 'genre_show', 'genre_delete', 'genre_filter',
            //                     'view_books', 'book_edit', 'book_show', 'book_delete',
            //                     'view_users', 'view_roles', 'role_create', 'role_edit', 'role_show', 'role_delete', 'edit_user_role']);

    }

}
