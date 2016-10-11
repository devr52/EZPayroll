<?php
	require_once(dirname(__FILE__)."/db-class.php");
	session_start();
	class select{

		public function all_users(){
			global $db;

			$query-"SELECT * FROM objects";

			return $db->select($query);
		}


		public function check_login($post){
			global $db;

			$uname=$post['uname'];
			$psw=$post['psw'];


			$query="SELECT user_id,user_name,full_name,password,c_status,company_name,trial_expire,account_type FROM `ezp.user_info` where user_name='$uname' AND password='$psw'";

			$rs=$db->select($query);

			if(!empty($rs)){
				if(!$rs[0]['c_status']) echo "<script type='text/javascript'>alert('Please Confirm your Email Address');</script>";
				else{
					$_SESSION["permission"] = "OK";
					$_SESSION["username"] = $rs[0]['user_name'];
					$_SESSION["full_name"] = $rs[0]['full_name'];
					$_SESSION["user_id"] = $rs[0]['user_id'];
					$_SESSION["c_status"] = $rs[0]['c_status'];
					$_SESSION["company_name"] = $rs[0]['company_name'];
					$_SESSION["trial_expire"] = $rs[0]['trial_expire'];
					$_SESSION["account_type"] = $rs[0]['account_type'];

					echo "login success";

					$URL="http://localhost/EZPayroll/dashboard";
					echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
				}
			}
			else{
				echo "<script>alert('wRONG USERNAME AND PASSWORD');</script>";
			}
		}

		public function display_emp_list($cn){
			global $db;

			$query="SELECT emp_num,last_name,first_name FROM ".$cn."_emp_info";

			$rs=$db->select($query);



			foreach ($rs as $v) {
				echo "<tr>";
				foreach ($v as $key => $value) {
					echo "
						<td>$value</td>
					 ";
				}
				echo "</tr>";
			}
			}




	}

	$select=new select;
?>
