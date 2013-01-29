<?php
/*Global Variables for sendind emails*/

$GLOBALS["bgcolor"] = "#faf3f1"; 
$GLOBALS["table_top_background_color"] = "#eac791"; 
$GLOBALS["table_background_color"] = "#eac791"; 
$GLOBALS["table_width"] = 700;
$GLOBALS["table_width_inside"] = 681;
$GLOBALS["table_border_color"] = "#A6A6A6";
$GLOBALS["table_bottom_border_color"] = "#eac791";
$GLOBALS["table_bottom_background_color"] = "#eac791";
$GLOBALS["textcolor"] = "#000000"; 
$GLOBALS["textsize"] = "14px";

$GLOBALS["logo"] = "logo.jpg"; 
$GLOBALS["logoWidth"] = "205"; 
$GLOBALS["logoHeight"] = "58"; 
$GLOBALS["top"] = "headerTop.jpg"; 
$GLOBALS["topWidth"] = "700"; 
$GLOBALS["topHeight"] = "10"; 
$GLOBALS["imgHeader"] = "header.jpg"; 
$GLOBALS["imgHeaderWidth"] = "700"; 
$GLOBALS["imgHeaderHeight"] = "60"; 

$GLOBALS["contentTop"] = "contentTop.jpg"; 
$GLOBALS["contentTopWidth"] = "700"; 
$GLOBALS["contentTopHeight"] = "15";

$GLOBALS["contentRepeat"] = "contentRepeat.jpg"; 
$GLOBALS["contentRepeatWidth"] = "700"; 
$GLOBALS["contentRepeatHeight"] = "3"; 

$GLOBALS["contentBottom"] = "contentBottom.jpg"; 
$GLOBALS["contentBottomWidth"] = "700"; 
$GLOBALS["contentBottomHeight"] = "11"; 

$GLOBALS["contentFooter"] = "contentFooter.jpg"; 
$GLOBALS["bottom"] = "footerbottom.jpg"; 
$GLOBALS["bottomWidth"] = "699"; 
$GLOBALS["bottomHeight"] = "11"; 


$GLOBALS["h1Style"] =" color:#8d9283; font-size:24px; font-weight:bold; text-align:left;";
$GLOBALS["h1SectionStyle"] =" color:#8d9283; font-size:30px; font-weight:bold; text-align:left;";
$GLOBALS["h2SectionStyle"] =" color:#8d9283; font-size:24px; font-weight:bold; text-align:left;";
$GLOBALS["h3SectionStyle"] =" color:#8d9283; font-size:18px; font-weight:bold; text-align:left;";
$GLOBALS["pStyle"] =" color:#8d9283; font-size:12px; text-align:left; line-height:18px;";
$GLOBALS["linkStyle"] =" font-size:10px; color:#289FB3; text-decoration:none; float:right;";
$GLOBALS["textBottomStyle"] =" font-size:11px; color:#8d9283; text-decoration:none; ";
$GLOBALS["bottompStyle"] =" color:#8d9283; font-size:10px;";
$GLOBALS["bottomlinkStyle"] =" font-size:10px; color:#7ac142; text-decoration:none;";

$GLOBALS["titleTopStyle"] =" font-size:14px; color:#CA262F; text-decoration:none; font-weight:bold;";
$GLOBALS["textTopStyle"] =" font-size:12px; color:#A6A6A6; text-decoration:none;";
$GLOBALS["textDataStyle"] =" font-size:12px; color:#000000; text-decoration:none;";
$GLOBALS["textDataSpanStyle"] =" font-size:12px; color:#A6A6A6; text-decoration:none;";
$GLOBALS["textLinkStyle"] =" font-size:12px; color:#68655E; text-decoration:none;";


$company->address = 'address';
$company->postal_code = 1;
$company->local = '';
$company->country = 'country';
$company->phone = 1;
$company->fax = 1;
$company->url = '';
$company->email = '';
$company->email2 = '';
$company->name = '';
$company->facebook = '';
$company->mobile = '';

$subject = '$subject';
$templates_images_folder = '';


function format_phone($phone)
{
	$phone = preg_replace("/[^0-9+]/", "", $phone);
	if(strlen($phone) == 6)
		return preg_replace("/([0-9]{3})([0-9]{3})/", "$1 $2", $phone);
	elseif(strlen($phone) == 9)
		return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone);
	elseif(strlen($phone) == 13)
		return preg_replace("/([+]{1})([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{3})/", "$1$2 $3 $4 $5", $phone);
	else
		return $phone;
}


$GLOBALS["address1"] = "<span style='padding-right:10px;'><br />".utf8_decode($company->address)." <br /> ".$company->postal_code." ".$company->local." | ".$company->country."<br /> tel.:".format_phone($company->phone)."<br /> fax.:".format_phone($company->fax)."<br /></span>";
//$GLOBALS["address2"] = "".utf8_decode($company->address)." | ".$company->postal_code." ".$company->local." | ".$company->country."<br /> tel.:".format_phone($company->mobile);


//$GLOBALS["address2"] = "".utf8_decode($company->address)." <br />".$company->postal_code." ".$company->local."";

$GLOBALS["addresspage"] = $company->url."/";
$GLOBALS["addresspageText"] = str_replace(array('http://','https://'), '', $company->url);
$GLOBALS["facebookAddresspage"] = "";
$GLOBALS["emailgeneral"] =  $company->email;
$GLOBALS["emailgeneral2"] = $company->email2;
$GLOBALS["namecompany"] = "da".$company->name;
$GLOBALS["titlecompany"] = $company->name;
$GLOBALS["facebookAddress"] = $company->facebook;



$GLOBALS["cellPhoneCompany"] = format_phone($company->mobile);
$GLOBALS["phoneCompany"] = format_phone($company->phone);
$GLOBALS["faxCompany"] = format_phone($company->fax);


$GLOBALS["unsubscribe"] = $company->url."/remove-newsletter";


$GLOBALS["newuserimage"] = "user_sucess.jpg"; 
$GLOBALS["removeuserimage"] = "user_error.jpg"; 
$GLOBALS["user_add"] = "user_add.jpg";
$GLOBALS["user_edit"] = "user_edit.jpg";
$GLOBALS["user_tools"] = "user_tools.jpg";

$GLOBALS["font_family"] = "Arial,Verdana, Geneva, sans-serif;";


$GLOBALS["header"] = "";
$GLOBALS["header"]= "\n";
$GLOBALS["header"].= "<!doctype html> <html lang='pt' >\n <head><meta charset='utf-8'><title>".$subject."</title></head>";
$GLOBALS["header"].= "<body style='margin:0; padding:0; display:block; background:".$GLOBALS["bgcolor"].";'>\n";
$GLOBALS["header"].= "<table id='table' style=' padding:0; margin:0; background-color:".$GLOBALS["bgcolor"]."; font-family:".$GLOBALS["font_family"].";  color: ".$GLOBALS["textcolor"]."; font-size:".$GLOBALS["textsize"]."; margin:0; padding:10px; vertical-align:bottom; text-align:center; border:0px; width:100%;'cellspacing='0'>\n";
$GLOBALS["header"].= "<tr>\n";
$GLOBALS["header"].= "<td style='background-color:".$GLOBALS["bgcolor"]."; width:100%;'>\n";
$GLOBALS["header"].= "<table id='tableInside' style='padding:0; margin:0; background-color:".$GLOBALS["bgcolor"]."; font-family:".$GLOBALS["font_family"]."; color:".$GLOBALS["textcolor"]."; font-size:".$GLOBALS["textsize"]."; margin:0 auto; padding:0; vertical-align:bottom; text-align:center; border:0; width:".$GLOBALS["table_width"]."px;' cellspacing='0' border='0'>\n";
$GLOBALS["header"].= "<tr>\n";
$GLOBALS["header"].= "<td style='background-color:".$GLOBALS["bgcolor"]."; width:100%; margin:0; padding:0;'>\n";
$GLOBALS["header"].="<a href='".$GLOBALS["addresspage"]."' title='".$GLOBALS["titlecompany"]."' style='text-decoration:none;' >\n";
$GLOBALS["header"].="<img src='".$templates_images_folder."".$GLOBALS["top"]."' width='".$GLOBALS["topWidth"]."' height='".$GLOBALS["topHeight"]."' alt='".$GLOBALS["titlecompany"]."' style='margin: 0pt; padding: 0pt;  display: block; border:0;' />";
$GLOBALS["header"].="</a>";
$GLOBALS["header"].= "</td>\n";
$GLOBALS["header"].= "</tr>\n";
$GLOBALS["header"].= "<tr>\n";
$GLOBALS["header"].= "<td style='margin-top:-2px; background:#eac791; margin:0; padding:0; float:left;'>\n";
$GLOBALS["header"].= "<a href='".$GLOBALS["addresspage"]."' title='".$GLOBALS["titlecompany"]."' style='text-decoration:none;' >\n";
$GLOBALS["header"].= "<img src='".$templates_images_folder."".$GLOBALS["imgHeader"]."' width='".$GLOBALS["imgHeaderWidth"]."' height='".$GLOBALS["imgHeaderHeight"]."' alt='".$GLOBALS["titlecompany"]."' style='margin:0; padding:0;  display: block; border:0;' />\n";
$GLOBALS["header"].= "</a>\n";
$GLOBALS["header"].= "</td>\n";
$GLOBALS["header"].= "</tr>\n";

$GLOBALS["header"].= "<tr>\n";
$GLOBALS["header"].= "<td style='background-color:".$GLOBALS["bgcolor"]."; width:100%; margin:0; padding:0;'>\n";
//$GLOBALS["header"].="<a href='".$GLOBALS["addresspage"]."' title='".$GLOBALS["titlecompany"]."' style='text-decoration:none;' >\n";
$GLOBALS["header"].="<img src='".$templates_images_folder."".$GLOBALS["contentTop"]."' width='".$GLOBALS["contentTopWidth"]."' height='".$GLOBALS["contentTopHeight"]."' alt='".$GLOBALS["titlecompany"]."' style='margin: 0pt; padding: 0pt;  display: block; border:0;' />";
//$GLOBALS["header"].="</a>";
$GLOBALS["header"].= "\n";

class Mail
{
	function email_site($mail_host,$mail_from,$mail_name_from,$message,$subject,$mail_to,$mail_to_cc,$mail_to_bcc)
	{  
		$alternativeBody = strip_tags($message);
		
		//Mail configurations
		$mail = new PHPMailer();
		//$mail->IsSMTP();   // set mailer to use SMTP
		$mail->Host       = $mail_host; // SMTP server
		$mail->From       = $mail_from;
		$mail->FromName   = $mail_name_from;
		$mail->Subject    = $subject;
		$mail->AltBody    = $alternativeBody; // optional, comment out and test
		
		$mail->Password    = "info2k11!";
		$mail->Username    = "info@negroesquisso.com";
		$mail->SMTPAuth    = true;
		
		$mail->MsgHTML($message);
		$mail->isHTML(true);
		$mail->CharSet =  "iso-8859-1";
		if(sizeof($mail_to)>0 and is_array($mail_to))
		{
			foreach($mail_to as $mail_to_send =>$value){
				$mail->AddAddress("".$mail_to_send."", "".$value."");}
		}
		if(sizeof($mail_to_cc)>0 and is_array($mail_to_cc))
		{
			foreach($mail_to_cc as $mail_to_send_cc =>$value){
				$mail->AddCC("".$mail_to_send_cc."", "".$value."");}	
		}
		if(sizeof($mail_to_bcc)>0 and is_array($mail_to_bcc))
		{
			foreach($mail_to_bcc as $mail_to_send_bcc =>$value){
				$mail->AddBCC("".$mail_to_send_bcc."", "".$value."");}
		}
		
		/*$sender = "$setting[setting_email_fromname] <$setting[setting_email_fromemail]>";
		$headers = "MIME-Version: 1.0"."\n";
		$headers .= "Content-type: text/html; charset=utf-8"."\n";
		$headers .= "Content-Transfer-Encoding: 8bit"."\n";
		$headers .= "From: $sender"."\n";
		$headers .= "Return-Path: $sender"."\n";
		$headers .= "Reply-To: $sender\n";*/
		
		if(!$mail->Send()) {
			return false;
		} else {
			return true;
		}
	}
	
	function email_body($images_folder,$subject,$body,$data, $footer="", $company = 0)
	{
		/*NEWSLETTER TOP*/
		$message= $GLOBALS["header"];
		$message.= "\n";
		/*END NEWSLETTER TOP*/
		
		/*NEWSLETTER LOGO NUMBER*/
		$message.= "<table style='background:".$GLOBALS["table_top_background_color"]."; margin:0; padding:0 6px; width:".$GLOBALS["table_width"]."px;  border:0;'>\n";
		$message.= "<tr>\n";
		$message.= "<td>\n";
		$message.= "\n";
		$message.= "\n";
		$message.= "\n";
		$message.= "<table  style='font-family:".$GLOBALS["font_family"]." color: ".$GLOBALS["textcolor"]."; font-size:".$GLOBALS["textsize"].";  width:".$GLOBALS["table_width_inside"]."px; border:0;   margin:-4px 0 0 0; background:".$GLOBALS["bgcolor"]."'>\n";
		
		$message.= "\n";
		/*END NEWSLETTER LOGO NUMBER*/
		
		/*NEWSLETTER TEXT*/
		$message.= "<tr>\n";
		$message.= "<td colspan='2' style='padding:0 30px 0 30px; text-align:left;'>\n";
		$message.= "".$body."";
		$message.="</td>";
		$message.= "</tr>\n";
		$message.= "\n";
		/*END NEWSLETTER TEXT*/
		
		$message.= "</table>\n";
		$message.= "\n";
		$message.= "\n";
					$message.= "</td>\n";
					$message.= "</tr>\n";
					$message.= "\n";
				$message.= "</table>\n";		
				//$message.="<a href='".$GLOBALS["addresspage"]."' title='".$GLOBALS["titlecompany"]."' style='text-decoration:none;' >\n";
				//$message.="<img src='".$images_folder."".$GLOBALS["bottom"]."' width='".$GLOBALS["bottomWidth"]."' height='".$GLOBALS["bottomHeight"]."' alt='".$GLOBALS["titlecompany"]."' style='margin: -4px 0 0 0; padding: 0pt;  display: block; border:0;' />";
				//$message.="</a>";
				$message.= "</td>\n";
				$message.= "</tr>\n";
				$message.= "\n";
						
				$message.= "<tr>\n";
				$message.= "<td style='background-color:#eac791; margin:0; padding:0; float:left;'>\n";
				$message.= "<img src='".$images_folder."".$GLOBALS["contentBottom"]."' width='700' height='".$GLOBALS["contentBottomHeight"]."' style='display: block; border:0; float:left; margin-top:-4px;' />";
				$message.="</td>";
				$message.= "</tr>\n";
				$message.= "\n";
				$message.= "\n";
				
				$message.= "<tr style='background-color:#eac791; float:left;' align='right'>\n";
				$message.= "<td style='font-size:12px; color:#724740; width:100%;'>\n"; 
				$message.="<img src='".$images_folder."".$GLOBALS["contentFooter"]."' width='698' height='1' display: block; border:0; float:left;' />";
				//$message.="<a href='".$GLOBALS["addresspage"]."' title='".$GLOBALS["titlecompany"]."' style='text-decoration:none; color:#724740;' >\n";
				$message.= $GLOBALS["address1"];
				$message.= $GLOBALS["address2"];
				//$message.="</a>";
				$message.= "</td>\n";
				$message.= "</tr>\n";
				$message.= "<tr>\n";
				$message.= "<td>\n";
				$message.="<img src='".$images_folder."".$GLOBALS["bottom"]."' width='".$GLOBALS["bottomWidth"]."' height='".$GLOBALS["bottomHeight"]."' alt='".$GLOBALS["titlecompany"]."' style='margin: -4px 0 0 0; padding: 0pt;  display: block; border:0; float:left;' />";
				$message.= "</td>\n";
				$message.= "</tr>\n";
				
				
				$message.= "<tr>\n";
				$message.= "<td style='font-size:11px;'>\n";
				$message.= "<br /><br />".$footer."";
				$message.= "</td>\n";
				$message.= "</tr>\n";
				
			$message.= "</table>\n";
			$message.= "</td>\n";
			$message.= "</tr>\n";
			$message.= "\n";
		$message.= "</table>\n";
		$message.= "</body>\n"; 
		$message.= "</html>\n";
		
		return $message;
	}
}
?>