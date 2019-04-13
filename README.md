# Installation

In order to use that connection, you have to create a database
named `codmoa` and a user named `trashbin` (_In order to permit deletion of users_).
Then, to insert data in your DB, run `dump.sql`.

Finally, be sure to update database informations in `library/API/PDOConnection.php` and `library/API/VerificationAPI.php`.

(_Please allow `pdo_pgsql` and `pgsql` in your php.ini extensions_).

_library/API/PDOConnection.php_
```php
const HOST = '<host>';
const DBNAME = 'codmoa';
```

_library/API/VerificationAPI.php_
```php
$host = '<host>';
$port = 5432;
$dbname = 'codmoa';
```

# Usage

Place files in your web server and **Enjoy !**.

