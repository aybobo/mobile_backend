<footer class="footer footer-static footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout">
        <span class="float-md-left d-block d-md-inline-block">Copyright &copy; <?= date('Y'); ?>, Nubiabille. </span>
    </p>
  </footer>
  <!-- BEGIN VENDOR JS-->
  <script src="<?=base_url()?>/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="<?=base_url()?>/app-assets/vendors/js/ui/jquery.sticky.js"></script>
  <script type="text/javascript" src="<?=base_url()?>/app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/pickers/dateTime/bootstrap-datetime.js"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
  <!-- BEGIN STACK JS-->
  <script src="<?=base_url()?>/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="<?=base_url()?>/app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $('select:not(#newevent)').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
</script>
<script>
   $('select:not(#editEvent)').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
</script>
<script>
   $('select:not(#newproject)').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
</script>
<script>
   $('select:not(#editproject)').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });
</script>
<script>
    $('#edituser').on('show.bs.modal', function(event) {
      var firstname = $(event.relatedTarget).data('firstname');
      $(event.currentTarget).find('input[name="firstname"]').val(firstname);

      var lastname = $(event.relatedTarget).data('lastname');
      $(event.currentTarget).find('input[name="lastname"]').val(lastname);

      var email = $(event.relatedTarget).data('email');
      $(event.currentTarget).find('input[name="email"]').val(email);

      var userid = $(event.relatedTarget).data('userid');
      $(event.currentTarget).find('input[name="userId"]').val(userid);

      var status = $(event.relatedTarget).data('status');
      if (status == 'Active') {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Inactive'>Inactive</option><option value='Pending'>Pending</option>");
      }
      else if (status == 'Pending') {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option>");
      }
      else {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Active'>Active</option><option value='Pending'>Pending</option>");
      }

      var role = $(event.relatedTarget).data('role');
      if (role == 'General') {
        $(event.currentTarget).find('.role').empty().append('<option value="' + role + '" selected="selected">' + role +  "</option><option value='Admin'>Admin</option><option value='Superadmin'>Superadmin</option>");
      }
      else if (role == 'Admin') {
        $(event.currentTarget).find('.role').empty().append('<option value="' + role + '" selected="selected">' + role +  "</option><option value='Admin'>Admin</option><option value='Superadmin'>Superadmin</option>");
      }
      else {
        $(event.currentTarget).find('.role').empty().append('<option value="' + role + '" selected="selected">' + role +  "</option><option value='General'>General</option><option value='Admin'>Admin</option>");
      }

      var location = $(event.relatedTarget).data('location');
      $(event.currentTarget).find('.location3').empty().append('<option value="' + location + '" selected="selected">' + location +  
        '</option><option value=\'Abia\'>Abia</option><option value=\'Abuja\'>Abuja</option><option value=\'Adamawa\'>Adamawa</option><option value=\'Akwa Ibom\'>Akwa Ibom</option>' +
        '<option value=\'Anambra\'>Anambra</option><option value=\'Bauchi\'>Bauchi</option>' +
        '<option value=\'Bayelsa\'>Bayelsa</option><option value=\'Benue\'>Benue</option>' +
        '<option value=\'Borno\'>Borno</option><option value=\'Cross River\'>Cross River</option>' +
        '<option value=\'Delta\'>Delta</option><option value=\'Ebonyi\'>Ebonyi</option>' +
        '<option value=\'Edo\'>Edo</option><option value=\'Ekiti\'>Ekiti</option>' +
        '<option value=\'Enugu\'>Enugu</option><option value=\'Gombe\'>Gombe</option>' +
        '<option value=\'Imo\'>Imo</option><option value=\'Jigawa\'>Jigawa</option>' +
        '<option value=\'Kaduna\'>Kaduna</option><option value=\'Kano\'>Kano</option>' +
        '<option value=\'Kebbi\'>Katsina</option><option value=\'Kebbi\'>Kebbi</option>' +
        '<option value=\'Kogi\'>Kogi</option><option value=\'Kwara\'>Kwara</option>' +
        '<option value=\'Lagos\'>Lagos</option><option value=\'Nasarawa\'>Nasarawa</option>' +
        '<option value=\'Niger\'>Niger</option><option value=\'Ogun\'>Ogun</option>' +
        '<option value=\'Ondo\'>Ondo</option><option value=\'Osun\'>Osun</option>' +
        '<option value=\'Oyo\'>Oyo</option><option value=\'Plateau\'>Plateau</option>' +
        '<option value=\'Rivers\'>Rivers</option><option value=\'Sokoto\'>Sokoto</option>' +
        '<option value=\'Taraba\'>Taraba</option><option value=\'Yobe\'>Yobe</option>' +
        '<option value=\'Zamfara\'>Zamfara</option>');

      var dob = $(event.relatedTarget).data('dob'); 
      $(event.currentTarget).find('.dob').attr("placeholder", dob);
      $(event.currentTarget).find('input[name="olddob"]').val(dob);
     
    });
</script>
<script>
    $('#editproject').on('show.bs.modal', function(event) {
      var id = $(event.relatedTarget).data('id');
      $(event.currentTarget).find('input[name="id1"]').val(id);

      var title = $(event.relatedTarget).data('title');
      $(event.currentTarget).find('input[name="title1"]').val(title);

      var description = $(event.relatedTarget).data('description');
      $(event.currentTarget).find('textarea[name="projectdesc1"]').val(description);

      var startdate = $(event.relatedTarget).data('startdate');
      $(event.currentTarget).find('.picker').attr("placeholder", startdate);
      $(event.currentTarget).find('input[name="oldStartDate"]').val(startdate);

      var enddate = $(event.relatedTarget).data('enddate');
      $(event.currentTarget).find('.picker').attr("placeholder", enddate);
      $(event.currentTarget).find('input[name="oldEndDate"]').val(enddate);

      var location = $(event.relatedTarget).data('location');
      $(event.currentTarget).find('#editlocation').empty().append('<option value="' + location + '" selected="selected">' + location +  
        '</option><option value=\'Abia\'>Abia</option><option value=\'Abuja\'>Abuja</option><option value=\'Adamawa\'>Adamawa</option><option value=\'Akwa Ibom\'>Akwa Ibom</option>' +
        '<option value=\'Anambra\'>Anambra</option><option value=\'Bauchi\'>Bauchi</option>' +
        '<option value=\'Bayelsa\'>Bayelsa</option><option value=\'Benue\'>Benue</option>' +
        '<option value=\'Borno\'>Borno</option><option value=\'Cross River\'>Cross River</option>' +
        '<option value=\'Delta\'>Delta</option><option value=\'Ebonyi\'>Ebonyi</option>' +
        '<option value=\'Edo\'>Edo</option><option value=\'Ekiti\'>Ekiti</option>' +
        '<option value=\'Enugu\'>Enugu</option><option value=\'Gombe\'>Gombe</option>' +
        '<option value=\'Imo\'>Imo</option><option value=\'Jigawa\'>Jigawa</option>' +
        '<option value=\'Kaduna\'>Kaduna</option><option value=\'Kano\'>Kano</option>' +
        '<option value=\'Kebbi\'>Katsina</option><option value=\'Kebbi\'>Kebbi</option>' +
        '<option value=\'Kogi\'>Kogi</option><option value=\'Kwara\'>Kwara</option>' +
        '<option value=\'Lagos\'>Lagos</option><option value=\'Nasarawa\'>Nasarawa</option>' +
        '<option value=\'Niger\'>Niger</option><option value=\'Ogun\'>Ogun</option>' +
        '<option value=\'Ondo\'>Ondo</option><option value=\'Osun\'>Osun</option>' +
        '<option value=\'Oyo\'>Oyo</option><option value=\'Plateau\'>Plateau</option>' +
        '<option value=\'Rivers\'>Rivers</option><option value=\'Sokoto\'>Sokoto</option>' +
        '<option value=\'Taraba\'>Taraba</option><option value=\'Yobe\'>Yobe</option>' +
        '<option value=\'Zamfara\'>Zamfara</option>');

      var venue = $(event.relatedTarget).data('venue');
      $(event.currentTarget).find('input[name="venue1"]').val(venue);

      var status = $(event.relatedTarget).data('status');
      if (status == 'Completed') {
        $(event.currentTarget).find('.status1').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='In Progress'>In Progress</option><option value='Pending'>Pending</option>");
      }
      else if (status == 'Pending') {
        $(event.currentTarget).find('.status1').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='In Progress'>In Progress</option><option value='Completed'>Completed</option>");
      }
      else {
        $(event.currentTarget).find('.status1').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Pending'>Pending</option><option value='Completed'>Completed</option>");
      }

      var oldimg = $(event.relatedTarget).data('img');
      $(event.currentTarget).find('input[name="imageName1"]').val(oldimg);

      var value = $(event.relatedTarget).data('imgurl');
      $(event.currentTarget).find('#imageLocation').attr("src", value);
    });
</script>
<script>
    $('#editNews').on('show.bs.modal', function(event) {
      var newsid = $(event.relatedTarget).data('newsid');
      $(event.currentTarget).find('input[name="id"]').val(newsid);

      var info = $(event.relatedTarget).data('info1');
      $(event.currentTarget).find('textarea[name="info1"]').val(info);

      var title = $(event.relatedTarget).data('title1');
      $(event.currentTarget).find('input[name="title1"]').val(title);

      var oldimg = $(event.relatedTarget).data('oldimg');
      $(event.currentTarget).find('input[name="imageName"]').val(oldimg);

      var value = $(event.relatedTarget).data('img');
      $(event.currentTarget).find('#imageLocation').attr("src", value);

      var status = $(event.relatedTarget).data('status');
      if (status == 'Active') {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Inactive'>Inactive</option>");
      }
      else {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Active'>Active</option>");
      }
    });
</script>
<script>
    $('#editEvent').on('show.bs.modal', function(event) {
      var eventname = $(event.relatedTarget).data('eventname');
      $(event.currentTarget).find('input[name="eventname"]').val(eventname);

      var aboutevent = $(event.relatedTarget).data('aboutevent');
      $(event.currentTarget).find('textarea[name="aboutevent"]').val(aboutevent);

      var venue = $(event.relatedTarget).data('venue');
      $(event.currentTarget).find('input[name="venue"]').val(venue);

      var location = $(event.relatedTarget).data('location');
        $(event.currentTarget).find('#editlocation').empty().append('<option value="' + location + '" selected="selected">' + location +  
        '</option><option value=\'Abia\'>Abia</option><option value=\'Abuja\'>Abuja</option><option value=\'Adamawa\'>Adamawa</option><option value=\'Akwa Ibom\'>Akwa Ibom</option>' +
        '<option value=\'Anambra\'>Anambra</option><option value=\'Bauchi\'>Bauchi</option>' +
        '<option value=\'Bayelsa\'>Bayelsa</option><option value=\'Benue\'>Benue</option>' +
        '<option value=\'Borno\'>Borno</option><option value=\'Cross River\'>Cross River</option>' +
        '<option value=\'Delta\'>Delta</option><option value=\'Ebonyi\'>Ebonyi</option>' +
        '<option value=\'Edo\'>Edo</option><option value=\'Ekiti\'>Ekiti</option>' +
        '<option value=\'Enugu\'>Enugu</option><option value=\'Gombe\'>Gombe</option>' +
        '<option value=\'Imo\'>Imo</option><option value=\'Jigawa\'>Jigawa</option>' +
        '<option value=\'Kaduna\'>Kaduna</option><option value=\'Kano\'>Kano</option>' +
        '<option value=\'Kebbi\'>Katsina</option><option value=\'Kebbi\'>Kebbi</option>' +
        '<option value=\'Kogi\'>Kogi</option><option value=\'Kwara\'>Kwara</option>' +
        '<option value=\'Lagos\'>Lagos</option><option value=\'Nasarawa\'>Nasarawa</option>' +
        '<option value=\'Niger\'>Niger</option><option value=\'Ogun\'>Ogun</option>' +
        '<option value=\'Ondo\'>Ondo</option><option value=\'Osun\'>Osun</option>' +
        '<option value=\'Oyo\'>Oyo</option><option value=\'Plateau\'>Plateau</option>' +
        '<option value=\'Rivers\'>Rivers</option><option value=\'Sokoto\'>Sokoto</option>' +
        '<option value=\'Taraba\'>Taraba</option><option value=\'Yobe\'>Yobe</option>' +
        '<option value=\'Zamfara\'>Zamfara</option>');
      
      var eventStartDate = $(event.relatedTarget).data('eventstartdate'); 
      var eventStartTime = $(event.relatedTarget).data('eventstarttime');
      var start = eventStartDate + ' ' + eventStartTime;
      $(event.currentTarget).find('.datetime').attr("placeholder", start);

      var eventEndDate = $(event.relatedTarget).data('eventenddate');
      var eventEndTime = $(event.relatedTarget).data('eventendtime');
      var end = eventEndDate + ' ' + eventEndTime;
      $(event.currentTarget).find('.datetime').attr("placeholder", end);

      var status = $(event.relatedTarget).data('status');
      if (status == 'Upcoming') {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "<option value='Done'>Done</option><option value='Cancelled'>Cancelled</option>");
      }
      else if (status == 'Done') {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Upcoming'>Upcoming</option><option value='Cancelled'>Cancelled</option>");
      }
      else {
        $(event.currentTarget).find('.status').empty().append('<option value="' + status + '" selected="selected">' + status +  "</option><option value='Upcoming'>Upcoming</option><option value='Done'>Done</option>");
      }
      
     
      var id = $(event.relatedTarget).data('id');
      $(event.currentTarget).find('input[name="id"]').val(id);

      var oldStartDate = $(event.relatedTarget).data('eventstartdate');
      $(event.currentTarget).find('input[name="oldStartDate"]').val(oldStartDate);

      var oldStartTime = $(event.relatedTarget).data('eventstarttime');
      $(event.currentTarget).find('input[name="oldStartTime"]').val(oldStartTime);

      var oldEndDate = $(event.relatedTarget).data('eventenddate');
      $(event.currentTarget).find('input[name="oldEndDate"]').val(oldEndDate);

      var oldEndTime = $(event.relatedTarget).data('eventendtime');
      $(event.currentTarget).find('input[name="oldEndTime"]').val(oldEndTime);

      var value = $(event.relatedTarget).data('img');
      $(event.currentTarget).find('#imageLocation').attr("src", value);

      var oldimg = $(event.relatedTarget).data('oldimg');
      $(event.currentTarget).find('input[name="imageName"]').val(oldimg);
    });
</script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>