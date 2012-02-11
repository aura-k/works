<? 
require_once "../config.php";
session_cache_limiter(''); 
session_start(); 

session_unregister(ID); 
session_destroy(); 

$url = '../login.php';
echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
?> 