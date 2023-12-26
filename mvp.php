<?php

use CarbonPHP\Abstracts\Composer;
use CarbonPHP\Application;
use CarbonPHP\CarbonPHP;
use CarbonPHP\Interfaces\iConfig;
use CarbonPHP\Programs\CLI;
use CarbonPHP\Rest;
use CarbonPHP\Tables\Carbons;

// Composer autoload
if (false === ($loader = include $autoloadFile = 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {

    print "<h1>Failed loading Composer at ($autoloadFile). Please run <b>composer install</b>.</h1>";

    die(1);

}

Composer::$loader = $loader;

(new CarbonPHP(new class extends Application implements iConfig
{

    public function defaultRoute(): void
    {

    }

    /**
     *
     * this should always be public and not static
     *
     * @param string $uri
     * @return bool
     */
    public function startApplication(string $uri): bool
    {
        if (Rest::MatchRestfulRequests('', Carbons::CLASS_NAMESPACE)) {
            return true;
        }

        return false;
    }

    public static function configuration(): array
    {
        return [
            CarbonPHP::REST => [
                CarbonPHP::NAMESPACE => 'Examples\\Tables\\',
                CarbonPHP::TABLE_PREFIX => Carbons::TABLE_PREFIX
            ],
            CarbonPHP::DATABASE => [
                CarbonPHP::REBUILD_WITH_CARBON_TABLES => true,
                CarbonPHP::DB_HOST => '127.0.0.1',
                CarbonPHP::DB_PORT => '3306',
                CarbonPHP::DB_NAME => 'CarbonPHPExamples',                       // Schema
                CarbonPHP::DB_USER => 'root',
                CarbonPHP::DB_PASS => 'password',
                CarbonPHP::REBUILD => false
            ],
            CarbonPHP::SITE => [
                CarbonPHP::PROGRAM_DIRECTORIES => [
                    CLI::class
                ],
                CarbonPHP::CACHE_CONTROL => [
                    'ico|pdf|flv' => 'Cache-Control: max-age=29030400, public',
                    'jpg|jpeg|png|gif|swf|xml|txt|css|woff2|tff|ttf|svg' => 'Cache-Control: max-age=604800, public',
                    'html|htm|hbs|js' => 'Cache-Control: max-age=0, private, public',   // It is not recommended to add php as an extension as explicitly hitting the .php would output its contents without compilation.
                    // This can be a valid use, but for 99% of users it will seem like a bug with apache.
                ],
                CarbonPHP::CONFIG => __FILE__,               // Send to sockets
                CarbonPHP::TIMEZONE => 'America/Phoenix',    //  Current timezone
                CarbonPHP::TITLE => 'CarbonPHP • C6',        // Website title
                CarbonPHP::VERSION => '0.0.0',               // Add link to semantic versioning
                CarbonPHP::SEND_EMAIL => 'richard@miles.systems',
                CarbonPHP::REPLY_EMAIL => 'richard@miles.systems',
                CarbonPHP::HTTP => true, //CarbonPHP::$app_local
            ],
            // ERRORS on point
            CarbonPHP::ERROR => [
                CarbonPHP::LOCATION => CarbonPHP::$app_root . 'logs' . DIRECTORY_SEPARATOR,
                CarbonPHP::LEVEL => E_ALL | E_STRICT,  // php ini level
                CarbonPHP::STORE => false,      // Database if specified and / or File 'LOCATION' in your system
                CarbonPHP::SHOW => true,       // Show errors on browser
                CarbonPHP::FULL => true        // Generate custom stacktrace will high detail - DO NOT set to TRUE in PRODUCTION
            ]
        ];

    }
}, __DIR__ . DIRECTORY_SEPARATOR))();


print 'Hello World!';

