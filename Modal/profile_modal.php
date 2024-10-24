<div class="modal fade" id="Profile" tabindex="-1" aria-labelledby="ProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="route.php" method="post">
            <?php $userId = getAdminProfile($_SESSION['admin_id'])['message'];?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" required value="<?php echo $userId['fname'];?>" name="fname" class="form-control">
                    <input type="hidden" name="UpdateProfile" value="UpdateProfile">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" required value="<?php echo $userId['lname'];?>"  name="lname" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Gender:</label>
                    <select name="sex" class="form-control">
                    <?php 
                        echo isset($userId['gender']) ? '<option value="'.$userId['gender'].'">'.$userId['gender'].'</option>' : '';
                    ?>     
                    <option value="Male">Male</option>  
                    <option value="Female">Female</option>                 
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" value="<?php echo $userId['address'];?>" required name="address" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" value="<?php echo $userId['username'];?>" required name="username" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" required name="password" class="form-control">
                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update Account</button>
        </form>
      </div>
    </div>
  </div>
</div>