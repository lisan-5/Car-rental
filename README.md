# Car Rental Application

This is a Laravel-based Car Rental web application where users can browse available cars, submit rental requests, and manage their own listings. Owners can accept or reject requests, and mark cars as rented or available.

## Features
- User registration, login, and profile management
- Browse cars with photos, specifications, and rental rates
- Add cars for rent with image upload and pricing options (daily, weekly, monthly)
- Add and remove cars from a personal cart
- Submit rental requests with custom duration and message
- Dashboard for owners: view, edit, delete cars, and manage rental requests (accept/reject)
- Automatic filtering of rented cars from the public listings
- Simple contact form for inquiries

## Requirements
- PHP >= 8.0
- Composer
- Node.js & npm
- A supported database (MySQL, PostgreSQL, SQLite)

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/lisan-5/car-rental.git
   cd car-rental
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JavaScript dependencies:
   ```bash
   npm install
   npm run dev
   ```
4. Copy the example environment file and update settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Configure database connection in `.env`.
6. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```
   Visit http://localhost:8000


## Usage
- Register a new account or login with an existing one
- Browse the **Cars** page to view available vehicles
- Add items to your cart or submit a rental request directly
- Owners can manage their listings in **Dashboard** and handle requests

## Testing
Run the PHPUnit test suite:
```bash
php artisan test
```

## Contributing
1. Fork the repository
2. Create a new feature branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m 'Add feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Create a Pull Request

## License
This project is open-source and available under the [MIT License](LICENSE).
