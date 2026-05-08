# Cutler Code Business Website

## Table of Contents

- [Description](#description)
- [Features](#features)
- [Technologies](#technologies)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Testing](#testing)
- [Deployment](#deployment)
- [Contact](#contact)
- [Screenshots](#screenshots)
- [Database Design](#database-design)
- [RESTful Endpoints](#restful-endpoints)

## Description

This is a Laravel-based business website for Cutler Code, a future software development company. The platform allows clients to submit project requests, view company services, and manage notifications. It features user authentication, an admin dashboard for request management, and a responsive frontend built with modern web technologies.

## Features

- User registration and authentication system
- Project request submission form with detailed fields
- Admin dashboard for managing client requests
- Notification system for updates on requests
- Responsive design optimized for desktop and mobile
- Secure user sessions and role-based access control

## Technologies

- **Backend**: Laravel 13 (PHP Framework)
- **Frontend**: Blade templates, Vite, JavaScript
- **Database**: MySQL
- **Styling**: CSS
- **Testing**: PHPUnit
- **Package Management**: Composer (PHP), NPM (JavaScript)

## Prerequisites

Before setting up the project, ensure you have the following installed:

- PHP >= 8.3
- Composer >= 2.2
- MySQL or compatible database server
- Node.js and NPM (optional, for frontend asset compilation)

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/CutlerCode/cutler-code.git
   cd cutler-code
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies** (optional, for frontend):
   ```bash
   npm install
   ```

4. **Environment configuration**:
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

6. **Database setup**:
   - Create a MySQL database named `cutler_code`.
   - Update the `.env` file with your database credentials.

7. **Run database migrations**:
   ```bash
   php artisan migrate
   ```

8. **Build frontend assets** (optional):
   ```bash
   npm run build
   ```

## Configuration

The application uses environment variables for configuration. Key settings in `.env`:

- `APP_NAME`: Application name (default: Cutler Code)
- `APP_ENV`: Environment (local, production)
- `APP_KEY`: Application encryption key (generated automatically)
- `APP_DEBUG`: Debug mode (true for development)
- `DB_CONNECTION`: Database connection type (mysql)
- `DB_HOST`: Database host
- `DB_PORT`: Database port (default: 3306)
- `DB_DATABASE`: Database name (cutler_code)
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password
- `MAIL_MAILER`: Email service (smtp, etc.)
- `MAIL_HOST`: SMTP host
- `MAIL_PORT`: SMTP port
- `MAIL_USERNAME`: SMTP username
- `MAIL_PASSWORD`: SMTP password

## Usage

To run the application locally:

1. Start the development server:
   ```bash
   php artisan serve
   ```

2. Open your browser and navigate to `http://localhost:8000`.

For frontend development with hot reloading:
```bash
npm run dev
```

## Testing

The project includes unit and feature tests using PHPUnit. To run the test suite:

```bash
./vendor/bin/phpunit
```

Or using Composer:
```bash
composer test
```

## Deployment

For production deployment:

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`.
2. Configure your web server (Apache/Nginx) to serve the `public/` directory.
3. Ensure proper file permissions for storage and cache directories.
4. Run database migrations on the production server.
5. Build and optimize frontend assets:
   ```bash
   npm run build
   ```
6. Set up SSL certificates for secure HTTPS connections.
7. Configure environment-specific settings (database, mail, etc.).

## Contact

For questions, support, or business inquiries:

- Email: [calexcutler@gmail.com]
- Website: [https://cacutler.github.io]
- GitHub: [https://github.com/CutlerCode/cutler-code](https://github.com/CutlerCode/cutler-code)

## Screenshots

### Home Screen

![Home Screen](Home.png)

### About Screen

![About Screen](About.png)

### Skills Screen

![Skills Screen](Skills.png)

### Requests Screen

![Requests Screen](Requests.png)

### Projects Screen

![Projects Screen](Projects.png)

### Pricing Screen

![Pricing Screen](Pricing.png)

## Database Design

### Requests

- ID: bigint unsigned and primary key
- Name: varchar(255)
- Goal: text
- Email: varchar(255)
- Company Name (company_name): varchar(255)
- Website: varchar(255)
- Employees: int
- Location: varchar(255)
- Phone: varchar(255)
- Challenge: text
- Comments: text
- Status: enum('pending','in_progress','completed','cancelled')
- Created At (created_at): timestamp
- Updated At (updated_at): timestamp

### Notifications

- ID: char(36) and primary key
- Type: varchar(255)
- Notifiable Type (notifiable_type): varchar(255) and composite
- Notifiable ID (notifiable_id): bigint unsigned
- Data: text
- Read At (read_at): timestamp
- Created At (created_at): timestamp
- Updated At (updated_at): timestamp

### Users

- ID: bigint unsigned and primary key
- Name: varchar(255)
- Email: varchar(255) and unique
- Email Verified At (email_verified_at): timestamp
- Password: varchar(255)
- Remember Token (remember_token): varchar(100)
- Is Admin (is_admin): tinyint(1)
- Created At (created_at): timestamp
- Updated At (updated_at): timestamp

## RESTful Endpoints

| Name                                    | Method | Path                                      | Middleware        | Route Name                  | Controller/Action                          |
| --------------------------------------- | ------ | ----------------------------------------- | ----------------- | --------------------------- | ------------------------------------------ |
| Retrieve home page                      | GET    | /                                         | N/A               | home                        | N/A                                        |
| Retrieve about page                     | GET    | /about                                    | N/A               | about                       | N/A                                        |
| Retrieve skills page                    | GET    | /skills                                   | N/A               | skills                      | N/A                                        |
| Retrieve projects page                  | GET    | /projects                                 | N/A               | projects                    | N/A                                        |
| Retrieve pricing page                   | GET    | /pricing                                  | N/A               | pricing                     | N/A                                        |
| Retrieve requests page                  | GET    | /requests                                 | N/A               | requests.create             | RequestController - create                 |
| Create request member                   | POST   | /requests                                 | N/A               | requests.store              | RequestController - store                  |
| Retrieve login page                     | GET    | /login                                    | N/A               | login                       | AuthController - showLogin                 |
| Create user session                     | POST   | /login                                    | N/A               | login.post                  | AuthController - login                     |
| Retrieve register page                  | GET    | /register                                 | N/A               | register                    | AuthController - showRegister              |
| Create user member                      | POST   | /register                                 | N/A               | register.post               | AuthController - register                  |
| Delete user session                     | POST   | /logout                                   | N/A               | logout                      | AuthController - logout                    |
| Retrieve dashboard page                 | GET    | /dashboard                                | Auth, Admin       | dashboard                   | DashboardController - index                |
| Retrieve requests collection            | GET    | /admin/requests                           | Auth, Admin       | requests.index              | RequestController - index                  |
| Retrieve request member                 | GET    | /admin/requests/{*request*}               | Auth, Admin       | requests.show               | RequestController - show                   |
| Delete request member                   | DELETE | /admin/requests/{*request*}               | Auth, Admin       | requests.destroy            | RequestController - destroy                |
| Update request member status            | PATCH  | /admin/requests/{*request*}/status        | Auth, Admin       | requests.updateStatus       | RequestController - updateStatus           |
| Retrieve notifications collection       | GET    | /notifications                            | Auth, Admin       | notifications.index         | RequestController - notifications          |
| Update notification member as read      | GET    | /notifications/{*notification*}/mark-read | Auth, Admin       | notifications.mark-read     | RequestController - markAsRead             |
| Update all notification members as read | GET    | /notifications/mark-all-read              | Auth, Admin       | notifications.mark-all-read | RequestController - markAllAsRead          |
| Delete notification member              | DELETE | /notifications/{*notification*}           | Auth, Admin       | notifications.delete        | RequestController - deleteNotification     |
| Delete all notification members         | DELETE | /notifications                            | Auth, Admin       | notifications.delete-all    | RequestController - deleteAllNotifications |