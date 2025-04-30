# TaskFlow

TaskFlow is a modern task management application built with PHP and React. It helps you organize and track your tasks efficiently.

## Features

- Calendar view for task scheduling and management
- Dashboard for task overview and quick actions
- Dark/Light mode support
- User authentication and authorization
- Modern, responsive UI
- Real-time updates

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL or PostgreSQL

### Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/taskflow.git
cd taskflow
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Copy the environment file and configure your database:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Start the development server:
```bash
php artisan serve
```

8. In a separate terminal, compile assets:
```bash
npm run dev
```

Visit `http://localhost:8000` in your browser to see the application.

## Contributing

Thank you for considering contributing to TaskFlow! Please feel free to submit pull requests or create issues for bugs and feature requests.

## Security Vulnerabilities

If you discover a security vulnerability within TaskFlow, please send an e-mail to the maintainers. All security vulnerabilities will be promptly addressed.

## License

TaskFlow is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
