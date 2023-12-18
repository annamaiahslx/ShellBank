<footer>
      <div class="container-fluid">
        <div class="col-md-8 p_left">
          <!-- <ul class="list-unstyled list-inline">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Legal Use</a></li>
            <li><a href="#">Contact</a></li>
          </ul> -->
        </div>
        <div class="col-md-4  text-right">
          <p>Copyright &copy; <?php echo date('Y');?></p>
        </div>
      </div>
    </footer>
    <input type="hidden" value="<?php echo base_url();?>" id="base_url">


      <!-- jQuery -->
      
      
      <script type='text/javascript' src="<?php echo base_url('assets/js/custom.js');?>"></script>


  <script type="text/javascript">
  	$(document).ready(function() {
  		$("#audit_mng").select2();
  		$("#assigned_auditor").select2();
  		$("#resp_manager").fSelect();
  	});
  </script>
  	</body>

  </html>