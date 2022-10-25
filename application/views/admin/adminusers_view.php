<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">All Users</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="media width-250 float-right">
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <?php if($msg = $this->session->flashdata('msg')) { ?>
                            <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div class="text-center"><?php echo $msg; ?></div>
                            </div>
                            <?php } ?>
                            <?php if($msg = $this->session->flashdata('success')) { ?>
                            <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div class="text-center"><?php echo $msg; ?></div>
                            </div>
                        <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard" style="overflow-x:auto;">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th><?php echo ''; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if ($num > 0) { 
                            foreach ($users as $row) { ?>
                            <tr style="cursor: pointer;">
                                <td>
                                    <?php echo $row->first_name . ' ' . $row->last_name; ?>
                                </td>

                                <td>
                                    <?php echo $row->role; ?>
                                </td>

                                <td>
                                    <?php echo $row->status; ?>
                                </td>

                                
                                <td>
                                    <a href="#edituser" data-toggle="modal" data-firstname="<?php echo $row->first_name; ?>"
                                    data-lastname="<?php echo $row->last_name; ?>" data-email="<?php echo $row->email; ?>" 
                                    data-userid="<?php echo $row->id; ?>" data-location="<?php echo $row->location; ?>" 
                                    data-dob="<?php echo $row->dob; ?>" data-status="<?php echo $row->status; ?>" data-role="<?php echo $row->role; ?>"
                                    class="btn btn-light btn-sm border border-dark rounded waves-effect waves-light text-center image m-b-20">Edit</a>
                                </td>
                            </tr>
                         <?php } } else { ?>
                            <tr>
                                <td colspan="4"><h5 class="text-center">No record found</h5></td>
                            </tr>
                        <?php }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

    <!-- edit user modal -->

    <div id="edituser" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit User</h1>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart('dashboard/updateuser', ['class' => 'form-material']); ?>
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="firstname" id="firstname" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="lastname" id="lastname" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email Address</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="email" id="email" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <label>Date of birth</label>
                      <div class="input-group" id="datetimepicker1013">
                          <input type="text" name="dob" class="form-control dob" placeholder=""/>
                          <div class="input-group-append">
                          <span class="input-group-text">
                              <span class="fa fa-calendar"></span>
                          </span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Select location</label>
                      <div class="">
                        <select name="location" class="form-control input-lg location3" style="width: 462px;"></select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Role</label>
                            <div class="">
                              <select name="role" class="form-control input-lg role" style="width: 200px;" required></select>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Status</label>
                            <div class="">
                              <select name="status" class="form-control input-lg status" style="width: 200px;" required></select>
                            </div>
                          </div>
                      </div>
                    </div>

                    <input type="hidden" name="userId" value="">
                    <input type="hidden" name="olddob" value="">
                    
                    <div class="form-group form-default">
                        <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20"><i class="fa fa-check-square-o"></i>Save</button>
                    </div>
                </form>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- end edit user modal -->
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  