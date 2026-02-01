# cPanel Deployment Guide for SMIS

This guide outlines the steps to deploy your Laravel application to a cPanel live server.

## 1. Prerequisites (Already Completed)
- [x] Frontend assets built (`npm run build`).
- [x] Local caches cleared (`php artisan optimize:clear`).

## 2. Prepare Files for Upload
1.  **Zip the Project**:
    *   Select all files in your project folder (`d:\smis`).
    *   **Exclude** these folders/files:
        *   `node_modules` (Heavy and unnecessary)
        *   `.git` (Version control history)
        *   `.env` (You will create a new one on the server)
    *   Create a ZIP file (e.g., `smis_deploy.zip`).

2.  **Database Export**:
    *   Open your local database manager (e.g., phpMyAdmin or HeidiSQL).
    *   Export your local database to an `.sql` file.

## 3. Server-Side Setup (cPanel)

### A. Database Setup
1.  Log in to cPanel.
2.  Go to **MySQL Database Wizard**.
3.  **Step 1**: Create a new database (e.g., `username_smis`).
4.  **Step 2**: Create a new user (e.g., `username_admin`) and password. **Save these details.**
5.  **Step 3**: Assign the user to the database and grant **ALL PRIVILEGES**.
6.  Go to **phpMyAdmin** in cPanel.
7.  Select your new database and **Import** the `.sql` file you exported earlier.

### B. Uploading Files
*We will use the secure method: separating the app code from the public folder.*

1.  **File Manager**: Go to cPanel File Manager.
2.  **App Directory**: Create a new folder **outside** of `public_html` (e.g., named `smis_app`).
3.  **Upload Info**:
    *   Upload `smis_deploy.zip` into this `smis_app` folder.
    *   Extract the ZIP file.
4.  **Public Files**:
    *   Go into `smis_app/public`.
    *   **Select All** files and folder inside `public`.
    *   **Move** them to `public_html` (or your subdomain folder).
    *   (Delete the empty `smis_app/public` folder afterwards).

### C. Configuration
1.  **Edit index.php**:
    *   Go to `public_html` (where you moved the public files).
    *   Edit `index.php`.
    *   Update the paths to point to your `smis_app` folder:
        ```php
        // Change:
        require __DIR__.'/../vendor/autoload.php';
        // To:
        require __DIR__.'/../smis_app/vendor/autoload.php';

        // Change:
        $app = require_once __DIR__.'/../bootstrap/app.php';
        // To:
        $app = require_once __DIR__.'/../smis_app/bootstrap/app.php';
        ```
    *   Save changes.

2.  **Environment (.env)**:
    *   Go to `smis_app` folder.
    *   Rename `.env.example` to `.env` (or create a new file named `.env`).
    *   Edit `.env` and update the production settings:
        ```ini
        APP_NAME=SMIS
        APP_ENV=production
        APP_DEBUG=false
        APP_URL=https://yourdomain.com

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=username_smis  <-- Your cPanel DB Name
        DB_USERNAME=username_admin <-- Your cPanel DB User
        DB_PASSWORD=your_password  <-- Your cPanel DB Password
        ```
    *   Save changes.

## 4. Final Steps
1.  **Symlink Storage** (Important for images):
    *   In cPanel, you may need to create a symlink from `smis_app/storage/app/public` to `public_html/storage`.
    *   Alternatively, use a Cron Job to run: `ln -s /home/username/smis_app/storage/app/public /home/username/public_html/storage`.

2.  **Test**: Visit your website. It should load.
