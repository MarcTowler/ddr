<?
  session_start();
  session_register("MM_Username_session");
  session_register("MM_UserAuthorization_session");
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
<!--#include file="inc_header.php" -->
<? 
$tfm_orderby="Nation_Dated";
$tfm_order="DESC";
if (($_GET["tfm_orderby"]!=""))
{

  $tfm_orderby=$_GET["tfm_orderby"];
} 

if (($_GET["tfm_order"]!=""))
{

  $tfm_order=$_GET["tfm_order"];
} 


$sql_orderby=" ".$tfm_orderby." ".$tfm_order;
?>


<body bgcolor="white" text="black">


<p align="center">




<? 
$rsGuestbook__sql_orderby="Nation_Dated";
if (($sql_orderby!=""))
{

  $rsGuestbook__sql_orderby=$sql_orderby;
} 


$rsGuestbook__MMColParam="0";
if (($MM_Username_session!=""))
{
  $rsGuestbook__MMColParam=$MM_Username_session;
} 

// $rsGuestbook is of type "ADODB.Recordset"

$lngRecordNo=$_GET["Team"];
$lngRecordNo2=$_GET["Alliance"];
if ($lngRecordNo!="" && $lngRecordNo2!="")
{

  $denyreason_session="Do not modify the URL.";
  header("Location: "."activity_denied.asp");
} 


if ($rsGuestbookHead["Strength"]>=30000)
{

  if ($lngRecordNo=="" && $lngRecordNo2=="")
  {

    $rsGuestbookSQL="SELECT Last_Tax_Collection,Strength,Cruise_Purchased,Poster,Nation_ID,Nation_Name,Nation_Dated,Nation_Team,Land_Purchased,Infrastructure_Purchased,Technology_Purchased,Nuclear_Purchased,Nation_Peace,Nuclear FROM Nation Where ((Strength >= 30000) OR (Strength >= '".$rsGuestbookHead["Strength"]*.5."' AND Strength <= '".$rsGuestbookHead["Strength"]*2."')) AND Nation_Dated < getdate()-1 "+$tfm_SQLstr+" ORDER BY "+str_replace("'","''",$rsGuestbook__sql_orderby)+"";
  } 

  if ($lngRecordNo!="" && $lngRecordNo2=="")
  {

    $rsGuestbookSQL="SELECT Last_Tax_Collection,Strength,Cruise_Purchased,Poster,Nation_ID,Nation_Name,Nation_Dated,Nation_Team,Land_Purchased,Infrastructure_Purchased,Technology_Purchased,Nuclear_Purchased,Nation_Peace,Nuclear FROM Nation Where ((Strength >= 30000) OR (Strength >= '".$rsGuestbookHead["Strength"]*.5."' AND Strength <= '".$rsGuestbookHead["Strength"]*2."')) AND Nation_Dated < getdate()-1 AND Nation_Team = '"+$lngRecordNo+"'     "+$tfm_SQLstr+" ORDER BY "+str_replace("'","''",$rsGuestbook__sql_orderby)+"";
  } 

  if ($lngRecordNo=="" && $lngRecordNo2!="")
  {

    $rsGuestbookSQL="SELECT Last_Tax_Collection,Strength,Cruise_Purchased,Poster,Nation_ID,Nation_Name,Nation_Dated,Nation_Team,Land_Purchased,Infrastructure_Purchased,Technology_Purchased,Nuclear_Purchased,Nation_Peace,Nuclear FROM Nation Where ((Strength >= 30000) OR (Strength >= '".$rsGuestbookHead["Strength"]*.5."' AND Strength <= '".$rsGuestbookHead["Strength"]*2."')) AND Nation_Dated < getdate()-1 AND Alliance = '"+$lngRecordNo2+"'     "+$tfm_SQLstr+" ORDER BY "+str_replace("'","''",$rsGuestbook__sql_orderby)+"";
  } 

}
  else
{

  if ($lngRecordNo=="" && $lngRecordNo2=="")
  {

    $rsGuestbookSQL="SELECT Last_Tax_Collection,Strength,Cruise_Purchased,Poster,Nation_ID,Nation_Name,Nation_Dated,Nation_Team,Land_Purchased,Infrastructure_Purchased,Technology_Purchased,Nuclear_Purchased,Nation_Peace,Nuclear FROM Nation Where Strength >= '".$rsGuestbookHead["Strength"]*.5."' AND Strength <= '".$rsGuestbookHead["Strength"]*2."' AND Nation_Dated < getdate()-1 "+$tfm_SQLstr+" ORDER BY "+str_replace("'","''",$rsGuestbook__sql_orderby)+"";
  } 

  if ($lngRecordNo!="" && $lngRecordNo2=="")
  {

    $rsGuestbookSQL="SELECT Last_Tax_Collection,Strength,Cruise_Purchased,Poster,Nation_ID,Nation_Name,Nation_Dated,Nation_Team,Land_Purchased,Infrastructure_Purchased,Technology_Purchased,Nuclear_Purchased,Nation_Peace,Nuclear FROM Nation Where Strength >= '".$rsGuestbookHead["Strength"]*.5."' AND Strength <= '".$rsGuestbookHead["Strength"]*2."' AND Nation_Dated < getdate()-1 AND Nation_Team = '"+$lngRecordNo+"'     "+$tfm_SQLstr+" ORDER BY "+str_replace("'","''",$rsGuestbook__sql_orderby)+"";
  } 

  if ($lngRecordNo=="" && $lngRecordNo2!="")
  {

    $rsGuestbookSQL="SELECT Last_Tax_Collection,Strength,Cruise_Purchased,Poster,Nation_ID,Nation_Name,Nation_Dated,Nation_Team,Land_Purchased,Infrastructure_Purchased,Technology_Purchased,Nuclear_Purchased,Nation_Peace,Nuclear FROM Nation Where Strength >= '".$rsGuestbookHead["Strength"]*.5."' AND Strength <= '".$rsGuestbookHead["Strength"]*2."' AND Nation_Dated < getdate()-1 AND Alliance = '"+$lngRecordNo2+"'     "+$tfm_SQLstr+" ORDER BY "+str_replace("'","''",$rsGuestbook__sql_orderby)+"";
  } 

} 



echo 1;
echo 2;
echo 3;
$rs=mysql_query($rsGuestbookSQL);
$rsGuestbook_numRows=0;

$RecordCounter=0;

$repeat8__numRows=20;
$repeat8__index=0;
$rsGuestbook_numRows=$rsGuestbook_numRows+$repeat8__numRows;

//  *** Recordset Stats, Move To Record, and Go To Record: declare stats variables



// set the record count

$rsGuestbook_total=mysql_num_rows($rsGuestbook_query);

// set the number of rows displayed on this page

if (($rsGuestbook_numRows<0))
{

  $rsGuestbook_numRows=$rsGuestbook_total;
}
  else
if (($rsGuestbook_numRows==0))
{

  $rsGuestbook_numRows=1;
} 


// set the first and last displayed record

$rsGuestbook_first=1;
$rsGuestbook_last=$rsGuestbook_first+$rsGuestbook_numRows-1;

// if we have the correct record count, check the other stats

if (($rsGuestbook_total!=-1))
{

  if (($rsGuestbook_first>$rsGuestbook_total))
  {

    $rsGuestbook_first=$rsGuestbook_total;
  } 

  if (($rsGuestbook_last>$rsGuestbook_total))
  {

    $rsGuestbook_last=$rsGuestbook_total;
  } 

  if (($rsGuestbook_numRows>$rsGuestbook_total))
  {

    $rsGuestbook_numRows=$rsGuestbook_total;
  } 

} 


// *** Recordset Stats: if we don't know the record count, manually count them
if (($rsGuestbook_total==-1))
{


// count the total records by iterating through the recordset

  $rsGuestbook_total=4000;
//While (Not rsGuestbook.EOF)

// rsGuestbook_total = rsGuestbook_total + 1

//rsGuestbook.MoveNext

//Wend


// reset the cursor to the beginning

//If (rsGuestbook.CursorType > 0) Then

//  rsGuestbook.MoveFirst

//Else

//  rsGuestbook.Requery

//End If


// set the number of rows displayed on this page

  if (($rsGuestbook_numRows<0 || $rsGuestbook_numRows>$rsGuestbook_total))
  {

    $rsGuestbook_numRows=$rsGuestbook_total;
  } 


// set the first and last displayed record

  $rsGuestbook_first=1;
  $rsGuestbook_last=$rsGuestbook_first+$rsGuestbook_numRows-1;

  if (($rsGuestbook_first>$rsGuestbook_total))
  {

    $rsGuestbook_first=$rsGuestbook_total;
  } 

  if (($rsGuestbook_last>$rsGuestbook_total))
  {

    $rsGuestbook_last=$rsGuestbook_total;
  } 


} 


// *** Move To Record and Go To Record: declare variables




$MM_rs=$MM_rsCount=$rsGuestbook_total;
$MM_size=$rsGuestbook_numRows;
$MM_uniqueCol="";
$MM_paramName="";
$MM_offset=0;
$MM_atTotal=false;
$MM_paramIsDefined=false;
if (($MM_paramName!=""))
{

  $MM_paramIsDefined=($_GET[$MM_paramName]<>"");
} 


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


// *** Move To Record: update recordset stats


// set the first and last displayed record

$rsGuestbook_first=$MM_offset+1;
$rsGuestbook_last=$MM_offset+$MM_size;

if (($MM_rsCount!=-1))
{

  if (($rsGuestbook_first>$MM_rsCount))
  {

    $rsGuestbook_first=$MM_rsCount;
  } 

  if (($rsGuestbook_last>$MM_rsCount))
  {

    $rsGuestbook_last=$MM_rsCount;
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


//sort column headers for rsProducts

$tfm_saveParams="";
$tfm_keepParams="";
if ($tfm_order=="ASC")
{

  $tfm_order="DESC";
}
  else
{

  $tfm_order="ASC";
} 


if ($tfm_saveParams!="")
{

  $tfm_params=$Split[$tfm_saveParams][","];
  for ($i=0; $i<=count($tfm_params); $i=$i+1)
  {

    if (${$tfm_params[$i]}!="")
    {

      $tfm_keepParams=$tfm_keepParams.strtolower($tfm_params[$i])."=".rawurlencode(${$tfm_params[$i]})."&";
    } 


  } 

} 

$tfm_orderbyURL=$_SERVER["URL"]."?".$tfm_keepParams."tfm_order=".$tfm_order."&tfm_orderby=";
?>

<b>
<? if ($lngRecordNo=="" && $lngRecordNo2=="")
{
?>
All
<? } ?>
<? if ($lngRecordNo!="" && $lngRecordNo2=="")
{
?>
<?   echo $lngRecordNo; ?>
<? } ?>
<? if ($lngRecordNo=="" && $lngRecordNo2!="")
{
?>
<?   echo $lngRecordNo2; ?>
<? } ?>
Nations Within My Strength Range</b></font><br>
<i>(Based on 50% - 200% Strength Formula)<br>
My Nation Strength: <? echo $FormatNumber[$rsGuestbookHead["Strength"]][3]; ?></i>

&nbsp;
                              </p>
                            <p align="center">
<img border="0" src="images/magnify.gif" width="16" height="16"> 
View By Team:
<a href="allNations_display_ranking.php?Team=Aqua">Aqua</a>| 
<a href="allNations_display_ranking.php?Team=Black">Black</a> |
<a href="allNations_display_ranking.php?Team=Blue">Blue</a>| 
<a href="allNations_display_ranking.php?Team=Brown">Brown</a> |
<a href="allNations_display_ranking.php?Team=Green">Green</a> |  
<a href="allNations_display_ranking.php?Team=Maroon">Maroon</a>
<br> 
<a href="allNations_display_ranking.php?Team=Orange">Orange</a> |
<a href="allNations_display_ranking.php?Team=Pink">Pink</a> |
<a href="allNations_display_ranking.php?Team=Purple">Purple</a> | 
<a href="allNations_display_ranking.php?Team=Red">Red</a> | 
<a href="allNations_display_ranking.php?Team=Yellow">Yellow</a> |
<a href="allNations_display_ranking.php?Team=White">White</a> |
<a href="allNations_display_ranking.php?Team=None">No Team</a>
</p>
<p align="center">
<img border="0" src="images/magnify.gif" width="16" height="16"> 
View By Alliance:
<a href="allNations_display_ranking.php?Alliance=Federation of Armed Nations">FAN</a> |
<a href="allNations_display_ranking.php?Alliance=Global Alliance and Treaty Organization">GATO</a> |
<a href="allNations_display_ranking.php?Alliance=Grand Global Alliance">GGA</a> |
<a href="allNations_display_ranking.php?Alliance=Goon Order Of Neutral Shoving">GOONS</a> |
<a href="allNations_display_ranking.php?Alliance=Green Protection Agency">GPA</a> |
<a href="allNations_display_ranking.php?Alliance=Independent Republic of Orange Nations">IRON</a> 
<br>
<a href="allNations_display_ranking.php?Alliance=The Legion">Legion</a> |
<a href="allNations_display_ranking.php?Alliance=National Alliance of Arctic Countries">NAAC</a> | 
<a href="allNations_display_ranking.php?Alliance=New Pacific Order">NPO</a> |
<a href="allNations_display_ranking.php?Alliance=New Polar Order">NpO</a> |
<a href="allNations_display_ranking.php?Alliance=Orange Defense Network">ODN</a> |
<a href="allNations_display_ranking.php?Alliance=Viridian Entente">VE</a>
</p>
                              <table width="100%" border="0">
                                <tr> 
                                  <td width="62%">Serving <? echo ($rsGuestbook_first); ?> to <? echo ($rsGuestbook_last); ?> of 
                                  
<? echo $FormatNumber[mysql_num_rows($rsGuestbook_query)][0]; ?> Nations Within Range
 <? 
$rsAllUsers->Close;
$rsAllUsers=null;

?>                                 
                                  
                                  </td>
                                  <td width="38%"><table border="0" width="100%" align="center">
                                      <tr> 
                                        <td width="23%" align="center"> <? if ($MM_offset!=0)
{
?>
                                          <a href="<?   echo $MM_moveFirst; ?>">
										<img src="assets/First.gif" border=0 alt="First"></a> 
                                          <? } 
// end MM_offset <> 0  

//31%" align="center"> <% If MM_offset <> 0 Then ?>
                                          <a href="<? 
