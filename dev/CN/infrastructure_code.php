<?
  session_start();
  session_register("MM_Username_session");
  session_register("MM_UserAuthorization_session");
  session_register("activity_session");
  session_register("denyreason_session");
  session_register("loginattempt_session");
?>
<!--#include file="connection.php" -->
<? 
// *** Restrict Access To Page: Grant or deny access to this page

$MM_authorizedUsers="";
$MM_authFailedURL="login.asp";
$MM_grantAccess=false;
if ($MM_Username_session!="")
{

  if ((false || $MM_UserAuthorization_session=="") || 
     ((strpos(1,$MM_authorizedUsers,$MM_UserAuthorization_session) ? strpos(1,$MM_authorizedUsers,$MM_UserAuthorization_session)+1 : 0)>=1))
  {

    $MM_grantAccess=true;
  } 

} 

if (!$MM_grantAccess)
{

  $MM_qsChar="?";
  if (((strpos(1,$MM_authFailedURL,"?") ? strpos(1,$MM_authFailedURL,"?")+1 : 0)>=1))
  {
    $MM_qsChar="&";
  } 
  $MM_referrer=$_SERVER["URL"];
  if ((strlen($_GET[])>0))
  {
    $MM_referrer=$MM_referrer."?".$_GET[];
  } 
  $MM_authFailedURL=$MM_authFailedURL.$MM_qsChar."accessdenied=".rawurlencode($MM_referrer);
  header("Location: ".$MM_authFailedURL);
} 

?>
<!--#include file="activity.php" -->
<!--#include file="inc_header.php" -->

<? 
$lngRecordNo=intval($rsGuestbookHead["Nation_ID"]);
// $rsGuestbook is of type "ADODB.Recordset"

$rsGuestbookSQL="SELECT Nation.* FROM Nation WHERE Nation_ID=".$lngRecordNo;
echo 0;
echo 2;
echo 3;
$rs=mysql_query($rsGuestbookSQL);

?>
<!--#include file="trade_connections.php" -->
<!--#include file="calculations.php" -->
<!--#include file="calculations_costs.php" -->
<? 
//Update the record in the recordset

if ($_POST["purchase_land"]>0)
{

  //Money_Spent") = rsGuestbook("Money_Spent") + (Request.form("purchase_land") * infrastructurecost)} 

if ($_POST["purchase_land"]<0)
{

  //Money_Spent") = rsGuestbook("Money_Spent") + (Request.form("purchase_land") * infrastructurecost2)} 


//Infrastructure_Purchased") =  Request.form("purchase_land") + rsGuestbook("Infrastructure_Purchased")//Number_Of_Purchases") = (rsGuestbook("Number_Of_Purchases") +1)
$checker=0;
if (($_POST["purchase_amount"]=="") || ($_POST["purchase_land"]==""))
{

  $checker=1;
  $denyreason_session="Purchase amount or land purchase amount is null.";
  header("Location: "."activity_denied.asp");
} 


if (time()()-$rsGuestbook["Last_Bills_Paid"]>=3 && $_POST["purchase_land"]>0)
{

  $denyreason_session="You must pay your bills before purchasing infrastructure.";
  $checker=1;
  header("Location: "."activity_denied.asp");
} 


if ($_POST["purchase_land"]<0)
{

  if (($rsGuestbook["Infrastructure_Purchased"]-$_POST["purchase_land"]<100))
  {

    $checker=1;
    $denyreason_session="You do not have that much infrastructure to sell. You must have 100 levels of infrastructure or more before attempting to sell infrastructure.";
    header("Location: "."activity_denied.asp");
  } 


  if ($rsGuestbook["Infrastructure_Purchased"]<0)
  {

    $denyreason_session="You have no infrastructure to sell.";
    $checker=1;
    header("Location: "."activity_denied.asp");
  } 

} 


if (($_POST["purchase_land"]>10))
{

  $checker=1;
  $denyreason_session="Infrastructure purchase is greater than the maximum allowed.";
  header("Location: "."activity_denied.asp");
} 


if (($_POST["purchase_land"]<-10))
{

  $checker=1;
  $denyreason_session="Infrastructure sale is greater than the maximum allowed.";
  header("Location: "."activity_denied.asp");
} 


if (($_POST["purchase_amount"]-$totalmoneyavailable>0))
{

  $denyreason_session="Purchase amount is greater than the amount of money you actually have.";
  $checker=1;
  header("Location: "."activity_denied.asp");
} 


if ((($_POST["purchase_land"]*$infrastructurecost)-$_POST["purchase_amount"]>5) && (($_POST["purchase_land"]*$infrastructurecost2)-$_POST["purchase_amount"]>5))
{

  $denyreason_session="The purchase and infrastructure calculation does not add up correctly in the system.";
  $checker=1;
  header("Location: "."activity_denied.asp");
} 


if ((($_POST["purchase_land"]*$infrastructurecost)-$totalmoneyavailable>5))
{

  $denyreason_session="You do not have enough money for that transaction.";
  $checker=1;
  header("Location: "."activity_denied.asp");
} 


if ($checker==0)
{

//Write the updated recordset to the database

  
} 

?>
<!--#include file="database_nationstrength.php" -->
<? 
//Reset server objects



$rsGuestbook=null;

$objConn->Close();
$objConn=null;


//Return to the update select page in case another record needs deleting

header("Location: "."nation_drill_display.asp?Nation_ID=".$lngRecordNo);
?>  
 
