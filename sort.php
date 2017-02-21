<?php
include("config.php");

$sql = "SELECT * FROM emprofile WHERE Status = 1";

if ($_GET['sort'] == 'id')
{
    $sql .= " ORDER BY EmpID";
}
elseif ($_GET['sort'] == 'emp')
{
    $sql .= " ORDER BY Fname";
}
elseif ($_GET['sort'] == 'dob')
{
    $sql .= " ORDER BY DOB";
}
elseif($_GET['sort'] == 'cell')
{
    $sql .= " ORDER BY Cell";
}
$sql = mysql_query($sql);
$result = mysql_fetch_assoc($sql); 

?>