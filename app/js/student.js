//JavaScript for student.php

$(document).ready(function(){
	
//ON INIT
	//this is fetched from the header.php for the students and taken from the PHP SESSION Variable (user_id)
	user_id = $('#welcome_user').attr("data-user-id");

	//the following two jQuery selects are for filling the two select boxes on top of the screen (course and course_day)
	$('#inputGroupCourse').on('change',function(){
		getCourseday($(this).val(), user_id);
		course = $('#inputGroupCourse option:selected').text();

	});

	$('#inputGroupCourseDay').on('change',function(){
		$('.hide').removeClass('d-none');

		var course_day = $('#inputGroupCourseDay option:selected').text();
		$('#tech_name').html('Technology: ' + course_day)

		getPair($(this).val(), user_id, course_day, course);
		
	});

//FUNCTIONS
	function getPair(courseDayId, userId, courseDay, course){

		$.ajax({
		url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':'fetch_pairs', 'courseDayId':courseDayId, 'userId': userId},
          dataType:"text",
          success:function(response)
          {
          	var response = $.parseJSON(response);
          	content = '';
          	user_lnames = '';

          	for (var i = 0; i< response.length; i++){
          		if (i == 0){
          			content += '<p><b>' + response[i].fname +' ' + response[i].lname + '</b></p>';
          			user_lnames += response[i].lname;
          		} else {
          		content += '<p>' + response[i].fname +' ' + response[i].lname + '</p>';
          		user_lnames += '-' + response[i].lname;
          		}
          	}
			$('#pair_partners').html(content);
			$('#github_name').html('Github: <br>' + course + '-' + courseDay + '-' + user_lnames)
			pairId = response[0].pair_id;
			getExercises(pairId, courseDayId);
			// course+course_day+lname1+lname2
          }//FSWD60 -GIT_DAY 1Waything-Kear-O'Fearguise
		});

	}

	function getExercises(pairId, courseDayId){
		$.ajax({
          url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':'fetch_exercises', 'pairId':pairId, 'courseDayId':courseDayId},
          dataType:"text",
          success:function(response)
	          {
	          	var response = $.parseJSON(response);
	          	var type = '';
	          	var result = '<h4 class="mt-2">Exercises</h4>';
	          	for (var i = 0; i < response.length; i++) {
	          		if (type != response[i].type) {
	          			result += '<p class="mt-2">Type: '+response[i].type+'</p>';
	          		}
	          		result += '<div class="form-check">';
	          		if (response[i].checked > 0) {
	          			result += '<input checked';
	          		} else {
	          		result += '<input'
	          		}
	          		result += ' class="form-check-input cb" type="checkbox" value="" id="'+response[i].id+'">';
	          		result += '<label class="form-check-label" for="'+response[i].id+'">';
	          		result += response[i].task_name;
	          		result += '</label>';
	          		result += '<p>Description: '+response[i].short_description+'</p>';
	          		result += '</div>';
	          		type = response[i].type
	     
	          	}

	          	$('#exercises').html(result);

	          	$('.cb').change(function(){
	          		var checked = 0;
	          		if($(this).is(":checked")){checked=1}
	          		updatePairExercise(checked,$(this).attr('id'),pairId)
	          	});

			  }
		});
	}

	function updatePairExercise(checked,id,pairId){

		if (checked == 1){
			
			$.ajax({
				url:"../../Controllers/action_course.php",
		          method: "post",
		          data:{'category':'insert_pair_exercise', 'pair_id':pairId, 'ce_id': id},
		          dataType:"text",
		          success:function(response)
		          {
		          	
		          }

		         });

		} else {
			
			$.ajax({
				url:"../../Controllers/action_course.php",
		          method: "post",
		          data:{'category':'delete_pair_exercise', 'pair_id':pairId, 'ce_id': id},
		          dataType:"text",
		          success:function(response)
		          {
		          	
		          }

		         });
		}
	}

	function getCourseday(courseId, user_id) {
		$.ajax({
          url:"../../Controllers/action_course.php",
          method: "post",
          data:{'category':'fetch_course_days', 'course_id':courseId, 'userId':user_id},
          dataType:"text",
          success:function(response)
          {
          	$('#inputGroupCourseDay').html('<option value="" selected disabled>Choose...</option>');

          	var response = $.parseJSON(response);
          	
          	for(var i=0; i< response.length;i++){
			// creates option tag
  				$('<option/>', {
        			html: response[i].name,
        			value: response[i].id
        		}).appendTo('#inputGroupCourseDay'); //appends to select if parent div has id dropdown
			}
          }
		});
	}

}); //end of document.ready function