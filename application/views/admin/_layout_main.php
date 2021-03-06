<?php $this->load->view('admin/_header'); ?>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
	    	<!-- Brand and toggle get grouped for better mobile display -->
	    	<div class="navbar-header">
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-content">
	        		<span class="sr-only">Toggle navigation</span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	      		</button>
	      		<a class="navbar-brand" href="<?php echo site_url('admin/controlpanel'); ?>"><?php echo $page_title; ?></a>
	    	</div>

	    	<!-- Collect the nav links, forms, and other content for toggling -->
	    	<div class="collapse navbar-collapse" id="navbar-content">
	      		<ul class="nav navbar-nav">
	        		<li class="<?php echo (strpos(uri_string(), 'admin/controlpanel')!==false) ? 'active' : '' ; ?>">
	        			<a href="<?php echo site_url('admin/controlpanel'); ?>">Control Panel <span class="sr-only">(current)</span></a>
	        		</li>
	        		<li class="<?php echo (strpos(uri_string(), 'admin/page')!==false) ? 'active' : '' ; ?>">
	        			<a href="<?php echo site_url('admin/page'); ?>">Pages</a>
	        		</li>
	        		<li class="<?php echo (strpos(uri_string(), 'admin/user')!==false) ? 'active' : '' ; ?>">
	        			<a href="<?php echo site_url('admin/user'); ?>">Users</a>
	        		</li>
	        	</ul>
	        
	        	<ul class="nav navbar-nav navbar-right">
	        		<li class="dropdown">

	        			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	        				<?php echo '<i class="glyphicon glyphicon-user"></i> ' . $this->session->userdata('name'); ?> <span class="caret"></span>
	        			</a>

				        <ul class="dropdown-menu" role="menu">
				            <li><a href="#">Another action</a></li>
				            <li><a href="#">Something else here</a></li>

				            <!-- JAVASCRIPT TRIGGER FOR OPENING MODAL WINDOW WITH SETTINGS -->
				            <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
				            <li class="divider"></li>
				            <li><?php echo anchor('admin/user/logout', '<i class="glyphicon glyphicon-off"></i> Logout'); ?></li>
				        </ul>
	        		</li>
	        	</ul>

	        </div>
	    </div> <!--- container-fluid -->
	</nav> <!-- navbar-default -->

	<div class="container rounded-corners-md">
		<div class="row clearfix">


			<!-- side column -->
            <div class="col-md-2 column">
            </div>

			<!-- main column -->
			<div class="col-md-7 column">
				<section class="mainSection">
					<!-- content -->
					<?php if(isset($contentView)) $this->load->view($contentView); ?>
				</section>
			</div>

			<!-- side column -->
			<div class="col-md-3 column">
				<section>
				</section>
			</div>
		</div>
	</div>

<?php $this->load->view('admin/_footer'); ?>