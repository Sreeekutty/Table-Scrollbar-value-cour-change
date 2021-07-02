
<?php

$hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "admin";  // MySQL database name 
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

$strQuery = "select t.Day,DATE_FORMAT(t.Date,'%c-%d-%Y') as Date,sum(s.GrossAmt) as GrossAmt from transdate as t join salesmaster as s where t.Date=s.DOT  group by t.Date ";
//DATE_FORMAT(salesmaster.DOT,'%c-%d-%Y') as DOT
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

?>
<html>
<head>
<style>
.divScroll {
 overflow:scroll; 
height:600px;
width:800px;
margin:4px, 4px;
position: -webkit-sticky;
position: sticky;
 overflow-x: auto;
 overflow-y: auto;
text-align:justify;
}
</style>
</head>
<body>

<div class="divScroll">



 <?php
 echo "<table border=3 bgcolor=wheat width=150%>";
  
 echo"<tr>";
  
 echo"<th>";  echo "Day";  echo"</th>";
 echo"<th>";  echo "Date";  echo"</th>";
 echo"<th>";  echo "GrossAmt";  echo"</th>";
   
 echo"</tr>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
  
  echo "<tr>";
            if($row['GrossAmt']>149204)
                              {
                                echo "<td style='color: #000000'>" . $row['Day']. "</td>";
                                echo "<td style='color: #000000'>" . $row['Date']. "</td>";
                                echo "<td style='color: #000000'>" . $row['GrossAmt']. "</td>";
                                
                              }
            else
                             {
                                echo "<td style='color: #FF0000'>" . $row['Day']. "</td>";
                                echo "<td style='color: #FF0000'>" . $row['Date']. "</td>";
                                echo "<td style='color: #FF0000;'>".$row['GrossAmt']."</td>"; 
        
                              }
  echo "</tr>";
}

}
echo"</table>";
?> 
</div>

</body>
</html>