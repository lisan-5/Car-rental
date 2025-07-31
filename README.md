# Car Rental Application

A Laravel-based car rental marketplace 🚗 where registered users can seamlessly list vehicles with photos and dynamic pricing, browse and add cars to a personal cart 🛒, submit tailored rental requests 📅 with personalized messages, owners manage their fleet and booking statuses via a sleek dashboard 🛠, and administrators oversee users, cars, and rentals with powerful server-side filtering, sorting, pagination, and role

## Features
 🎯 ## Features
 - 🏠 Browse available cars with photos, specifications, and customizable rental rates
 - 🔒 User registration, login, and profile management
 - 🛒 Add and remove cars from a personal cart
 - 📑 Submit rental requests with custom duration and personalized message
 - 🛠 Owner dashboard: create, edit, delete your car listings
 - ✅ Owner rental management: accept/reject requests and mark cars as rented or available
 - 🌐 Admin user management: list, search, sort, paginate, edit, and delete users
 - 🚗 Admin car management: list, search, sort, paginate, edit, and delete all cars
 - 📋 Admin rental management: view, edit status, and delete all rental requests
 - 🔍 Server-side pagination, sorting, and filtering on admin listings
 - 📊 User dashboard: view your rental request history and status updates
 - 📞 Simple contact form for inquiries


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
