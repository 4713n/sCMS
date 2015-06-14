	<p><h2>Pages</h2></p>
	<p>
		<?php echo anchor('admin/page/edit', '<span class="glyphicon glyphicon-plus"></span> Add a page'); ?>
	</p>
	<table id = "pagesTable" class="table table-striped">
		<tr>
	    	<th>
	    		<?php
	    			echo anchor('admin/page?sort=title', 'Title', ['style' => 'color:black']);
	    			if( empty($this->input->get('sort')) || $this->input->get('sort')=='title')
	    				echo '<span class="caret"></span>';
	    		?>
	    	</th>
	    	<th>
	    		<?php
	    			echo anchor('admin/page?sort=modified', 'Modified', ['style' => 'color:black']);
	    			if( !empty($this->input->get('sort')) && $this->input->get('sort')=='modified')
	    				echo '<span class="caret"></span>';
	    		?>
	    	</th>
	   		<th>Edit</th>
	    	<th>Delete</th>
	  	</tr>

		<?php
	  		if(isset($pages) && count($pages) > 0){

	  			foreach($pages as $page){
	  	?>
	  				<tr>
			    		<td><?php echo anchor('admin/page/edit/'.$page->id, $page->title, ['style' => 'color:#2F2F2F']); ?></td>
			    		<td><?php echo $page->datetime; ?></td>
			    		<td><?php echo btnEdit('admin/page/edit/' . $page->id); ?></td>		    		
			    		<td><?php echo btnDelete('admin/page/delete/' . $page->id); ?></td>
			  		</tr>
	  	<?php
	  			} //foreach pages

	  		}

	  		else{ //no pages
	  	?>
	  			<tr>
	  				<td colsp an="3">No pages found</td>
	  			</tr>
	  	<?php
	  		} //if
	  	?>
	</table>