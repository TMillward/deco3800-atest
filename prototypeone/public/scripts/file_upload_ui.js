$(document).ready(function() {
	
	var max_files = 5;
	var wrapper = $(".images_fields_wrap");
	var add_file_button = $(".add_image_button");
	
	var count = 1;
	$(add_file_button).click(function (e) {
		console.log("added new field");
		e.preventDefault();
		if(count < max_files) {
			count++;
			$(wrapper).append("<div><input name='research_images[]' type='file'> <a href='#' class='remove_field'>remove</a></div>");
		}
	});
	
	$(wrapper).on("click", ".remove_field", function (e) {
		e.preventDefault(); 
		$(this).parent('div').remove();
		count--;
	})
});	