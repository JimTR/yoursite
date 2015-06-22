<?PHP
    // Application flag
    //namespace UAS;
    error_reporting( 0 );
    define('SPF', true);
    global $Auth;
    global $ret;
    //date_default_timezone_set('Europe/London'); //need to pull this from config 

    // Determine our absolute document root
    if (!defined('DOC_ROOT')) {
    define('DOC_ROOT', realpath(dirname(__FILE__) . '/../'));
}

    // Global include files
    //require DOC_ROOT . '/includes/class.uaparser.php';
    require DOC_ROOT . '/includes/functions.inc.php';  // spl_autoload_register() is contained in this file
    require DOC_ROOT . '/includes/class.dbquick.php'; // DB quick class may replace dbobject.php... and has done 
    require DOC_ROOT . '/includes/class.objects.php';  // and its subclasses ... now the db object has gone do we need this ?
    require DOC_ROOT . '/includes/class.template.php'; // template class
    require DOC_ROOT . '/includes/class.mobile_detect.php'; // device type class
    require DOC_ROOT. '/includes/config.php'; // get config
	require DOC_ROOT. '/includes/settings.php';// get settings 
	$site->config = &$config; // load the config
	$site->settings = &$settings; // load settings
	$time_format = "h:i:s A"; // default time settings should get from Auth
	$tz = $site->settings['server_tz'];
    $tz = return_tz ($tz);
    //die ($tz);
	date_default_timezone_set($tz); //need to pull this from config    
    define( 'DB_HOST', $site->config['database']['hostname'] ); // set database host
	define( 'DB_USER', $site->config['database']['username'] ); // set database user
	define( 'DB_PASS', $site->config['database']['password'] ); // set database password
	define( 'DB_NAME', $site->config['database']['database'] ); // set database name
	define( 'SEND_ERRORS_TO', $site->config['database']['errors'] ); //set email notification email address
	define( 'DISPLAY_DEBUG', $site->config['database']['display_error'] ); //display db errors?
	define( 'DB_COMMA',  '`'); // sql comma thingy 
	define('COMMENT',$settings['templatecomments']); // show template comments or not 
    define('TIME_NOW', time()); //time stamp
    define('FORMAT_TIME',  date($time_format)); // this should be the user time format
    
    //die ("tz = ".$tz);
    
    if ($site->settings['year'] === "1")
   {
	       define ("COPY_YEAR", romanNumerals(date("Y"))); 
           define ("START_YEAR",romanNumerals($site->settings['start_year']));
   }
    else {
		 define ("COPY_YEAR", date("Y")); 
         define ("START_YEAR",$site->settings['start_year']);
      }
    define ("CLEAR", 15*60); // should be a setting *60
    //using the in-built templates these entries must be in this order
    // modules can alter their values or add extra elements
    $page['header'] = '';
	$page['footer'] = '';
	$page['include'] = '';
	$page['login'] = '';
	$page['path'] = $site->settings['url'];
	$page['copy_year'] = COPY_YEAR;
	$page['start_year'] = START_YEAR;
	$page['title'] = $site->settings['sitename'];
	$page['msg'] = '';
	$page['logo'] = $site->settings['url'].$site->settings['logo'];
	$page['sitename'] = $site->settings['sitename'];
	$page['address'] = $site->settings['address'];
    const SALT = 'insert some random text here';
    $database = new db();
    $detect = new Mobile_Detect;
    $isMobile = $detect->isMobile();
    $isTablet = $detect->isTablet();
    $page['device'] = ($isMobile ? ($isTablet ? 'tablet' : 'mobile') : 'desktop');
    $site->settings['template_path'] = DOC_ROOT.'/templates/'.$page['device'].'/'; // set the templates for the device
 
    // Fix magic quotes
    if(get_magic_quotes_gpc())
    {
        $_POST    = fix_slashes($_POST);
        $_GET     = fix_slashes($_GET);
        $_REQUEST = fix_slashes($_REQUEST);
        $_COOKIE  = fix_slashes($_COOKIE);
    }


    $Auth = Auth ::getAuth();
    
	
      if($site->settings['session'] === "1") //we need to understand the session
      { 
		 //check that db events are switched on here
		 
        DBSession::gc (CLEAR); // delete old sessions depends on settings if no sql events do this line 
        DBSession::register(); // register the session
       }
       
    // Initialize our session
		session_name('yoursite');
		session_start();
	    $id= session_id();
	    $_SESSION['userid'] = intval($Auth->id);
	    $_SESSION['nid'] = $Auth->nid;
	    DBSession::read ($id);
	  
    // Object for tracking and displaying error messages
    $Error = Error::getError();

   
