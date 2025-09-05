## <h1 align="center"> About Vintage Management </h1>

# Inventory Manager

**Inventory Manager** is a web-based application designed to streamline the day-to-day management of retail stores and small businesses. Built with the Laravel PHP Framework, it provides intuitive tools for inventory, sales, suppliers, and employee management.

---

## Features

- **Inventory Management:** Track products, categories, suppliers, and restocking orders.
- **Sales & Transactions:** Built-in point of sale, transaction history, and refund processing.
- **Employee Management:** Manage payrolls, schedules, and employee databases.
- **Reports:** Generate and view sales and inventory reports.
- **Responsive UI:** Built with Tailwind CSS and JavaScript for a modern user experience.

---

## Installation & Setup

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL or compatible database
- Node.js & npm (for frontend assets)
- WampServer/XAMPP/LAMP or any web server

### Steps

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/inventory-manager.git
   cd inventory-manager
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install frontend dependencies:**
   ```sh
   npm install
   npm run build
   ```

4. **Copy and configure your environment file:**
   ```sh
   cp .env.example .env
   ```
   - Set your database credentials and other settings in `.env`.

5. **Generate application key:**
   ```sh
   php artisan key:generate
   ```

6. **Run migrations and seeders:**
   ```sh
   php artisan migrate --seed
   ```

7. **Start the development server:**
   ```sh
   php artisan serve
   ```
   - Or use your preferred web server (Wamp/XAMPP).

---

## Usage

- Access the application at [http://localhost:8000](http://localhost:8000) or your configured domain.
- Register an account and log in to begin managing your inventory and sales.
    - There is a default user Email: "johndoe@gmail.com", Password: "password" That should be deleted if needed.

---

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.  
For major changes, open an issue first to discuss what you would like to change.

---

## Code of Conduct

Please review the [Code of Conduct](https://laravel.com/docs/12.x/contributions#code-of-conduct) before contributing.

---

## Security Vulnerabilities

If you discover a security vulnerability, please submit an issue or contact the maintainer directly.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Credits

Inventory Manager is built on the [Laravel](https://laravel.com/) PHP Framework.  
Special thanks to the Laravel community and sponsors.

---

## Laravel Sponsors

[View Laravel Sponsors](https://laravel.com/sponsors)

---

## Premium Partners

[View Laravel Premium Partners](https://laravel.com/partners)

