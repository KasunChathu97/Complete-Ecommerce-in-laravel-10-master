# Quotation: E-Commerce Website

## 1. Project Overview

This quotation covers the design, development, and deployment of a fully-featured E-Commerce Website with integrated wholesale & retail management, online and offline (walk-in) sales handling, social media order management, courier tracking, SMS billing system, accounting, sales reporting, and payment gateway integration.

The system will provide a complete digital solution to manage products, customers, sales staff, orders, and financial reports from a single platform.

### Project Alignment (Implemented in Codebase)

The project has been prepared with database-ready support for the above scope (no UI changes yet):

- Wholesale & retail: product wholesale pricing fields + user customer type
- Walk-in (offline) sales: order source + offline receipt number
- Social media orders: order source + social platform/reference fields
- Courier tracking: order courier fields + shipment tracking events table
- SMS billing: SMS log table linked to orders
- Accounting / reporting: ledger entries table + reporting-friendly order fields

## 2. Scope of Work & Features

### A. E-Commerce Website Features

- Responsive and modern website design (Desktop, Tablet & Mobile)
- Product categories and product management
- Wholesale & retail pricing options
- Customer registration and login system
- Shopping cart and checkout system
- Multiple payment gateway integration (Card, Online Banking, Wallets, etc.)
- Order confirmation and invoice generation

### A1. Code References (Current Project)

Below are the main locations in this Laravel project that implement (or enable) the above features.

#### Responsive Website UI

- Views: `resources/views/frontend/*`
- Layouts: `resources/views/frontend/layouts/*`

#### Product Categories & Product Management

- Admin routes (CRUD): `routes/web.php` (admin group)
	- `Route::resource('/category', 'CategoryController');`
	- `Route::resource('/product', 'ProductController');`
- Models:
	- `app/Models/Category.php`
	- `app/Models/Product.php`

#### Wholesale & Retail Pricing Options

- Database fields (added):
	- `products.wholesale_price`, `products.wholesale_min_qty`
	- `users.customer_type` (retail/wholesale), `users.company_name`
- Migrations:
	- `database/migrations/2026_01_05_000002_add_wholesale_fields_to_products_table.php`
	- `database/migrations/2026_01_05_000003_add_customer_and_staff_fields_to_users_table.php`
- Model fillables:
	- `app/Models/Product.php` includes `wholesale_price`, `wholesale_min_qty`
	- `app/User.php` includes `customer_type`, `company_name`

#### Customer Registration / Login

- Auth routes:
	- `Auth::routes(['register' => false]);`
	- Custom user auth endpoints in `routes/web.php`:
		- `user/login`, `user/register`, `user/logout`

#### Shopping Cart & Checkout

- Routes:
	- `add-to-cart/{slug}`, `single-add-to-cart`, `cart-update`, `checkout`
- Controllers/Models:
	- `app/Http/Controllers/CartController.php`
	- `app/Models/Cart.php`

#### Payment Gateway Integration

- Existing gateway route/controller:
	- `routes/web.php`: `payment`, `payment/success`, `cancel`
	- `app/Http/Controllers/PayPalController.php`

#### Order Confirmation & Invoice (PDF)

- Order creation:
	- `app/Http/Controllers/OrderController.php` (`store()`)
- PDF generation:
	- Route: `order/pdf/{id}`
	- Controller: `OrderController@pdf`
	- Templates:
		- `resources/views/backend/order/pdf.blade.php`
		- `resources/views/user/order/pdf.blade.php`

##### Example Snippets

**Wholesale pricing fields (migration)**

```php
// database/migrations/2026_01_05_000002_add_wholesale_fields_to_products_table.php
$table->decimal('wholesale_price', 12, 2)->nullable();
$table->unsignedInteger('wholesale_min_qty')->default(0);
```

**Order PDF route (web routes)**

```php
// routes/web.php
Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
```

**Order PDF generation (controller)**

```php
// app/Http/Controllers/OrderController.php
public function pdf($id){
		$order = Order::getAllOrder($id);
		$file_name = $order->order_number.'-'.$order->first_name.'.pdf';
		$pdf = PDF::loadview('backend.order.pdf', compact('order'));
		return $pdf->download($file_name);
}
```

### B. Order Management System

- Online orders management (Website orders)
- Centralized order dashboard
- Order status updates (Pending, Processing, Shipped, Delivered, Cancelled)

**Code references (current project)**

- Admin order dashboard:
	- View: `resources/views/backend/order/index.blade.php`
	- Routes: `Route::resource('/order', 'OrderController');` (inside admin group in `routes/web.php`)
- Status updates:
	- Controller: `app/Http/Controllers/OrderController.php` (`update()` validates `status` and updates order)
	- Note: current status values are `new`, `process`, `delivered`, `cancel`.
	  - These map closely to Pending/Processing/Delivered/Cancelled; “Shipped” can be represented via courier tracking events + `orders.shipped_at` (already prepared in DB).

### C. Courier & Delivery Management

- Courier assignment for each order
- Courier tracking number entry

**Code references (current project)**

- Database fields (already prepared):
	- `orders.courier_name`, `orders.tracking_number`
	- Migration: `database/migrations/2026_01_05_000001_add_commerce_extensions_to_orders_table.php`
- Admin management:
	- Edit order: `resources/views/backend/order/edit.blade.php` (courier + tracking number)
	- Save/update: `app/Http/Controllers/OrderController.php` (`update()`)
- Customer view:
	- Order tracking page: `resources/views/frontend/pages/order-track.blade.php` (shows courier + tracking number)

### D. Reports & Analytics

- Product-wise sales reports
- Daily, monthly, and custom date range reports
- Exportable reports (PDF / Excel)

**Code references (current project)**

- Controller:
	- `app/Http/Controllers/ReportController.php`
- Routes (Admin):
	- `admin/reports/product-sales`
	- `admin/reports/sales-summary`
	- Export endpoints:
		- PDF: `.../export/pdf`
		- Excel: `.../export/excel`
- Views:
	- `resources/views/backend/reports/product-sales.blade.php`
	- `resources/views/backend/reports/sales-summary.blade.php`
	- PDF templates:
		- `resources/views/backend/reports/pdf/product-sales.blade.php`
		- `resources/views/backend/reports/pdf/sales-summary.blade.php`
- Excel export package:
	- `maatwebsite/excel` (installed)
	- Export classes:
		- `app/Exports/ProductSalesExport.php`
		- `app/Exports/SalesSummaryExport.php`

### E. Payment Gateway Integration

- Current integration (PayPal):
	- Routes: `routes/web.php`
		- `payment`, `payment/success`, `cancel`
	- Controller: `app/Http/Controllers/PayPalController.php`
	- Config: `config/paypal.php`
- Extension approach for additional gateways (Card/Online Banking/Wallets):
	- Add a new controller (e.g., `StripeController`, `PayHereController`, etc.)
	- Add routes similar to PayPal (initiate/callback/cancel)
	- Store gateway name + payment reference in the order record

**Order payment reference fields (already prepared)**

```php
// database/migrations/2026_01_05_000001_add_commerce_extensions_to_orders_table.php
$table->string('payment_gateway', 50)->nullable();
$table->string('payment_reference', 150)->nullable();
```

### F. Courier Tracking

- Database:
	- Table: `shipment_trackings`
	- Migration: `database/migrations/2026_01_05_000004_create_shipment_trackings_table.php`
	- Model: `app/Models/ShipmentTracking.php`
- Admin management:
	- Routes: `routes/web.php`
		- `order.tracking.store`, `order.tracking.destroy`
	- Controller: `app/Http/Controllers/ShipmentTrackingController.php`
	- Admin UI: `resources/views/backend/order/show.blade.php`
- Customer view:
	- Page: `resources/views/frontend/pages/order-track.blade.php`
	- Handler: `app/Http/Controllers/OrderController.php` (`productTrackOrder()`)

**Tracking event insert (controller)**

```php
// app/Http/Controllers/ShipmentTrackingController.php
ShipmentTracking::create([
		'order_id' => $order->id,
		'status' => $request->status,
		'location' => $request->location,
		'description' => $request->description,
		'event_time' => $request->event_time,
		'created_by' => auth()->id(),
]);
```

### G. SMS Billing System

- Database:
	- Table: `sms_logs`
	- Migration: `database/migrations/2026_01_05_000005_create_sms_logs_table.php`
	- Model: `app/Models/SmsLog.php`
- Notes:
	- Current project includes the logging structure; provider integration can be wired to write logs on send/response.

**SMS log schema (migration)**

```php
// database/migrations/2026_01_05_000005_create_sms_logs_table.php
$table->string('phone', 50);
$table->text('message');
$table->string('provider', 100)->nullable();
$table->string('status', 30)->default('queued');
$table->timestamp('sent_at')->nullable();
```

### H. Accounting & Sales Reporting (Foundation)

- Accounting ledger (foundation):
	- Table: `ledger_entries`
	- Migration: `database/migrations/2026_01_05_000006_create_ledger_entries_table.php`
	- Model: `app/Models/LedgerEntry.php`
- Reporting-ready order fields:
	- Source fields: `orders.order_source`, `orders.sales_staff_id`, `orders.payment_gateway`, `orders.payment_reference`
- Existing report example:
	- Income chart method: `app/Http/Controllers/OrderController.php` (`incomeChart()`)

**Ledger entry schema (migration)**

```php
// database/migrations/2026_01_05_000006_create_ledger_entries_table.php
$table->date('entry_date');
$table->string('entry_type', 10); // debit | credit
$table->decimal('amount', 12, 2);
$table->string('reference_type', 50)->nullable();
$table->unsignedBigInteger('reference_id')->nullable();
```

### F. Admin Panel

- Secure admin login
- User, product, order, and report management

**Code references (current project)**

- Admin login (secure):
	- Default auth login page: `resources/views/auth/login.blade.php`
	- Access restricted to roles `admin`, `staff`, `salesman` in: `app/Http/Controllers/Auth/LoginController.php`
	- Admin area protection:
		- `routes/web.php` admin groups use `auth` + role/admin middleware
		- Middleware: `app/Http/Middleware/Admin.php`, `app/Http/Middleware/Role.php`

- User management (Admin only):
	- Routes: `Route::resource('users', 'UsersController');` (inside admin-only group)
	- Controller: `app/Http/Controllers/UsersController.php`
	- Views: `resources/views/backend/users/*`

- Product management (Admin only):
	- Routes: `Route::resource('/product', 'ProductController');`
	- Controller: `app/Http/Controllers/ProductController.php`
	- Views: `resources/views/backend/product/*`

- Order management (Admin/Staff/Salesman):
	- Routes: `Route::resource('/order', 'OrderController');`
	- Controller: `app/Http/Controllers/OrderController.php`
	- Views: `resources/views/backend/order/*`

- Report management (Admin/Staff/Salesman):
	- Controller: `app/Http/Controllers/ReportController.php`
	- Routes: `admin/reports/product-sales`, `admin/reports/sales-summary`
	- Views: `resources/views/backend/reports/*`

## 3. Technology & Platform

### Secure Database & Server-Side Architecture

- Framework: Laravel (server-side MVC), Eloquent ORM, migrations
- Security foundations used by the project:
	- CSRF protection (web middleware): `app/Http/Kernel.php` (web group includes `VerifyCsrfToken`)
	- Password hashing: `Illuminate\Support\Facades\Hash` usage in `app/Http/Controllers/UsersController.php`
	- Authentication: Laravel auth (`Auth::routes`) + route middleware (`auth`, `admin`, `role`, `user`) in `routes/web.php`
	- Role-based access control (RBAC): `app/Http/Middleware/Admin.php`, `app/Http/Middleware/Role.php`
	- Input validation: controller validation rules across controllers (examples: `OrderController@store`, `OrderController@update`)

### SSL Security Implementation

- SSL/TLS is implemented at the hosting/web-server layer (Nginx/Apache/IIS) by installing an SSL certificate and forcing HTTPS.
- Laravel supports proxy/HTTPS awareness via:
	- Proxy handling: `app/Http/Middleware/TrustProxies.php`
	- App URL and session/cookie settings: `.env` (`APP_URL`) and `config/session.php` (`secure`, `same_site`)

### Secure Payment Gateway Integration

- Current payment gateway in project: PayPal
	- Controller: `app/Http/Controllers/PayPalController.php`
	- Config: `config/paypal.php` (should read credentials from `.env`)
	- Routes: `routes/web.php` (`payment`, `payment/success`, `cancel`)
- Payment traceability fields already prepared on orders:
	- `orders.payment_gateway`, `orders.payment_reference` (migration: `database/migrations/2026_01_05_000001_add_commerce_extensions_to_orders_table.php`)

### Regular Data Backup Support

- Recommended backup coverage:
	- Database backups (SQL dump / managed DB snapshots)
	- Uploaded files (the `storage/app/public` directory) + `.env` (kept secure)
- Operational approach:
	- Run backups on a schedule (cron / Windows Task Scheduler) and store copies off-server
	- Test restores periodically (backup is only useful if restore works)
- Laravel provides a scheduler entry point if you later want automated scheduled jobs:
	- `app/Console/Kernel.php` (scheduled tasks)
	- Command runner: `php artisan schedule:run`
