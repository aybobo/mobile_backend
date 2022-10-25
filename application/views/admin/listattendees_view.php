<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Registered Event Attendees</h3>
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
            <div class="col-md-10 offset-md-1">
              <div class="card">
                <div class="card-header">
                <h4 class="card-title"><strong>Event Name: </strong><?php echo $eventName; ?></h4>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard" style="overflow-x:auto;">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                            <th><?php echo ''; ?></th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Registration Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $j = 0;
                        foreach ($rows as $row) { $j++; ?>
                            <tr style="cursor: pointer;">
                                <td><?php echo $j; ?></td>
                                <td><?php echo $row->fullName; ?></td>
                                <td><?php echo $row->location; ?></td>
                                <td><?php echo $row->registerDate; ?></td>
                            </tr>
                        <?php } ?>
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
  