# Solar Maintenance System

A web-based **Preventive Solar-Battery Maintenance Management System** developed to support the inspection, maintenance scheduling, condition monitoring, degradation tracking, cost recording, and replacement forecasting of solar-battery installations.

The system provides a centralized platform for managing solar installation components and their maintenance activities, helping users plan preventive maintenance, record completed work, monitor component conditions, and identify components that may require attention or replacement.

---

## Project Overview

Solar photovoltaic and battery installations require regular inspection and preventive maintenance to maintain reliable performance and extend equipment lifespan.

Manual maintenance processes can make it difficult to keep accurate records, identify overdue maintenance, monitor component degradation, and estimate future replacement requirements.

The **Solar Maintenance System** addresses these challenges by providing a web-based platform for:

* Solar installation management
* Component management
* Component type classification
* Inspection scheduling and recording
* Performance measurement
* Preventive maintenance scheduling
* Maintenance record management
* Maintenance cost tracking
* Component degradation monitoring
* Replacement forecasting
* Maintenance and system reports

The system is designed for use in environments where solar and battery installations need to be monitored and maintained systematically.

---

## Project Title

**Preventive Maintenance Schedule and Cost Model for a 2-Year-Old Solar-Battery Installation: Inspection Checklist, Degradation Tracking, and Replacement Forecasting**

---

## Objectives

The main objectives of the system are to:

1. Provide a centralized platform for managing solar-battery installation components.
2. Schedule and monitor preventive maintenance activities.
3. Record inspection results and component conditions.
4. Track component performance and degradation over time.
5. Record maintenance activities and associated costs.
6. Identify overdue and upcoming maintenance activities.
7. Forecast components that may require replacement.
8. Provide useful maintenance information through reports and dashboard summaries.
9. Improve the organization and accessibility of solar maintenance records.

---

## Key Features

### 1. Dashboard

The dashboard provides an overview of the solar maintenance system, including:

* Total installations
* Total components
* Pending inspections
* Maintenance due
* Component condition information
* Replacement risk
* Recent inspection activities

---

### 2. Installation Management

The system allows authorized users to manage solar installations and store important installation information.

Installation records can be used to associate components, inspections, measurements, and maintenance activities with a particular solar installation.

---

### 3. Component Management

Components installed within a solar system can be registered and managed.

Examples include:

* Solar panels
* Batteries
* Inverters
* Charge controllers
* Other relevant solar-system components

Each component can be associated with its installation and component type.

---

### 4. Component Type Management

Component types provide a structured way of categorizing equipment within the solar installation.

This makes it easier to organize and identify components during inspection and maintenance activities.

---

### 5. Inspection Management

The inspection module allows users to schedule and record inspections.

Inspection information can include:

* Inspection date
* Inspector
* Component
* Inspection findings
* Component condition
* Recommendations
* Inspection items

The system can also use the latest inspection information when displaying component condition information on the dashboard.

---

### 6. Performance Measurement

The system supports recording performance measurements for solar and battery components.

Supported performance parameters include:

* Capacity
* Power
* Energy
* Usable Capacity
* Battery Capacity
* Output Power
* Panel Power

These measurements can be used to monitor performance changes over time.

---

### 7. Preventive Maintenance Scheduling

The maintenance schedule module allows users to create and manage preventive maintenance schedules.

Maintenance schedules include information such as:

* Component
* Maintenance task
* Frequency
* Last maintenance date
* Next due date
* Priority
* Status

The system automatically identifies maintenance activities as:

* **Scheduled**
* **Due**
* **Overdue**
* **Completed**

This helps maintenance personnel identify activities that require immediate attention.

---

### 8. Complete Maintenance Workflow

Authorized users can complete a due or overdue maintenance schedule directly from the maintenance schedule interface.

When maintenance is completed, the system records:

* Technician
* Maintenance type
* Maintenance date
* Description
* Condition before maintenance
* Action taken
* Condition after maintenance
* Next due date
* Remarks

The system automatically creates a corresponding maintenance record and updates the maintenance schedule.

---

### 9. Maintenance Records

The maintenance records module provides a history of maintenance activities performed on system components.

Records can contain:

* Component
* Technician
* Maintenance type
* Maintenance date
* Description
* Condition before
* Action taken
* Condition after
* Next due date
* Status
* Remarks

This provides a historical record that can be used for future maintenance decisions.

---

### 10. Maintenance Cost Tracking

The system allows maintenance-related costs to be recorded and monitored.

Cost records can help provide information about expenditure associated with maintaining the solar installation.

---

### 11. Degradation Tracking

The system supports monitoring component performance degradation.

Performance changes can be used to classify component conditions and identify equipment that may require closer monitoring.

The system uses degradation levels such as:

| Degradation | Classification |
| ----------- | -------------- |
| 0–5%        | Normal         |
| >5–15%      | Monitor        |
| >15–30%     | Attention      |
| >30%        | Critical       |

These classifications help users understand the condition of monitored components.

---

### 12. Replacement Forecasting

The replacement forecasting functionality helps identify components that may require replacement based on available maintenance, inspection, and performance information.

Replacement risk can be categorized to assist maintenance planning and decision-making.

---

### 13. Reports

The system provides maintenance-related information that can be used for monitoring, analysis, and reporting.

Reports can assist users in reviewing:

* Inspections
* Maintenance activities
* Maintenance costs
* Component conditions
* Replacement risks

---

## User Roles

The system uses role-based access control.

### Administrator

The Administrator has broad access to system management functions, including:

* Managing installations
* Managing components
* Managing inspections
* Managing maintenance schedules
* Managing maintenance records
* Managing costs
* Viewing reports
* Managing users and system information

### Technician

Technicians can perform operational maintenance activities, including:

* Viewing maintenance schedules
* Creating maintenance schedules
* Editing maintenance schedules
* Completing maintenance
* Recording maintenance activities
* Recording inspection information
* Monitoring component conditions

### Supervisor

Supervisors have primarily monitoring and viewing access.

They can review:

* Maintenance schedules
* Maintenance records
* System information
* Maintenance activities

This separation of responsibilities helps ensure that users only perform actions appropriate to their roles.

---

## Technology Stack

### Backend

* **PHP 8.2.12**
* **Laravel 12**
* **MySQL / MariaDB**

### Frontend

* **HTML5**
* **CSS3**
* **JavaScript**
* **Bootstrap**
* **Bootstrap Icons**
* **AdminLTE 4**
* **Blade Templates**

### Development Environment

* **XAMPP**
* **Visual Studio Code**
* **Git**
* **GitHub**

---

## System Architecture

The application follows the Laravel Model-View-Controller (MVC) architecture.

```text
User
  │
  ▼
Web Browser
  │
  ▼
Laravel Routes
  │
  ▼
Controllers
  │
  ├──────────────► Models
  │                   │
  │                   ▼
  │                MySQL
  │
  ▼
Blade Views
  │
  ▼
Web Browser
```

This architecture separates application logic, data management, routing, and presentation.

---

## Main System Modules

```text
Solar Maintenance System
│
├── Dashboard
│
├── Installations
│
├── Components
│   └── Component Types
│
├── Inspections
│
├── Measurements
│
├── Maintenance Schedules
│
├── Maintenance Records
│
├── Cost Records
│
├── Replacement Forecasts
│
├── Reports
│
└── User Management
```

---

## Installation

### Requirements

Before installing the system, ensure the following are available:

* PHP 8.2 or later
* Composer
* MySQL or MariaDB
* XAMPP
* Git
* Node.js and npm where required by the Laravel frontend setup

---

### 1. Clone the Repository

```bash
git clone https://github.com/Bencalixtus/Solar-Maintenance-System.git
```

Navigate into the project:

```bash
cd Solar-Maintenance-System
```

---

### 2. Install PHP Dependencies

```bash
composer install
```

---

### 3. Create Environment File

Copy the example environment file:

```bash
copy .env.example .env
```

On Linux/macOS:

```bash
cp .env.example .env
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Configure Database

Create a MySQL database, for example:

```text
solar_maintenance
```

Then update the database section in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=solar_maintenance
DB_USERNAME=root
DB_PASSWORD=
```

Update the username and password if your MySQL installation uses different credentials.

---

### 6. Run Migrations

```bash
php artisan migrate
```

If seeders are available:

```bash
php artisan db:seed
```

---

### 7. Install Frontend Dependencies

```bash
npm install
```

Build frontend assets:

```bash
npm run build
```

For development:

```bash
npm run dev
```

---

### 8. Start the Laravel Application

```bash
php artisan serve
```

The application can then be accessed through the local development address provided by Laravel.

When using XAMPP, the project may also be accessed through the configured Apache installation.

---

## Database

The system uses a relational database to store information about:

* Users
* Installations
* Components
* Component types
* Inspections
* Inspection items
* Measurements
* Maintenance schedules
* Maintenance records
* Cost records
* Replacement forecasts

Relationships between these entities allow maintenance activities and performance information to be associated with the correct solar installation and component.

---

## Maintenance Workflow

The general maintenance workflow is:

```text
Solar Installation
       │
       ▼
Register Components
       │
       ▼
Schedule Inspection
       │
       ▼
Record Inspection
       │
       ▼
Record Measurements
       │
       ▼
Monitor Component Condition
       │
       ▼
Create Maintenance Schedule
       │
       ▼
Scheduled
       │
       ├──► Due
       │
       └──► Overdue
               │
               ▼
       Complete Maintenance
               │
               ▼
       Create Maintenance Record
               │
               ▼
       Update Next Maintenance Date
               │
               ▼
       Continue Monitoring
```

---

## Maintenance Status Logic

The system uses the maintenance due date to determine schedule status.

```text
Next Due Date > Today
        │
        ▼
    Scheduled

Next Due Date = Today
        │
        ▼
       Due

Next Due Date < Today
        │
        ▼
     Overdue

Maintenance completed
        │
        ▼
    Completed
```

When a completed maintenance activity has another future maintenance date, the schedule can continue as a new scheduled maintenance activity.

---

## Security

The application uses Laravel's built-in security mechanisms and role-based access control.

Security-related features include:

* Authentication
* Authorization middleware
* CSRF protection
* Request validation
* Password hashing
* Role-based access control
* Eloquent ORM
* Protected routes
* Mass-assignment protection

---

## Project Structure

Important Laravel directories include:

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
│
├── Models/
│
database/
├── migrations/
├── seeders/
└── factories/

resources/
└── views/
    ├── auth/
    ├── components/
    ├── installations/
    ├── inspections/
    ├── maintenance-records/
    ├── maintenance-schedules/
    ├── measurements/
    ├── reports/
    └── replacement-forecasts/

routes/
└── web.php

public/
└── images/

.env
artisan
composer.json
package.json
```

---

## Project Screenshots

Screenshots of the application can be added here as the project documentation is expanded.

Recommended screenshots include:

1. Welcome Page
2. Login Page
3. Dashboard
4. Installation Management
5. Component Management
6. Inspection Management
7. Maintenance Schedule
8. Complete Maintenance Form
9. Maintenance Records
10. Cost Records
11. Replacement Forecast
12. Reports

Example:

```text
docs/screenshots/dashboard.png
docs/screenshots/maintenance-schedule.png
docs/screenshots/maintenance-records.png
```

---

## Academic Information

**Project:** Solar Maintenance System

**Project Topic:**

> Preventive Maintenance Schedule and Cost Model for a 2-Year-Old Solar-Battery Installation: Inspection Checklist, Degradation Tracking, and Replacement Forecasting

**Department:** Software and Web Development

**Institution:** Federal Polytechnic Bauchi

**Developer:** Ukaba Benjamin Adekpe

**Supervisor:** Mal. ZAINAB UMAR MOHAMMED

---

## Future Improvements

Possible future improvements include:

* Automated maintenance reminders
* Email notifications
* SMS notifications
* More advanced degradation prediction
* Improved replacement-cost forecasting
* Exportable PDF reports
* Excel report generation
* Maintenance analytics
* Interactive performance charts
* Mobile-responsive improvements
* API integration
* Automated backup system
* More detailed audit logging

---

## Contribution

Contributions and suggestions are welcome.

To contribute:

1. Fork the repository.
2. Create a feature branch.

```bash
git checkout -b feature/your-feature
```

3. Make your changes.
4. Test the application.
5. Commit your changes.

```bash
git commit -m "Add your feature"
```

6. Push the branch.

```bash
git push origin feature/your-feature
```

7. Create a Pull Request.

---

## License

This project was developed as an academic and software development project.

All rights reserved unless otherwise stated.

---

## Author

### Ukaba Benjamin Adekpe

Software and Web Development Student
Federal Polytechnic Bauchi, Nigeria
WhatsApp No: +2349031949925

GitHub:

**Bencalixtus**

Repository:

**Solar-Maintenance-System**

---

## Project Status

**Status: Active Development**

The core solar maintenance management functionality has been implemented and tested, including installation/component management, inspection management, maintenance scheduling, maintenance completion, maintenance records, cost tracking, degradation monitoring, and replacement forecasting.
