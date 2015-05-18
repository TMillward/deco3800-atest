$(document).ready(function () {
	var existing_images = new Array();// this needs to be moved to the top of the page before including this script
	
	//toggle deletion status of an image
	$(".remove_image").click(function (event) {
		var element = $(this).attr('id');
		if (existing_images[element][1] == false) {
			existing_images[element][1] = true;
		} else if (existing_images[element][1] == true) {
			existing_images[element][1] = false;
		}
		//add serialised array as value of hidden field
	}
	
	function update_hidden() {
		$('[name = "delete_status"]').val(existing_images.serialize());
	}

});