# Installation

In order to use that connection, you have to create the database corresponding by running `createDB.sql` script to your SQL console.
Then, to insert data in your DB, run `dump.sql`.

Finally, be sure to update database informations in `library/API/PDOConnection.php` and `library/API/VerificationAPI.php`

_library/API/PDOConnection.php_
```php
const HOST = '<host>';
const DBNAME = '<dbname>';
```

_library/API/VerificationAPI.php_
```php
$host = '<host>';
$port = 5432;
$dbname = '<dbname>';
```

# Usage

Place files in your `www/` directory and **Enjoy !**.

