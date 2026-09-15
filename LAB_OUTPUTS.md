# Laboratory Outputs 1-5

Student: Prince Lawrence Dimaapi

## Lab 1 - Development Environment

Project output: installed and verified LavaLust project source. The required submission PDF still needs the student's screenshots of WAMP, Git, Composer, GitHub, the running LavaLust page, Render, and Aiven.

## Lab 2 - GitHub and Render Deployment

Project output: personalized landing page, Dockerfile, environment configuration, GitHub repository, and a live Render deployment.

- GitHub: <https://github.com/lawrenceprince39-stack/prince-lawrence-dimaapi-lavalust>
- Live website: <https://prince-lawrence-dimaapi-lavalust.onrender.com/>

## Lab 3 - Routing, Controller, Views, and Middleware

- `/student` - Prince Lawrence Dimaapi Student Information page
- `/student/profile` - protected Student Profile page
- `StudentController` passes the student data to both views
- `StudentMiddleware` redirects unauthorized profile visits

## Lab 4 - Database and MVC

- `/users` - dynamic users table
- `UsersModel` and `UsersController`
- `database/lab4_users.sql` - `mydb` and five sample users
- `LabDatabaseSetup` creates the database and table automatically

## Lab 5 - Authenticated Product CRUD

- `/login` - authentication page
- `/products` - protected product list
- `/products/create` - add product
- `/products/edit/{id}` - edit product
- `/products/delete/{id}` - POST-only delete operation
- `ProductModel`, `ProductController`, and `ProductAuthMiddleware`
- Aiven MySQL service: `dimaapi-prince-lab5-mysql` (Free tier)
- `database/lab5_products.sql` - products table schema
- Live CRUD: <https://prince-lawrence-dimaapi-lavalust.onrender.com/products>
- Demo login credentials are supplied separately from the public repository.

## Verification Status

- Lab 3 structural test: PASS
- Lab 4 structural test: PASS
- Lab 5 structural test: PASS
- PHP syntax checks: PASS
- Aiven MySQL service creation: COMPLETE
- GitHub publishing: PASS
- Render deployment: PASS
- Live landing page: PASS
- Live authentication: PASS
- Live Aiven product creation and update: PASS
