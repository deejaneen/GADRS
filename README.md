# Gym and Dorm Reservation System (GADRS)

## Overview
The **Gym and Dorm Reservation System (GADRS)** is a full-stack application designed to manage gym and dormitory reservations. Built with **Laravel** on the backend and **CSS** for the frontend, it features role-based access for users, admins, and managers. The system supports multiple workflows, including reservation tracking, user management, and payment processing.

You can view the live application at [https://gadrs.deeja.dev/](https://gadrs.deeja.dev/).

## Table of Contents
1. [Features](#features)
2. [Technologies Used](#technologies-used)
3. [Roles and Functionalities](#roles-and-functionalities)
4. [Installation](#installation)
5. [Contact Information](#contact-information)
6. [License](#license)

## Features
- **Role-based Access Control**: Different functionalities for Admin, Guest, Receiving, Supply, and Cashier roles.
- **Reservation Management**: Manage and track gym and dorm reservations, including date restrictions and capacity handling.
- **Automated Payment Workflow**: Integrated payment tracking, with roles handling different stages (e.g., receiving, cashier).
- **Responsive Design**: Optimized for both mobile and desktop.
- **Profile Management**: Users can update their personal details and view past reservations.
- **Admin Capabilities**: Admins can create users, manage date restrictions, and oversee reservation statuses.

## Technologies Used
This project utilizes modern tools and technologies to ensure high performance and scalability:
- **Laravel** for backend functionality.
- **CSS** for the frontend interface.
- **MySQL** / **MariaDB** for database management.
- **FontAwesome** for icons.
- **Docker** for containerization and easy deployment.
- **Cloudflare** for DNS management and performance optimization.

## Roles and Functionalities
1. **Admin**:
   - Manage users (create/edit/remove).
   - Set and manage date restrictions.
   - View all reservation statuses.
2. **Receiving**:
   - Attach form numbers to reservations.
   - Handle reservations moving to the 'Received' status.
3. **Cashier**:
   - Process payments for reservations.
4. **Supply**:
   - Track and verify reservation details with supply needs.
5. **Guest**:
   - View past reservations, update profile, and change password.

## Installation
If you want to run the project locally, follow these steps:

1. **Clone the repository**:
    ```bash
    git clone (https://github.com/deejaneen/GADRS.git)
    ```

2. **Install backend dependencies**:
    ```bash
    cd gadrs
    composer install
    ```

3. **Set up the environment**:
    Create a `.env` file in the root directory for Laravel, and configure your database, mail server, and other environment variables.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations**:
    Set up the database by running the migrations:
    ```bash
    php artisan migrate
    ```

5. **Run the application**:
   - **For the backend**:
     ```bash
     php artisan serve
     ```
   - **For the frontend**:
     ```bash
     npm run dev
     ```

7. **Access the application**:
   The application will be available at `http://localhost:8000` (or a different port depending on your setup).

## Contact Information
For any queries or support, feel free to contact me at:
- **Email**: [tomeldendjaninetara@gmail.com](mailto:tomeldendjaninetara@gmail.com)
- **LinkedIn**: [linkedin.com/in/dttomelden/](https://www.linkedin.com/in/dttomelden/)
- **GitHub**: [github.com/deejaneen](https://github.com/deejaneen)

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
