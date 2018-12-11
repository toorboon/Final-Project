<!-- Modal for the course_day_form -->

    <div class="modal fade" tabindex="-1" id="modal_course_exercise" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Add a new exercise!
          </h5>
          <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
      <form id="register_course_exercise" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="form-group">
          <input class="form-control" type="text" name="id" placeholder="id empty" value="">
        </div>

        <div class="form-group">
          <label>Course</label>
          <select id="real_course" class="custom-select form-control courses" name="selected_course" required>
              
          </select>
        </div>

        <div class="form-group">
          <label>Course_Day + Tech</label>
          <select id="course_days" class="custom-select form-control" name="selected_course_day" required>
              <option value="" selected disabled>Choose FIRST the Course then the Day</option>
          </select>
        </div>

        <div class="form-group">
          <label>Exercise Type</label>
          <select id="exercise_type" class="custom-select form-control" name="exercise_type" required>
              
          </select>
        </div>

        <div class="form-group">
          <label>Task Name</label>
          <input class="form-control" type="text" name="task_name" placeholder="Name of the task" value="Do something idiot!">
        </div>
        
        <div class="form-group">
          <label>Short Description</label>
          <input class="form-control" type="text" name="short_description" placeholder="Short Description" value="I am some description!">
        </div>

        <div class="d-flex justify-content-center btn-group">
          <button type="button" class="btn btn-danger close_button" data-dismiss="modal">Close</button>
          <input class="btn btn-success" type="submit" name="new_course_exercise" value="Create Exercise">
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

