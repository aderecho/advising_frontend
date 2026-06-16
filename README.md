# Advisement Management System (Aderecho Advising)

A comprehensive, role-based student advisement and curriculum management portal. The system is designed to streamline academic advising, prospectus tracking, and curriculum building for students, academic advisers, evaluators, and the Office of the University Registrar (OUR).

---

## 🚀 Tech Stack

The project features a modern decoupled architecture:

### Frontend
- **Framework**: [Nuxt.js 4](https://nuxt.com/) (Vue 3, TypeScript)
- **State Management**: [Pinia](https://pinia.vuejs.org/)
- **Styling**: [Tailwind CSS v4](https://tailwindcss.com/) with Vite
- **Typography**: Poppins (Google Fonts)

### Backend
- **Framework**: [Laravel 13](https://laravel.com/) (PHP 8.3+)
- **Authentication**: [Laravel Sanctum](https://laravel.com/docs/sanctum) (Cookie/session-based API authentication)
- **Database**: SQLite (default, configurable via `.env`)

---

## 👥 Roles & Features

The platform provides dedicated workflows for five distinct user roles:

### 1. 🎓 Students (`student`)
- **Interactive Dashboard**: Track completed courses, current enrollment, and remaining subjects.
- **Prospectus Checklists**: Visualize academic progress through a dynamic prospectus flow.
- **Advisement Tracking**: Submit and view status updates for academic advisement.

### 2. 🛠️ Administrators (`admin`)
- **Curriculum Builder**: Build, structure, and organize curriculum paths.
- **Prospectus Previewer**: Live visual validation of the academic prospectus.
- **Publish Workflow**: Seal and publish curriculum revisions to the system.

### 3. 🏛️ Office of the University Registrar (`our`)
- **Course Catalog Management**: Manage global subjects, courses, and prerequisites.
- **Advising Monitor**: Real-time status views of all active student advisements.
- **Curriculum Reception**: Verify, approve, and finalize incoming curriculum packages.
- **Student Summary Records**: Review consolidated academic history and progress reports.

### 4. 🧑‍🏫 Advisers (`adviser`)
- Review student academic files, clear students for enrollment, and provide guidance comments.

### 5. 🔍 Evaluators (`evaluator`)
- Perform pre-graduation checks, transfer-credit evaluations, and official syllabus matching.

---

## 📁 Project Structure

```
advisement_management/
├── app/                      # Laravel Backend Application Logic
│   ├── Enums/                # UserRole & general enumerations
│   ├── Http/Controllers/     # API & Web Controllers grouped by Role
│   └── Models/               # Eloquent Database Models
├── bootstrap/                # Laravel bootstrapping files
├── config/                   # Laravel configurations
├── database/                 # Database migrations, seeders, and SQLite db
│   ├── migrations/           # Database Schema definitions
│   └── seeders/              # Initial accounts and lookup tables
├── routes/                   # Clean role-based route splits
│   ├── admin.php             # Admin endpoints
│   ├── adviser.php           # Adviser endpoints
│   ├── api.php               # Sanctum auth & utility endpoints
│   ├── evaluator.php         # Evaluator endpoints
│   ├── our.php               # Registrar endpoints
│   ├── student.php           # Student endpoints
│   └── web.php               # Default web endpoints
├── frontend/                 # Nuxt.js 4 Frontend Application
│   ├── app/                  # Main frontend pages, stores, and layouts
│   │   ├── pages/            # Role-scoped pages (admin/, student/, our/)
│   │   ├── stores/           # Pinia stores (auth, curriculum, etc.)
│   │   └── layouts/          # Layout configurations
│   ├── nuxt.config.ts        # Nuxt 4 configuration & Nitro dev proxy
│   └── package.json          # Node dependencies (Tailwind 4, Vue 3, Pinia)
├── composer.json             # Composer PHP packages (Laravel 13, Sanctum)
└── package.json              # Main workspace scripts
```

---

## 🛠️ Getting Started

### 📋 Prerequisites
- **PHP**: `^8.3`
- **Composer**: Latest Stable
- **Node.js**: `^18` or `^20`

### 1. Backend Setup (Laravel)
Navigate to the root directory and complete these steps:

1. **Install dependencies**:
   ```bash
   composer install
   ```

2. **Configure Environment File**:
   Copy `.env.example` to `.env`:
   ```bash
   copy .env.example .env
   ```

3. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

4. **Prepare Database**:
   Create the SQLite database file if it doesn't exist (configured default is SQLite):
   ```bash
   # In Windows PowerShell:
   New-Item -ItemType File -Path database\database.sqlite -Force
   ```
   Then run migrations and seed the initial users/lookups:
   ```bash
   php artisan migrate --seed
   ```

5. **Start Dev Server**:
   ```bash
   php artisan serve
   ```
   *The backend will be running on `http://127.0.0.1:8000`.*

### 2. Frontend Setup (Nuxt 4)
Navigate to the `/frontend` directory:

1. **Install node modules**:
   ```bash
   cd frontend
   npm install
   ```

2. **Start Dev Server**:
   ```bash
   npm run dev
   ```
   *The Nuxt development server will start on `http://localhost:3000`.*
   *Note: Nitro is pre-configured to proxy API calls (`/api`, `/sanctum`) to port 8000.*

---

## 🔑 Seed Accounts for Testing

All seeded accounts share the password: `password`

| Role | Email | Password |
|---|---|---|
| **System Admin** | `admin@advisement.test` | `password` |
| **OUR Registrar** | `our@advisement.test` | `password` |
| **Adviser** | `adviser@advisement.test` | `password` |
| **Student** | `student@advisement.test` | `password` |
| **Evaluator** | `evaluator@advisement.test` | `password` |
