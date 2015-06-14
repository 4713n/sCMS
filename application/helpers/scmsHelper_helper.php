<?php 

function btnEdit($url){
	return anchor($url, '<span class="btnEditUser glyphicon glyphicon-edit"></span>');
}


function btnDelete($url){
	return anchor($url, '<span class="btnDeleteUser glyphicon glyphicon-remove-circle"></span>', 
					["onClick"	=>	"return confirm('Are you sure you want to delete this user?');"]);
}

 ?>