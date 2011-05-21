<? 
session_cache_limiter(''); 
session_start(); 
include"m_sess_func.php"; //로그아웃 

session_unregister(ID); 
session_destroy(); 
GoTo("로그아웃 하셨습니다.","../index.php"); 
?> 