<?
  session_start();
  session_register("MM_Username_session");
  session_register("MM_UserAuthorization_session");
  session_register("denyreason_session");
  session_register("loginattempt_session");
  session_register("activity_session");
?>
<!--#include file="connection.php" -->
<? 
// *** Restrict Access To Page: Grant or deny access to this page

$MM_authorizedUsers="";
$MM_authFailedURL="login.asp?login=1";
$MM_grantAccess=false;
if ($MM_Username_session!="")
{

  if ((true || $MM_UserAuthorization_session=="") || 
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
<? 
$rsSent__MMColParam="0";
if (($MM_Username_session!=""))
{
  $rsSent__MMColParam=$MM_Username_session;
} ?>
<? 
// $rsSent is of type "ADODB.Recordset"

echo $MM_conn_STRING;
echo "SELECT *  FROM National_Events WHERE National_Event_Receiver_Ruler = '"+str_replace("'","''",$rsSent__MMColParam)+"' ORDER BY National_Event_ID DESC";

echo 0;
echo 2;
echo 3;
$rs=mysql_query();
$rsSent_numRows=0;
?>
<? 

$RecordCounter=0;
?>
<? 
$repeat8__numRows=9;
$repeat8__index=0;
$rsSent_numRows=$rsSent_numRows+$repeat8__numRows;
?>
<? 
//  *** Recordset Stats, Move To Record, and Go To Record: declare stats variables



// set the record count

$rsSent_total=mysql_num_rows($rsSent_query);

// set the number of rows displayed on this page

if (($rsSent_numRows<0))
{

  $rsSent_numRows=$rsSent_total;
}
  else
if (($rsSent_numRows==0))
{

  $rsSent_numRows=1;
} 


// set the first and last displayed record

$rsSent_first=1;
$rsSent_last=$rsSent_first+$rsSent_numRows-1;

// if we have the correct record count, check the other stats

if (($rsSent_total!=-1))
{

  if (($rsSent_first>$rsSent_total))
  {

    $rsSent_first=$rsSent_total;
  } 

  if (($rsSent_last>$rsSent_total))
  {

    $rsSent_last=$rsSent_total;
  } 

  if (($rsSent_numRows>$rsSent_total))
  {

    $rsSent_numRows=$rsSent_total;
  } 

} 

?>
<? 
// *** Recordset Stats: if we don't know the record count, manually count them
if (($rsSent_total==-1))
{


// count the total records by iterating through the recordset

  $rsSent_total=0;
  while((!($rsSent==0)))
  {

    $rsSent_total=$rsSent_total+1;
    $rsSent=mysql_fetch_array($rsSent_query);
    $rsSent_BOF=0;

  } 

// reset the cursor to the beginning

  if ((>0))
  {

    
  }
    else
  {

    
  } 


// set the number of rows displayed on this page

  if (($rsSent_numRows<0 || $rsSent_numRows>$rsSent_total))
  {

    $rsSent_numRows=$rsSent_total;
  } 


// set the first and last displayed record

  $rsSent_first=1;
  $rsSent_last=$rsSent_first+$rsSent_numRows-1;

  if (($rsSent_first>$rsSent_total))
  {

    $rsSent_first=$rsSent_total;
  } 

  if (($rsSent_last>$rsSent_total))
  {

    $rsSent_last=$rsSent_total;
  } 


} 

?>

<? 
// *** Move To Record and Go To Record: declare variables




$MM_rs=$MM_rsCount=$rsSent_total;
$MM_size=$rsSent_numRows;
$MM_uniqueCol="";
$MM_paramName="";
$MM_offset=0;
$MM_atTotal=false;
$MM_paramIsDefined=false;
if (($MM_paramName!=""))
{

  $MM_paramIsDefined=($_GET[$MM_paramName]<>"");
} 

?>
<? 
// *** Move To Record: handle 'index' or 'offset' parameter
if ((!$MM_paramIsDefined && $MM_rsCount!=0))
{


// use index parameter if defined, otherwise use offset parameter

  $MM_param=$_GET["index"];
  if (($MM_param==""))
  {

    $MM_param=$_GET["offset"];
  } 

  if (($MM_param!=""))
  {

    $MM_offset=intval($MM_param);
  } 


// if we have a record count, check if we are past the end of the recordset

  if (($MM_rsCount!=-1))
  {

    if (($MM_offset>=$MM_rsCount || $MM_offset==-1))
    {
// past end or move last

      if ((($MM_rsCount$Mod$MM_size)>0))
      {
// last page not a full repeat region

        $MM_offset=$MM_rsCount-($MM_rsCount%$MM_size);
      }
        else
      {

        $MM_offset=$MM_rsCount-$MM_size;
      } 

    } 

  } 


// move the cursor to the selected record

  $MM_index=0;
  while(((!$MM_rs->EOF) && ($MM_index<$MM_offset || $MM_offset==-1)))
  {

$MM_rs->MoveNext;
    $MM_index=$MM_index+1;
  } 
  if (($MM_rs->EOF))
  {

    $MM_offset=$MM_index; // set MM_offset to the last possible record
;
  } 


} 

?>
<? 
// *** Move To Record: if we dont know the record count, check the display range


if (($MM_rsCount==-1))
{


// walk to the end of the display range for this page

  $MM_index=$MM_offset;
  while((!$MM_rs->EOF && ($MM_size<0 || $MM_index<$MM_offset+$MM_size)))
  {

$MM_rs->MoveNext;
    $MM_index=$MM_index+1;
  } 

// if we walked off the end of the recordset, set MM_rsCount and MM_size

  if (($MM_rs->EOF))
  {

    $MM_rsCount=$MM_index;
    if (($MM_size<0 || $MM_size>$MM_rsCount))
    {

      $MM_size=$MM_rsCount;
    } 

  } 


// if we walked off the end, set the offset based on page size

  if (($MM_rs->EOF && !$MM_paramIsDefined))
  {

    if (($MM_offset>$MM_rsCount-$MM_size || $MM_offset==-1))
    {

      if ((($MM_rsCount$Mod$MM_size)>0))
      {

        $MM_offset=$MM_rsCount-($MM_rsCount%$MM_size);
      }
        else
      {

        $MM_offset=$MM_rsCount-$MM_size;
      } 

    } 

  } 


// reset the cursor to the beginning

  if (($MM_rs->CursorType>0))
  {

$MM_rs->MoveFirst;
  }
    else
  {

$MM_rs->Requery;
  } 


// move the cursor to the selected record

  $MM_index=0;
  while((!$MM_rs->EOF && $MM_index<$MM_offset))
  {

$MM_rs->MoveNext;
    $MM_index=$MM_index+1;
  } 
} 

?>
<? 
// *** Move To Record: update recordset stats


// set the first and last displayed record

$rsSent_first=$MM_offset+1;
$rsSent_last=$MM_offset+$MM_size;

if (($MM_rsCount!=-1))
{

  if (($rsSent_first>$MM_rsCount))
  {

    $rsSent_first=$MM_rsCount;
  } 

  if (($rsSent_last>$MM_rsCount))
  {

    $rsSent_last=$MM_rsCount;
  } 

} 


// set the boolean used by hide region to check if we are on the last record

$MM_atTotal=($MM_rsCount<>-1&$MM_offset+$MM_size>=$MM_rsCount);
?>
<? 
// *** Go To Record and Move To Record: create strings for maintaining URL and Form parameters




// create the list of parameters which should not be maintained

$MM_removeList="&index=";
if (($MM_paramName!=""))
{

  $MM_removeList=$MM_removeList."&".$MM_paramName."=";
} 


$MM_keepURL="";
$MM_keepForm="";
$MM_keepBoth="";
$MM_keepNone="";

// add the URL parameters to the MM_keepURL string

foreach ($_GET as $MM_item)
{

  $MM_nextItem="&".$MM_item."=";
  if (((strpos(1,$MM_removeList,$MM_nextItem,1) ? strpos(1,$MM_removeList,$MM_nextItem,1)+1 : 0)==0))
  {

    $MM_keepURL=$MM_keepURL.$MM_nextItem.rawurlencode($_GET[$MM_item]);
  } 

} 
// add the Form variables to the MM_keepForm string

foreach ($_POST as $MM_item)
{

  $MM_nextItem="&".$MM_item."=";
  if (((strpos(1,$MM_removeList,$MM_nextItem,1) ? strpos(1,$MM_removeList,$MM_nextItem,1)+1 : 0)==0))
  {

    $MM_keepForm=$MM_keepForm.$MM_nextItem.rawurlencode($_POST[$MM_item]);
  } 

} 
// create the Form + URL string and remove the intial '&' from each of the strings$MM_keepBoth=$MM_keepURL.$MM_keepForm;
if (($MM_keepBoth!=""))
{

  $MM_keepBoth=substr($MM_keepBoth,strlen($MM_keepBoth)-(strlen($MM_keepBoth)-1));
} 

if (($MM_keepURL!=""))
{

  $MM_keepURL=substr($MM_keepURL,strlen($MM_keepURL)-(strlen($MM_keepURL)-1));
} 

if (($MM_keepForm!=""))
{

  $MM_keepForm=substr($MM_keepForm,strlen($MM_keepForm)-(strlen($MM_keepForm)-1));
} 


// a utility function used for adding additional parameters to these strings

function MM_joinChar($firstItem)
{
  extract($GLOBALS);


  if (($firstItem!=""))
  {

    $MM_joinChar="&";
  }
    else
  {

    $MM_joinChar="";
  } 

  return $function_ret;
} 
?>
<? 
// *** Move To Record: set the strings for the first, last, next, and previous links




$MM_keepMove=$MM_keepBoth;
$MM_moveParam="index";

// if the page has a repeated region, remove 'offset' from the maintained parametersif (($MM_size>1))
{

  $MM_moveParam="offset";
  if (($MM_keepMove!=""))
  {

    $MM_paramList=$Split[$MM_keepMove]["&"];
    $MM_keepMove="";
    for ($MM_paramIndex=0; $MM_paramIndex<=count($MM_paramList); $MM_paramIndex=$MM_paramIndex+1)
    {

      $MM_nextParam=substr($MM_paramList[$MM_paramIndex],0,(strpos($MM_paramList[$MM_paramIndex],"=") ? strpos($MM_paramList[$MM_paramIndex],"=")+1 : 0)-1);
      if ((strcmp($MM_nextParam,$MM_moveParam,1)!=0))
      {

        $MM_keepMove=$MM_keepMove."&".$MM_paramList[$MM_paramIndex];
      } 


    } 

    if (($MM_keepMove!=""))
    {

      $MM_keepMove=substr($MM_keepMove,strlen($MM_keepMove)-(strlen($MM_keepMove)-1));
    } 

  } 

} 


// set the strings for the move to links

if (($MM_keepMove!=""))
{

  $MM_keepMove=$MM_keepMove."&";
} 


$MM_urlStr=$_SERVER["URL"]."?".$MM_keepMove.$MM_moveParam."=";

$MM_moveFirst=$MM_urlStr."0";
$MM_moveLast=$MM_urlStr."-1";
$MM_moveNext=$MM_urlStr.$MM_offset+$MM_size;
if (($MM_offset-$MM_size<0))
{

  $MM_movePrev=$MM_urlStr."0";
}
  else
{

  $MM_movePrev=$MM_urlStr.$MM_offset-$MM_size;
} 

?>

<? 
$HLooper1__numRows=-2;
$HLooper1__index=0;
$rsCat_numRows=$rsCat_numRows+$HLooper1__numRows;
?>
<!--#include file="inc_header.php" -->
<? 
//Dimension variables


$lngRecordNo=intval($rsGuestbookHead["Nation_ID"]);

// $adoCon is of type "ADODB.Connection"

$a2p_connstr==$MM_conn_STRING;
$a2p_uid=strstr($a2p_connstr,'uid');
$a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$a2p_pwd=strstr($a2p_connstr,'pwd');
$a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$a2p_database=strstr($a2p_connstr,'dsn');
$a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$adoCon=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
mysql_select_db($a2p_database,$adoCon);
// $rsGuestbook is of type "ADODB.Recordset"

$strSQL="SELECT * FROM Nation WHERE Nation_ID=".$lngRecordNo;
$rs=mysql_query($strSQL);?>  

<!--#include file="calculations.php" --> 

<? if (strtoupper($rsUser->Fields.$Item["U_ID"].$Value)><strtoupper($rsGuestbookHead->Fields.$Item["POSTER"].$Value))
{
?>
<font color="#FF0000">Please do not attempt to cheat.</font>
<? }
  else
{
?> 

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td height="0" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td height="221" align="left" valign="top"> <?   if ($rsUser->EOF && $rsUser->BOF)
  {
?>
<?   } 
// end rsUser.EOF And rsUser.BOF  $rsUser->EOF|$Not$rsUser->BOF$Then; ?>




<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td height="0" align="left" valign="middle">
<p align="center"><b>Events for <?   echo (.$Item["Nation_Name"].$Value); ?>

</b>

<p>
Events are generated randomly when you collect taxes. Expired events will be 
automatically deleted five days after the event expiration date.
</p>



<?   if (!($rsSent==0) || !($rsSent_BOF==1))
  {
?>
<table width="90%" border="0">
<tr> 
<td width="62%">&nbsp;</td>
<td width="38%">&nbsp; <table border="0" width="100%" align="center">
<tr> 
<td width="23%" align="center"> <?     if ($MM_offset!=0)
    {
?>
<a href="<?       echo $MM_moveFirst; ?>"><img src="assets/First.gif" border=0></a> 
<?     } 
// end MM_offset <> 0  

//31%" align="center"> <% If MM_offset <> 0 Then ?>  } 

//<%=MM_movePrev%>"><img src="assets/Previous.gif" border=0></a> // end MM_offset <> 0  ?> 
</td>
<td width="23%" align="center"> <?   if (!$MM_atTotal)
  {
?>
<a href="<?     echo $MM_moveNext; ?>"><img src="assets/Next.gif" border=0></a> 
<?   } 
// end Not MM_atTotal  

//23%" align="center"> <% If Not MM_atTotal Then ?>} 

//<%=MM_moveLast%>"><img src="assets/Last.gif" border=0></a> // end Not MM_atTotal  ?> 
</td>
</tr>
</table></td>
</tr>
</table>
<? ' end Not rsSent.EOF Or NOT rsSent.BOF %> 
</td>
</tr>
<tr> 
<td align="left" valign="top"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr> 
<td width="100%" height="150"><form action="messageDeleting2.php" method="post" name="outbox" id="outbox">
<? 