function getCourseday(courseId) {
	$('.generate').addClass('d-none');
	$('#content').html('');
	$.ajax({
      url:"../../Controllers/action_course.php",
      method: "post",
      data:{'category':'fetch_course_days', 'course_id':courseId},
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

function getPairs(course_day_id) {
	$.ajax({
      url:"../../Controllers/action_course.php",
      method: "post",
      data:{'category':'fetch_course_day_pairs', 'course_day_id':course_day_id},
      dataType:"text",
      success:function(response)
      {
      	var response = $.parseJSON(response);
      	if (response.length == 0) {
      		$('.generate').removeClass('d-none');
      		$('#content').html('');
      	} else {
      		var pairId = '';
			var pairs = [];
			var count = 1;
      		for (var i = 0 ; i < response.length; i++) {
      			if (pairId != '' && pairId != response[i].pair_id) {
      				count += 1;
      			}
      			pairId = response[i].pair_id;
      			if (pairs[count] == undefined){ pairs[count]=[]}
      			pairs[count].push(response[i].name);
      		}
      		PrintPairs(pairs);
      	}
      }

	});
}

function PrintPairs(pairs){
	$('.generate').addClass('d-none');
		
		var content = '';
		for (var i = 1; i < pairs.length; i++) {
			content+="<div class='col-4'><div class='card m-3' style='width: 18rem;'><div class='card-body'><h5 class='card-title'>Pair "+i+"</h5>";
			for (var j = 0; j < pairs[i].length; j++) {
				if (j == 0){
					content+="<p><b>"+pairs[i][j]+"</b></p>"
				} else {
					content+="<p>"+pairs[i][j]+"</p>"
				}
			}
			content+="</div></div></div>"
}
$('#content').html(content);
	}

function getStudents(courseId) {
      $.ajax({
      url:"../../Controllers/action_course.php",
      method: "post",
      data:{'category':'fetch_students', 'course_id':courseId},
      dataType:"text",
      success:function(response)
      {
            $('#inputGroupStudent').html('<option value="" selected disabled>Choose...</option>');

            var response = $.parseJSON(response);
            
            for(var i=0; i< response.length;i++){
            // creates option tag
                        $('<option/>', {
                  html: response[i].name,
                  value: response[i].id
            }).appendTo('#inputGroupStudent'); //appends to select if parent div has id dropdown
            }
      }
      });
}

function getPairRoom(studentId,courseDayId) {
      course = $('#inputGroupCourse option:selected').text();
      courseDay = $('#inputGroupCourseDay option:selected').text();
      $('#tech_name').html('Technology: ' + courseDay);

      getPair(courseDayId,studentId, courseDay, course);
      $('.hide').removeClass('d-none');

}

function getPair(courseDayId, userId, courseDay, course){
            $('#github_name').removeClass('alert, alert-success')
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
                              var github = response[i].github;
                        } else {
                        content += '<p>' + response[i].fname +' ' + response[i].lname + '</p>';
                        user_lnames += '-' + response[i].lname;
                        }
                  }
                        $('#pair_partners').html(content);
                        var reponame = course + '-' + courseDay + '-' + user_lnames;
                        var reponame = reponame.replace(/ /gi, "-");
                        var reponame = reponame.replace(/'/gi, "-");
                        $('#github_name').html('Github: <br><a href="https://github.com/'+github+'/'+reponame+'" target="_blanc">' + reponame +'</a>')
                        pairId = response[0].pair_id;
                        getExercises(pairId, courseDayId);
                        var test = 'https://api.github.com/repos/'+github+'/'+reponame;
                        $.getJSON(test, function(data){
                              if(data['owner'].login == github)$('#github_name').addClass('alert, alert-success');
                              });

                }
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
                        result += '<h5>'+response[i].type+'</h5>';
                  }
                  result += '<div class="form-check">';
                  if (response[i].checked > 0) {
                        result += '<input checked';
                  } else {
                  result += '<input'
                  }
                  result += ' disabled="disabled" class="form-check-input cb" type="checkbox" value="" id="'+response[i].id+'">';
                  result += '<label class="form-check-label" for="'+response[i].id+'">';
                  result += response[i].task_name;
                  result += '</label>';
                  result += '<p class="small">'+response[i].short_description+'</p>';
                  result += '</div>';
                  type = response[i].type
     
            }

            $('#exercises').html(result);

              }
      });
}

function generatePairs(courseId,courseDayId,teamsize) {
      if (generate == 1) {
            return
      }
      generate = 1;
	$.ajax({
      url:"../../Controllers/actions/action_pairgenerator.php",
      method: "post",
      data:{'courseId':courseId, 'courseDayId':courseDayId,'teamsize':teamsize},
      dataType:"text",
      success:function(response)
      {
      	var response = $.parseJSON(response);
      	if (response == false) {
      		$('.generate').removeClass('d-none');
      		$('#content').html('<p class="alert alert-danger text-center m-auto mt-3">There are no students available</p>');
                  generate = 0;
      	} else {
      		getPairs(courseDayId);
                  generate = 0;
      	}
      }
	});
}

$('#inputGroupCourse').change(function(){
	getCourseday($(this).val());
})
$('#inputGroupCourseDay').change(function(){
	getPairs($(this).val());
      getStudents($('#inputGroupCourse').val());
})
$('#generateBtn').click(function(){
	generatePairs($('#inputGroupCourse').val(),$('#inputGroupCourseDay').val(),$('#inputPairSize').val());
})
$('#inputGroupStudent').change(function(){
      getPairRoom($(this).val(),$('#inputGroupCourseDay').val());
})

// Set variable to prevent to generating Pairs more than one time 
var generate = 0;
