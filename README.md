# GSB Expense Management with Laravel

This GSB Expense Management project is a web application developed using the Laravel framework. It allows users to enter their expenses for the current month or view expenses from previous months. Supported expenses include: Travel Allowance, Mileage, Hotel Overnight, and Restaurant Meals.

In addition, the application provides features for accountants to manage user expenses, including viewing and modifying them. Accountants can review and approve expenses submitted by users, ensuring compliance with company policies and accurate expense reporting.

This application is a simple yet powerful tool for effectively managing both user and accountant professional expenses. ✅

<p align="center">
  <img alt="Laravel" src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" width="50" height="50"/>
  <img alt="PHP" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" width="50" height="50"/>
  <img alt="MySQL" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg" width="50" height="50"/>
  <img alt="HTML" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" width="50" height="50"/>
  <img alt="CSS" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" width="50" height="50"/>
</p>

## Features

- ✏️ **Expense Entry and Viewing**: Users can enter their expenses for the current month or view expenses from previous months.
- 📊 **Expense Management by an Accountant**: Accountants can modify, approve, or reject expenses submitted by users, ensuring accurate expense reporting.
- 📄 **Expense Download as PDF**: Ability to download expenses for each month in PDF format.

## Additional Features

- 👩‍💼 **Accountant Interface**: An interface for accountants to manage user expenses, including viewing, modifying, approving, or rejecting them.
- 📝 **Expense Authorization**: Authorization system to ensure only authorized accountants can access and modify user expenses, maintaining data integrity and security.
- 📜 **PDF Generation**: Generate PDF reports for user expenses, allowing for easy printing, sharing, and record-keeping.


## Prerequisites

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)

## Installation

1. **Clone the repository**:
   ```
   git clone https://github.com/your-username/gsb-expense-management.git
   ```
2. **Navigate to the project directory**:
   ```
   cd gsb-expense-management
   ```
3. **Install dependencies**:
   ```
   composer install
   ```
4. **Configure environment variables**:
   ```
   cp .env.example .env
   ```
5. **Generate a Laravel application key**:
   ```
   php artisan key:generate
   ```
6. **Migrate the database**:
   ```
   php artisan migrate --seed
   ```
7. **Run the application**:
   ```
   php artisan serve
   ```

## Learn More

You can learn more about Laravel and web development in general through various online resources and tutorials. Check out the [Laravel documentation](https://laravel.com/docs) for comprehensive guides and examples.

## Contribution

Contributions are welcome! Feel free to fork the repository and submit pull requests to improve the GSB Expense Management application.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---
