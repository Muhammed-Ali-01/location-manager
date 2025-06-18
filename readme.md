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
- Docker
- Docker Compose
- Git

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Muhammed-Ali-01/location-manager.git
```

2. Change directory to the project folder:
```bash
cd  location-manager
```

3. Checkout to the developer branch:
```bash
git checkout developer
```

4. Copy the .env.example file to .env:
```bash
cp .env.example .env
```

5. Build and start the Docker containers:
```bash
docker compose up --build
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

