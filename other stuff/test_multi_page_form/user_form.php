<!-- Modal for the user form -->

    <div class="modal fade" tabindex="-1" id="modal_user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Add a new User!
          </h5>
          <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
      <form id="register_user" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="form-group">
          <input class="form-control" type="text" name="id" placeholder="id empty" value="">
        </div>

        <div class="form-group">
          <label>First Name</label>
          <input class="form-control" type="text" name="fname" placeholder="Put the first name here!" value="Horst">
        </div>

        <div class="form-group">
          <label>Last Name</label>
          <input class="form-control" type="text" name="lname" placeholder="Put the last name here!" value="Horstman">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input class="form-control" type="text" name="username" placeholder="Put the username here!" value="clementine">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input class="form-control" type="password" name="password" placeholder="Put the Password here!" value="">
          <label>Repeat Password</label>
          <input class="form-control" type="password" name="repeat_password" placeholder="Repeat the Password here!" value="">
        </div>

        <div class="form-group">
          <label>E-Mail</label>
          <input class="form-control" type="email" name="email" placeholder="Put the E-Mail here!" value="horst_horstman@gmail.com">
        </div>

        <div class="form-group">
          <label>Github Account</label>
          <input class="form-control" type="text" name="github" placeholder="Put the name of the Github account here!" value="https://github.com/Mario-Weiss/Final-Project/">
        </div>

        <div class="form-group">
          <label>Info</label>
          <input class="form-control" type="text" name="info_field" placeholder="Put additional information here!" value="I am some information">
        </div>

        <div class="form-group">
           <label>User Role</label>
          <select id="user_role" class="custom-select form-control courses" name="user_role" required>
              
          </select>
        </div>
        
        <div class="d-flex justify-content-center btn-group">
          <button type="button" class="btn btn-danger close_button" data-dismiss="modal">Close</button>
          <input class="btn btn-success" type="submit" name="new_user" value="Create User">
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
