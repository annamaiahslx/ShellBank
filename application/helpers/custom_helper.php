<?php
 if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
 }

if (!function_exists('date_hepler')) {
    function date_hepler($date)
    {
        return '<b>'.date_format($date, 'D d-M-Y h:m:i a').'</b>';
    }
}

if (!function_exists('audit_date')) {
    function audit_date($date)
    {
        return date_format($date, 'd  M  Y');
    }
}
if (!function_exists('date_formate_ymd')) {
    function date_formate_ymd($date)
    {
        if ($date != ''):
            return date('Y-m-d', strtotime($date)); else:
            return null;
        endif;
    }
}
if (!function_exists('audit_edit_date')) {
    function audit_edit_date($date)
    {
        if ($date != '') {
            return	$str_date = date('d F Y', strtotime($date));
        }
    }
}

if (!function_exists('auditor_status')) {
    function auditor_status($status)
    {
        if ($status == 2) {
            return 'Agree';
        } elseif ($status == 3) {
            return 'Disagree';
        } else {
            return 'Open';
        }
    }
}

if (!function_exists('date_rag_color')) {
    function date_rag_color($date)
    {
        if ($date != '') {
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($date);
            $diff = date_diff($date1, $date2);
            $days_cont = $diff->format('%R%a');
            if ($days_cont > 30) {
                return 3;
            } elseif ($days_cont > 0 && $days_cont <= 30) {
                return 2;
            } elseif ($days_cont < 1) {
                return 1;
            }
        } else {
            return null;
        }
    }
}
//Function to detrmine the color for Date Status Rag
if (!function_exists('date_status_rag_color')) {
	function date_status_rag_color($date)
	{
		if ($date != '') {
			$date1 = date_create(date('Y-m-d'));
			$date2 = date_create($date);
			$diff = date_diff($date1, $date2);
			$days_cont = $diff->format('%R%a');
			if ($days_cont >= 30) {
				return 'Green';
			} elseif ($days_cont >= 0 && $days_cont < 30) {
				return 'Orange';
			} elseif ($days_cont < 0) {
				return 'Red';
			}
		} 
	}
}

if (!function_exists('str_limit')) {
    function str_limit($str)
    {
        $length = strlen($str);
        if ($length > 75) {
            $str = substr($str, 0, 75).'...';
            return $str;
        }

        return $str;
    }
}

if(!function_exists('listing_display_date_format')){
function listing_display_date_format($date){
if ($date != '') {
return $str_date = date('d/m/Y', strtotime($date));
}else{
return 'N/A';
}
}
}

if (!function_exists('pr')) {
    function pr($str, $debug=false)
    {
        echo "<pre>";
        print_r($str);
        if($debug){
            die;
        }
    }
}


