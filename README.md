# Symfony-Task-Manager-App

A task management application built with Symfony. 

## Prerequisites
Before running this project, ensure you have the following installed on your local machine:
* PHP 8.5 or higher
* Composer
* XAMPP (for MySQL/MariaDB and local server environment)
* Git

## Local Setup Instructions

**1. Clone the repository**
Open your terminal and clone this project to your local machine:
`git clone https://github.com/JCValdez20/Symfony-Task-Manager-App.git`

**2. Install dependencies**
Navigate into the project directory and install the required Symfony packages:
`cd Symfony-Task-Manager-App`
`composer install`

**3. Configure the Database Connection**
Open the `.env` file in the root directory. Find the `DATABASE_URL` variable and update it with your local XAMPP MySQL credentials. 
For a default XAMPP setup, it should look like this:
`DATABASE_URL="mysql://root:@127.0.0.1:3306/symfony_db?serverVersion=10.11.2-MariaDB&charset=utf8mb4"`

**4. Create the Database and Tables**
Run the following Doctrine commands to build the database and execute the migrations:
`php bin/console doctrine:database:create`
`php bin/console doctrine:migrations:migrate`

**5. Start the Local Server**
Run the built-in Symfony server to view the application in your browser:
`symfony server:start`

Navigate to `http://localhost:8000` to view the app!