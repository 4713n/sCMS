	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
		    selector: "textarea#editPageBody",
		    theme: "modern",
		    plugins: [
			         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			         "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
			         "save table contextmenu directionality emoticons template paste textcolor"
			   		 ],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
		 });
	</script>

</body>
</html>