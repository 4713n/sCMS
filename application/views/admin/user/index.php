	<p><h2>Users</h2></p>
	<p>
		<?php echo anchor('admin/user/edit', '<span class="glyphicon glyphicon-plus"></span> Add a user'); ?>
	</p>
	<table id = "usersTable" class="table table-striped">
		<tr>
	    	<th>
	    		<?php
	    			echo anchor('admin/user?sort=username', 'Username', ['style' => 'color:black']);
	    			if( empty($this->input->get('sort')) || $this->input->get('sort')=='username')
	    				echo '<span class="caret"></span>';
	    		?>
	    	</th>
	    	<th>
	    		<?php
	    			echo anchor('admin/user?sort=email', 'Email', ['style' => 'color:black']);
	    			if( !empty($this->input->get('sort')) && $this->input->get('sort')=='email')
	    				echo '<span class="caret"></span>';
	    		?>
	    	</th>
	    	<th>
	    		<?php
	    			echo anchor('admin/user?sort=added', 'Registered', ['style' => 'color:black']);
	    			if( !empty($this->input->get('sort')) && $this->input->get('sort')=='added')
	    				echo '<span class="caret"></span>';
	    		?>
	    	</th>
	   		<th>Edit</th>
	    	<th>Delete</th>
	  	</tr>

		<?php
	  		if(isset($users) && count($users) > 0){

	  			foreach($users as $user){
	  	?>
	  				<tr>
			    		<td><?php echo anchor('admin/user/edit/'.$user->id, $user->name, ['style' => 'color:#2F2F2F']); ?></td>
			    		<td><?php echo anchor('admin/user/edit/'.$user->id, $user->email, ['style' => 'color:#2F2F2F']); ?></td>
			    		<td><?php echo $user->datetime; ?></td>
			    		<td><?php echo btnEdit('admin/user/edit/' . $user->id); ?></td>
			    		<td><?php echo btnDelete('admin/user/delete/' . $user->id); ?></td>
			  		</tr>
	  	<?php
	  			} //foreach users

	  		}

	  		else{ //no users
	  	?>
	  			<tr>
	  				<td colsp an="3">No users found</td>
	  			</tr>
	  	<?php
	  		} //if
	  	?>
	</table>