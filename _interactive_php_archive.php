<?php
header("Content-Type: text/html; charset=ISO-8859-15");
$filedir = basename($_SERVER['PHP_SELF'], ".php");
$filename = $filedir . "-php";


$i = 0;
foreach($_GET as $param => $value) {
    $amp = ($i > 0) ? "&" : "?";
    $addtourl = $amp . $param . "=" . $value;

    if($param == 'amp') {
        $addtourl = '&amp;amp';
    }

    $filename = $filename . $addtourl; 
    $i++;
}

$finalfilename = ".phparchiv/" . $filedir . "/" . $filename . ".txt";
$filecontent = file_get_contents($finalfilename);


/* Fallback URLs - If the current URL isn't archived, try if there's another copy of it */
$url_list = [];
$url_list[] = $finalfilename;

/* Customizations for phpBB-based forums */

if (strpos($finalfilename, 'sid=') !== false) {
    $finalfilename = preg_replace('/(?<=sid=)(.*)(?=.txt|&)/', '', $finalfilename);
    $sidreplacements = ['&sid=', '?sid='];
    $url_list[] = str_replace($sidreplacements, '', $finalfilename);
}

if (strpos($finalfilename, '&amp') === false) {
    $url_list = array_merge($url_list, array_map(function ($a) { return (substr($a, 0, -4) . '&amp.txt'); }, $url_list));
}

/* End of phpBB fixes */

$i = 0;
for($i=0; $i < sizeof($url_list); $i++) {
    $filecontent = file_get_contents($url_list[$i]);
    if($filecontent !== false) {
        break;   
    }  
}

$filecontent = ($filecontent !== false) ? $filecontent : '<h1>Not found</h1>';

echo $filecontent;
