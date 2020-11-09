  
<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>

  <body>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Documentation List</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div id="data_list"> 
            <div class="tile">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Pilih Sistem</label>
                    <select class="form-control" name='nickname_sistem' id='nickname_sistem'>
                      <option>Pilih Salah Satu</option>
                      <?php   
                      foreach($nickname_sistem as $row)
                      { 
                        echo '<option value="'.$row->id_sistem.'">'.$row->nickname_sistem.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Pilih Customer</label>
                    <select class="form-control" id="nickname_customer" name="nickname_customer" disabled="">
                    <!--            <option value="">Pilih Salah Satu</option> -->
                    </select>
                  </div>
                </div>

              </div>
              
              <div class="tile-footer" align="right">
                <button class="btn btn-primary" type="submit" onclick='get_list_document()'>Find</button>
              </div>

              <div  align="left">
                <!-- <button class="btn btn-primary" type="submit" onclick=''>SORT</button> -->
                <button class="btn btn-primary" type="submit" onclick='form_tambah_data();'>ADD</button>
              </div>
            </div>

            <div id='data' class="row">
            
            </div>
          </div>

          <div id='data_tambah' class="row d-none">
            <div class="col-md-6">
              <div class="tile">                
                <div class="tile-body">
                  
                  <h3 class="tile-title">ADD DOCUMENTATION</h3>
                  <div class="tile-body">
                    <form class="form-horizontal" id="tes5" method="post" enctype="multipart/form-data">

                      <div class="form-group row">
                        <label class="control-label col-md-3">Title</label>
                        <div class="col-md-8">
                          <input class="form-control" type="text" placeholder="Title" name="title">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-8">
                          <textarea class="form-control" rows="4" placeholder="Description" name="description"></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">System / Customer</label>
                        <div class="col-md-4">
                          <select class="form-control" name='nickname_sistem2' id='nickname_sistem2'>
                            <option>Pilih Salah Satu</option>
                            <?php   
                            foreach($nickname_sistem as $row)
                            { 
                              echo '<option value="'.$row->id_sistem.'">'.$row->nickname_sistem.'</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <select class="form-control" id="nickname_customer2" name="nickname_customer2" disabled="">
                          
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">File</label>
                          <div class="col-md-8">
                            <input class="form-control" type="file" name="file">
                          </div>
                      </div>  
                    </div>
              
                    <div class="tile-footer">
                      <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                        <button class="btn btn-primary" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                          &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" onclick="form_tambah_data();"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                      </div>
                    </div>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>     
    </main>
  </body>
</html>



