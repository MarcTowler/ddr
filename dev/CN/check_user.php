<?
  session_start();
  session_register("blnIsUserGood_session");
?>
<? // Option $Explicit; ?>
<!--#include file="common.inc" -->
<? 
//****************************************************************************************

//**  Copyright Notice    

//**

//**  Web Wiz Guide ASP Weekly Poll

//**                                                              

//**  Copyright 2001-2002 Bruce Corkhill All Rights Reserved.                                

//**

//**  This program is free software; you can modify (at your own risk) any part of it 

//**  under the terms of the License that accompanies this software and use it both 

//**  privately and commercially.

//**

//**  All copyright notices must remain in tacked in the scripts and the 

//**  outputted HTML.

//**

//**  You may use parts of this program in your own private work, but you may NOT

//**  redistribute, repackage, or sell the whole or any part of this program even 

//**  if it is modified or reverse engineered in whole or in part without express 

//**  permission from the author.

//**

//**  You may not pass the whole or any part of this application off as your own work.

//**   

//**  All links to Web Wiz Guide and powered by logo's must remain unchanged and in place//**  and must remain visible when the pages are viewed unless permission is first granted

//**  by the copyright holder.

//**

//**  This program is distributed in the hope that it will be useful,

//**  but WITHOUT ANY WARRANTY; without even the implied warranty of

//**  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE OR ANY OTHER 

//**  WARRANTIES WHETHER EXPRESSED OR IMPLIED.

//**

//**  You should have received a copy of the License along with this program; 

//**  if not, write to:- Web Wiz Guide, PO Box 4982, Bournemouth, BH8 8XP, United Kingdom.

//**    

//**

//**  No official support is available for this program but you may post support questions at: -

//**  http://www.webwizguide.info/forum

//**

//**  Support questions are NOT answered by e-mail ever!

//**

//**  For correspondence or non support questions contact: -

//**  info@webwizguide.com

//**

//**  or at: -

//**

//**  Web Wiz Guide, PO Box 4982, Bournemouth, BH8 8XP, United Kingdom

//**

//****************************************************************************************



//Set the response buffer to true as we maybe redirecting

ob_start();


//Initalise the strUserName variable

$strUserName=$_POST["txtUserName"];

//Create recorset object

// $rsCheckUser is of type "ADODB.Recordset"


//Initalise the strSQL variable with an SQL statement to query the database

$strSQL="SELECT tblConfiguration.Password, tblConfiguration.Username ";
$strSQL=$strSQL."FROM tblConfiguration ";
$strSQL=$strSQL."WHERE tblConfiguration.Username ='".$strUserName."'";

//Query the database

$rs=mysql_query($strSQL);

//If the recordset finds a record for the username entered then read in the password for the user

if (!($rsCheckUser==0))
{

//Read in the password for the user from the database

  if (($_POST["txtUserPass"])==$rsCheckUser["Password"])
  {


//If the password is correct then set the session variable to True

    $blnIsUserGood_session=true;

//Close Objects before redirecting

    $rsCheckUser=null;

    $strCon=null;

    $adoCon=null;


//Redirect to the admin menu page

    // Unknown response object on line 88
.$asp";
  } 

} 


//Reset server objects

$rsCheckUser=null;

$strCon=null;

$adoCon=null;


//If the script is still running then the user must not be authorised

$blnIsUserGood_session=false;

//Redirect to the unautorised user page

// Unknown response object on line 101
.$htm";
?>




