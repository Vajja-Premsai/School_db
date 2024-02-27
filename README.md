# Student Detils Centralization  Dashboard

## Overview

The Student Dashboard is a web-based application designed for teachers to manage student information. It allows teachers to add, update, and view details of students, including personal information, contact details, and academic data.

## Features

### 1. Authentication
   - The dashboard includes a simple authentication mechanism to ensure that only authorized users (in this case, teachers) can access and manage student information.

### 2. Student Management
   - Teachers can add new students by providing relevant details such as student ID, name, father's name, school information, contact details, date of birth, gender, and more.
   - The application supports the ability to update existing student records.

### 3. User Roles
   - The system distinguishes between different user roles, and only users with the role 'Teacher' are allowed access. Unauthorized users will be redirected to the logout page.

### 4. Responsive Design
   - The dashboard has a responsive design, ensuring a consistent user experience across different devices and screen sizes.

## Getting Started

To set up and run the Student Dashboard on your local machine, follow these steps:

1. **Environment Setup:**
   - Ensure that you have a web server (e.g., Apache) and PHP installed on your machine.

2. **Database Configuration:**
   - Import the provided `database.php` file to set up the necessary database structure and tables.

3. **Login:**
   - Log in using your teacher credentials to access the main dashboard.

4. **Student Management:**
   - Use the dashboard to add new students, update existing records, and view a list of all students.

5. **Logout:**
   - To log out, click on the logout option in the dashboard.

## Technologies Used

- **Frontend:**
  - HTML, CSS, Bootstrap, JavaScript

- **Backend:**
  - PHP

- **Database:**
  - MySQL

- **Libraries:**
  - DataTables, Select2, Bootstrap Datepicker

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvement, please create a GitHub issue or submit a pull request.

## License

This Student Dashboard is open-source and available under the [MIT License](LICENSE).

Feel free to explore and enhance the functionality of the Student Dashboard based on your specific needs!
