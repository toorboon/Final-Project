<!-- Modal for the course_day_form -->

    <div class="modal fade" tabindex="-1" id="modal_course_day" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Add a new course day!
          </h5>
          <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
      <form id="register_course_day" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="form-group">
          <input class="form-control" type="text" name="id" placeholder="id empty" value="">
        </div>

        <div  class="form-group">
           <label>Course</label>
          <select class="custom-select form-control courses" name="selected_course" required>
              
          </select>
        </div>
        
        <div class="form-group">
          <label>Date of the day</label>
          <input class="form-control" type="date" name="course_day_date" placeholder="Date of the Course Day" value="2018-12-01">
        </div>
        
        <div class="form-group">
          <label>Technology</label>
          <select class="custom-select form-control" name="technology" required>
              <option value="" selected disabled>Choose Technology</option>
              <option value="Github">Github</option>
              <option value="HTML">HTML</option>
              <option value="CSS">CSS</option>
              <option value="Algorithms">Algorithms</option>
              <option value="JavaScript">JavaScript</option>
              <option value="JavaScript">Jasmine</option>
              <option value="jQuery">jQuery</option>
              <option value="Bootstrap 4">Bootstrap 4</option>
              <option value="TypeScript">TypeScript</option>
              <option value="Angular">Angular</option>
              <option value="Database Design">Database Design</option>
              <option value="MySQL">MySQL</option>
              <option value="PHP">PHP</option>
              <option value="AJAX">AJAX</option>
              <option value="AJAX">API</option>
              <option value="Wordpress">Wordpress</option>
              <option value="Symfony">Symfony</option>
              <option value="SCRUM">SCRUM</option>
          </select>
        </div>

        <div class="form-group">
          <label>Technology Day</label>
          <input class="form-control" type="text" name="tech_day" placeholder="Day of the technology" value="1">
        </div>
        
        <div class="d-flex justify-content-center btn-group">
          <button type="button" class="btn btn-danger close_button m-2" data-dismiss="modal">Close</button>
          <input class="btn btn-success m-2" type="submit" name="new_course_day" value="Create Course Day">
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

