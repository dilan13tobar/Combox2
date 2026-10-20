<?php

  //local conecction
  $local_host     = "localhost";  //127.0.0.1
  $local_port     = "5432";
  $local_user     = "postgres";
  $local_dbname   = "combox";
  $local_password = "1087408876";

  $supa_host     = "aws-0-ca-central-1.pooler.supabase.com";  
  $supa_port     = "6543";
  $supa_user     = "postgres.atlffzzvhifphuexjnlp";
  $supa_dbname   = "postgres";
  $supa_password = "unicesmag@@";


  $local_conn = pg_connect("
    host = $local_host
    port = $local_port
    dbname = $local_dbname
    user = $local_user
    password = $local_password
  ");

  $supa_conn = pg_connect("
    host = $supa_host
    port = $supa_port
    dbname = $supa_dbname
    user = $supa_user
    password = '$supa_password'
  ");

  if (!$local_conn){
    die ("Error local connection !!!");
  }else{
    echo ("<br>Local connection success !!!");
  }

  if (!$supa_conn){
    die ("Error SUPA connection !!!");
  }else{
    echo ("<br>SUPA connection success !!!");
  }  
  ?>