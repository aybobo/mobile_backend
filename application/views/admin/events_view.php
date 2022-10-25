<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">All Events</h3>
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
                        <h4 class="card-title"><a href="#newevent" data-toggle="modal" class="btn btn-secondary">New Event</a></h4>
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
                            <th>Event Name</th>
                            <th>Venue</th>
                            <th>Location</th>
                            <th>Event Start Date</th>
                            <th>Event Start Time</th>
                            <th>Event End Date</th>
                            <th>Event End Time</th>
                            <th>Number of Attendees</th>
                            <th>Status</th>
                            <th><?php echo ''; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if ($num > 0) { 
                            foreach ($events as $row) { ?>
                            <tr style="cursor: pointer;">
                                <td>
                                    <?php
                                        $splitFile = explode("/", $row->eventFlier);
                                    ?>
                                    <img src="<?php echo base_url().'/events/'. $splitFile[5]; ?>" height="30" width="30"/>
                                </td>
                                <td><?php echo $row->eventName; ?></td>
                                <td><?php echo $row->venue; ?></td>
                                <td><?php echo $row->eventLocation; ?></td>
                                <td><?php echo $row->eventStartDate; ?></td>
                                <td><?php echo $row->eventStartTime; ?></td>
                                <td><?php echo $row->eventEndDate; ?></td>
                                <td><?php echo $row->eventEndTime; ?></td>
                                <td style="text-align:center;">
                                  <?php
                                  
                                    if ($row->numberOfEventAttendees == 0) {
                                     echo $row->numberOfEventAttendees;
                                    }
                                    else { ?>
                                      <a href="<?=base_url()?>dashboard/listOfEventAttendees/<?php echo $row->eventId; ?>" class="btn btn-secondary"><?php echo $row->numberOfEventAttendees; ?></a>
                                  <?php  }
                                  
                                  ?>
                                
                                </td>
                                <td><?php echo $row->eventStatus; ?></td>
                                <td>
                                    <a href="#editEvent" data-toggle="modal" data-eventname="<?php echo $row->eventName; ?>" data-aboutevent="<?php echo $row->eventDesc; ?>"
                                    data-venue="<?php echo $row->venue; ?>" data-location="<?php echo $row->eventLocation; ?>" data-eventstartdate="<?php echo $row->eventDateForAdmin; ?>" 
                                    data-eventstarttime="<?php echo $row->eventStartTime; ?>" data-eventenddate="<?php echo $row->flatPickrEndDate; ?>"
                                    data-eventendtime="<?php echo $row->eventEndTime; ?>" data-status="<?php echo $row->eventStatus; ?>" data-oldimg="<?php echo $splitFile[5]; ?>"
                                    data-img="<?php echo $row->eventFlier; ?>" data-id="<?php echo $row->eventId; ?>" class="btn btn-light btn-sm border border-dark rounded waves-effect waves-light text-center image m-b-20">Edit</a>
                                </td>
                            </tr>
                         <?php } } else { ?>
                            <tr>
                                <td colspan="11"><h5 class="text-center">No record found</h5></td>
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
  <!-- add event modal -->

  <div id="newevent" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Event</h1>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('dashboard/addevent', ['class' => 'form-material']); ?>
                    <div class="form-group">
                        <label class="control-label">Event Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="eventname" id="eventname1" required>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">About Event</label>
                      <div>
                        <textarea name="aboutevent" class="form-control" rows="4" id="aboutevent1" style="resize:none;" required></textarea>
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
                            <label>Event Start Date</label>
                            <div class="input-group" id='datetimepicker100'>
                                <input type="text" name="datetime" class="form-control" required/>
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
                            <label>Event End Date</label>
                            <div class="input-group" id='datetimepicker1'>
                                <input type="text" name="enddatetime" class="form-control" required/>
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
                        <label>Upload event flier</label>
                        <input type="file" name="flier" class="form-control-file" id="flier" required>
                    </fieldset>

                    <div class="form-group form-default">
                        <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20">Add Event</button>
                    </div>
                </form>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- end add event modal -->

  <!-- edit event modal -->

  <div id="editEvent" class="modal fade">
    <div class="modal-dialog" data-bs-focus="false"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit Event</h1>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-4 offset-md-1" style="margin-bottom:50px;">
                    <img src="" id="imageLocation" height="200px" width="300px"/>
                </div>
            </div>
                <?php echo form_open_multipart('dashboard/updateevent', ['class' => 'form-material']); ?>
                    <div class="form-group">
                        <label class="control-label">Event Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="eventname" name="eventname" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">About Event</label>
                      <div>
                        <textarea name="aboutevent" class="form-control" rows="4" id="aboutevent" style="resize:none;" required></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Venue</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="venue" id="venue" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label">Select location</label>
                      <div class="">
                        <select name="location" class="form-control input-lg location" id="editlocation" style="width: 462px;" required></select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Event Start Date</label>
                            <div class="input-group" id="datetimepicker101">
                                <input type="text" name="datetime" class="form-control datatime datetime" placeholder=""/>
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
                            <label>Event End Date</label>
                            <div class="input-group" id="datetimepicker102">
                                <input type="text" name="enddatetime" class="form-control datatime datetime" placeholder=""/>
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
                        <select name="status" class="form-control input-lg status" style="width: 462px;" required></select>
                      </div>
                    </div>

                    <fieldset class="form-group">
                        <label>Upload event flier</label>
                        <input type="file" name="flier" class="form-control-file" id="flier">
                    </fieldset>

                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="oldStartDate" value="">
                    <input type="hidden" name="oldStartTime" value="">
                    <input type="hidden" name="oldEndDate" value="">
                    <input type="hidden" name="oldEndTime" value="">
                    <input type="hidden" name="imageName" value="">
                    
                    <div class="form-group form-default">
                        <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20"><i class="fa fa-check-square-o"></i>Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <!-- end edit event modal -->
  