<?php 
unset($_SESSION["erro_email"]);
unset($_SESSION["sucess"]);
unset($_SESSION["erro_not_send"]);
unset($_SESSION["erro_empty"]);
$_SESSION["lang"] = $_POST["lang"];
?>
<?
$form_id = 'formcontacts';
$error_class = 'error';
$success_class = 'sucess';
$error = 0;
/*ANTI-INJECTION of data inserted*/
$name = anti_injection($_POST[$form_id.'_'.'name']);
$email = anti_injection($_POST[$form_id.'_'.'email']);
$phone = anti_injection($_POST[$form_id.'_'.'phone']);
$message = anti_injection($_POST[$form_id.'_'.'message']);
$subject = anti_injection($_POST[$form_id.'_'.'subject']);
$another_subject = anti_injection($_POST[$form_id.'_'.'other_subject']);
/*VERIFY ERROR THAT MAY EXIST*/
$_SESSION["erro_empty"] = array();
if($email=="" and $name=="" and $phone=="" and $subject=="" and $message=="")
{
	$_SESSION["erro_empty"][]= CAMPOS_OBRIGATORIOS;
	$error++;
}
else
{
	/****************************************************************************/
	$field = $form_id.'_'."name";
	if(strlen($name) == 0)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][] = NAME_NULL;
	}
	else
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
	$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$error_class.'").addClass("'.$success_class.'");
	$("#'.$form_id.' #'.$field.'_status").removeClass("'.$error_class.'").addClass("'.$success_class.'").html("&nbsp;");
	</script></div>';
	}
	/****************************************************************************/
	/****************************************************************************/
	$field = $form_id.'_'."email";
	if(strlen($email) == 0)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][] = EMAIL_NULL;
	}
	else if(check_email($email)==false)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][]= EMAIL_VALID;
	}
	else
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$error_class.'").addClass("'.$success_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$error_class.'").addClass("'.$success_class.'").html("&nbsp;");
		</script></div>';	 	
	}
	/****************************************************************************/
	/****************************************************************************/
	$field = $form_id.'_'."phone";
	if(strlen($phone) == 0)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][] = PHONE_NULL;
	}
	else if(is_numeric($phone)==false or strlen($phone) < 9)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][] =  PHONE_INVALID;
	}
	else
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$error_class.'").addClass("'.$success_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$error_class.'").addClass("'.$success_class.'").html("&nbsp;");
		</script></div>';	 
	}
	/****************************************************************************/
	$field = $form_id.'_'."message";
	if(strlen($message) == 0)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' textarea[name='.$field.']").parent().parent().parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][] = MESSAGE_NULL;
	}
	else
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' textarea[name='.$field.']").parent().parent().parent().parent().parent().removeClass("'.$error_class.'").addClass("'.$success_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$error_class.'").addClass("'.$success_class.'").html("&nbsp;");
		</script></div>';
	}
	/****************************************************************************/
	$field = $form_id.'_'."subject";
	if(strlen($subject) == 0/* and ($subject != "-1" or $subject != "-2")*/)
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$success_class.'").addClass("'.$error_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$success_class.'").addClass("'.$error_class.'").html("&nbsp;");
		</script></div>';
		$error++;
		$_SESSION["erro_empty"][] = SUBJECT_NULL;
	}
	else
	{
	echo '<div class="'.$field.'"><script type="text/javascript">
		$("#'.$form_id.' input[name='.$field.']").parent().parent().parent().removeClass("'.$error_class.'").addClass("'.$success_class.'");
		$("#'.$form_id.' #'.$field.'_status").removeClass("'.$error_class.'").addClass("'.$success_class.'").html("&nbsp;");
		</script></div>';
	}
	
	/****************************************************************************/
	
}
if($_GET['action'] == 'submit')
{
?>
    <div class="script">
<?
if($error == 0)
{
		/*If no errors do the query*/
		if(sizeof($_SESSION["erro_empty"])==0 and sizeof($_SESSION["erro_email"])==0)
		{	
			include("../includes/mail.php");
			
			$name = utf8_decode($name);
			$email = utf8_decode($email);
			$phone = utf8_decode($phone);
			$message = utf8_decode($message);
			$subject2 = utf8_decode($subject);
		
			//Get the footer message
			$array_footer=array("email"=>$email, "unsubscribe"=>$adress_page."remove-newsletter", "data"=>$GLOBALS["date_system"]);
			$permalink = "footer-contacts";
			$language=$_SESSION["lang"];//Language of the email
			$array_return = $queries->getEmailText($array_footer,$permalink,$language);// Get the values from Database like the subject and body
			$GLOBALS["footermessage"] = $array_return["text"]; //Return Body;
			
			$array_names=array("name"=>$name,"email"=>$email,"phone"=>$phone,"subject"=>$subject2,"message"=>$message, "data"=>$GLOBALS["date_system"],"link"=>""); //All the variables you need to send the email  
			$permalink="contacts-user"; //Insert the permalink that is in the Database. 
			$language=$_SESSION["lang"];//Language of the email
			
			$array_return = $queries->getEmailText($array_names,$permalink,$language);// Get the values from Database like the subject and body
			$body = $array_return["text"]; //Return Body
			$subject = $array_return["subject"]; // Return Subject
			
			$message2 =  email_body($templates_images_folder,$subject,$body,$GLOBALS["date_system"],$GLOBALS["footermessage"]); // get the complete message with data 
			
			//EMAILS USER to send
			$mail_to_user = array($email => $name);
			$mail_to_cc_user = "";
			$mail_to_bcc_user = "";
			//Send EMAIL
			
			if(email_site($host_mail,$mail_from,$mail_name_from,$message2,$subject,$mail_to_user,$mail_to_cc_user,$mail_to_bcc_user))
			{
				
				$_SESSION["sucess"]= SUCESS_CONTACTS_SEND;
				//Get the footer message
				$array_footer=array("data"=>$GLOBALS["date_system"]);
				$permalink = "footer-company";
				$language=$_SESSION["lang"];//Language of the email
				$array_return = $queries->getEmailText($array_footer,$permalink,$language);// Get the values from Database like the subject and body
				$GLOBALS["footermessage"] = $array_return["text"]; //Return Body;
				
				$array_names=array("name"=>$name,"email"=>$email,"phone"=>$phone,"subject"=>$subject2,"message"=>$message, "data"=>$GLOBALS["date_system"]); 
					
				$permalink="contacts-company"; //Insert the permalink that is in the Database. 
				$language=$_SESSION["lang"];//Language of the email
				
				$array_return = $queries->getEmailText($array_names,$permalink,$language);// Get the values from Database like the subject and body
				$body = $array_return["text"]; //Return Body
				$subject = $array_return["subject"]; // Return Subject
				
				$message2 =  email_body($templates_images_folder,$subject,$body,$GLOBALS["date_system"],$GLOBALS["footermessage"], 1); // get the complete message with data 
				email_site($host_mail,$email,$name,$message2,$subject,$mail_to,$mail_to_cc,$mail_to_bcc);
			}
			else
			{
				$_SESSION["erro_not_send"] = ERROR_USER_CONTACTS_NO_EMAIL_SENT;	
			}			
		}
		if(isset($_SESSION["sucess"]))
		{
		?>
        <?
		$js = '<script type="text/javascript">
		$("form#'.$form_id.' .required").removeClass("'.$success_class.'").removeClass("'.$error_class.'");
		$("form#'.$form_id.' .result").removeClass("'.$success_class.'").removeClass("'.$error_class.'");
		//$("form#'.$form_id.' input").each(function(){ $(this).val(""); });
		//$("form#'.$form_id.' textarea").each(function(){ $(this).val(""); });
		//successState = 1;
		$("form#'.$form_id.'").resetForm();
		$("form#'.$form_id.' .watermark").each(function(){
			$(this).css("display","block");
		});
		</script>'; ?>
		<? echo successNotice($_SESSION["sucess"].$js); ?>
		<?php
		unset($_SESSION["sucess"]);
		}
        if(isset($_SESSION["erro_not_send"]))
        {
        ?>
            <? echo errorNotice($_SESSION["erro_not_send"]); ?>
        <?php
		unset($_SESSION["erro_not_send"]);
        }
		?>
	<? 
	}
	else
	{
		if(isset($_SESSION["erro_empty"]) and sizeof($_SESSION["erro_empty"]) > 0)
		{
			$campos = "";
			if(sizeof($_SESSION["erro_empty"]) == 1)
			{
				$campos = $_SESSION["erro_empty"][0];
			}
			else
			{
				for($i=1;$i<=sizeof($_SESSION["erro_empty"]);$i++)
				{
					/*if($i == sizeof($_SESSION["erro_empty"]))
					{
					$campos .= " ".AND_2." ";
					}
					if($i < sizeof($_SESSION["erro_empty"]) and $i > 1)
					{
					$campos .= ", ";
					}*/
					$campos .= '<span class="marginLeft35">- '.$_SESSION["erro_empty"][$i-1].'</span><br />';
				}
			}
			?>
			<? 
				$aux = '';
				if($_SESSION["erro_empty"][0] != CAMPOS_OBRIGATORIOS)
				{$aux = '<p>'.PREENCHA_O.'</p>'; $aux .= " ";}
				$aux .= '<p>'.$campos.'</p>'; 
			?>
            <? echo errorNotice($aux); ?>
		<?php
		
		unset($_SESSION["erro_empty"]);
		
		}
	}
	?>
</div>
<?
} //end $_GET["action"] 
?>