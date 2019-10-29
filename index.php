<?

use app\core\Router;
use app\model\User;
use app\core\App;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

session_start();

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DEBU', '1'); //0-не выводить ошибки
define('CONFIG', APP . '/config.php');


spl_autoload_register(function ($class) {
    $file = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require_once $file;
    }
});

$url = $_SERVER['QUERY_STRING'];

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); // fw/test/do -> controller/action

Router::add('^$', ['controller' => 'main', 'action' => 'index']); // fw/ -> main/index

Router::dispatch($url);
