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
git clone git@github.com:scshasha/fixaroo.git
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

### 8. Build Assets
Fixaroo uses Laravel Mix to compile and manage frontend assets like CSS, JavaScript, images, and fonts. Follow these steps to build the assets:

Install Node.js Dependencies
Run the following command to install the required npm packages:
```bash
ddev npm install
```

Development Build
For a development build (unminified assets, faster compilation):
```bash
ddev npm run mix:dev
```

Extra commands (minified assets, live reload):
```bash
ddev npm run mix:prod
```
```bash
ddev npm run mix:watch
```

---

### 9. Clean Destination Folders Before Building
To ensure that old or unused files are removed before generating new assets, Laravel Mix is configured to clean the destination folders (public/themes/fixaroo-base) during the build process. This happens automatically when you run any of the above commands (mix:dev, mix:prod, or mix:watch).

If you'd like to manually verify the cleaning behavior, check the webpack.mix.js file for the configuration of the CleanWebpackPlugin.

---

### 10. Access the Application
Once everything is up and running, visit your Fixaroo site:

👉 https://fixaroo.ddev.site

---

### 11. Optional: Seed the Database
If you have seeders, you can run:

```bash
ddev exec php artisan db:seed
```

---

### 12. Debugging Asset Builds
If you encounter issues while building assets, try the following:

Clear Laravel Cache:
```bash
ddev exec php artisan cache:clear
```
```bash
ddev exec php artisan config:clear
```
```bash
ddev exec php artisan view:clear
```
Reinstall Node Modules:
```bash
ddev npm install
```
Manually Run Mix Commands:
```bash
ddev npm run mix:dev
```

---

### 13. Summary of Commands

| Command                        | Description                                                      |
|---------------------------------|------------------------------------------------------------------|
| npm run mix:build               | Default build.                                |
| npm run mix:watch               | Watches files for changes and rebuilds.                         |
| npm run mix:dev                  | Explicitly runs a development build.                            |
| npm run mix:prod                 | Runs a production build (versioned).                  |
| composer run-script build-mix    | Runs a production build via Composer.                           |
| composer run-script watch-mix    | Starts the watcher via Composer.                                |
| composer run-script build-dev    | Runs a development build via Composer.                          |