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
          <label>Course + Course_Day</label>
          <select class="custom-select form-control" name="selected_course" required>
              <option value=""  disabled>Choose Course and Day</option>
              <option value="FSWD_Day1" selected>FSWD_Day1</option>
              <option value="FSWD_Day2">FSWD_Day2</option>
              <option value="FSWD_Day3">FSWD_Day3</option>
              <option value="FSWD_Day4">FSWD_Day4</option>
          </select>
        </div>

        <div class="form-group">
          <label>Exercise Type</label>
          <select class="custom-select form-control" name="exercise_type" required>
              <option value=""  disabled>Choose Type</option>
              <option value="Basic" selected>Basic</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Advanced">Advanced</option>
              <option value="Challenge">Challenge</option>
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
          <input class="btn btn-success" type="submit" name="new_course_exercise" value="Create Course">
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

