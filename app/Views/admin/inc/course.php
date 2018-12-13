<!-- This is for the course form -->

    <div class="modal fade" id="modal_course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Add a new course here!
          </h5>
          <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
      <form id="register_course" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="form-group">
          <input class="form-control" type="text" name="id" placeholder="id empty" value="">
        </div>
        
        <div class="form-group">
          <label>Name of the Course</label>
          <input class="form-control" type="text" name="course_name" placeholder="Name of the course" value="Python">
        </div>
        
        <div class="form-group">
          <label>Start Date</label>
          <input class="form-control" type="date" name="start_date" placeholder="Start Date" value="2019-01-03">
        </div>
        
        <div class="form-group">
          <label>End Date</label>
          <input class="form-control" type="date" name="end_date" placeholder="End Date" value="2020-01-03">
        </div>

        <div class="form-group">
          <label>Office Start</label>
          <input class="form-control" type="time" name="office_start" placeholder="Start time for an office day" value="09:00">
        </div>

         <div class="form-group">
          <label>Office End</label>
          <input class="form-control" type="time" name="office_end" placeholder="End time for an office day" value="16:00">
        </div>
        
        <div class="form-group">
          <label>Short Description</label>
          <input class="form-control" type="text" name="description" placeholder="Short Description" value="Some description">
        </div>

        <div class="d-flex justify-content-center btn-group">
          <button type="button" class="btn btn-danger close_button m-2" data-dismiss="modal">Close</button>
          <input class="btn btn-success m-2" type="submit" name="new_course" value="Create Course">
        </div>
      </form>
        </div>
      </div>
    </div>
  </div>
