<?
  session_start();
  session_register("MM_Username_session");
  session_register("MM_UserAuthorization_session");
  session_register("denyreason_session");
  session_register("loginattempt_session");
?>
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
<!--#include file="connection.php" -->

<? 
$rsMess__MMColParam="0";
if (($MM_Username_session!=""))
{
  $rsMess__MMColParam=$MM_Username_session;
} ?>
<? 
// $rsMess is of type "ADODB.Recordset"

echo $MM_conn_STRING_Messages;
echo "SELECT *  FROM EMESSAGES  WHERE  MESS_DATE > getdate()-7 AND  MESS_FROM = '"+str_replace("'","''",$rsMess__MMColParam)+"'  ORDER BY MESS_DATE DESC";
echo 0;
echo 2;
echo 3;
$rs=mysql_query();
$rsMess_numRows=0;
?>
<? 
//Dim RecordCounter

$RecordCounter=0;
?>
<? 
//Dim repeat8__numRows

//Dim repeat8__index


$repeat8__numRows=5;
$repeat8__index=0;
$rsMess_numRows=$rsMess_numRows+$repeat8__numRows;
?>
<? 
//  *** Recordset Stats, Move To Record, and Go To Record: declare stats variables



// set the record count

$rsMess_total=mysql_num_rows($rsMess_query);

// set the number of rows displayed on this page

if (($rsMess_numRows<0))
{

  $rsMess_numRows=$rsMess_total;
}
  else
if (($rsMess_numRows==0))
{

  $rsMess_numRows=1;
} 


// set the first and last displayed record

$rsMess_first=1;
$rsMess_last=$rsMess_first+$rsMess_numRows-1;

// if we have the correct record count, check the other stats

if (($rsMess_total!=-1))
{

  if (($rsMess_first>$rsMess_total))
  {

    $rsMess_first=$rsMess_total;
  } 

  if (($rsMess_last>$rsMess_total))
  {

    $rsMess_last=$rsMess_total;
  } 

  if (($rsMess_numRows>$rsMess_total))
  {

    $rsMess_numRows=$rsMess_total;
  } 

} 

?>
<? 
// *** Recordset Stats: if we don't know the record count, manually count them
if (($rsMess_total==-1))
{


// count the total records by iterating through the recordset

  $rsMess_total=0;
  while((!($rsMess==0)))
  {

    $rsMess_total=$rsMess_total+1;
    $rsMess=mysql_fetch_array($rsMess_query);
    $rsMess_BOF=0;

  } 

// reset the cursor to the beginning

  if ((>0))
  {

    
  }
    else
  {

    
  } 


// set the number of rows displayed on this page

  if (($rsMess_numRows<0 || $rsMess_numRows>$rsMess_total))
  {

    $rsMess_numRows=$rsMess_total;
  } 


// set the first and last displayed record

  $rsMess_first=1;
  $rsMess_last=$rsMess_first+$rsMess_numRows-1;

  if (($rsMess_first>$rsMess_total))
  {

    $rsMess_first=$rsMess_total;
  } 

  if (($rsMess_last>$rsMess_total))
  {

    $rsMess_last=$rsMess_total;
  } 


} 

?>

<? 
// *** Move To Record and Go To Record: declare variables




$MM_rs=$MM_rsCount=$rsMess_total;
$MM_size=$rsMess_numRows;
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

    $MM_param=intval($_GET["offset"]);
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

$rsMess_first=$MM_offset+1;
$rsMess_last=$MM_offset+$MM_size;

if (($MM_rsCount!=-1))
{

  if (($rsMess_first>$MM_rsCount))
  {

    $rsMess_first=$MM_rsCount;
  } 

  if (($rsMess_last>$MM_rsCount))
  {

    $rsMess_last=$MM_rsCount;
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

<? 
function DoTrimProperly($str,$nNamedFormat,$properly,$pointed,$points)
{
  extract($GLOBALS);


  $strRet=htmlspecialchars($str);
  $strRet=str_replace("\r\n","",$strRet);
  $strRet=str_replace("\t","",$strRet);
  if ((strlen($strRet)>$nNamedFormat))
  {

    $strRet=substr($strRet,0,$nNamedFormat);
    if (($properly==1))
    {

      $TempArray=$split[$strRet][" "];
      $strRet="";
      for ($n=0; $n<=count($TempArray)-1; $n=$n+1)
      {

        $strRet=$strRet." ".$TempArray[$n];

      } 

    } 

    if (($pointed==1))
    {

      $strRet=$strRet.$points;
    } 

  } 

  $DoTrimProperly=$strRet;
  return $function_ret;
} 
?>
<!--#include file="inc_header.php" -->

<script language="JavaScript" type="text/JavaScript">
<!-- Begin
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "Uncheck All"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "Check All"; }
}
//  End -->
<!--
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
//-->

</script>
           
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="0" valign="top"><p>
                  <? 
if ($rsUser->EOF && $rsUser->BOF)
{
?>
                  <? } 
// end rsUser.EOF And rsUser.BOF  $rsUser->EOF|$Not$rsUser->BOF$Then; ?>
                  <div align="center">
                  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000080">
                    <tr> 
                      <td align="left" bgcolor="#000080" height="26"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#ffffFF">
                      &nbsp;:. <? echo ($rsUser->Fields.$Item["U_ID"].$Value); ?>'s </font></b></font><b>
						<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFFF">
						Sent Messages</font></b></td>
                    </tr>
                    <tr> 
                      <td align="left" valign="top"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="100%"><font color="#FF0000" size="2">&nbsp;</font> 
                       <p>
                          <p align="left"><i><font color="#0000FF">Messages 
							older than 7 days will be automatically deleted. Please delete old unneeded 
								messages in order to help reduce the size of our 
								databases.</font><br>
&nbsp;</i></p>
								</p>
                              <? if (!($rsMess==0) || !($rsMess_BOF==1))
{
?>
                              <table width="100%" border="0" cellspacing="2" cellpadding="0">
                                <tr> 
                                  <td width="66%">Message <?   echo ($rsMess_first); ?> to <?   echo ($rsMess_last); ?> of <?   echo ($rsMess_total); ?> </td>
                                  <td width="34%"><div align="right"> 
                                      <table border="0" width="50%" align="center">
                                        <tr> 
                                          <td width="23%" align="center"> <?   if ($MM_offset!=0)
  {
?>
                                            <a href="<?     echo $MM_moveFirst; ?>"><img src="assets/First.gif" border=0></a> 
                                            <?   } 
// end MM_offset <> 0  
//31%" align="center"> <% If MM_offset <> 0 Then ?>} 

//<%=MM_movePrev%>"><img src="assets/Previous.gif" border=0></a> // end MM_offset <> 0  ?> </td>
                                          <td width="23%" align="center"> <? if (!$MM_atTotal)
{
?>
                                            <a href="<?   echo $MM_moveNext; ?>"><img src="assets/Next.gif" border=0></a> 
                                            <? } 
// end Not MM_atTotal  
//23%" align="center"> <% If Not MM_atTotal Then ?>
                                            <a href="<? 