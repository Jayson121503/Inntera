# Inntera Tech Stack

This document outlines the modern technology stack used to build the Inntera Hotel Booking System, ensuring high performance, scalability, and a premium user experience.

---

## 1. Frontend (Client-Side)
The frontend is a highly interactive Single Page Application (SPA) built with a focus on speed and rich UI components.

- **Framework**: [React 18.2](https://react.dev/)
- **Build Tool**: [Vite 5](https://vitejs.dev/) - Provides lightning-fast development and optimized production builds.
- **Language**: [TypeScript 5.3](https://www.typescriptlang.org/) - Ensures type safety and robust codebase maintenance.
- **Styling**: 
    - [Tailwind CSS 3.3](https://tailwindcss.com/) - Utility-first CSS for rapid and consistent UI development.
    - [Radix UI](https://www.radix-ui.com/) - Unstyled, accessible primitive components for complex UI patterns (Modals, Dropdowns, Tabs).
    - [Lucide React](https://lucide.dev/) - Sleek, consistent iconography.
- **Navigation**: [React Router 7](https://reactrouter.com/) - Advanced client-side routing with role-based access control.
- **Form Management**: [React Hook Form](https://react-hook-form.com/) & [Zod](https://zod.dev/) - Powerful form handling and schema-based validation.
- **Data Visualization**: [Recharts](https://recharts.org/) - Interactive charts for Admin and Staff dashboards.
- **Utilities**:
    - `date-fns`: Lightweight date manipulation.
    - `clsx` & `tailwind-merge`: Dynamic class name management.
    - `jsPDF` & `html2canvas`: Client-side report and receipt generation.

---

## 2. Backend (Server-Side)
The backend is a robust RESTful API that handles business logic, security, and data persistence.

- **Framework**: [Laravel 12](https://laravel.com/) - The latest PHP framework providing high security and developer efficiency.
- **Language**: [PHP 8.2+](https://www.php.net/) - Utilizing modern features for performance and readability.
- **API Architecture**: RESTful design pattern.
- **Authentication**:
    - [Laravel Sanctum](https://laravel.com/docs/sanctum) - Token-based authentication for the SPA.
    - [Laravel Socialite](https://laravel.com/docs/socialite) - Integrated Google OAuth for social sign-ins.
- **Task Management**: Laravel Queues for background processing (notifications, reports).

---

## 3. Database & Storage
- **Database Engine**: [MySQL](https://www.mysql.com/) - Reliable relational database for structured data management.
- **ORM**: [Eloquent](https://laravel.com/docs/eloquent) - Laravel's intuitive ActiveRecord implementation for database interactions.
- **Migrations**: Version-controlled database schema management.

---

## 4. Infrastructure & DevOps
- **Local Development**: Laravel Sail (Docker-based) and Vite dev server.
- **Environment Management**: `.env` configuration for secure credential handling.
- **Linting & Formatting**: ESLint and Laravel Pint for code quality standards.
