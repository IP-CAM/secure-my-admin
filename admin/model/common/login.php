<?php
class ModelCommonLogin extends Model {
	
	public function getTotalIpChecks() {
		function check_ip() {
 			$ipaddress = '';
		  	if (getenv('HTTP_CLIENT_IP'))
				$ipaddress = getenv('HTTP_CLIENT_IP');
		  	else if(getenv('REMOTE_ADDR'))
				$ipaddress = getenv('REMOTE_ADDR');
			else
			        $ipaddress = 'UNKNOWN';
			return $ipaddress;               
		}      	

		$ip = check_ip();
	
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "admin_ip_whitelist` WHERE ip = '" . $ip . "'");		 
		return $query->row['total'];
	} 
}
?>