
  <!-- Horizontal navigation-->
  <div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Stats -->
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 bg-gradient-x-primary white media-body">
                    <h5>Upcoming Events</h5>
                    <h5 class="text-bold-400 mb-0">28</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 bg-gradient-x-danger white media-body">
                    <h5>Pending Projects</h5>
                    <h5 class="text-bold-400 mb-0">10</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 bg-gradient-x-warning white media-body">
                    <h5>Completed Projects</h5>
                    <h5 class="text-bold-400 mb-0"> 75</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 bg-gradient-x-success white media-body">
                    <h5>Ongoing Projects</h5>
                    <h5 class="text-bold-400 mb-0"> 12</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- events table -->
        <div class="row match-height">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-4"><h4 class="card-title">Upcoming Events</h4></div>
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
              <div class="card-content">
                <div class="card-body">
                    <span class="float-right"><a href="<?=site_url('dashboard/events')?>" >All Events<i class="ft-arrow-right"></i></a></span>
                  </p>
                </div>
                <div class="table-responsive">
                  <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                    <thead>
                      <tr>
                        <th><?php echo ''; ?></th>
                        <th>Event Name</th>
                        <th>Venue</th>
                        <th>Location</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>End Date</th>
                        <th>End Time</th>
                        <th>Number of Attendees</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if ($num > 0) { 
                          foreach ($events as $row) { ?>
                          <tr style="cursor: pointer;">
                            <td class="text-truncate">
                            <?php $splitFile = explode("/", $row->eventFlier); ?>
                            <img src="<?php echo base_url().'/events/'. $splitFile[5]; ?>" height="30" width="30"/>
                            </td>
                            <td class="text-truncate">
                              <?php
                                echo (strlen($row->eventName) <= 15) ? $row->eventName : substr($row->eventName,0,15) . '...';
                              ?>
                            </td>
                            <td class="text-truncate">
                              <?php
                                echo (strlen($row->venue) <= 15) ? $row->venue : substr($row->venue,0,15) . '...';
                              ?>
                            </td>
                            <td class="text-truncate">
                              <?php echo $row->eventLocation; ?>
                            </td>
                            <td class="text-truncate">
                              <?php echo $row->eventStartDate; ?>
                            </td>
                            <td class="text-truncate">
                              <?php echo $row->eventStartTime; ?>
                            </td>
                            <td class="text-truncate">
                              <?php echo $row->eventEndDate; ?>
                            </td>
                            <td class="text-truncate">
                              <?php echo $row->eventEndTime; ?>
                            </td>
                            <td><?php echo $row->numberOfEventAttendees; ?></td>
                            <td class="text-truncate">
                              <?php echo $row->eventStatus; ?>
                            </td>
                          </tr>
                       <?php } } 
                          else { ?>
                            <tr>
                              <td colspan="9"><h5 class="text-center">No record found</h5></td> 
                            </tr>
                        <?php  }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end events table -->
        <!-- ongoing projects table -->
        <div class="row match-height">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Ongoing Projects</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                    <span class="float-right"><a href="<?=site_url('dashboard/projects')?>" >All Projects<i class="ft-arrow-right"></i></a></span>
                  </p>
                </div>
                <div class="table-responsive">
                  <table id="" class="table table-hover mb-0 ps-container ps-theme-default">
                    <thead>
                      <tr>
                        <th><?php echo ''; ?></th>
                        <th>Project Title</th>
                        <th>Venue</th>
                        <th>Location</th>
                        <th>Start Date</th>
                        <th>Estimated End Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php if ($count > 0) { 
                            foreach ($projects as $row) { ?>
                            <tr style="cursor: pointer;">
                              <td class="text-truncate">
                                <?php $splitFile = explode("/", $row->projectImage); ?>
                                <img src="<?php echo base_url().'/projects/'. $splitFile[5]; ?>" height="30" width="30"/>
                              </td>
                              <td class="text-truncate">
                                <?php
                                  echo (strlen($row->projectTitle) <= 15) ? $row->projectTitle : substr($row->projectTitle,0,15) . '...';
                                ?>
                              </td>
                              <td class="text-truncate">
                                <?php
                                  echo (strlen($row->projectVenue) <= 15) ? $row->projectVenue : substr($row->projectVenue,0,15) . '...';
                                ?>
                              </td>
                              <td class="text-truncate">
                                <?php echo $row->projectLocation; ?>
                              </td>
                              <td class="text-truncate">
                                <?php echo $row->projectStartDate; ?>
                              </td>
                              <td class="text-truncate">
                                <?php echo $row->projectEndDate; ?>
                              </td>
                              <td class="text-truncate">
                                <?php echo $row->projectStatus; ?>
                              </td>
                            </tr>
                         <?php } } 
                          else { ?>
                          <tr>
                            <td colspan="7"><h5 class="text-center">No record found</h5></td>
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
      </div>
    </div>
  </div>
  