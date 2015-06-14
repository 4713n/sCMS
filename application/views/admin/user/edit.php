<p>
    <?php if(empty($user->id)){ ?>
        <p><h3>Add new user</h3></p>
    <?php }else{ ?>
            <p><h3>Edit user <?php echo $user->name; ?></h3></p>
    <?php } ?>

</p>

<div class="wrapper">
    <?php echo form_open('', ['class' => 'form-editUser form-horizontal', 'role' => 'form']); ?>
     	<?php
     		echo validation_errors();
            echo '<div style="color:red">' . $this->session->flashdata('errors') . '</div>';
     	?>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="editUserInput form-control input-md" name="name" placeholder="Name" autofocus="" value="<?php echo set_value('name', $user->name); ?>"/>
                </div>
            </div>

            <div class="form-group">
             	<div class="col-md-12">
    	        	<label for="email" class="control-label">Email</label>
    	            <input type="email" class="editUserInput form-control input-md" name="email" placeholder="Email" value="<?php echo set_value('email', $user->email); ?>" />
                </div>
          	</div>

            <div class="form-group">
             	<div class="col-md-12">
    	        	<label for="password" class="control-label">
                    <?php echo ( !empty($user->id) ) ? 'New password' : 'Password'; ?>      
                    </label>
    	            <input type="password" class="editUserInput form-control input-md" name="password" placeholder="<?php echo ( !empty($user->id) ) ? '(Leave blank, if dont want to change)' : 'Password'; ?>" />

    	        </div>
            </div>

            <div class="form-group">
             	<div class="col-md-12">
                    <label for="password_confirm" class="control-label">
                        <?php echo ( !empty($user->id) ) ? 'Confirm new password' : 'Confirm password'; ?>    
                    </label>
    	            <input type="password" class="editUserInput form-control input-md" name="password_confirm" placeholder="<?php echo ( !empty($user->id) ) ? '(Leave blank, if dont want to change)' : 'Confirm password'; ?>" />
    	        </div>
            </div>

            <div id="editUserSubmitDiv" class="col-md-12">
                <button class="btn btn-md btn btn-success" id="editUserSubmitBtn" type="submit">
                <?php echo ( !empty($user->id) ) ? 'Update' : 'Add'; ?>
                </button>
            </div>

    <?php echo form_close(); ?>
</div>