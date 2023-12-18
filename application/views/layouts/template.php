<!-- Header -->
<?php $this->load->view('layouts/header'); ?>
<!-- Header -->
<div class="min_height bg_grey">
    <div class="container-fluid min_height">
        <!-- Commn Title and Breadcrumb -->
        <h1 class="main_tit"><?php echo $page_title;?></h1>
            <!-- Breadcrumb Stsrt -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_breadcrumb;?></li>
                </ol>
            </nav>
            <!-- Breadcrumb End-->
	           <!-- Commn Title and Breadcrumb End-->
	        	<div class="row m_left m_right home_content">
	                	<!-- <div class="col-md-3 p_left left_grid_control">
	                  		<?php //$this->load->view('layouts/dashboard_sidebar'); ?>
	                  	</div> -->
	                  	<?php if($this->session->flashdata('msg')): ?>
						    <div class="success_msg">
						    <p class="m_bottom"><?php echo $this->session->flashdata('msg'); ?></p>
						    </div>
						<?php endif; ?>	
						<?php if($this->session->flashdata('Emsg')): ?>
						    <div class="error_msg">
						    	<p class="m_bottom"><?php echo $this->session->flashdata('Emsg'); ?></p>
						    </div>
						<?php endif; ?>	
	                	<!-- Body Content -->
	                	<div class="col-md-12 p_left p_right">
	                		<?php echo $contents; ?>
	                	 </div>
	                    <!-- Body Content -->
	                    <!-- Right Side Menu content -->
	            </div>
    </div>
    <!-- Main Content End -->
</div>
<!-- Main Content end  -->
<!-- footer -->
<?php $this->load->view('layouts/footer'); ?>
<!-- footer -->
