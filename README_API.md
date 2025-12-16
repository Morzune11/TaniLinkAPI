# API Documentation

This project provides a RESTful API for a simple social media application (Auth, Posts).

## Setup

1.  **Install Dependencies**
    ```bash
    composer install
    ```

2.  **Environment Setup**
    Copy `.env.example` to `.env` if you haven't already:
    ```bash
    cp .env.example .env
    ```
    Generate app key:
    ```bash
    php artisan key:generate
    ```

3.  **Database**
    Configure your database in `.env`. Then run migrations:
    ```bash
    php artisan migrate
    ```

4.  **Storage Link**
    To serve images/videos, create the storage link:
    ```bash
    php artisan storage:link
    ```

5.  **Run Server**
    ```bash
    php artisan serve
    ```
    The API will be available at `http://127.0.0.1:8000/api`.

## Endpoints

### Auth
-   `POST /api/register`
    -   Body: `name`, `email`, `password`, `password_confirmation`, `bio` (optional)
-   `POST /api/login`
    -   Body: `email`, `password`
-   `POST /api/logout`
    -   Headers: `Authorization: Bearer <token>`

### Posts
-   `GET /api/home`
    -   Returns all posts.  
-   `POST /api/posts`
    -   Headers: `Authorization: Bearer <token>`
    -   Body (form-data): `content` (optional), `image` (file, optional), `video` (file, optional)

## Testing with Postman

1.  Open Postman.
2.  Click **Import**.
3.  Select the `postman_collection.json` file included in this project.
4.  Use the collection to test the endpoints.
    -   **Note**: For protected routes (Logout, Create Post), make sure to copy the `token` received from the Login response and paste it into the **Authorization** tab (Type: Bearer Token) of the request.
