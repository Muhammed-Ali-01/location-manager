# Location Manager API

A RESTful API for managing locations and calculating routes between them.

## Features

- Location Management:
  - Create new locations with latitude, longitude, name, and marker color
  - List all locations
  - Get detailed information about a specific location
  - Update location information

- Routing:
  - Calculate routes based on proximity
  - Distance calculation between locations
  - Sorted locations by distance from a reference point

## Requirements

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Composer
- Node.js and npm

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Muhammed-Ali-01/location-manager.git
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy .env.example to .env and configure your environment:
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

## API Documentation

### Endpoints

#### Locations

- **GET /api/locations**
  - List all locations

- **POST /api/locations**
  - Create a new location
  - Request Body:
    ```json
    {
        "name": "string",
        "latitude": "float",
        "longitude": "float",
        "color": "string" (hex color)
    }
    ```

- **GET /api/locations/{id}**
  - Get detailed information about a specific location

- **PUT /api/locations/{id}**
  - Update a location
  - Request Body same as POST endpoint

#### Routing

- **GET /api/route/{location}**
  - Get locations sorted by distance from the reference location
  - Returns locations with calculated distances

## Rate Limiting

- 10 requests per minute for all API endpoints
- Exceeding the limit will result in a 429 Too Many Requests response

## Testing

Run tests using:
```bash
php artisan test
```

