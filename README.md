# CarbonPHP Examples

CarbonPHP is free open-source software that ships with two major features. The first is a beautiful error reporting system with code output of where the issue arose. The second is a MySQL ORM for querying your database.

<img width="1792" alt="Screenshot 2023-12-26 at 12 47 44 AM" src="https://github.com/RichardTMiles/CarbonPHPExamples/assets/9538357/be347928-d545-4b1f-a71b-18ebf3897405">


<img width="1792" alt="Screenshot 2023-12-26 at 12 47 36 AM" src="https://github.com/RichardTMiles/CarbonPHPExamples/assets/9538357/0b169cb8-0c04-4e59-81c8-be00394ccc84">


<img width="1761" alt="Screenshot 2023-12-26 at 1 21 16 AM" src="https://github.com/RichardTMiles/CarbonPHPExamples/assets/9538357/bcbd4e62-bf33-44b2-bf2a-ca18775fb919">

<img width="1792" alt="Screenshot 2023-12-26 at 1 30 50 AM" src="https://github.com/RichardTMiles/CarbonPHPExamples/assets/9538357/9d42b0c7-c4d1-40e2-8b37-7f02279e13da">


## Explain how you would handle exceptions in PHP. Provide an example.

There are two types of throwable issues in PHP: Exceptions and Errors. Both Errors and Exceptions extend the
[Throwable](https://www.php.net/manual/en/class.throwable) interface. Both types of Throwable issues can be handled
globally using the php
internal [set_exception_handler](https://www.php.net/manual/en/function.set-exception-handler.php)
and [set_error_handler](https://www.php.net/manual/en/function.set-error-handler.php) functions respectively. What types
of errors are thrown can be controlled using
the [error_reporting](https://www.php.net/manual/en/function.error-reporting.php)
function. Some errors are not catchable using `Try {} catch () {}` blocks, such as
[E_DEPRECATED](https://www.php.net/manual/en/errorfunc.constants.php#errorfunc.constants.errorlevels) and must be
handled with global handlers. Other oddities should be
noted [compile time vs runtime](https://stackoverflow.com/questions/59619285/deprecation-warning-not-catchable-in-php-7-4).
Implementing a global handlers and try catch blocks should be done.

Let's look at an example of
my [Throwable Handler](https://github.com/CarbonORM/CarbonPHP/blob/lts/carbonphp/error/ThrowableHandler.php).
If you do not have Composer installed globally you can use
the [shell installer](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md) also provided in
this repo.

```BASH
chmod +x ./downlaodComposer.sh
./downlaodComposer.sh
```

Update the configurations database username and password. The default is `root` and `password`.
This is located ./examples/Sample.php.
You can use this command ` cat ./examples/Sample.php | grep -n CarbonPHP::DB_USER` to find the line number or
optionally use the following sed command to update the file.
You'll still need to modify the user and password (MySQLUsername & MySQLPassword) from the command below.

```BASH 
sed -i '' -E "s|CarbonPHP::DB_USER => '(.*)',|CarbonPHP::DB_USER => 'MySQLUsername',|g" ./examples/Sample.php
sed -i '' -E "s|CarbonPHP::DB_PASS => '(.*)',|CarbonPHP::DB_PASS => 'MySQLPassword',|g" ./examples/Sample.php
```

Once you have composer installed you can use it to install the dependencies and set up
our [PSR-4 namespacing](https://www.php-fig.org/psr/psr-4/) for this project.

```BASH
./composer.phar install
```

Now we can run the example using php's built in web server.
Note PHP's server does have a small memory leak, so it is not recommended for production or large projects.

```BASH
php -S 0.0.0.0:8000 error.php
```

Then visit http://localhost:8000/ in your browser. Some OS' support:

```BASH
open http://localhost:8000/
```

### Write a PHP script using PDO to connect to a MySQL database and execute a SELECT query.

The following command will start a php server on port 8000 and serve the connect.php file.
This demonstrates a connection to a MySQL database using PDO.

```BASH
php -S 0.0.0.0:8000 connect.php
```

SQL injection is easily prevented by
using [prepared statements](https://www.php.net/manual/en/pdo.prepared-statements.php).
[CarbonPHP](https://github.com/CarbonORM/CarbonPHP) uses PDO and prepared statements by default and automates
the process in a way that is seamless and simple to use.
[This file](https://github.com/CarbonORM/CarbonPHP/blob/lts/carbonphp/Rest.php) is largely responsible for the REST ORM
PDO foundation.

