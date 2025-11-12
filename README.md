# Gym Management System

A beginner-friendly gym management system built with HTML, CSS, JavaScript, PHP, and MySQL.

## Features

- Trainee registration and login
- User dashboard with BMI calculation
- Payment processing
- Secure session management

## Setup Instructions

### 1. Database Setup

1. Start your MySQL server
2. Import the database:
   ```bash
   mysql -u root -p < database.sql
   ```
   Or manually run the SQL commands in `database.sql`

### 2. Configure Database Connection

Edit `db.php` and update your MySQL credentials:

- `$user` - your MySQL username (default: root)
- `$pass` - your MySQL password

### 3. Run the Application

1. Start your PHP server:
   ```bash
   php -S localhost:8000
   ```
2. Open your browser and go to: `http://localhost:8000`

## Project Structure

- `index.html` - Home page
- `login.html` - Login page
- `register.html` - Registration page
- `dashboard.php` - User dashboard with BMI
- `payment.php` - Payment processing
- `style.css` - Styling
- `db.php` - Database connection
- `database.sql` - Database schema

## Default Usage

1. Register as a new trainee
2. Login with your credentials
3. View your dashboard with BMI calculation
4. Make payments

## Security Notes

WARNING: This is a beginner project for learning purposes. For production use:

- Use prepared statements to prevent SQL injection
- Hash passwords (use `password_hash()` and `password_verify()`)
- Add CSRF protection
- Validate and sanitize all inputs
- Use HTTPS
