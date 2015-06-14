<?php $this->load->view('admin/_header'); ?>
<body>

<div class="wrapper">
    <?php echo form_open('', ['class' => 'form-signin rounded-corners-md', 'role' => 'form']); ?>
        <span id="loginTitle">sCMS</span>
        <hr>
        <h3 class="form-signin-heading">Please login</h3>
     		<?php
       		echo validation_errors();
          echo '<div style="color:red; text-align:center">' . $this->session->flashdata('loginError') . '</div>';
     		?>
     		<input type="text" class="form-control input-sm" name="username" placeholder="Username/Email" autofocus="" required="" />
      	<input type="password" class="form-control input-sm" name="password" placeholder="Password" required="" />      
      	<label class="checkbox">
          	<input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <button class="btn  btn-md btn-primary btn-block" id="loginSubmitBtn" type="submit">Login</button>   
    <?php echo form_close(); ?>
</div>

<?php $this->load->view('admin/_footer'); ?>