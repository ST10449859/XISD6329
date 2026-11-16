# FightClubSA Website

A standalone responsive PHP website for FightClubSA. The website is a separate browser application; it does **not** open inside the Android app. The native Android application and this website can independently call the same PHP REST API and use the same MySQL database.

## Included pages
- Home, Login, Register, Dashboard
- Classes, Timetable, Bookings
- Membership, Payments, Notifications
- Profile, Settings, Trainers

## Requirements
- PHP 8.1+ (8.2 recommended)
- MySQL 5.7+ / MariaDB
- Apache (XAMPP locally or cPanel hosting)
- PHP PDO MySQL extension enabled

## Local XAMPP installation
1. Copy the `FightClubSA_Website` folder into `C:\xampp\htdocs\`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin and import `database/schema.sql`.
4. Copy `config.example.php` to `api/config.php`.
5. For XAMPP, the example defaults are `127.0.0.1`, database `fightclubsa`, user `root`, blank password. Adjust if your local MySQL differs.
6. Visit `http://localhost/FightClubSA_Website/`.
7. Register a member account and test login, classes and bookings.

## cPanel deployment
1. In cPanel > MySQL Databases, create a database and a database user. Add the user to the database with the required privileges.
2. In phpMyAdmin, select that database and import `database/schema.sql`. If your hosting provider does not allow `CREATE DATABASE`, remove the first two lines of the SQL file and import it into the database you selected.
3. Upload the contents of this project folder into `public_html` or a subfolder using File Manager or FTP.
4. Copy `config.example.php` to `api/config.php`. Set `DB_HOST`, `DB_NAME`, `DB_USER` and `DB_PASS` to the exact values shown by your hosting provider. cPanel often prefixes database and usernames, and the host is not always `127.0.0.1`; use the values supplied by your host.
5. Ensure `api/config.php` is not downloadable. The API directory should execute PHP, not expose source. Keep backups outside `public_html`.
6. Enable an SSL certificate and use the website with `https://`.
7. Test registration, login, classes, booking/cancellation, profile, settings and membership.

## API endpoints
All protected endpoints require `Authorization: Bearer <token>`.
- `POST api/auth.php` with `action=register` or `action=login`
- `POST api/logout.php`
- `GET api/classes.php`
- `GET api/bookings.php`; `POST` with `action=book` / `action=cancel`
- `GET api/membership.php`
- `GET api/payments.php`
- `GET/POST api/notifications.php`
- `GET/PUT api/settings.php`
- `GET/PUT api/profile.php`
- `GET api/trainers.php`

## Important integration notes
- The website and Android app should use the same production API base URL and database, but keep their own native user interfaces and navigation.
- Do not put a WebView in the Android app if the requirement is a native standalone app.
- Update the Android app's Retrofit endpoint models to match these JSON response fields.
- The supplied SQL schema uses `membership_plans.price`; the membership API deliberately aliases it as `monthly_price` for the existing page.
- The `attendance` table is an optional extension; it is not yet exposed through a trainer attendance API/page.
- Payments are displayed as records only. This package does not process card payments or collect card details.
- No admin CRUD interface is claimed as complete. The current API includes a `role` field for future role-based administration; member-facing functions are implemented here.
- Remove any old debug endpoints and never leave seed/demo scripts publicly accessible.
