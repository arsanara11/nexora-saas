<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use App\Models\Inventory;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NexoraSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Company
        |--------------------------------------------------------------------------
        */

        $company = Company::create([
            'name' => 'NEXORA Demo Business',
            'slug' => 'nexora-demo-business',
            'email' => 'admin@nexora.test',
            'phone' => '+62 812 3456 7890',
            'address' => 'Jakarta, Indonesia',
            'timezone' => 'Asia/Jakarta',
            'currency' => 'IDR',
        ]);

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => 'Nabila Sabrina',
            'email' => 'admin@nexora.test',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'view_dashboard' => 'View Dashboard',
            'manage_sales' => 'Manage Sales',
            'manage_customers' => 'Manage Customers',
            'manage_products' => 'Manage Products',
            'manage_inventory' => 'Manage Inventory',
            'manage_purchasing' => 'Manage Purchasing',
            'manage_finance' => 'Manage Finance',
            'view_analytics' => 'View Analytics',
            'manage_team' => 'Manage Team',
            'manage_settings' => 'Manage Settings',
        ];

        $permissionModels = [];

        foreach ($permissions as $slug => $name) {
            $permissionModels[$slug] = Permission::create([
                'name' => $name,
                'slug' => $slug,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Role
        |--------------------------------------------------------------------------
        */

        $ownerRole = Role::create([
            'company_id' => $company->id,
            'name' => 'Owner',
            'slug' => 'owner',
            'description' => 'Full access to the company.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Role Permissions
        |--------------------------------------------------------------------------
        */

        $ownerRole->permissions()->attach(
            collect($permissionModels)->pluck('id')->toArray()
        );

        /*
        |--------------------------------------------------------------------------
        | Company User
        |--------------------------------------------------------------------------
        */

        $user->companies()->attach($company->id, [
            'role_id' => $ownerRole->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = [
            'Electronics',
            'Fashion',
            'Home & Living',
            'Beauty',
            'Accessories',
        ];

        $categoryModels = [];

        foreach ($categories as $categoryName) {
            $categoryModels[$categoryName] = Category::create([
                'company_id' => $company->id,
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'is_active' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $products = [
            [
                'name' => 'Aurora Headphones',
                'category' => 'Electronics',
                'brand' => 'NEXORA',
                'description' => 'Premium wireless headphones with immersive sound.',
                'sku' => 'AUR-HDP-001',
                'price' => 1499000,
                'cost_price' => 950000,
            ],
            [
                'name' => 'Minimal Oversized Shirt',
                'category' => 'Fashion',
                'brand' => 'NOIR',
                'description' => 'Premium cotton oversized shirt with a relaxed silhouette.',
                'sku' => 'NOIR-SHT-001',
                'price' => 349000,
                'cost_price' => 180000,
            ],
            [
                'name' => 'Luma Desk Lamp',
                'category' => 'Home & Living',
                'brand' => 'NEXORA',
                'description' => 'Minimal modern desk lamp for contemporary workspaces.',
                'sku' => 'LUMA-LMP-001',
                'price' => 599000,
                'cost_price' => 320000,
            ],
            [
                'name' => 'Velour Face Serum',
                'category' => 'Beauty',
                'brand' => 'VELA',
                'description' => 'Lightweight daily serum for a refined skincare routine.',
                'sku' => 'VEL-SRM-001',
                'price' => 289000,
                'cost_price' => 140000,
            ],
            [
                'name' => 'Arc Leather Wallet',
                'category' => 'Accessories',
                'brand' => 'ARC',
                'description' => 'Slim leather wallet designed for everyday carry.',
                'sku' => 'ARC-WLT-001',
                'price' => 449000,
                'cost_price' => 210000,
            ],
        ];

        $productModels = [];

        foreach ($products as $productData) {
            $product = Product::create([
                'company_id' => $company->id,
                'category_id' => $categoryModels[$productData['category']]->id,
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'brand' => $productData['brand'],
                'status' => 'active',
            ]);

            $variant = ProductVariant::create([
                'company_id' => $company->id,
                'product_id' => $product->id,
                'sku' => $productData['sku'],
                'name' => 'Default',
                'price' => $productData['price'],
                'cost_price' => $productData['cost_price'],
                'is_active' => true,
            ]);

            $productModels[] = [
                'product' => $product,
                'variant' => $variant,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Warehouses
        |--------------------------------------------------------------------------
        */

        $mainWarehouse = Warehouse::create([
            'company_id' => $company->id,
            'name' => 'Main Warehouse',
            'code' => 'WH-JKT-01',
            'address' => 'Jl. Sudirman No. 10',
            'city' => 'Jakarta',
            'phone' => '+62 811 1111 1111',
            'is_active' => true,
        ]);

        $secondWarehouse = Warehouse::create([
            'company_id' => $company->id,
            'name' => 'Secondary Warehouse',
            'code' => 'WH-JKT-02',
            'address' => 'Jl. Gatot Subroto No. 20',
            'city' => 'Jakarta',
            'phone' => '+62 811 2222 2222',
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Inventory
        |--------------------------------------------------------------------------
        */

        foreach ($productModels as $index => $item) {
            Inventory::create([
                'warehouse_id' => $mainWarehouse->id,
                'product_variant_id' => $item['variant']->id,
                'quantity' => 50 + ($index * 15),
                'reserved_quantity' => $index === 3 ? 8 : 0,
                'reorder_level' => 20,
            ]);

            Inventory::create([
                'warehouse_id' => $secondWarehouse->id,
                'product_variant_id' => $item['variant']->id,
                'quantity' => 15 + ($index * 5),
                'reserved_quantity' => 0,
                'reorder_level' => 10,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $customers = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@example.com',
                'phone' => '+62 812 1111 1111',
                'city' => 'Jakarta',
            ],
            [
                'name' => 'Sarah Wijaya',
                'email' => 'sarah@example.com',
                'phone' => '+62 812 2222 2222',
                'city' => 'Bandung',
            ],
            [
                'name' => 'Rizky Mahendra',
                'email' => 'rizky@example.com',
                'phone' => '+62 812 3333 3333',
                'city' => 'Depok',
            ],
            [
                'name' => 'Alya Putri',
                'email' => 'alya@example.com',
                'phone' => '+62 812 4444 4444',
                'city' => 'Tangerang',
            ],
            [
                'name' => 'Dimas Saputra',
                'email' => 'dimas@example.com',
                'phone' => '+62 812 5555 5555',
                'city' => 'Bekasi',
            ],
        ];

        foreach ($customers as $customerData) {
            Customer::create([
                'company_id' => $company->id,
                'name' => $customerData['name'],
                'email' => $customerData['email'],
                'phone' => $customerData['phone'],
                'city' => $customerData['city'],
                'is_active' => true,
            ]);
        }
    }
}