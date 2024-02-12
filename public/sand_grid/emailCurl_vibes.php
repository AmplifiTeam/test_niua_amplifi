<?php
class Emailclass{
	var $mailaccount = '';
	var $to = '';
	var $toname = '';
	var $from = '';
	var $fromname  = '';
	var $cc = '';
	var $bcc = '';
	var $subject = "";
	var $body = "";
	var $allcc = array();
	var $allbcc = array();
	var $allto = array();
	var $alltoname = array();
	var $temp_tonamelist = '';
	var $tem_cclist = '';
	var $tem_bcclist = '';
	var $tonamelist = '';
	
	
	function validate()
	{
		// trim all the variables
		if($this->mailaccount == '')
		{
			return "Mail Account is Empty.";
		}
		
		if($this->to == '')
		{
			return "Email To List is blank";
		}
		
		$tolist = explode(",",$this->to);
		if($this->toname != "")
		{
			$tonamelist = explode(",",$this->toname);
			if(sizeof($tonamelist) != sizeof($tolist))
			{
				return "Count of Email To List and Email Toname are not same";
			}
		}
		//echo $this->allto;
		for($z=0;$z<sizeof($tolist);$z++)
		{
			$tolist[$z] = trim($tolist[$z]);
			if($this->toname != "")
			{
				$tonamelist[$z] = trim($tonamelist[$z]);
			}
			if($tolist[$z]== '')
			{
				continue;
			}
			// pattern match for Email
			else if (!filter_var($tolist[$z],FILTER_VALIDATE_EMAIL)) 
			{
				return "To EmailId : <b>".$tolist[$z]."</b> is not valid";
			} 
			else
			{
				array_push($this->allto,$tolist[$z]);
				if($this->toname != "")
				{
					array_push($this->alltoname,$tonamelist[$z]);
				}
			}
		}
		
		if($this->bcc != "")
		{
			$bcclist = explode(",",$this->bcc);
			if(sizeof($bcclist) > 10)
			{
				return "Bcc List can't be greater than 10 Email-Ids.";
			}
			for($i=0;$i<sizeof($bcclist);$i++)
			{
				$bcclist[$i] = trim($bcclist[$i]);
				if($bcclist[$i]== '')
				{
					continue;
				}
				else if (!filter_var($bcclist[$i], FILTER_VALIDATE_EMAIL)) 
				{
					return "BCC EmailId : <b>".$bcclist[$i]."</b> is not valid";
				}
				else
				{
					array_push($this->allbcc,$bcclist[$i]);
					
				}
			}
		}
		if($this->cc != "")
		{
			$cclist = explode(",",$this->cc);
			if(sizeof($cclist) > 10)
			{
				return "cc List can't be greater than 10 Email-Ids.";
			}
			for($i=0;$i<sizeof($cclist);$i++)
			{
				$cclist[$i] = trim($cclist[$i]);
				if($cclist[$i]== '')
				{
					continue;
				}
				else if (!filter_var($cclist[$i], FILTER_VALIDATE_EMAIL)) 
				{
					return "CC EmailId : <b>".$cclist[$i]."</b> is not valid";
				}
				else
				{
					array_push($this->allcc,$cclist[$i]);
					
				}
			}
		}
		
		if($this->fromname == '')
		{
			return "From Name is Empty.";
		}
		 
		if($this->from == '')
		{
			return "From EmailId is Empty.";
		}
		// pattern match check for From Email
		if(!filter_var($this->from, FILTER_VALIDATE_EMAIL)) 
		{	
			return "From EmailId is not valid";
			//return "From EmailId : <b>".$this->from."</b> is not valid";
		}
		if($this->subject == '')
		{
			return "Subject is Empty.";
		}
		if($this->body == '')
		{
			return "Body is Empty.";
		}
		return "0";
	}
	
	function sendemail()
	{
		
		$validate_res = $this->validate();
		if($validate_res != "0")
		{
			return $validate_res;
		}
		
		$from = $this->from;
		$fromname = $this->fromname;
		$message = preg_replace('/\"/', '\\"', $this->body);
		$message = preg_replace('/\s/', ' ', $this->body);
		$subject = $this->subject;
		
		$tem_cclist = '';
		if($this->cc != "")
		{	
			for($i=0;$i<sizeof($this->allcc);$i++)
			{
				$tem_cclist .= " { \"email\": \"".$this->allcc[$i]."\" } ";
			}
		}
		
		$tem_bcclist = '';
		if($this->bcc != "")
		{
			for($i=0;$i<sizeof($this->allbcc);$i++)
			{
				$tem_bcclist .= " { \"email\": \"".$this->allbcc[$i]."\" } ";
			}
			$tem_bcclist = ",\"bcc\": [ ".$tem_bcclist." ]";
		}

		// if($tem_bcclist=='')
		// {
		// 	$tem_bcclist .= " { \"email\": \"taranjeet.puri@widexsound.com\" } ";
		// }

		$temp_tolist = '';
		$error = '';
		
		for($i=0;$i<sizeof($this->allto);$i++)
		{	
			//$msg = urlencode($message);
			if(sizeof($this->alltoname) > 0)
			{
				$temp_tolist .= " { \"email\": \"".$this->allto[$i]."\", \"name\": \"".$this->alltoname[$i]."\" } ";
			}
			else
			{
				$temp_tolist .= " { \"email\": \"".$this->allto[$i]."\", \"name\": \"".$this->alltoname[$i]."\" } ";
			}
			
			$message_body = "{\"personalizations\": [{ \"to\": [ ".$temp_tolist." ]$tem_bcclist, \"subject\": \"".$subject."\" } ], \"content\": [ { \"type\": \"text/html\", \"value\": \"".$message."\" } ], \"from\": { \"email\": \"".$from."\", \"name\": \"".$fromname."\" }, \"reply_to\": { \"email\": \"".$from."\", \"name\": \"".$fromname."\" } }";
			
			$sendemail = 0;
			ob_start();	//Anubhav
			if(($i+1) % 20 == 0)
			{
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $message_body,
				CURLOPT_HTTPHEADER => array(
				"authorization: Bearer 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",
				"content-type: application/json"
				),
				));
				
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				$this->temp_tolist = '';
				$this->tem_cclist = '';
				$this->tem_bcclist = '';
				if($response==''){
					$sendemail = 'sent';
				}else{
					$sendemail = 'fail';
				}
			}
			else if(($i+1) == sizeof($this->allto))
			{
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $message_body,
				CURLOPT_HTTPHEADER => array(
				"authorization: Bearer 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",
				"content-type: application/json"
				),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				//var_dump($response); die;
				if($response==''){
					$sendemail = 'sent';
				}else{
					$sendemail = 'fail';
				}
				$this->temp_tolist = '';
				$this->tem_cclist = '';
				$this->tem_bcclist = '';
			}
			ob_end_clean();	//Anubhav
			
			if($sendemail == 'sent')
			{
				$sendemail = 0;
			}
			else
			{
				$error .= "\n"."<br/>".$obj1->message."\n"."<br/>";
				for($m=0; $m<sizeof($obj1->errors); $m++)
				{
					$error .= $obj1->errors[$m]."<br/>"."\n";
				}
				$error .= "\n"."<br/>for emails"."\n"."<br/>".$temp_tolist1;
			}
		}
		if($error == '')
		{
			return 1;
		}
		else
		{
			return 0;
			// return $error;
		}
	}
}

