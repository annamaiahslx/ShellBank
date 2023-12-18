<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo 	base_url('assets/images/favicon.ico'); ?>" type="image/gif">
     <title><?php echo $title; ?></title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/fSelect.css'); ?>">
  <link href="<?php echo base_url('assets/css/bootstrap-fileupload/bootstrap-fileupload.min.css');?>" rel="stylesheet">
    <!-- CSS only -->

    <script type='text/javascript' src="<?php echo base_url('assets/js/jquery-1.12.4.js');?>"></script> 
    <script type='text/javascript' src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/select2.js');?>"></script>
	<script type='text/javascript' src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>  
    <script type='text/javascript' src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/dataTables.buttons.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/jszip.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/buttons.html5.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/js/fSelect.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-fileupload/bootstrap-fileupload.min.js');?>"></script>
 </head>
<body>
   <!-- Header -->
  <header>
    <div class="container-fluid">
      <div class="logo col-md-3 p_left">
        <a href="<?php  echo $this->config->item('landing_url'); ?>" >
        <img src="<?php echo base_url('assets/images/logo.jpg'); ?>" class="img-responsive" alt="logo" >
         <h5 class="log_insight">Insight</h5>
		<h5>Audit Tracking</h5>
        </a>
       
      </div>
       <div class="top_menu_hd col-md-7 p_left text-center">
       <?php if (isset($_SESSION['audit_logged_in'])):?>
		<ul class="list-unstyled list-inline">
    <?php if (check_action_permission($this->audit, 'CAN_VIEW')):?>
			<li class="sub-menu <?php if ($this->uri->segment(1) == 'audit' || $this->uri->segment(2) == 'audit_add' || $this->uri->segment(2) == 'audit_edit' || $this->uri->segment(2) == 'closed_audtis') {
    echo 'active';
} ?>"><a href="<?php echo base_url().'audit'; ?>">Audit  <?php if (check_action_permission($this->closed_audits, 'CAN_VIEW')):?> <span class="caret"></span> <?php endif;?></a>
        <?php if (check_action_permission($this->closed_audits, 'CAN_VIEW')):?>
				<ul>
                    <li class="<?php if (($this->uri->segment(2) == 'closed_audits')) { 
    echo 'active';
} ?>"><a href="<?php echo base_url().'audit/closed_audits'; ?>">Closed Audits</a></li>  

					<li class="<?php if (($this->uri->segment(1) == 'audit')) {	
                        echo 'active';
                    } ?>"><a href="<?php echo base_url().'audit'; ?>">Audits</a>
                    </li>					
        </ul>
    <?php endif; ?>
<?php endif; ?>
			</li>
			<?php if (check_action_permission($this->audit_type, 'CAN_VIEW') || check_action_permission($this->department, 'CAN_VIEW') || check_action_permission($this->area_recommendation, 'CAN_VIEW') || check_action_permission($this->user_mang, 'CAN_VIEW')):?>
			<li class="<?php if ($this->uri->segment(1) == 'master' || $this->uri->segment(1) == 'user_management') {
    echo 'active';
} ?> sub-menu"><a href="#">Administration<span class="caret"></span></a>
				<ul>
          <?php if (check_action_permission($this->audit_type, 'CAN_VIEW')):?>
					<li class="<?php if (($this->uri->segment(1) == 'master' || $this->uri->segment(2) == 'audit_type') && $this->uri->segment(2) != 'department_list' && $this->uri->segment(2) != 'department' && $this->uri->segment(2) != 'area_recommendation_list' && $this->uri->segment(2) != 'area_recommendation') {
    echo 'active';
} ?>"><a href="<?php echo base_url('master'); ?>">Audit Type</a></li>
        <?php endif;
        if (check_action_permission($this->department, 'CAN_VIEW')):?>
					<li class="<?php if ($this->uri->segment(2) == 'department_list' || $this->uri->segment(2) == 'department') {
            echo 'active';
        } ?>" ><a href="<?php echo base_url('master/department_list'); ?>">Department</a></li>
<?php endif;
        if (check_action_permission($this->area_recommendation, 'CAN_VIEW')):?>
					<li class="<?php if ($this->uri->segment(2) == 'area_recommendation_list' || $this->uri->segment(2) == 'area_recommendation') {
            echo 'active';
        } ?>" ><a href="<?php echo base_url('master/area_recommendation_list'); ?>">Area of Recommendation</a></li>
<?php endif;
        if (check_action_permission($this->user_mang, 'CAN_VIEW')):?>
						<li class="<?php if ($this->uri->segment(1) == 'user_management') {
            echo 'active';
        } ?>"><a href="<?php echo base_url('user_management'); ?>">User Management</a></li>
<?php endif; 
		if (check_action_permission($this->email_template, 'CAN_VIEW')):?>
				         <li class="<?php if ($this->uri->segment(1) == 'email') {
            echo 'active';
        } ?>"><a href="<?php echo base_url('master/email_template_list'); ?>">Email Template</a></li>
        <?php endif; 
		if (check_action_permission($this->user_mang, 'CAN_VIEW')):?>
			<li class="<?php if ($this->uri->segment(2) == 'activity_master_list') {
            echo 'active';
        } ?>"><a href="<?php echo base_url('master/activity_master_list'); ?>">Activity Master</a></li>
        <?php endif; 
		  if (check_action_permission($this->user_mang, 'CAN_VIEW')):?>
			<li class="<?php if ($this->uri->segment(2) == 'activities_list') {
            echo 'active';
        } ?>"><a href="<?php echo base_url('master/activities_list'); ?>">Activities</a></li>
					<?php endif;?>
				</ul>
			</li>
      <?php endif;
      if (check_action_permission($this->report, 'CAN_VIEW')):?>
      <li><a href="<?php echo base_url('audit/reports');?>">Reports</a></li>
      <?php endif; ?>
	  
	    <?php if (check_action_permission($this->user_guide, 'CAN_VIEW')):?>
      <li><a href="<?php echo base_url();?>uploads/Audit_User_Guide.pdf" target="_blank">User Guide</a></li>
      <?php endif; ?>
		</ul>
		<?php endif; ?>
	  </div>
      <div class="head_con col-md-2 p_right text-right btn-group">

        
        <?php if($_SESSION['user_name'] != ''): ?>
        <ul class="list-unstyled list-inline" id="header_user_profile"><li class="sub-menu">
            <a href="javascript:;"><?php echo $_SESSION['user_name'];?><span class="caret"></span></a>
            <ul class="dropdown-menu-right">
        <?php 
            $roles = $_SESSION['roles'];
            $activeProfile = $_SESSION['active_profile'];

            if(is_array($roles) && count($roles) > 0):
            foreach($roles as $role_data):

                $switch_role_url = base_url(). 'user/switch_role/'. $role_data['ROLE_ID'] .'/'. $role_data['OFFICE_ID'];
                $display_text = $role_data['ROLE_NAME'] . "-" . $role_data['OFFICE_NAME'];

                $active_role = '';
                if(($activeProfile['ROLE_ID'] == $role_data['ROLE_ID']) && ($activeProfile['OFFICE_ID'] == $role_data['OFFICE_ID']) ){
                    $active_role = 'active';
                    $switch_role_url = 'javascript:;';
                }
        ?>

                <li class="<?php echo $active_role; ?>"><a href="<?php echo $switch_role_url;?>"><?php echo $display_text;?></a></li>

        <?php endforeach; 
        endif; ?>

        <?php if (isset($_SESSION['user_name']) && $_SESSION['user_name'] != ''):?>
             <li><a href="<?php echo base_url(); ?>user/logout" >Logout</a></li>
        <?php endif; ?>

         </ul></li></ul>
     <?php endif; ?>
   

      </div>
    </div>
  </header>