<?php 

Class General{

	public function get_user_role_code($id){

        $role_code = 'readonly_administrator';
        switch($id){
            case 5:
                $role_code = 'administrator';
            break;
        }

        return $role_code;
    }


    public function get_role_id($code){

        $id = 5;
        switch($code){
            case 'administrator':
                $id = 5;
            break;
        }

        return $id;
    }

   public function displayDateTime($date=''){

        $d=strtotime($date);

        /*return date("Y/m/d h:i A", $d);*/
        return date("d/m/Y h:i A", $d);
    }

    public function displayDate($date=''){

		if($date!=''){
			$d=strtotime($date);
			return date("d-m-Y", $d);
		}else{
			return 'N/A';
		}
	}

}

?>