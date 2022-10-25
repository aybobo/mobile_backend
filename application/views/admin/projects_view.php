<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">All Projects</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="media width-250 float-right">
          </div>
        </div>
      </div>
      <div class="content-body">
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-4">
                        <h4 class="card-title"><a href="#newproject" data-toggle="modal" class="btn btn-secondary">New Project</a></h4>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
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
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard" style="overflow-x:auto;">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                            <th><?php echo ''; ?></th>
                            <th>Project Title</th>
                            <th>Venue</th>
                            <th>Location</th>
                            <th>Start Date</th>
                            <th>Estimated End Date</th>
                            <th>Status</th>
                            <th><?php echo ''; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if ($num > 0) { 
                            foreach ($projects as $row) { $val = $row->projectId; ?>
                            <tr style="cursor: pointer;">
                                <td>
                                    <?php
                                        $splitFile = explode("/", $row->projectImage);
                                    ?>
                                    <img src="<?php echo base_url().'/projects/'. $splitFile[5]; ?>" height="30" width="30"/>
                                </td>
                                <td>
                                    <?php echo $row->projectTitle; ?>
                                </td>
                                <td>
                                    <?php echo $row->projectVenue; ?>
                                </td>
                                <td>
                                    <?php echo $row->projectLocation; ?>
                                </td>
                                <td>
                                    <?php echo $row->projectStartDate; ?>
                                </td>
                                <td>
                                    <?php echo $row->projectEndDate; ?>
                                </td>
                                <td>
                                    <?php echo $row->projectStatus; ?>
                                </td>
                                <td>
                                    <a href="#editproject" data-toggle="modal" data-id="<?php echo $row->projectId; ?>" data-title="<?php echo $row->projectTitle; ?>"
                                    data-description="<?php echo $row->projectDescription; ?>" data-startdate="<?php echo $row->projectStartDate; ?>"
                                    data-enddate="<?php echo $row->projectEndDate; ?>" data-status="<?php echo $row->projectStatus; ?>"
                                    data-img="<?php echo $splitFile[5]; ?>" data-imgurl="<?php echo $row->projectImage; ?>" 
                                    data-venue="<?php echo $row->projectVenue; ?>" data-location="<?php echo $row->projectLocation; ?>" class="btn btn-light btn-sm border border-dark rounded waves-effect waves-light text-center image m-b-20">Edit</a>
                                </td>
                            </tr>
                         <?php } } else { ?>
                            <tr>
                                <td colspan="9"><h5 class="text-center">No record found</h5></td>
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
 
  <!-- add project modal -->

  <div id="newproject" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add New Project</h1>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('dashboard/addproject', ['class' => 'form-material']); ?>
                    <div class="form-group">
                        <label class="control-label">Project Title</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="title" id="title1">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Project Description</label>
                      <div>
                        <textarea name="projectdesc" class="form-control" rows="4" style="resize:none;" id="projectdesc1" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Venue</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="venue" id="venue1" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Select location</label>
                      <div class="">
                        <select name="location" class="form-control input-lg location1" style="width: 462px;" required>
                            <option value="">Select a location</option>
                            <option value="Abia">Abia</option>
                            <option value="Abuja">Abuja</option>
                            <option value="Adamawa">Adamawa</option>
                            <option value="Akwa Ibom">Akwa Ibom</option>
                            <option value="Anambra">Anambra</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Bayelsa">Bayelsa</option>
                            <option value="Benue">Benue</option>
                            <option value="Borno">Borno</option>
                            <option value="Cross River">Cross River</option>
                            <option value="Delta">Delta</option>
                            <option value="Ebonyi">Ebonyi</option>
                            <option value="Edo">Edo</option>
                            <option value="Ekiti">Ekiti</option>
                            <option value="Enugu">Enugu</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Imo">Imo</option>
                            <option value="Jigawa">Jigawa</option>
                            <option value="Kaduna">Kaduna</option>
                            <option value="Kano">Kano</option>
                            <option value="Katsina">Katsina</option>
                            <option value="Kebbi">Kebbi</option>
                            <option value="Kogi">Kogi</option>
                            <option value="Kwara">Kwara</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Nasarawa">Nasarawa</option>
                            <option value="Niger">Niger</option>
                            <option value="Ogun">Ogun</option>
                            <option value="Ondo">Ondo</option>
                            <option value="Osun">Osun</option>
                            <option value="Oyo">Oyo</option>
                            <option value="Plateau">Plateau</option>
                            <option value="Rivers">Rivers</option>
                            <option value="Sokoto">Sokoto</option>
                            <option value="Taraba">Taraba</option>
                            <option value="Yobe">Yobe</option>
                            <option value="Zamfara">Zamfara</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Project Start Date</label>
                            <div class="input-group" id="datetimepicker1011">
                                <input type="text" name="startdate" class="form-control" />
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Estimated End Date</label>
                            <div class="input-group" id="datetimepicker1012">
                                <input type="text" name="enddate" class="form-control" />
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <fieldset class="form-group">
                        <label>Upload project banner</label>
                        <input type="file" name="banner" class="form-control-file" id="banner1" required>
                    </fieldset>
                    
                    <div class="form-group form-default">
                        <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20">Add Project</button>
                    </div>
                </form>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- end add project modal -->

  <!-- edit project modal -->

  <div id="editproject" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit Project</h1>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-4 offset-md-1" style="margin-bottom:50px;">
                      <img src="" id="imageLocation" height="200px" width="300px"/>
                  </div>
              </div>
                <?php echo form_open_multipart('dashboard/updateproject', ['class' => 'form-material']); ?>
                    <div class="form-group">
                        <label class="control-label">Project Title</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="title1" value="" id="title">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Project Description</label>
                      <div>
                        <textarea name="projectdesc1" class="form-control" rows="4" id="projectdesc" style="resize:none;" value="" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Venue</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="venue1" value="">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Select location</label>
                      <div class="">
                        <select name="location1" class="form-control input-lg location" id="editlocation" style="width: 462px;" required></select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Start Date</label>
                            <div class="input-group" id='datetimepicker10'>
                                <input type="text" name="startdate1" class="form-control picker" placeholder=""/>
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Estimated End Date</label>
                            <div class="input-group" id='datetimepicker1010'>
                                <input type="text" name="enddate1" class="form-control picker" placeholder=""/>
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Status</label>
                      <div class="">
                        <select name="status1" class="form-control input-lg status1" style="width: 462px;" required></select>
                      </div>
                    </div>

                    <div class="form-group">
                        <label>Upload project banner</label>
                        <input type="file" name="flier1" class="form-control-file"/>
                    </div>

                    <input type="hidden" name="id1" value="">
                    <input type="hidden" name="imageName1" value="">
                    <input type="hidden" name="oldStartDate" value="">
                    <input type="hidden" name="oldEndDate" value="">
                    
                    <div class="form-group form-default">
                        <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20"><i class="fa fa-check-square-o"></i>Save</button>
                    </div>
                </form>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- end edit project modal -->