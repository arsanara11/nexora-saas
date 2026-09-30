<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Products',
])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');
});


/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Products',
])->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');
});


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Customers',
])->group(function () {

    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('customers.index');

    Route::get('/customers/create', [CustomerController::class, 'create'])
        ->name('customers.create');

    Route::post('/customers', [CustomerController::class, 'store'])
        ->name('customers.store');

    Route::get('/customers/{customer}', [CustomerController::class, 'show'])
        ->name('customers.show');

    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit');

    Route::put('/customers/{customer}', [CustomerController::class, 'update'])
        ->name('customers.update');

    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');
});


/*
|--------------------------------------------------------------------------
| Inventory Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Inventory',
])->group(function () {

    Route::get('/inventory', [InventoryController::class, 'index'])
        ->name('inventory.index');

    Route::get('/inventory/create', [InventoryController::class, 'create'])
        ->name('inventory.create');

    Route::post('/inventory', [InventoryController::class, 'store'])
        ->name('inventory.store');


    /*
    |--------------------------------------------------------------------------
    | Stock Movement Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/inventory/stock-movements', [StockMovementController::class, 'index'])
        ->name('stock-movements.index');

    Route::get('/inventory/stock-movements/{stockMovement}', [StockMovementController::class, 'show'])
        ->name('stock-movements.show');


    /*
    |--------------------------------------------------------------------------
    | Inventory Detail Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])
        ->name('inventory.edit');

    Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])
        ->name('inventory.update');

    Route::get('/inventory/{inventory}', [InventoryController::class, 'show'])
        ->name('inventory.show');


    /*
    |--------------------------------------------------------------------------
    | Warehouse Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/warehouses', [WarehouseController::class, 'index'])
        ->name('warehouses.index');

    Route::get('/warehouses/create', [WarehouseController::class, 'create'])
        ->name('warehouses.create');

    Route::post('/warehouses', [WarehouseController::class, 'store'])
        ->name('warehouses.store');

    Route::get('/warehouses/{warehouse}', [WarehouseController::class, 'show'])
        ->name('warehouses.show');

    Route::get('/warehouses/{warehouse}/edit', [WarehouseController::class, 'edit'])
        ->name('warehouses.edit');

    Route::put('/warehouses/{warehouse}', [WarehouseController::class, 'update'])
        ->name('warehouses.update');

    Route::patch('/warehouses/{warehouse}/toggle-status', [WarehouseController::class, 'toggleStatus'])
        ->name('warehouses.toggle-status');

    Route::delete('/warehouses/{warehouse}', [WarehouseController::class, 'destroy'])
        ->name('warehouses.destroy');
});


/*
|--------------------------------------------------------------------------
| Purchasing Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Purchasing',
])->group(function () {

    Route::get('/purchasing', [PurchaseOrderController::class, 'index'])
        ->name('purchasing.index');

    Route::get('/purchasing/create', [PurchaseOrderController::class, 'create'])
        ->name('purchasing.create');

    Route::post('/purchasing', [PurchaseOrderController::class, 'store'])
        ->name('purchasing.store');

    Route::get('/purchasing/{purchaseOrder}', [PurchaseOrderController::class, 'show'])
        ->name('purchasing.show');

    Route::get('/purchasing/{purchaseOrder}/edit', [PurchaseOrderController::class, 'edit'])
        ->name('purchasing.edit');

    Route::put('/purchasing/{purchaseOrder}', [PurchaseOrderController::class, 'update'])
        ->name('purchasing.update');

    Route::patch('/purchasing/{purchaseOrder}/status', [PurchaseOrderController::class, 'updateStatus'])
        ->name('purchasing.status');

    Route::delete('/purchasing/{purchaseOrder}', [PurchaseOrderController::class, 'destroy'])
        ->name('purchasing.destroy');


    /*
    |--------------------------------------------------------------------------
    | Supplier Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('suppliers.index');

    Route::get('/suppliers/create', [SupplierController::class, 'create'])
        ->name('suppliers.create');

    Route::post('/suppliers', [SupplierController::class, 'store'])
        ->name('suppliers.store');

    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])
        ->name('suppliers.show');

    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])
        ->name('suppliers.edit');

    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])
        ->name('suppliers.update');

    Route::patch('/suppliers/{supplier}/toggle-status', [SupplierController::class, 'toggleStatus'])
        ->name('suppliers.toggle-status');

    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
        ->name('suppliers.destroy');
});


/*
|--------------------------------------------------------------------------
| Sales / Orders Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Sales',
])->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/create', [OrderController::class, 'create'])
        ->name('orders.create');

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])
        ->name('orders.edit');

    Route::put('/orders/{order}', [OrderController::class, 'update'])
        ->name('orders.update');

    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.status');

    Route::patch('/orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])
        ->name('orders.payment.status');

    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
        ->name('orders.destroy');
});


/*
|--------------------------------------------------------------------------
| Finance Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/finance', [FinanceController::class, 'index'])
    ->middleware([
        'auth',
        'permission:Manage Finance',
    ])
    ->name('finance.index');


/*
|--------------------------------------------------------------------------
| Finance / Invoice Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Finance',
])->group(function () {

    Route::get('/finance/invoices', [InvoiceController::class, 'index'])
        ->name('finance.invoices.index');

    Route::get('/finance/invoices/create', [InvoiceController::class, 'create'])
        ->name('finance.invoices.create');

    Route::post('/finance/invoices', [InvoiceController::class, 'store'])
        ->name('finance.invoices.store');

    Route::get('/finance/invoices/{invoice}', [InvoiceController::class, 'show'])
        ->name('finance.invoices.show');

    Route::get('/finance/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])
        ->name('finance.invoices.edit');

    Route::put('/finance/invoices/{invoice}', [InvoiceController::class, 'update'])
        ->name('finance.invoices.update');

    Route::patch('/finance/invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])
        ->name('finance.invoices.status');

    Route::delete('/finance/invoices/{invoice}', [InvoiceController::class, 'destroy'])
        ->name('finance.invoices.destroy');
});


/*
|--------------------------------------------------------------------------
| Finance / Expense Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Finance',
])->group(function () {

    Route::get('/finance/expenses', [ExpenseController::class, 'index'])
        ->name('finance.expenses.index');

    Route::get('/finance/expenses/create', [ExpenseController::class, 'create'])
        ->name('finance.expenses.create');

    Route::post('/finance/expenses', [ExpenseController::class, 'store'])
        ->name('finance.expenses.store');

    Route::get('/finance/expenses/{expense}', [ExpenseController::class, 'show'])
        ->name('finance.expenses.show');

    Route::get('/finance/expenses/{expense}/edit', [ExpenseController::class, 'edit'])
        ->name('finance.expenses.edit');

    Route::put('/finance/expenses/{expense}', [ExpenseController::class, 'update'])
        ->name('finance.expenses.update');

    Route::delete('/finance/expenses/{expense}', [ExpenseController::class, 'destroy'])
        ->name('finance.expenses.destroy');
});


/*
|--------------------------------------------------------------------------
| Finance / Payment Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Finance',
])->group(function () {

    Route::get('/finance/payments', [PaymentController::class, 'index'])
        ->name('finance.payments.index');

    Route::get('/finance/payments/create', [PaymentController::class, 'create'])
        ->name('finance.payments.create');

    Route::post('/finance/payments', [PaymentController::class, 'store'])
        ->name('finance.payments.store');

    Route::get('/finance/payments/{payment}', [PaymentController::class, 'show'])
        ->name('finance.payments.show');

    Route::get('/finance/payments/{payment}/edit', [PaymentController::class, 'edit'])
        ->name('finance.payments.edit');

    Route::put('/finance/payments/{payment}', [PaymentController::class, 'update'])
        ->name('finance.payments.update');

    Route::delete('/finance/payments/{payment}', [PaymentController::class, 'destroy'])
        ->name('finance.payments.destroy');
});


/*
|--------------------------------------------------------------------------
| Analytics Routes
|--------------------------------------------------------------------------
*/

Route::get('/analytics', [AnalyticsController::class, 'index'])
    ->middleware([
        'auth',
        'permission:View Analytics',
    ])
    ->name('analytics.index');


/*
|--------------------------------------------------------------------------
| Team Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Team',
])->group(function () {

    Route::get('/team', [TeamController::class, 'index'])
        ->name('team.index');

    Route::get('/team/create', [TeamController::class, 'create'])
        ->name('team.create');

    Route::post('/team', [TeamController::class, 'store'])
        ->name('team.store');

    Route::get('/team/{user}/edit', [TeamController::class, 'edit'])
        ->name('team.edit');

    Route::put('/team/{user}', [TeamController::class, 'update'])
        ->name('team.update');

    Route::patch('/team/{user}/toggle-status', [TeamController::class, 'toggleStatus'])
        ->name('team.toggle-status');
});


/*
|--------------------------------------------------------------------------
| Role & Permission Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Team',
])->group(function () {

    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit');

    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update');

    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy');
});


/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Settings',
])->group(function () {

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');

    Route::put('/settings', [SettingsController::class, 'update'])
        ->name('settings.update');
});


/*
|--------------------------------------------------------------------------
| Audit Log Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:Manage Settings',
])->group(function () {

    Route::get('/audit-logs/export', [AuditLogController::class, 'export'])
        ->name('audit-logs.export');

    Route::get('/audit-logs', [AuditLogController::class, 'index'])
        ->name('audit-logs.index');
});


/*
|--------------------------------------------------------------------------
| Notification Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.read-all');
});


/*
|--------------------------------------------------------------------------
| Global Search
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/global-search', GlobalSearchController::class)
        ->name('global.search');
});


/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware([
        'auth',
        'verified',
        'permission:View Dashboard',
    ])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])
        ->name('profile.avatar.remove');
});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';