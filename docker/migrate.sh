# Wait for MySQL to be ready
until nc -z -v -w30 $DB_HOST 3306
do
  echo "Waiting for database connection..."
  sleep 1
done

# Run migrations
php artisan migrate