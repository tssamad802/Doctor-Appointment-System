
# Doctor Appointment Management System

## Description

A comprehensive web-based Doctor Appointment Management System built with PHP and MySQL. This application facilitates appointment scheduling between patients and doctors, with separate dashboards for administrators, doctors, and patients. The system features real-time slot availability checking, appointment management, and doctor schedule configuration.

## Features

### For Patients
- Browse available doctors by specialization
- View doctor schedules and available time slots
- Book appointments with selected doctors
- Check appointment status using phone number
- Cancel appointments

### For Doctors
- Personal dashboard showing appointment statistics
- View and manage patient appointments
- Configure weekly availability schedule
- Approve or cancel appointments
- Set custom time slots for consultations

### For Administrators
- Complete system oversight dashboard
- Manage doctor accounts (add, edit, activate/deactivate)
- View and manage all appointments
- Approve or cancel appointments system-wide
- Monitor system statistics

## Technology Stack

- **Backend**: PHP 7+ with Object-Oriented Programming
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, Bootstrap 5.3.2
- **JavaScript**: jQuery 2.2.4 for AJAX functionality
- **Server**: Apache with mod_rewrite enabled

## Architecture

### Design Patterns
- **MVC Pattern**: Separation of Model (database operations), View (presentation), and Controller (business logic)
- **Trait Pattern**: Reusable logout functionality
- **Authentication Guard**: Role-based access control system

### Key Components

1. **Database Layer** (`includes/dbh.inc.php`)
   - Manages database connections
   - Connection pooling and charset configuration

2. **Model Layer** (`includes/model.php`)
   - CRUD operations with prepared statements
   - SQL injection protection
   - Dynamic query building

3. **Controller Layer** (`includes/control.php`)
   - Input validation
   - Business logic processing
   - Session management

4. **Authentication System** (`includes/auth.php`)
   - Role-based access control
   - Session validation
   - Automatic redirection for unauthorized access

5. **View Layer** (`includes/view.php`)
   - Error message display
   - Session-based flash messages

## Database Schema

### Tables

**admin**
- `id` (INT, Primary Key, Auto Increment)
- `email` (VARCHAR 55)
- `pwd` (VARCHAR 55)

**doctor**
- `id` (INT, Primary Key, Auto Increment)
- `name` (VARCHAR 55)
- `email` (VARCHAR 55)
- `pwd` (VARCHAR 55)
- `Specialization` (VARCHAR 55)
- `is_active` (VARCHAR 55, Default: 'is_active')
- `created_at` (TIMESTAMP, Default: CURRENT_DATE)

**patient**
- `id` (INT, Primary Key, Auto Increment)
- `name` (VARCHAR 55)
- `email` (VARCHAR 55)
- `phone` (VARCHAR 20)
- `doctor_id` (INT, Foreign Key)
- `slot` (VARCHAR 20)
- `patient_date` (DATE)

**schedule**
- `id` (INT, Primary Key, Auto Increment)
- `doctor_id` (INT, Foreign Key)
- `day` (VARCHAR 55)
- `start_time` (INT)
- `end_time` (INT)
- `slot` (INT) - duration in minutes
- `created_at` (TIMESTAMP, Default: CURRENT_TIME)

## Installation

1. **Clone the repository**
   ```bash
   git clone [repository-url]
   cd [repository-name]
   ```

2. **Configure Apache**
   - Ensure mod_rewrite is enabled
   - Point document root to the project directory
   - The `.htaccess` file handles URL rewriting

3. **Database Setup**
   ```bash
   mysql -u root -p
   CREATE DATABASE `doctor-appointment`;
   USE `doctor-appointment`;
   source db.sql
   ```

4. **Configure Database Connection**
   Edit `includes/dbh.inc.php`:
   ```php
   private $server = "localhost";
   private $username = "root";
   private $password = "your_password";
   private $dbname = "doctor-appointment";
   ```

5. **Session Configuration**
   Update `includes/config.session.inc.php`:
   ```php
   'domain' => 'your-domain.com',  // Change from 'localhost' if needed
   'secure' => true,  // Set to false if not using HTTPS in development
   ```

6. **Create Admin Account**
   ```sql
   INSERT INTO admin (email, pwd) VALUES ('admin@example.com', 'admin123');
   ```

## Usage

### Access Points

- **Homepage**: `/` or `/home`
- **Patient Portal**: `/doctors`, `/appointments`
- **Login**: `/login`
- **Admin Dashboard**: `/admin-dashboard` (requires admin authentication)
- **Doctor Dashboard**: `/doctor-dashboard` (requires doctor authentication)

### User Workflows

**Patient Booking Flow:**
1. Visit `/doctors` to browse available doctors
2. Click "View Schedule" on a doctor card
3. Select a date to view available time slots
4. Click on a time slot and provide patient details
5. Submit appointment request
6. Check appointment status at `/appointments` using phone number

**Doctor Workflow:**
1. Login at `/login`
2. Access dashboard to view appointment count
3. Configure weekly schedule at `/doctor-schedule`
4. View and manage appointments at `/doctor-appointment`
5. Approve or cancel patient requests

**Admin Workflow:**
1. Login at `/login`
2. Access comprehensive dashboard
3. Manage doctors at `/admin-doctors`
4. Add new doctors at `/add-doctor`
5. Edit doctor details at `/edit-doctor`
6. Oversee all appointments at `/admin-appointments`

## Security Features

- **Prepared Statements**: Protection against SQL injection
- **Input Validation**: Server-side validation for all user inputs
- **Email Validation**: Filter-based email verification
- **Session Management**: 
  - Session regeneration every 30 minutes
  - HTTP-only cookies
  - Secure flag for HTTPS
  - Strict mode enabled
- **Authentication Guards**: Role-based access control on all protected routes
- **XSS Protection**: HTML entity encoding on output
- **CSRF Protection**: Session-based validation

## API Endpoints (AJAX)

### `/server` (POST)
Dynamic slot availability checker
- **Input**: `date`, `doctor_id`
- **Output**: JSON array of available time slots
- **Logic**: Matches selected date's day with doctor's schedule, generates time slots based on configured duration

## Known Issues & Limitations

1. **Password Storage**: Passwords stored in plain text (should implement hashing)
2. **Validation**: Some duplicate email checks may be inconsistent
3. **Status Field**: `is_active` column not consistently used (sometimes uses `status`)
4. **Error in edit-doctor-script.inc.php**: Line 22 checks wrong variable name
5. **Appointments Table**: Missing in `db.sql` but referenced throughout code
6. **Time Format**: Schedule times stored as integers but should be TIME type

## Recommended Improvements

1. Implement password hashing (bcrypt/Argon2)
2. Add CSRF token validation
3. Implement proper error logging
4. Add email notification system
5. Include appointments table in schema
6. Add data validation on front-end
7. Implement proper time zone handling
8. Add search and filter functionality for doctors
9. Include pagination for large datasets
10. Add appointment reminders
11. Implement doctor availability status (busy/available)
12. Add patient history tracking

## Project Structure

```
├── .htaccess                 # URL rewriting configuration
├── index.php                 # Main router
├── db.sql                    # Database schema
├── README.md                 # This file
├── includes/                 # Backend logic
│   ├── config.session.inc.php
│   ├── dbh.inc.php
│   ├── model.php
│   ├── control.php
│   ├── auth.php
│   ├── view.php
│   └── [various script files]
└── pages/                    # Frontend views
    ├── home.php
    ├── login.php
    ├── doctors.php
    ├── schedule.php
    ├── book.php
    ├── appointments.php
    ├── admin-*.php
    ├── doctor-*.php
    └── 404.php
```

## License

[Specify your license here]

## Contributors

[Add contributor information]

## Support

For issues and feature requests, please [create an issue](link-to-issues) or contact [support-email].
