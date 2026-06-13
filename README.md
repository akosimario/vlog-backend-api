 Setup
1. Install dependencies
   composer install

2. Copy env file and configure database
   cp .env.example .env
   php artisan key:generate
3. Run migrations

   php artisan migrate

4. Start server
   php artisan serve
## Notes
- Backend runs on http://localhost:8000
- Frontend must run on http://localhost:5173 for CORS