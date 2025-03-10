# Simple Flight starter kit

Ultra simple Flight boilerplate.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/masroore/flightphp-starter.git
    cd flightphp-starter
    ```

2. Install dependencies using Composer:
    ```sh
    composer install
    ```

## Docker Instructions

1. Build the Docker image:
    ```sh
    docker build -t flightphp-starter .
    ```

2. Run the Docker container:
    ```sh
    docker run -d -p 80:80 flightphp-starter
    ```
