
<html>
<head>
        <title>Server and Client Time Example</title>
</head>
<body>
        <script type='text/javascript'>

        // when we submit the form, get the client time and submit it as the
        // hidden field 'client_timestamp'
        function getClientTime() {
                var d = new Date();
                // we divide the timestamp by 1000 to go from milliseconds to seconds
                //var timestamp = Math.floor(d.getTime()/1000);

                // put the timestamp into hidden field to be passed with the form
                document.getElementById('client_timestamp').value = d;
        }

        </script>
          <form method='POST' id='myform' onsubmit='getClientTime();'>
                <input type='hidden' id='client_timestamp' name='client_timestamp' />
                <button type='submit'>Send My Time</button>
        </form>

  <?php
//echo time();
//die();
date_default_timezone_set('America/Los_Angeles');
         //if the form with the timestamp was submitted
        if(isset($_REQUEST['client_timestamp'])) {
                 //the time posted to this script through the form
                $client_time = $_REQUEST['client_timestamp'];
                $server_time = time();
                $xt1 = new DateTime();
                $xt =  $xt1->format('D M d Y H:i:s  \G\M\TO (T)');
                $client_string = 'Your clients time is: ';
                $client_string .= $client_time;
                $server_string = 'Your server time is: ';
                $server_string .= $xt;
                 //display the times
                echo $client_string.'<br>';
                echo $server_string.'<br>';
                
        }

	echo 'running';
	echo ' - '.$xt;  
  ?>      
</body>

</html>
