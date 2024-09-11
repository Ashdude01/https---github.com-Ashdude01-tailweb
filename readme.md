# tailweb
Simple PHP project (Student Listing)
---\

### Instruction to run this project in local environment

## Requirements
Before running this project, ensure you have the following installed on your system:

- PHP 7.x or higher
- MySQL or MariaDB
- Web server (Apache or Nginx) or PHP's built-in server

---
## Installation
---

### 1. Move Your PHP Project to XAMPP Directory
 Go to your XAMPP installation directory. Typically:
   On Windows: C:\xampp\htdocs
   On macOS/Linux: /Applications/XAMPP/htdocs/

        --OR--
        
### Clone the repository
[https://github.com/Ashdude01/tailweb-test.git](https://github.com/Ashdude01/tailweb-test.git)

### Install Required Dependency (if required)
composer install

### 2. Configure Database

If your project uses a MySQL database, follow these steps:

  Open phpMyAdmin:
      Go to http://localhost/phpmyadmin in your browser.
      This will take you to the phpMyAdmin interface, where you can manage databases.

  Create a new database:
      Click on Databases at the top.
      Enter a name for your database (e.g., my_database) and click Create.

  Import an existing database (SQL file provided in database folder):
      Click on the Import tab in phpMyAdmin.
      Choose the SQL file (.sql) from your project and click Go to import it.

  Update your project’s database configuration:
        Open the project’s configuration file *dbConfig.php* and update the database connection details:

### 3. Access This PHP Project in Browser
  Open your web browser and type the following URL:
  http://localhost/tailweb/


--The END--


