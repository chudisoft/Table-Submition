<?php
    session_start();
    $SiteName = "Chudisoft.com";
    $AdminEmail = "chudisoft@gmail.com";
    $SiteEmail = "support@chudisoft.com";
    $SiteURL = "https://test.chudisoft.com";
    $SiteLogo = '<a href="'.$SiteURL.'">
                <img src="'.$SiteURL.'/asset/img/logo.png" alt="" class="" style="max-width:80%">
            </a>';
    
    
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "ticketsubmitiondb";

    
    // CONNECTING TO THE DATABASE
    $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die(__LINE__ . ' Connection Failed: ' . $conn->connect_errno);
    }

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: " . $SiteEmail . "\r\n".
        "Reply-To: " . $SiteEmail . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

	function validate($con, $vi){
		if ($vi == null) {
			return $vi;
		}

		$var = mysqli_real_escape_string($con, $vi);
		$var_p = filter_var($var, FILTER_SANITIZE_STRING);
		return $var_p;
	}
	function GUID()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	
	function mail_Reg($name, $email, $ref, $pass, $username){
        $to = $email;
        $subject = "Account Registration";
        global $headers; global $SiteURL; global $SiteName; global $AdminEmail;
        //$headers .= "\r\n BC: " . $AdminEmail;
        $message = 'Hello ' . $name .
                    '<h2 style="text-align:center; color:#326dd9;">Excellent job on creating your account!</h2>
                    <div>
                        Your account with '.$SiteName.' has been successfully registered. We are happy to welcome you to the team.
                    </div>
          
                    <span>Here Are Your Login Details</span>
                    <p style="color:#326dd9;">
                        <span style="font-size:16px; color:black">Here Are Your Login Details</span><br/>
	                    Username: '.$username.'<br/>
	                    Password: '.$pass.'
                    </p>';
        $temp = $message.'Best Regards,<br/><a href="'.$SiteURL.'">'.$SiteName.'</a><br/><br/> <img src="'.$SiteURL.'/logo.png" alt="Company logo"> ';

        mail($to,$subject,$temp,$headers);
        mail($AdminEmail,$subject,$temp,$headers);
	}
	
	function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
?>