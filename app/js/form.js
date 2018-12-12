$(document).ready(function(){

//ON INIT
	//Adds the submit action on the buttons for the forms and inserts the data to db
	$('#register_course, #register_course_day, #register_course_exercise, #register_user').on('submit',function(e){
		
		var indicator = $(document.activeElement).attr('name');
		var form = $(this);
		// console.log(indicator)
		// console.log(form)
		if (indicator == 'new_user'){

			var password1 = $('input[name=password]').val();
			var password2 = $('input[name=repeat_password]').val();
			// console.log('inside new_user' + password1 + '  ' + password2)
		
			if (password1 != password2){
				e.preventDefault();
				alert('the passwords did not match');
			} else {
				insertData(e, form, indicator)
			}
		} else {
			insertData(e, form, indicator)
		}
		// insertData(e, form, indicator)
	});

	/*//This is for testing purpose, if the correct id is saved on the thing
	$('#user_role').on('change',function(){
		console.log($(document.activeElement).val())
	})*/;

	//Ajax Call for filling the Course Day+Tech fields
	$('#real_course').on('change',function(){
		
		var course_id = $(document.activeElement).val();
		var category = 'fetch_course_days';
		// console.log('course_id: ' + course_id)
		// console.log('category: ' + category)

		$.ajax({
          url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':category, 'course_id':course_id},
          dataType:"text",
          success:function(response)
          {
          	// console.log(response)
          	$('#course_days').html('<option value="" selected disabled>Choose a Day</option>');

          	var response = $.parseJSON(response);
          	
          	for(var i=0; i< response.length;i++){
			// console.log(response[i].name)
			// console.log(response[i].id)
			// creates option tag
  				$('<option/>', {
        			html: response[i].name,
        			value: response[i].id
        		}).appendTo('#course_days'); //appends to select if parent div has id dropdown
			}
          }
		});
	})
	
	//if a modal is shown prepulate the course field
	$('#modal_course_day, #modal_course_exercise').on('shown.bs.modal', function (e) {

  		 category = 'fetch_courses';
  		 element = 'course';
  		
  		$.ajax({
          url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':category, 'element':element},
          dataType:"text",
          success:function(response)
          {
          	$('.courses').html('<option value="" selected disabled>Choose Course</option>');

          	response = $.parseJSON(response);
          	
          	for(var i=0; i< response.length;i++){
			// console.log(response[i].name)
			// console.log(response[i].id)
			// creates option tag
  				$('<option/>', {
        			html: response[i].name,
        			value: response[i].id
        		}).appendTo('.courses'); //appends to select if parent div has id dropdown
			}
          }
		});
	});

	//This populates the field "exercise_type" in the add new exercise form
	$('#modal_course_exercise').on('shown.bs.modal', function (e) {

  		category = 'fetch_exercise_type';
  		
  		$.ajax({
          url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':category},
          dataType:"text",
          success:function(response)
          {
          	
          	$('#exercise_type').html('<option value="" selected disabled>Choose Exercise Type</option>');

          	response = $.parseJSON(response);
          	
          	for(var i=0; i< response.length;i++){
			// console.log(response[i].name)
			// console.log(response[i].id)
			// creates option tag
  				jQuery('<option/>', {
        			html: response[i].name,
        			value: response[i].id
        		}).appendTo('#exercise_type'); //appends to select if parent div has id dropdown
			}
          }
		});
	});

	//This populates the field "exercise_type" in the add new exercise form
	$('#modal_user').on('shown.bs.modal', function (e) {

  		category = 'fetch_user_role';
  		
  		$.ajax({
          url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':category},
          dataType:"text",
          success:function(response)
          {
          	
          	$('#user_role').html('<option value="" selected disabled>Choose User Role</option>');

          	response = $.parseJSON(response);
          	
          	for(var i=0; i< response.length;i++){
			// console.log(response[i].name)
			// console.log(response[i].id)
			// creates option tag
  				jQuery('<option/>', {
        			html: response[i].name,
        			value: response[i].id
        		}).appendTo('#user_role'); //appends to select if parent div has id dropdown
			}
          }
		});
	});


//FUNCTIONS
	function insertData(event, form, submit_name){
		event.preventDefault();
		form = new FormData(form[0]);
		form.append('category',submit_name)
		
		$.ajax({
            url:"../../Controllers/action_course.php",
            method: "post",
            data: form,
            processData: false,
            contentType: false,
            success:function(data)

            {
              // $('#modal_course').modal('toggle');
              alert('Insert data is done!'+ data);
            }
        });
	}



}); //end of the .ready function