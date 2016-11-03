<?php
$counter = 0;
$file = fopen("data.csv", "r");
while (!feof($file)) {
    $ar = fgetcsv($file);
    $counter++;
}

$message = "
<html>
<head>
<title>Visitor Report</title>
</head>
<body>
<p>Visitor Report</p>
<table style='width:200px;'>
<tr>
<th style='width:100px;'>Date</th>
<th>Visitor</th>
</tr>
<tr>
<td>" . date('M d, Y') . "</td>
<td>{$counter}</td>
</tr>
</table>

<h2><a href='http://sohelrana.me/theme-tracking/car-house/data.csv'>Download Data</a></h2>

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail('me.sohelrana@gmail.com', 'Car House - Visitor Report', $message, $headers);
