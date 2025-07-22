# Rental Property Management System Documentation

## README

### Overview

The Rental Property Management System is a comprehensive platform designed for managing rental properties, expenses, issues, reviews, contracts, and payments. It provides an integrated solution for landlords and tenants to streamline property management tasks.

### Features

- **Expense Tracking**: Log, categorize, and manage recurring expenses with receipt upload capabilities.
- **Issue Management**: Report, track, and resolve property issues with real-time updates and notifications.
- **Reviews**: Submit and view reviews for landlords and tenants to foster transparency and trust.
- **Payment Confirmation**: Landlords can create expenses, and tenants can confirm payments with proof uploads.
- **Contract Management**: Upload, create, and sign contracts electronically using DocuSign integration.
- **Property Management**: Add and manage properties with detailed information and associate tenants with properties.

### Requirements

- PHP >= 8.0
- Composer
- Laravel >= 9.x
- Filament PHP >= 2.x
- MySQL >= 5.7 or other supported database
- Node.js and npm for frontend assets

### Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-repository/rental-property-management.git
   cd rental-property-management
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**

   Copy the `.env.example` file to `.env` and configure your environment variables, including database settings and API keys for DocuSign and other services.

   ```bash
   cp .env.example .env
   ```

   Generate an application key:

   ```bash
   php artisan key:generate
   ```

4. **Database Setup**

   Create a database for the application and update the `.env` file with your database credentials. Run the migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```

5. **Compile Assets**

   ```bash
   npm run dev
   ```

6. **Serve the Application**

   ```bash
   php artisan serve
   ```

### Usage

Access the application in your web browser at `http://localhost:8000`. Register as a landlord or tenant to start managing properties, expenses, issues, and contracts.

### Configuration

- **DocuSign Integration**: Configure your DocuSign API credentials in the `.env` file to enable electronic signatures.
- **Payment Gateways**: Set up your payment gateway credentials for processing rent and expense payments.
- **Email Notifications**: Configure your mail server settings to enable email notifications for reminders and updates.

### Testing

Run the test suite using PHPUnit:

```bash
php artisan test
```

### Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your changes. Ensure that your code adheres to the project's coding standards and includes appropriate tests.

### License

The Rental Property Management System is open-source software licensed under the MIT license.

---

## Coding Standards

### PHP Coding Standards

1. **PSR-12 Compliance**: Follow the PSR-12 coding standard for PHP code. Use tools like PHP_CodeSniffer to enforce these standards.

2. **Naming Conventions**:
   - Use camelCase for variable and function names.
   - Use PascalCase for class and interface names.
   - Use snake_case for table and column names in the database.

3. **Code Organization**:
   - Keep controllers lean by moving business logic to service classes.
   - Use Laravel's dependency injection for class dependencies.
   - Organize code into appropriate directories (e.g., `app/Models`, `app/Services`, `app/Http/Controllers`).

4. **Comments and Documentation**:
   - Use PHPDoc blocks to document classes, methods, and properties.
   - Include inline comments to explain complex logic or workarounds.

### Laravel Specific Standards

1. **Migrations**: Use Laravel's migration system for database schema changes. Include both `up` and `down` methods to allow for rollbacks.

2. **Eloquent Models**: Use Eloquent ORM for database interactions. Define relationships between models and use accessors/mutators for custom logic.

3. **Validation**: Use Laravel's validation system to validate incoming request data. Create Form Request classes for complex validation logic.

4. **Blade Templates**: Use Blade templating for views. Keep templates clean and avoid complex logic in views.

### Filament PHP Standards

1. **Resource Classes**: Organize Filament resources in the `app/Filament/Resources` directory. Each resource should have a corresponding model and follow Filament's conventions.

2. **Forms and Tables**: Use Filament's form and table builders to create consistent and reusable components. Customize fields and columns as needed for your application.

3. **Widgets**: Create custom widgets for dashboards and other reusable components. Place widget classes in the `app/Filament/Widgets` directory.

### JavaScript and CSS Standards

1. **ES6 Compliance**: Use modern JavaScript (ES6+) for frontend code. Use tools like ESLint to enforce coding standards.

2. **Alpine.js**: Utilize Alpine.js for adding interactivity to your frontend components. Alpine.js is a rugged, minimal framework for composing JavaScript behavior in your markup. Here are some guidelines for using Alpine.js:
   - **Directives**: Use Alpine.js directives like `x-data`, `x-bind`, `x-on`, etc., to add behavior to your HTML elements.
   - **Reactivity**: Leverage Alpine's reactivity system to manage state within your components.
   - **Organization**: Keep your Alpine.js code organized by using component-based structures. You can define components within your Blade templates or separate JavaScript files.
   - **Example**:
     ```html
     <div x-data="{ open: false }">
         <button @click="open = true">Open Dropdown</button>
         <div x-show="open" @click.away="open = false">
             Dropdown Content
         </div>
     </div>
     ```

3. **Sass/SCSS**: Use Sass or SCSS for stylesheets. Organize styles into partials and use meaningful class names. Ensure that your styles are modular and reusable.

4. **Responsive Design**: Implement responsive design principles to ensure that your application is accessible and user-friendly on various devices and screen sizes.

5. **Performance**: Optimize your JavaScript and CSS for performance. Minimize the use of large libraries and ensure that your assets are properly compressed and cached.

### Testing Standards

1. **Pest**: Write unit and feature tests using Pest, a more expressive and modern testing framework for PHP. Place tests in the tests directory and follow Laravel's testing conventions with Pest's syntax. 

2. **Test Coverage**: Aim for high test coverage, especially for critical business logic. Use tools like PHPUnit's coverage reports to identify untested code.

3. **Mocking**: Use Laravel's mocking utilities or libraries like Mockery to mock external dependencies in tests.

### Version Control

1. **Git**: Use Git for version control. Follow a branching strategy like Git Flow or GitHub Flow.

2. **Commits**: Write meaningful commit messages that describe the changes made. Use the imperative mood and include a reference to any related issues or tickets.

3. **Pull Requests**: Submit changes via pull requests and include a description of the changes and any relevant context. Ensure that pull requests are reviewed and approved before merging.
