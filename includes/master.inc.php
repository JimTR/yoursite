<?PHP
    // Application flag
    define('SPF', true);
    global $Auth;
    // https://twitter.com/#!/marcoarment/status/59089853433921537
    date_default_timezone_set('Europe/London');

    // Determine our absolute document root
    define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
    define("TIME_NOW", time()); //time
    define("FORMAT_TIME",  date("D d F Y  G:i:s")); 
    const SALT = 'insert some random text here';
    // Global include files
    require DOC_ROOT . '/includes/functions.inc.php';  // spl_autoload_register() is contained in this file
    require DOC_ROOT . '/includes/class.dbobject.php'; // DBOBject...
    require DOC_ROOT . '/includes/class.dbquick.php'; // DB quick class may replace dbobject.php...
    require DOC_ROOT . '/includes/class.objects.php';  // and its subclasses
    require DOC_ROOT . '/includes/class.template.php'; // template class
    require DOC_ROOT. "/includes/config.php"; // get config
	require DOC_ROOT. "/includes/settings.php";// get settings 
	$site->config = &$config; // load the config
	$site->settings = &$settings; // load settings
    define( 'DB_HOST', $site->config['database']['hostname'] ); // set database host
	define( 'DB_USER', $site->config['database']['username'] ); // set database user
	define( 'DB_PASS', $site->config['database']['password'] ); // set database password
	define( 'DB_NAME', $site->config['database']['database'] ); // set database name
	define( 'SEND_ERRORS_TO', $site->config['database']['errors'] ); //set email notification email address
	define( 'DISPLAY_DEBUG', $site->config['database']['display_error'] ); //display db errors?
	define( 'comma',  '`'); // sql comma thingy 
//echo "errors shown ".DISPLAY_DEBUG."<br>";
    $database = new db();
 
    // Fix magic quotes
    if(get_magic_quotes_gpc())
    {
        $_POST    = fix_slashes($_POST);
        $_GET     = fix_slashes($_GET);
        $_REQUEST = fix_slashes($_REQUEST);
        $_COOKIE  = fix_slashes($_COOKIE);
    }

    // Load our config settings
    $Config = Config::getConfig();

    // Store session info in the database?
    $Auth = Auth::getAuth();
    if(Config::get('useDBSessions') === true)
		 $clear = 15*60;
        DBSession::gc ($clear); // delete old sessions
        DBSession::register(); // register
       
       
    // Initialize our session
    session_name('yoursite');
    session_start();
	  $id= session_id();
	  //DBSession::write($id,"some data");
        //die ("after register");

    // Object for tracking and displaying error messages
    $Error = Error::getError();

    // If you need to bootstrap a first user into the database, you can run this line once
     //$Auth->tableName = "users";
     //Auth::createNewUser('fred', 'balls');
