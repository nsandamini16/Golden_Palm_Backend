# Golden Palm Resort Frontend & Backend

This repository contains the full-stack web application for the Golden Palm Resort. It features a complete frontend design with a functional backend built using PHP and MySQL. 

## Features

- **Responsive Frontend:** HTML5, CSS3, and JavaScript used for an interactive user interface.
- **User Authentication:** Registration, Login, and Logout functionality.
- **Dashboard:** A personalized dashboard for logged-in users.
- **Contact Form:** Functional contact page that stores user inquiries in the database.
- **Secure Backend:** PHP logic utilizing PDO/MySQLi with prepared statements to prevent SQL injection.

## Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Environment:** XAMPP (Localhost)

## Project Structure

```
6307_Project/
│
├── auth/                   # Authentication scripts (Login, Register, Logout)
├── images/                 # Image assets for the frontend
├── includes/               # Reusable backend components (db.php, functions.php)
├── database.sql            # SQL schema for creating the necessary database and tables
├── index.html              # Main landing page
├── auth.html               # Frontend page for login and registration
├── contact.html            # Contact us page frontend
├── contact.php             # Script to handle contact form submissions
├── dashboard.php           # User dashboard accessed after successful login
├── styles.css              # Global stylesheets
├── script.js               # Global JavaScript logic
└── README.md               # Project documentation
```

## Setup Instructions

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) installed on your local machine.

### Installation & Configuration

1. **Clone the repository:**
   Clone this project into your XAMPP `htdocs` directory.
   ```bash
   git clone <your-repository-url> C:\xampp\htdocs\6307_Project
   ```

2. **Start XAMPP Services:**
   Open the XAMPP Control Panel and start the **Apache** and **MySQL** modules.
   *(Note: This project is configured to run MySQL on Port **3307**. If your XAMPP MySQL uses the default 3306, you may need to update the database connection in `includes/db.php`.)*

3. **Database Setup:**
   - Open your browser and navigate to `http://localhost/phpmyadmin/`.
   - Go to the **Import** tab.
   - Choose the `database.sql` file located in the root of the project folder.
   - Click **Import** to create the `golden_palm_resort` database and its necessary tables (`users`, `messages`).

4. **Run the Application:**
   Open your web browser and go to:
   ```
   http://localhost/6307_Project/index.html
   ```

## Database Schema Overview

The database `golden_palm_resort` contains two primary tables:
- `users`: Stores registered user information (username, unique email, hashed passwords).
- `messages`: Stores inquiries submitted through the contact form (name, email, message body).

## Security Measures

- **Password Hashing:** Passwords are fully hashed before being stored in the database.
- **Prepared Statements:** All database queries utilize prepared statements to defend against SQL Injection attacks.
- **Session Management:** PHP sessions are used to control access to restricted pages such as the dashboard.

## Acknowledgments

- Designed and developed as an academic/university project.
- Golden Palm Resort Wireframes and specifications.
