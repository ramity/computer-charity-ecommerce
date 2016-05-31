<?php
$opts = array(
  'https'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file=file_get_contents('http://pcpartpicker.com/user/ramity/saved/JPKscf',false,$context);
$bits=explode('<!-- heading -->',$file);

echo $bits[1];
echo $bits[2];
echo $bits[3];
echo $bits[4];
echo $bits[5];
echo $bits[6];

$line=cut('<div style="margin-top:8px;">','</div>',$bits[1]);
$line=cut('">','</a>',$line[0]);
$item=$line[0];
echo $item;

$line=cut('<b>','</b>',$bits[1]);
$line=cut('">','</a>',$line[0]);
$type=$line[0];
echo $type;

$line=cut(' rel="nofollow" target="_blank">','</a>',$bits[1]);
$price=$line[0];
echo $price;

function cut($start,$finish,$value)
{
	$foo=explode($start,$value);
	$bar=explode($finish,$foo[1]);
	return $bar;
}
?>