 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                              <div class="col-md-12">
                          <br>

                      <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Add User</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                      <br><br>
                          <div class="tile-body">
                            <form class="form-horizontal" id="formAddUser">
                              <div class="form-group row"> 
                                <label class="control-label col-md-3">Username</label>
                                <div class="col-md-8">
                                  <input class="form-control" name="username" id="username" type="text" placeholder="Enter username">
                                </div>
                              </div>

                                <div class="form-group row"> 
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-8">
                                  <input class="form-control" name="password" id="password"  type="password" placeholder="Enter password">
                                </div>
                              </div>

                             <div class="form-group row"> 

                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-8">
                                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
                                </div>
                              </div>
              
                            </form>
                          </div>
                          <div class="tile-footer">
                            <div class="row">
                        
                            </div>
                          </div>
                    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="tambahUser()">Add</button>
                      </div>
                    </div>
                  </div>
                </div>

<!---===========================================MODAL UNTUK EDIT USER ======================================--->

 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                              <div class="col-md-12">
                          <br>

                      <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Edit User</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                      <br><br>
                          <div class="tile-body">
                            <form class="form-horizontal" id="formEditUser">
                             
                              <input name="id" id="id" type="hidden">

                              <div class="form-group row"> 
                                <label class="control-label col-md-3">Username</label>
                                <div class="col-md-8">
                                  <input class="form-control" name="username2" id="username2" type="text" placeholder="Enter username">
                                </div>
                              </div>

                                <div class="form-group row"> 
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-8">
                                  <input class="form-control" name="password2" id="password2"  type="password" placeholder="Enter your new password">
                                </div>
                              </div>

                             <div class="form-group row"> 

                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-8">
                                  <input class="form-control" name="email2" id="email2" type="email" placeholder="Enter email address">
                                </div>
                              </div>
              
                            </form>
                          </div>
                          <div class="tile-footer">
                            <div class="row">
                        
                            </div>
                          </div>
                    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editUser()">Edit User</button>
                      </div>
                    </div>
                  </div>
                </div>

<!---===========================================MODAL UNTUK ROLE MENU======================================--->

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="col-md-12">
        <br>

        <div class="modal-header">
          <h3 class="modal-title" id="role_menu5">Role Menu</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 

        <div class="tile-body">
          <form class="form-horizontal" id="formRoleMenu">
            <input name="id_user" id="id_user" type="hidden">
            <div class="accordion" id="accordionExample">
            </div>
          </form>
        </div>
        
        <div class="tile-footer">
          <div class="row">
          </div>
        </div>
                    
      </div>
           
     

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="save_role_access()">Save</button>
      </div>
    </div>
  </div>
</div>