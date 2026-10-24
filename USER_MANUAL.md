# Supermarket POS — User Manual

## 1. Getting Started
### Installation
1. Install PHP 8+, MySQL 8+, Apache/Nginx.
2. Import `database/schema.sql` into MySQL.
3. Run `php database/seed.php` to create demo data (login: admin / admin123).
4. Configure `config/database.php` with DB credentials.
5. Point web root to `public/`. Access http://localhost.

### Windows POS
- Install XAMPP, place project in htdocs, start Apache+MySQL.
- Open Chrome/Edge in kiosk mode: `chrome.exe --kiosk http://localhost/supermarket-pos/public`.

### Android POS
- Use Termux: install php/mysql, or point to remote server URL.
- Or wrap URL in a WebView kiosk app.

## 2. Roles
- super_admin: platform-wide
- admin: supermarket account admin (manage branches, users, products)
- manager: branch manager
- cashier: POS sales
- accountant: reports, books of accounts

## 3. Modules
### Supermarkets & Branches
Admin creates supermarkets and branches. Each branch has its own stock.

### Products
Admin manages products, categories, prices, cost prices, tax rates.

### POS
Cashier selects products, builds cart, chooses payment method, checks out. Stock auto-deducts. Receipt number generated.

### Customers
Optional customer linking, loyalty points.

### Reports & Analytics
Dashboard: today's sales, product/branch counts.
Reports page: date-range sales, cost of goods, gross profit, expenses, net profit.

### Books of Accounts
Chart of accounts per supermarket. Journal entries (double entry) for sales, expenses, etc. Accountant manages.

## 4. Payment Gateways
Supported: Cash, Card, Mobile Money (MTN MoMo, Airtel Money), Stripe, Flutterwave, Paystack.
Configure keys in `config/payments.php`. Each sale stores payment_method and reference.

## 5. Troubleshooting
- 404: check front controller routing / base path.
- DB errors: verify credentials and schema imported.
- Blank page: enable display_errors in php.ini.
