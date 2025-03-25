Basic Migration Commands
Command	Description
php artisan make:migration create_table_name_table	Creates a new migration file in the database/migrations directory.
php artisan migrate	Runs all pending migrations and updates the database schema.
php artisan migrate:rollback	Rolls back the last batch of migrations.
php artisan migrate:reset	Rolls back all migrations.
php artisan migrate:refresh	Rolls back and re-runs all migrations.
php artisan migrate:fresh	Drops all tables and re-runs all migrations from scratch.
Migration Options
Command	Description
php artisan make:migration create_table_name_table --create=table_name	Generates a migration file with boilerplate code for creating a new table.
php artisan make:migration add_column_to_table_name_table --table=table_name	Generates a migration file for modifying an existing table.
php artisan migrate --force	Runs migrations in production without confirmation.
php artisan migrate:rollback --step=2	Rolls back the last two batches of migrations.
php artisan migrate:refresh --seed	Refreshes migrations and runs database seeders.
Seeding and Migration Together
Command	Description
php artisan migrate --seed	Runs migrations and seeds the database.
php artisan db:seed	Runs the database seeder to populate tables with test data.
php artisan db:seed --class=SeederClassName	Runs a specific seeder class.