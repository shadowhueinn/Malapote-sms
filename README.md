# UniFAST-TDP Scholarship Management System

**Student Name:** Cyd Nathaniel Malapote

**Project:** UniFAST-TDP Scholarship Management System

**Framework:** Laravel 10

**Date:** February 2026

## Project Overview

The UniFAST-TDP Scholarship Management System is a Laravel-based application designed to manage scholarship applications, document verification, evaluation, and student assistance workflows for the UniFAST Tertiary Development Program.

This system supports multiple user roles including students, secretaries, and administrators, providing tailored access to application creation, review, approval, and reporting.

## Key Features

### 1. Authentication & User Management
- Student, Secretary, and Admin roles
- User registration, login, logout
- Profile editing and password management
- Role-based access control

### 2. Student Application Management
- Create and submit scholarship applications
- Save drafts and complete Annex 1 information
- Search, filter, view, edit, and delete applications
- View application status updates

### 3. Document Management
- Upload required scholarship documents
- Review and verify submitted files
- Approve or reject documents with notes
- Download and track document status

### 4. Scholarship Evaluation & Processing
- Process pending applications
- Approve, reject, or request more information
- Add evaluator comments and status updates
- Manage grantee records and renewal status

### 5. Regional Office Management
- Manage CHED regional office data
- Assign regional coordinators
- Generate regional reports and export data

### 6. School / Institution Management
- Maintain HEI records and accreditation details
- Track enrolled students per institution
- Generate Annex 5 and institution-level reports

### 7. Family Background Management
- Capture parent and guardian information
- Record household income and family composition
- Track sibling and dependency data

### 8. Financial Assistance Tracking
- Manage other educational aid records
- Validate income eligibility against scholarship thresholds
- Generate financial verification reports

### 9. Special Categories Management
- Track tribal membership data
- Record Persons with Disability (PWD) status
- Generate special category reports

### 10. Reporting & Analytics
- Generate application and approval reports


### 11. Notification System
- Send email notifications for application events
- Manage in-app alerts and reminders
- Support notifications for status changes

### 12. System Administration
- Manage user accounts and roles
- Configure system and application settings
- Maintain audit trails and activity logs
- Perform backups and recovery tasks

### 13. Search & Filter Functions
- Advanced search by name, school ID, application ID, dates
- Filter by status, region, school, year level, and more

### 14. Export & Import Functions
- Export application and student data
- Import student or school data from Excel
- Validate and preview import results

### 15. Communication Module
- Send messages between users
- Publish announcements and alerts
- Manage communication history

## Installation

1. Clone the repository:
   ```bash
   git clone <your-repo-url>
   cd pogil-sms
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy environment file:
   ```bash
   cp .env.example .env
   ```
4. Configure database settings in `.env`.
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations:
   ```bash
   php artisan migrate
   ```

## API and Usage

The system is built as a headless Laravel API with Sanctum authentication. Use the provided API routes for authentication, application management, role-based operations, and admin user control.

## Contact

Created by: **Cyd Nathaniel Malapote**

---

*UniFAST-TDP Scholarship Management System* is intended for academic and administrative management of scholarship applications and related student assistance workflows.
