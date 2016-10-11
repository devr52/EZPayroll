<?php
	require_once(dirname(__FILE__)."/db-class.php");
	// require_once '../../PHPMailer/PHPMailerAutoload.php';

	class insert{

		public function add_user($post){
			global $db;
			$data=array(
					'user_name'=>$post['user_name'],
					'full_name'=>$post['full_name'],
					'password'=>$post['password'],
					'email'=>$post['email'],
					'company_name'=>$post['company_name'],
					'info_source'=>$post['info_source'],
					'confirm_code'=>$post['confirm_code']
				 );

			$table="ezp.user_info";
			$bind_paramF=array('s','s','s','s','s','s','d');

			$rs=$db->insert($table,$data,$bind_paramF);

			if($rs) {
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'ezp.service@gmail.com';
				$mail->Password = '2e3dy1el';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;

				$mail->setFrom('donotreply@ezp-service.com', 'EZ Payroll');
				$mail->addAddress($post['email'], $post['first_name']);     // Add a recipient

				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = '[EZ-Payroll] Email Confirmation';

				$ccode=$post['confirm_code'];

				$mail->Body="<div>
					<h1>Please confirm your Registration</h1>
					<h4>Hi ".$post['full_name'].", </h4>

					<p>Company Name: ".$post['company_name']."</p>
					<p>Email: ".$post['email']."</p>
					<p>Username: ".$post['user_name']."</p>

					<div><a href=\"http://localhost/EZPayroll/users/register.php?verified=$ccode\">Activate Account</a></div>

					<p>Good Luck! Have Fun!<br><br>
					-EZ Payroll Team</p>
				</div>";

				$mail->AltBody = '
				Please confirm your Registration

				Hi '.$post['full_name'].'!

				Email: '.$post['email'].'
				Username: '.$post['user_name'].'

				Activate Account: http://localhost/EZPayroll/users/register.php?verified=$ccode

				Good Luck! Have Fun!

				-EZ Payroll Team
				';

				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
				    echo 'Message has been sent';
				}

			}


			return $rs;
		}

		public function add_employee($post,$company){
			global $db;

			$date = $post['employment_date'];
			$date = date('Y-m-d',strtotime($date));

			$data=array(
					'emp_num'=>$post['emp_num'],
					'last_name'=>$post['last_name'],
					'first_name'=>$post['first_name'],
					'gender'=>$post['gender'],
					'email'=>$post['email'],
					'contact_num'=>$post['contact_num'],
					'position'=>$post['position'],
					'employee_type'=>$post['employee_type'],
					'employment_date'=>$date
				 );

			$table=$company."_emp_info";
			$bind_paramF=array('s','s','s','s','s','s','s','s','s');

			$rs=$db->insert($table,$data,$bind_paramF);

			return $rs;


		}
	}

	$insert=new insert;
?>
