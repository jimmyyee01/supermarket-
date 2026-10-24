# Supermarket POS Application

PHP + MySQL multi-tenant supermarket POS supporting Windows/Android POS machines.

## Features
- Multiple supermarkets (tenants), each with multiple branches
- Role-based users: super_admin, admin, manager, cashier, accountant
- Product catalog, categories, branch stock
- POS sales with items, payments, receipts
- Double-entry bookkeeping (chart of accounts, journal entries)
- Expenses tracking
- Financial reports & analytics: sales, profit, P&L, branch performance

## Setup
1. Import `database/schema.sql` into MySQL.
2. Configure `config/database.php`.
3. Point web server document root to `public/`.
4. Default login: create a super_admin user manually or via seed script.

## Structure
- config/ - configuration
- public/ - front controller (index.php)
- app/controllers/ - controllers
- app/models/ - models
- app/views/ - views
- database/ - SQL schema
- assets/ - css/js

## Running on POS
- Windows: XAMPP/WAMP serving public/, open in Edge/Chrome fullscreen.
- Android: Termux + PHP + MySQL or remote server URL in WebView/kiosk app.
