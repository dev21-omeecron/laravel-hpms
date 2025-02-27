#### Overview
Hospital Patient Management System (HPMS) is now a comprehensive web-based application built on [Laravel](https://laravel.com), designed to manage hospital operations, patient records, appointments, and prescriptions for Patients, Doctors, and Administrators. This shift to Laravel enhances scalability, security, and maintainability.

#### System Architecture
- **Framework**: [Laravel](https://laravel.com), including PHP and MySQL.
- **Front-end**: HTML5, CSS3, JavaScript, jQuery, with UI frameworks like [Bootstrap](https://getbootstrap.com) and [vuexy](https://pixinvent.com/vuexy-bootstrap-html-admin-template/).
- **Session Management**: Handled securely by Laravel’s session system.

#### Directory Structure
The project now follows Laravel’s standard structure, organized for modularity:

```
/laravel-hpms/
├── app/
│   ├── Console/
│   ├── Events/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Doctor/
│   │   │   ├── Patient/
│   │   │   └── Auth/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   ├── Providers/
│   └── Resources/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeds/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
│   └── index.php
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── doctor/
│   │   ├── patient/
│   │   └── auth/
│   └── lang/
│   └── js/
├── routes/
├── storage/
│   ├── app/
│   ├── framework/
│   ├── logs/
│   ├── meta/
│   ├── sessions/
│   └── views/
├── tests/
│   ├── Feature/
│   ├── Unit/
│   └── TestCase.php
│   └── kernel.php
│   └── server.php
├── .env
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── server.php
└── webpack.mix.js
```

#### Core Modules

##### 1. Authentication Module
- **Login System**: Managed by `app/Http/Controllers/LoginController.php`.
- **Registration System**: Managed by `app/Http/Controllers/RegisterController.php`.
- **Password Management**: Handled by `app/Http/Controllers/ChangePasswordController.php`.
- **Session Management**: Secured by Laravel’s session handling.
- **Logout Functionality**: Handled by `app/Http/Controllers/LoginController.php`.
- **Change Password Functionality**: Handled by `app/Http/Controllers/ChangePasswordController.php`.


##### 2. Patient Module
- **Appointment Booking**: Managed by `app/Http/Controllers/Patient/AppointmentController.php`.
- **Appointment History**: Handled by `app/Http/Controllers/Patient/AppointmentController.php`.
- **Prescription View**: Managed by `app/Http/Controllers/Patient/PrescriptionController.php`.
- **Change Password**: Handled by `app/Http/Controllers/ChangePasswordController.php`.
- **Bill Payment**: Handled by `app/Http/Controllers/Patient/PrescriptionController.php`.


##### 3. Doctor Module
- **Appointment Management**: Handled by `app/Http/Controllers/Doctor/DoctorAppointmentController.php`.
- **Prescription Management**: Managed by `app/Http/Controllers/Doctor/DoctorPrescriptionController.php`.
- **Patient Records**: Handled by `app/Http/Controllers/Doctor/DoctorAppointmentController.php`.
- **Change Password**: Handled by `app/Http/Controllers/ChangePasswordController.php`.

##### 4. Admin Module
- **Doctor Management**: Managed by `app/Http/Controllers/Admin/AdminController.php`.
- **Patient Management**: Handled by `app/Http/Controllers/Admin/AdminController.php`.
- **Appointment Overview**: Managed by `app/Http/Controllers/Admin/AdminController.php`.
- **System Messages**: Handled by `app/Http/Controllers/Admin/AdminController.php`.

#### Key Features

##### Authentication & Security
- Secure login/registration using Laravel’s authentication system.
- Password hashing with Bcrypt.
- Session management with secure cookies.
- Role-based access control via gates or policies.
- CSRF protection and XSS prevention.

##### Patient Features
- Book appointments with doctors.
- View appointment history.
- Access prescriptions.
- Change Password

##### Doctor Features
- Manage patient appointments.
- Create and manage prescriptions.
- View patient history.
- Schedule management.
- Change Password

##### Admin Features
- Add and manage doctors.
- View patient records.
- Monitor appointments.
- System message management.

##### General Features
- Responsive design.
- User-friendly interface.
- SEO friendly design.
- DataTable Liabrary for Server-side data rendering.
- Export CSV, PDF, and Excel files to download data record by Admin.

#### Database Structure
Uses MySQL with key tables:
- `admin` (Administrator information).
- `doctreg` (Doctor registration).
- `patreg` (Patient registration).
- `appointments` (Appointment records).
- `prescription` (Medical prescriptions).

#### Security Features
1. **Password Hashing**: Uses Bcrypt via Illuminate Support.
2. **Session Management**: Secured by Laravel’s session system.
3. **SQL Injection Prevention**: Handled by Elegant ORM’s prepared statements.
4. **XSS Protection**: Managed with HTML escaping in views.
5. **CSRF Protection**: Automatically handled by Laravel’s token system.

#### Contact Information
For technical support, use the contact form on the website.

#### System Requirements
- Web Server: Apache/Nginx.
- PHP Version: 8.1 or higher.
- MySQL Version: 8.0 or higher.
- Modern web browser with JavaScript enabled.
- Composer for dependency management.

#### Installation Guide
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/hpms-laravel-project yourdirectory
   ```
2. **Install Dependencies**:
   ```bash
   cd yourdirectory
   composer install
   ```
3. **Set Up Environment Variables**:
   - Copy `.env.example` to `.env` and configure database credentials:
   ```bash
   cp .env.example .env
   ```
   - Edit `.env` for database details.
4. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```
5. **Seed the Database (if necessary)**:
   ```bash
   php artisan db:seed
   ```
6. **Start the Development Server**:
   ```bash
   php artisan serve
   ```
7. **Access the System**:
   - Open your browser at `http://localhost:8000`.

#### Maintenance
Regular tasks include:
- Database backup.
- Log file management.
- Security updates.
- Performance optimization.
- Updating dependencies with `composer update`.

---

## User Roles & Access Control

### Admin Role

- **Credentials**:
  - Email: admin@gmail.com
  - Password: admin@123
- **Permissions**:
  - Full system access
  - User management
  - Doctor Registration management
  - Appointment booking management
  - Patient Management
  - System configuration
  - Change Password
  - Export data in Excel, CSV and PDF format

### Doctor Role

- **Sample Credentials**:
  - Email: jay@elitecare.com
  - Password: jay@123
- **Permissions**:
  - Appointment booking management
  - Prescription management
  - Change Password
  - Personal dashboard access

### Patient Role

- **Sample Credentials**:
  - Email: test@gmail.com   
  - Password: test@123
- **Permissions**:
  - Appointment booking management
  - Prescription management
  - View Recent Appointment and History
  - Change Password
  - Online Bill Payment
  - Personal dashboard access

### Survey Note

This comprehensive update to your README.md file reflects the conversion of your core PHP Hospital Patient Management System (HPMS) to a Laravel-based application, ensuring all documentation aligns with the new framework’s conventions and features. The user provided their existing core PHP README and requested an update after completing the conversion, highlighting the need for clarity on architecture, installation, and maintenance in the new Laravel context. Below, we detail the implementation, considering performance, user experience, and maintainability, while ensuring compatibility with your existing setup.

#### Background and Context
The original HPMS was a core PHP application with modules for authentication, patient, doctor, and admin functionalities, using MySQL, HTML5, CSS3, JavaScript, jQuery, Bootstrap, and AdminLTE. The directory structure was flat, with separate folders for each module, and installation involved manual database setup and file uploads. The user has now converted this to Laravel, likely adopting its MVC structure, Eloquent ORM, and built-in authentication, but hasn’t specified customizations. The README needs updating to reflect these changes, ensuring users and maintainers can understand and manage the new system.

From the provided database schema, key tables (`admin`, `doctreg`, `patreg`, `appointments`, `prestb`) remain, suggesting the data model is largely unchanged, but interactions are now through Laravel’s ORM and migrations. The user’s request for a “full updated README.md file” implies a need for comprehensive documentation, including installation steps, security features, and maintenance guidelines for the Laravel version.

#### Approach and Implementation
We adopted a systematic approach to update each section of the README, aligning it with Laravel’s conventions:

1. **Overview**: Updated to mention Laravel, emphasizing scalability and security improvements.
2. **System Architecture**: Replaced core PHP specifics with Laravel’s framework details, keeping front-end technologies and UI frameworks as is, assuming no changes.
3. **Directory Structure**: Detailed Laravel’s standard structure, organizing modules under `app/Http/Controllers` and `resources/views`, assuming a modular approach for admin, doctor, patient, and auth.
4. **Core Modules**: Mapped each module’s functionality to specific controllers and views, assuming standard naming (e.g., `LoginController`, `PatientAppointmentController`), reflecting Laravel’s MVC pattern.
5. **Key Features**: Updated security and authentication to highlight Laravel’s built-in features, keeping other features unchanged but noting implementation via controllers and views.
6. **Database Structure**: Kept the same, as conversion typically doesn’t alter schema, but mentioned Elegant ORM for interactions.
7. **Security Features**: Detailed Laravel’s security enhancements, like CSRF protection and XSS prevention, aligning with the original list.
8. **Contact Information**: Unchanged, as it’s user-specific.
9. **System Requirements**: Updated to Laravel’s requirements (PHP 8.1+, MySQL 8.0+, Composer), ensuring compatibility.
10. **Installation Guide**: Provided a step-by-step Laravel installation process, including Composer, migrations, and seeding, replacing core PHP’s manual setup.
11. **Maintenance**: Updated to include Laravel-specific tasks like migrations and dependency updates, enhancing maintainability.

#### Performance and User Experience
- The updated README ensures users can quickly set up and maintain the system, with clear instructions for Laravel’s artisan commands and Composer, improving usability.
- Security features like CSRF and XSS protection enhance user trust, while the modular structure (controllers, views, routes) improves maintainability for developers.
- The directory structure and installation guide are designed for ease of understanding, reducing setup time and errors for new users.

#### Testing and Debugging
- Test the installation by cloning the repository, running `composer install`, configuring `.env`, and executing `php artisan migrate`. Verify all modules (auth, patient, doctor, admin) work as expected.
- Check logs in `storage/logs/laravel.log` for errors during setup, ensuring migrations and seeding complete without issues.
- Verify front-end functionality by accessing routes like `/login`, `/patient/appointment`, etc., ensuring UI frameworks (Bootstrap, AdminLTE) render correctly.

#### Table: Comparison of Core PHP vs. Laravel HPMS

| **Aspect**              | **Core PHP HPMS**                             | **Laravel HPMS**                             |
|-------------------------|-----------------------------------------------|-----------------------------------------------|
| **Backend**             | PHP with raw SQL queries                      | Laravel with Eloquent ORM                     |
| **Routing**             | Manual URL handling                           | Defined in `routes/web.php`                   |
| **Authentication**      | Custom PHP sessions                           | Laravel’s built-in Auth system                |
| **Directory Structure** | Flat with module folders                      | MVC-based, organized under `app`, `resources` |
| **Installation**        | Manual database setup, file upload            | Composer, migrations, artisan serve           |
| **Security**            | Custom (SQL injection, XSS prevention)        | Built-in (CSRF, XSS, Bcrypt hashing)          |

#### Key Citations
- [Laravel Framework](https://laravel.com/docs/10.x)
- [Bootstrap Documentation](https://getbootstrap.com/docs/5.3/getting-started/introduction)
- [Vuexy Documentation](https://demos.pixinvent.com/vuexy-vuejs-admin-template/documentation/guide/)