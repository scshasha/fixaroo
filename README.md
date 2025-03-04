# 📚 Fixaroo

## About Fixaroo

**Fixaroo** is a fun, lightweight ticket logging application built with **Laravel**, designed to make issue tracking simple, efficient, and enjoyable. Whether you're handling bugs, feature requests, or internal support tickets, Fixaroo keeps your workflow smooth and your team smiling.

## Features

- ✅ Simple Ticket Creation & Tracking
- ✅ Unique link for users to view their ticket progress
- ✅ Email Notifications for:
    - Ticket authors (on creation and updates)
    - Administrators (on new tickets)
    - Agents (on ticket assignment)
- ✅ Role-Based Access Control:
    - Administrators see and manage all tickets
    - Agents see only their assigned tickets
    - Users (ticket authors) see only their own tickets
- ✅ Ticket Assignment & Status Management (Open, In Progress, Resolved, Closed)
- ✅ Agent Comments & Progress Updates
- ✅ Ticket Deletion (Admin Only)
- ✅ Real-Time Notifications to Keep Everyone Updated
- ✅ Friendly UI with playful Fixaroo vibes

---

## 🛠️ Getting Started with DDEV

This project is set up to run in a **DDEV** environment for local development. Follow the steps below to get started.

### 1. Install DDEV (if you don’t have it)

Check out the official [DDEV Installation Guide](https://ddev.readthedocs.io/en/stable/users/install/).

---

### 2. Clone the Repository

```bash
git clone https://github.com/scshasha/fixaroo.git
cd fixaroo
```

---

### 3. Initialize DDEV Project

Run the following command to set up your Laravel project in DDEV:
```bash
ddev config --project-name=fixaroo --project-type=laravel --docroot=public --create-docroot
```

---

### 4. Start DDEV

```bash
ddev start
```

---

### 5. Install Dependencies

Once DDEV is running, install Laravel dependencies using Composer:
```bash
ddev composer install
```

---

### 6. Environment Setup

Copy the environment files:
```bash
cp .env.example .env
```
Generate your application key:
```bash
ddev exec php artisan key:generate
```

---

### 7. Database Migration

Run the migration to set up the database tables:
```bash
ddev exec php artisan migrate
```

---

### 8. Access the Application

Once everything is up and running, visit your Fixaroo site:

👉 https://fixaroo.ddev.site

---

### 9. Optional: Seed the Database

If you have seeders, you can run:
```bash
ddev exec php artisan db:seed
```

---

✨ Happy Fixing with Fixaroo!
If you have any questions or want to contribute, feel free to submit a pull request or open an issue.
