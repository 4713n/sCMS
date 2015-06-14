<p>
    <?php if(empty($page->id)){ ?>
        <p><h3>Add a new page</h3></p>
    <?php }else{ ?>
        <p><h3>Edit page <?php echo $page->title; ?></h3></p>
    <?php } ?>
</p>

<div class="wrapper">
    <?php echo form_open('', ['class' => 'form-editPage form-horizontal', 'role' => 'form']); ?>
     	<?php
     		echo validation_errors();
            echo '<div style="color:red">' . $this->session->flashdata('errors') . '</div>';
     	?>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" class="editPageInput form-control input-md" name="title" placeholder="Title" autofocus="" value="<?php echo set_value('name', $page->title); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label for="slug" class="control-label">Slug</label>
                    <input type="text" class="editPageInput form-control input-md" name="slug" placeholder="Slug" value="<?php echo set_value('slug', $page->slug); ?>" />
                    <span class="help-block">User-friendly URL will be generated from this text</span>
                </div>
            </div>

            <div class="form-group">
             	<div class="col-md-12">
    	        	<label for="body" class="control-label">Page content</label>
    	            <textarea id="editPageBody" class="editPageInput form-control input-md" name="body" placeholder="Body"><?php echo set_value('body', $page->body); ?></textarea>
                </div>
          	</div>

            <div id="editPageSubmitDiv" class="col-md-12">
                <button class="btn btn-md btn btn-success" id="editPageSubmitBtn" type="submit">
                <?php echo ( !empty($page->id) ) ? 'Update' : 'Add'; ?>
                </button>
            </div>

    <?php echo form_close(); ?>
</div>