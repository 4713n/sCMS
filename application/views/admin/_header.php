<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page_title; ?></title>
	<meta charset="UTF-8">
    <meta name="author" content="Alexander Landori">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/general.css">

	<?php if(uri_string()=='user/login' || uri_string()=='admin/user/login') { ?> <link rel="stylesheet" href="<?php echo base_url(); ?>css/login.css"> <?php } ?>
	<?php if(uri_string()=='admin/user') {?> <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin_user.css"> <?php } ?>
	<?php if( strpos(uri_string(), 'admin/user/edit') !== false ) {?> <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin_user_edit.css"> <?php } ?>
	<?php if( strpos(uri_string(), 'admin/page/edit') !== false ) {?> <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin_page_edit.css"> <?php } ?>
	
</head>