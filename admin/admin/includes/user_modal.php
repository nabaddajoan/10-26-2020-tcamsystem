<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add user</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="add_user.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email id</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="email" id="email"></textarea>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="password" id="password"></textarea>
                    </div>
                </div>
                   <div class="form-group">
                    <label for="contactno" class="col-sm-3 control-label">Contact Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contactno" name="contactno">
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Posting-date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="posting_date">
                      </div>
                    </div>
                </div>
             
                
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->

<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="user_id"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="update-users.php">
                <input type="hidden" class="id" name="id">
                <div class="form-group">
                    <label for="edit_fname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_fname" name="fname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lname" name="lname">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label for="edit_contactno" class="col-sm-3 control-label">Contact Number</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="contactno" id="edit_contactno"></textarea>
                    </div>
                </div>
                
                
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="u_id"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="delete-users.php">
                <input type="hidden" class="uid" name="id">
                <div class="text-center">
                    <p>DELETE User</p>
                    <h2 class="bold del_user_name"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

