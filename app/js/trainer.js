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

function generatePairs(courseId,courseDayId,teamsize) {
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
      	} else {
      		getPairs(courseDayId);
      	}
      }
	});
}

$('#inputGroupCourse').change(function(){
	getCourseday($(this).val());
})
$('#inputGroupCourseDay').change(function(){
	getPairs($(this).val());
})
$('#generateBtn').click(function(){
	generatePairs($('#inputGroupCourse').val(),$('#inputGroupCourseDay').val(),$('#inputPairSize').val());
})
