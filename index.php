<?php
include 'configs/index.php';

$me_ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$domain = '-';
$ip = '-';
$country_code = '-';
$country_name = '-';
$region_name = '-';
$city_name = '-';
$latitude = '-';
$longitude = '-';
$action = '-';

if (empty($_GET['ip'])) {
    if (isset($_GET['check'])) {
        $domain = $_GET['domain'];
        $ip = gethostbyname($domain);
        $apiKey = "YOUR_API";
        $url = "https://api.ip2location.com/v2/?ip={$ip}&key={$apiKey}&package=WS5";
        $data = json_decode(file_get_contents($url), true);
        $country_code = $data['country_code'];
        $country_name = $data['country_name'];
        $region_name = $data['region_name'];
        $city_name = $data['city_name'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $action = '<a class="cusme_button_type_2" title="Go to maps" alt="Go to maps" target="_blank" href="https://www.google.com/maps/search/?api=1&query='.$latitude.'%2C'.$longitude.'">Maps</a>';
        if (isset($data['response']) == 'OK') {
            mysqli_query($link, "INSERT INTO me_check (domain, ip_address, country_code, country_name, region_name, city_name, latitude, longitude, me_ip) VALUES ('$domain', '$ip', '$country_code', '$country_name', '$region_name', '$city_name', '$latitude', '$longitude', '$me_ip')");
        }
    }
} else {
    if (isset($_GET['check'])) {
        $domain = $_GET['domain'];
        $ip = gethostbyname($domain);
        $apiKey = "YOUR_API";
        $url = "https://api.ip2location.com/v2/?ip={$ip}&key={$apiKey}&package=WS5";
        $data = json_decode(file_get_contents($url), true);
        $country_code = $data['country_code'];
        $country_name = $data['country_name'];
        $region_name = $data['region_name'];
        $city_name = $data['city_name'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $action = '<a class="cusme_button_type_2" title="Go to maps" alt="Go to maps" target="_blank" href="https://www.google.com/maps/search/?api=1&query='.$latitude.'%2C'.$longitude.'">Maps</a>';
        if (isset($data['response']) == 'OK') {
            mysqli_query($link, "INSERT INTO me_check (domain, ip_address, country_code, country_name, region_name, city_name, latitude, longitude, me_ip) VALUES ('$domain', '$ip', '$country_code', '$country_name', '$region_name', '$city_name', '$latitude', '$longitude', '$me_ip')");
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CusMeDroid | IP2Location Contest</title>
        <link rel="icon" type="image/x-icon" href="icon/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Search Website From Domain And Get IP Info With API By IP2Location.">
        <meta name="author" content="CusMeDroid">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
        <link rel="stylesheet" href="https://cusmedroid.github.io/fontawesome-4/css/font-awesome.min.css">
        <script type="text/javascript" src="https://cusmedroid.github.io/js/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <header id="myBg">
            <h1 id="title" class="audiowide">CusMeDroid</h1>
            <p id="description" class="sofia palere">Search Website From Domain And Get IP Info With API By <a alt="IP2Location" title="IP2Location" target="_blank" style="color:#fff;" href="https://www.ip2location.com/">IP2Location.</a></p>
            <p class="sofia palere tag">#ProgrammingContest and #IP2LocationContest</p>
        </header>
        <form method="get">
            <input class="cusme_input_type_1" type="text" name="domain" placeholder="Ex : google.com" required>
            <button class="cusme_button_type_1" type="submit" name="check" value="OK"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <main id="main">
            <div class="encrol">
                <table id="customers">
                    <tr>
                        <th class="radius_left">Domain</th>
                        <th>IP Address</th>
                        <th>Country Code</th>
                        <th>Country Name</th>
                        <th>Region Name</th>
                        <th>City Name</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th class="radius_right">Action</th>
                    </tr>
                    <tr>
                        <td><?php echo $domain ?></td>
                        <td><?php echo $ip ?></td>
                        <td><?php echo $country_code ?></td>
                        <td><?php echo $country_name ?></td>
                        <td><?php echo $region_name ?></td>
                        <td><?php echo $city_name ?></td>
                        <td><?php echo $latitude ?></td>
                        <td><?php echo $longitude ?></td>
                        <td align="center"><?php echo $action ?></td>
                    </tr>
                </table>
            </div>
        </main>
        <div class="main">
            <div id="msugest">
                <h1 id="sugesto" class="titlehome audiowide">History <i class="fa fa-retweet" aria-hidden="true"></i></h1>
                <div id="btnContainer">
                  <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
                  <button class="btn piactive" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
                </div>
                <br>
                <div class="row">
                    <?php

                    $per_page_record = 6;
                    if (isset($_GET["page_pos"])) {    
                        $page  = $_GET["page_pos"];    
                    } else {    
                        $page=1;    
                    }
                            
                    $start_from = ($page-1) * $per_page_record;
                            
                    $possqlite = "SELECT * FROM me_check ORDER BY id DESC LIMIT $start_from, $per_page_record";
                    $posquery = mysqli_query($link, $possqlite);
                
                    while ($posdata = mysqli_fetch_array($posquery)) {
                        ?>
                        <div class="column">
                            <div class="card">
                              <img oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' class="card-img" alt="" title="" src="icon/logo.png">
                              <div class="card-title sofia"><b><?php echo $posdata['domain']?></b></div>
                              <div class="card-container">
                                <div class="row">
                                    <div class="card-column">
                                        <p class="pabo"><b><?php echo $posdata['ip_address']?></b></p>
                                    </div>
                                    <div class="card-column">
                                        <p align="right">
                                            <a alt="<?php echo $posdata['domain']?>" title="<?php echo $posdata['domain']?>" target="_blank" href="http://<?php echo $posdata['domain']?>" class="mbtn"><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </p>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <?php
                    }
                  ?>
                  <!-- Row -->
                </div>
                <center style="padding:20px;">
                    <div class="pagination">
                        <?php  
                            $poscount = "SELECT COUNT(*) FROM me_check";     
                            $posquerys = mysqli_query($link, $poscount);     
                            $posrow = mysqli_fetch_row($posquerys);     
                            $total_records = $posrow[0];     
                              
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pagLink = "";       
                                                      
                            if($page>=2){   
                                echo "<a href='?page_pos=".($page-1)."#msugest'>«</a>";   
                            }       
                                                                   
                            for ($jhi=1; $jhi<=$total_pages; $jhi++){   
                                if ($jhi == $page) {   
                                    $pagLink .= "<a style='color:black;' class='activeps' href='?page_pos=".$jhi."#msugest'>".$jhi."</a>";   
                                } else  {    
                                    $pagLink .= "<a style='color:black;' href='?page_pos=".$jhi."#msugest'>".$jhi."</a>";
                                }   
                            };     
                            echo $pagLink;
                                                  
                            if($page<$total_pages){   
                                echo "<a style='color:black;' href='?page_pos=".($page+1)."#msugest'>»</a>";   
                            }
                        ?>
                    </div>
                </center>
            </div>
        </div>
        <footer>
            <div class="row">
              <div class="column3 trump">
                <h1 class="audiowide">CusMeDroid</h1>
                <p id="description" class="sofia pato">&copy; 2022 Powered By <a target="_blank" style="color: white;" alt="CusMeDroid" title="CusMeDroid" href="https://cusmedroid.github.io/ip2location-contest">CusMeDroid</a></p>
              </div>
              <div class="column3">
                  <div class="column2">
                    <h1 class="audiowide">Sponsor</h1>
                    <p id="description" class="sofia pato"><a target="_blank" style="color: white;" title="iExperimen" alt="iExperimen" href="https://iexperimen.github.io">iExperimen</a></p>
                    <p id="description" class="sofia pato"><a target="_blank" style="color: white;" title="MWF Album" alt="MWF Album" href="https://google.com/search?q=MWFAlbum">MWF Album</a></p>
                    <p id="description" class="sofia pato"><a target="_blank" style="color: white;" title="IyoRTML" alt="IyoRTML" href="https://google.com/search?q=iyortml">IyoRTML</a></p>
                    <p id="description" class="sofia pato pabo"><a target="_blank" style="color: white;" title="Radio Tip Masa Lampau" alt="Radio Tip Masa Lampau" href="https://google.com/search?q=Radio+Tip+Masa+Lampau">Radio Tip Masa Lampau</a></p>
                  </div>
                  <div class="column2">
                    <h1 class="audiowide">Contact</h1>
                    <p id="description" class="sofia pato"><a target="_blank" style="color: white;" title="Send Mail" alt="Send Mail" href="mailto:iyortml@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i> IyoRTML</a></p>
                    <p id="description" class="sofia pato"><a target="_blank" style="color: white;" title="Call" alt="Call" href="tel:+6285772757932"><i class="fa fa-phone" aria-hidden="true"></i> +62 8577 2757 932</a></p>
                  </div>
              </div>
            </div>
        </footer>
        <script type="text/javascript">
            // Get the elements with class="column"
            var elements = document.getElementsByClassName("column");

            // Declare a loop variable
            var pi;

            // List View
            function listView() {
            for (pi = 0; pi < elements.length; pi++) {
                elements[pi].style.width = "100%";
            }
            }

            // Grid View
            function gridView() {
            for (pi = 0; pi < elements.length; pi++) {
                elements[pi].style.width = "50%";
            }
            }

            /* Optional: Add active class to the current button (highlight it) */
            var container = document.getElementById("btnContainer");
            var btns = container.getElementsByClassName("btn");
            for (var pi = 0; pi < btns.length; pi++) {
            btns[pi].addEventListener("click", function() {
                var current = document.getElementsByClassName("piactive");
                current[0].className = current[0].className.replace(" piactive", "");
                this.className += " piactive";
            });
            }
        </script>
    </body>
</html>