# Project Setup

## Requirements
- XAMPP (or any similar local server environment)
- Apache and MySQL services running

## Setup Instructions

1. **Install XAMPP:**
   - Download and install XAMPP from [Apache Friends](https://www.apachefriends.org/index.html).

2. **Start Services:**
   - Open the XAMPP Control Panel.
   - Start the Apache and MySQL services.

3. **Create Database:**
   - Open phpMyAdmin (usually accessible at `http://localhost/phpmyadmin`).
   - Create a new database named `blog2`.
   - Import the `/database/setup.sql` script to set up the necessary tables.

4. **Create Uploads Folder:**
   - In the root directory of your project, create a folder named `uploads`.
   - Ensure this folder has the necessary write permissions.

## Additional Notes
- Ensure your PHP version is compatible with the codebase.
- Adjust any necessary configurations in `config/db.php` for database connection settings.
