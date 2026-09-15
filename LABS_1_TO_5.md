# Labs 1-5 Setup and Submission Guide

Student: Prince Lawrence Dimaapi  
Course: Web Systems and Technologies 2  
Framework: LavaLust

## Before running the application

1. Install PHP, Apache (Laragon/XAMPP/WAMP are acceptable), Git, Composer, and MySQL.
2. Copy `.env.example` to `.env` and set `APP_URL` to the local project URL (including the trailing slash).
3. Generate a strong random `APP_KEY` and set a non-default `AUTH_USERNAME` and `AUTH_PASSWORD`.
4. Lab 3 uses Student ID `00079`, Year Level `3rd Year`, Section `2-F2`, and Email `princedimaapi.com` for Prince Lawrence Dimaapi.
5. For local MySQL, set `DB_HOST=localhost`, `DB_PORT=3306`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE=mydb`.
6. The application creates `mydb`, `users`, and `products` automatically on the first `/users` or `/products` request. The SQL files in `database/` remain available for manual import.
7. Configure the web-server document root for this folder and enable Apache `mod_rewrite` and `.htaccess` overrides.

## Lab 1 - Development environment

Verify the local server, Git, Composer, GitHub, LavaLust, Render, and Aiven. The final `Dimaapi_PrinceLawrence_Lab1.pdf` must contain the seven screenshots listed in the laboratory handout. Account dashboards and locally installed software must be captured by the student; they are not fabricated in this repository.

## Lab 2 - GitHub and Render

Use a public repository named `dimaapi-prince-lawrence-lavalust` and a personalized Render service such as `dimaapi-prince-lawrence`. Deploy with the included `Dockerfile`. On Render, configure all values from `.env.example` as environment variables, set `APP_URL` to the final HTTPS Render URL with a trailing slash, and do not commit `.env`.

The application should be available at a URL similar to `https://dimaapi-prince-lawrence.onrender.com`. Record the actual URL only after deployment succeeds. Push a small approved landing-page update to demonstrate automatic redeployment.

## Lab 3 - Student routing and middleware

- `/student` calls `StudentController::index` and grants the session access flag.
- `/student/profile` runs `StudentMiddleware` before `StudentController::profile`.
- Opening `/student/profile` in a fresh session redirects to `/student`.
- Both views receive student data from the controller and provide working navigation.

## Lab 4 - Database MVC

- `database/lab4_users.sql` creates `mydb`, the required `users` table, and five sample records.
- `UsersModel` maps to `users`.
- `UsersController::index` retrieves data with `all()` and passes it to the dynamic table view.
- `/users` displays records from MySQL rather than hard-coded table rows.

## Lab 5 - Authenticated CRUD and Aiven

- `database/lab5_products.sql` creates the required `products` table.
- Unauthenticated product requests are redirected by `ProductAuthMiddleware`.
- Authenticated users can list, create, edit, and delete products.
- Login credentials and database secrets are read from environment variables.

For Aiven, set `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE` from the service overview. On Render, provide the project CA certificate as `DB_SSL_CA_CONTENT`; the application securely creates a temporary certificate file at runtime. A filesystem path may be supplied through `DB_SSL_CA` instead for local use.

## Verification

Run these tests with PHP CLI:

```text
php tests/lab3_student_flow_test.php
php tests/lab4_database_flow_test.php
php tests/lab5_products_auth_flow_test.php
```

Also run `php -l` on files under `app/controllers`, `app/models`, `app/middlewares`, `app/views`, and `app/config`.

## Submission evidence

Do not place passwords in screenshots. Capture the exact evidence requested by each handout: local tools and account dashboards for Lab 1; GitHub, push, Render configuration/deployment, public URL, and redeployment for Lab 2; the two student pages and relevant source files for Lab 3; database structure/data, MVC source files, route, and `/users` output for Lab 4; and login, product list, create, edit, delete, Aiven table, GitHub URL, and Render URL for Lab 5.
