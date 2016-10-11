<?php
	require_once(dirname(__FILE__)."/db-class.php");


	class update{

		public function update_status($where=''){
			$db=new dbc;

			$data=array(
					'c_status'=>1,
					'confirm_code'=>0
				 );

			$where=array(
					'confirm_code'=> $where['verify']
				);

			$table="users";
			$format=array('i','i');
			$where_format=array('d');



			return $db->update($table,$data,$format,$where,$where_format);
		}


		public function update_trial($where=''){
			$db=new dbc;

			$data=array(
					'account_type'=>'7 DAY TRIAL',
					'trial_expire'=>time()+604800
				 );

			$where=array(
					'user_name'=> $where['username']
				);

			$table="users";
			$format=array('s','i');
			$where_format=array('s');

			return $db->update($table,$data,$format,$where,$where_format);
		}

	}

	$update=new update;
?>
