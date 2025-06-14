# simple-php-mvc

A lightweight, educational PHP MVC (Model-View-Controller) framework. This project demonstrates the core concepts of the MVC pattern in PHP, making it easy to understand, extend, and use for small projects or as a learning resource.

---

## Project Structure

```
app/
  Config/         # Configuration files (e.g., database.php)
  Controller/     # Application controllers (e.g., HomeController.php, UserController.php)
  Core/           # Core framework classes (routing, base controller/model, request/response, database)
  Model/          # Data models (e.g., UserModel.php, CityModel.php)
  Repository/     # Data access logic (e.g., UserRepository.php)
  Views/          # View templates
bootstrap/        # Bootstrap scripts (e.g., load_env.php, process_url.php)
test/             # Unit and feature tests
index.php         # Application entry point
composer.json     # Composer dependencies
Dockerfile        # Docker build instructions
docker-compose.yml# Docker orchestration
.env.example      # Example environment configuration
```

---

## Features
- Simple, clear MVC structure
- Routing, controllers, models, and repositories
- Environment configuration via `.env`
- Docker support for easy setup
- Example tests

---

## Getting Started

### 1. Clone the repository
```sh
git clone <your-repo-url> simple-php-mvc
cd simple-php-mvc
```

### 2. Configure Environment
Copy `.env.example` to `.env` and adjust values as needed:
```sh
cp .env.example .env
```

**Important**: The `APP_PATH` configuration is crucial for the routing to work correctly:
- For local development (PHP built-in server): `APP_PATH=localhost:8000`
- For Docker setup: `APP_PATH=localhost:3333`

Make sure to set the correct `APP_PATH` based on your setup method.

---

## Running on a Local Server

You need PHP 7.2.5+ and Composer installed.

1. Install dependencies:
   ```sh
   composer install
   ```
2. Make sure your `.env` has `APP_PATH=localhost:8000`
3. Start the PHP built-in server:
   ```sh
   php -S localhost:8000
   ```
4. Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## Running with Docker

1. Make sure your `.env` has `APP_PATH=localhost:3333`
2. Build and start the containers:
   ```sh
   docker-compose up -d
   ```
3. The app will be available at [http://localhost:3333](http://localhost:3333)
4. Adminer (database UI) at [http://localhost:2222](http://localhost:2222)

---

## Project Structure Details
- **app/Config/**: Application configuration files
- **app/Controller/**: Handles HTTP requests and returns responses
- **app/Core/**: Framework core (routing, base classes, database, request/response)
- **app/Model/**: Data models representing database tables
- **app/Repository/**: Data access logic, repository pattern
- **app/Views/**: View templates
- **bootstrap/**: Application bootstrap and environment loading
- **test/**: Example tests (PHPUnit)

---

## Testing

If you have PHPUnit installed:
```sh
./vendor/bin/phpunit test/
```

---

## Troubleshooting

### Common Issues

1. **Routing Not Working**
   - Make sure `APP_PATH` in `.env` matches your setup:
     - Local server: `APP_PATH=localhost:8000`
     - Docker: `APP_PATH=localhost:3333`
   - Check that the port number matches your actual setup

2. **Database Connection Issues**
   - Verify MySQL credentials in `.env`
   - Check if MySQL container is running
   - Ensure correct port mapping

---

## Contributing
Pull requests and issues are welcome! Feel free to fork and adapt for your own learning or projects.

---

## License
Specify your license here (e.g., MIT, Apache 2.0, etc.)

---

## Author
DanhTP and contributors

## Support

If you find this project helpful and would like to support its development, consider buying me a coffee!

[![Buy Me a Coffee](https://img.shields.io/badge/Buy%20Me%20a%20Coffee-FFDD00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/phuongdanh)

## Usage

### Creating a Controller

```php
namespace App\Controller;

class MyController extends Controller {
    public function index() {
        $data = ['message' => 'Hello World'];
        $this->render('my/view', $data);
    }
}
```

### Creating a View

```php
<div class="container">
    <h1><?php echo $message; ?></h1>
</div>
```

### Routing

The framework uses a simple URL routing system. URLs follow this pattern:
```
http://your-domain.com/controller-name/method-name
```

#### Examples:

| URL | Controller | Method | Description |
|-----|------------|--------|-------------|
| `/my/index` | MyController | index() | Default method |
| `/my/show/123` | MyController | show(123) | With parameter |
| `/user/profile` | UserController | profile() | Custom method |
| `/` | HomeController | index() | Default route |

#### Controller Method Example:

```php
namespace App\Controller;

class MyController extends Controller {
    // Access via: /my/index
    public function index() {
        $this->render('my/index', ['title' => 'Home']);
    }

    // Access via: /my/show/123
    public function show($id) {
        $data = $this->model->getById($id);
        $this->render('my/show', $data);
    }

    // Access via: /my/profile
    public function profile() {
        $this->render('my/profile', ['user' => $this->getCurrentUser()]);
    }
}
```
