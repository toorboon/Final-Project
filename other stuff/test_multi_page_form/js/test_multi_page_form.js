$(document).ready(function(){

//ON INIT
	//Adds the submit action on the buttons for the forms and inserts the data to db
	$('#register_course, #register_course_day, #register_course_exercise').on('submit',function(e){
		insertData(e,$(this), $(document.activeElement).attr('name'))
	});

	/*//This is for testing purpose, if the correct id is saved on the thing
	$('#course_days').on('change',function(){
		console.log($(document.activeElement).val())
	});*/

	//Ajax Call for filling the Course Day+Tech fields
	$('#real_course').on('change',function(){
		
		var course_id = $(document.activeElement).val();
		var category = 'fetch_course_days';
		// console.log('course_id: ' + course_id)
		// console.log('category: ' + category)

		$.ajax({
          url:"action_handle_form.php",
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
          url:"action_handle_form.php",
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
          url:"action_handle_form.php",
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

	// $('input').on('input',function(){
	// 	$(this).removeClass('invalid');
	// });

	// $('#prevBtn').on('click', function(){
	// 	nextPrev(-1);
	// });

	// $('#nextBtn').on('click', function(){
	// 	nextPrev(1);
	// });

	// var currentTab = 0; // Current tab is set to be the first tab (0)
	// showTab(currentTab); // Display the current tab

//FUNCTIONS
	function insertData(event, form, submit_name){
		event.preventDefault();
		form = new FormData(form[0]);
		form.append('category',submit_name)
		
		$.ajax({
            url:"action_handle_form.php",
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
	// function showTab(n) {
	//   // This function will display the specified tab of the form ...
	//   var x = document.getElementsByClassName("tab");
	//   x[n].style.display = "block";
	//   // ... and fix the Previous/Next buttons:
	//   if (n == 0) {
	//     document.getElementById("prevBtn").style.display = "none";
	//   } else {
	//     document.getElementById("prevBtn").style.display = "inline";
	//   }
	//   if (n == (x.length - 1)) {
	//     document.getElementById("nextBtn").innerHTML = "Submit";
	//   } else {
	//     document.getElementById("nextBtn").innerHTML = "Next";
	//   }
	//   // ... and run a function that displays the correct step indicator:
	//   fixStepIndicator(n)
	// }

	// function nextPrev(n) {
	//   // This function will figure out which tab to display
	//   var x = document.getElementsByClassName("tab");
	//   // Exit the function if any field in the current tab is invalid:
	//   if (n == 1 && !validateForm()) return false;
	//   // Hide the current tab:
	//   x[currentTab].style.display = "none";
	//   // Increase or decrease the current tab by 1:
	//   currentTab = currentTab + n;
	//   // if you have reached the end of the form... :
	//   if (currentTab >= x.length) {
	//     //...the form gets submitted:
	//     // $('#regForm').on('submit', function(event) {
	//     // 	var $this = $(this);
	//     // 	var frmValues = $this.serialize();
	//     // 	console.log('values: '+frmValues)
	//     // })
	//     // document.getElementById("regForm").submit(); //put here your Ajax Call to the PHP file
	//     test();
	//     return false;
	//   }

	//   // Otherwise, display the correct tab:
	//   showTab(currentTab);
	// }

	// function validateForm() {
	//   // This function deals with validation of the form fields
	//   var x, y, i, valid = true;
	//   x = document.getElementsByClassName("tab");
	//   y = x[currentTab].getElementsByTagName("input");
	//   // A loop that checks every input field in the current tab:
	//   for (i = 0; i < y.length; i++) {
	//     // If a field is empty...
	//     if (y[i].value == "") {
	//       // add an "invalid" class to the field:
	//       y[i].className += " invalid";
	//       // and set the current valid status to false:
	//       valid = false;
	//     }
	//   }
	//   // If the valid status is true, mark the step as finished and valid:
	//   if (valid) {
	//     document.getElementsByClassName("step")[currentTab].className += " finish";
	//   }
	//   return valid; // return the valid status
	// }

	// function fixStepIndicator(n) {
	//   // This function removes the "active" class of all steps...
	//   var i, x = document.getElementsByClassName("step");
	//   for (i = 0; i < x.length; i++) {
	//     x[i].className = x[i].className.replace(" active", "");
	//   }
	//   //... and adds the "active" class to the current step:
	//   x[n].className += " active";
	// }	

	// function test() {
	// 	// var allInputs = $(":input").val();
	// 	// event.preventDefault();
	// 	form = $('#regForm')
	// 	// temp = new FormData(form[0])
	// 	// console.log(allInputs)
	// 	// for (var pair of temp.entries()) {
	// 	//     console.log(pair[0]+ ', ' + pair[1]); 
	// 	// }
	// 	$.ajax({
	//             url:"test_multi_page_form/check.php",
	//             method: "post",
	//             data: new FormData(form[0]),
	//             processData: false,
	//             contentType: false,
	//             success:function(data)

	//             {
	//                console.log('answer: '+data)
	//                $('#result').html(data);
	              
	//             }
	//         });

		
	// }


}); //end of the .ready function