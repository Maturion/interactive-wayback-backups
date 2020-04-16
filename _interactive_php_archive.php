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


if($filecontent === false) {

    /* Customizations for phpBB-based forums */
    if (strpos($finalfilename, '&amp') !== false) {
        $finalfilename = (substr($finalfilename, 0, -8) . '.txt');
    }
    if (strpos($finalfilename, 'sid=') !== false) {

        $finalfilename = preg_replace('/(?<=sid=)(.*)(?=.txt|&)/', '', $finalfilename);
        $sidreplacements = ['&sid=', '?sid='];
        $finalfilename = str_replace($sidreplacements, '', $finalfilename);
    }
 
    $filecontent = file_get_contents($finalfilename);
    $filecontent = ($filecontent !== false) ? $filecontent : '<h1>Nicht gefunden</h1>';
    
}

echo $filecontent;
