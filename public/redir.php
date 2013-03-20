<html>
<?php
  //grab link information
  $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $parsed = parse_url($link);
  $queries = explode(';', $_SERVER['QUERY_STRING']);
  $dcr_queries = null;
  $email = null;
  $key = null;
  $ip = null;
  for ($i = 0, $n = sizeof($queries); $i < $n; $i++)
  {
    $dcr_queries[] = implode('',decrypt($queries[$i]));
  }

  //connect to db
  $connection = mysqli_connect('localhost','root','password','email_dev');
  if(mysqli_connect_errno())
  {
    echo 'Failed to connect to database: ' . mysqli_connect_error();
  }


  if(isset($queries[0], $queries[1], $queries[2]))
  {
    $email = $dcr_queries[0];
    $key = $dcr_queries[1];
    $ip = $_SERVER['REMOTE_ADDR'];
    $redirect_url = $dcr_queries[2];
    date_default_timezone_set('America/Los_Angeles');
    $datetime = date('Y-m-d H:i:s');
    mysqli_query($connection,"INSERT INTO mail_data (email, enckey, created_at, ip) VALUES ('".$email."','".$key."','".$datetime."','".$ip."')");
    echo 'Error: ' . mysqli_error($connection); 
  }
  mysqli_close($connection);
 
  //header("Location: http://www.".$redirect_url);
  header("Location: http://www.gooselab.com/thanks");

  //functions
  function decrypt($str)
  {
    $array_str = explode('-',$str);
    $secret = explode(" ","k e y"); 
    for ($i = 0, $n = sizeof($array_str); $i < $n; $i++)
    {
      $vals_array[] = chr(intval($array_str[$i])/ord($secret[$i%3]));
    }
    return $vals_array;
  }
?>
</html>
