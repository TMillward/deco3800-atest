$(document).ready(function () {

	//toggle deletion status of an image
	$(".remove_image").click(function (event) {
		var element = $(this).attr('id');
		if (existing_images[element][1] == false) {
			existing_images[element][1] = true;
			$(this).css("background-color", "red");
		} else if (existing_images[element][1] == true) {
			existing_images[element][1] = false;
			$(this).css("background-color", "white");
		}
		
		//add serialised array as value of hidden field
		$('[name = "delete_status"]').val($(existing_images).serializeArray());
		console.log(existing_images[0]);
	});
	


});