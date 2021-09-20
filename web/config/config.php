<?php

  define('PRODUCTION_MODE', false);
  //echo 'FROM Config';
  $dbInfo = array();
  if(PRODUCTION_MODE)
  {
     $dbInfo['db']   = 'calculator';
     $dbInfo['user'] = 'root';
     $dbInfo['pass'] = '';
     $dbInfo['host'] = '';  
     
     define('SITE_URL',    '');
     define('SMTP_HOST',   '');
     
  }
  else
  {
     $dbInfo['db']   = 'calculator';
     $dbInfo['user'] = 'root';
     $dbInfo['pass'] = '';
     $dbInfo['host'] = 'localhost';
     
     define('SITE_URL',    'localhost/calculator/');
     define('SMTP_HOST',   '');
  }


  define('VIEWS_DIR',          DOCUMENT_ROOT . '/calculator/views/');

  define('LIST_TEMPLATE',  VIEWS_DIR . 'calculator_list.php');

  # Database tables
  //define('CALCULATOR_TBL', 'calculator');
?>