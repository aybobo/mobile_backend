<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">News Items</h3>
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
                        <h4 class="card-title"><a href="#newsitem" data-toggle="modal" class="btn btn-secondary">Add News</a></h4>
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
                            <th>News Title</th>
                            <th>Entry Date</th>
                            <th>Status</th>
                            <th><?php echo ''; ?></th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if ($num > 0) { 
                            foreach ($news as $row) { $val = $row->newsId; 
                            $detail=  base_url() .'/dashboard/deleteNews/'.$val;
                            ?>
                            <tr style="cursor: pointer;">
                                <td>
                                    <?php
                                        $splitFile = explode("/", $row->newsImage);
                                    ?>
                                    <img src="<?php echo base_url().'/news/'. $splitFile[5]; ?>" height="30" width="30"/>
                                </td>
                                <td>
                                    <?php echo $row->title; ?>
                                </td>
                                <td>
                                    <?php echo $row->entryDate; ?>
                                </td>
                                <td>
                                    <?php echo $row->newsStatus; ?>
                                </td>
                                <td>
                                    <a href="#editNews" data-toggle="modal" data-newsid="<?php echo $row->newsId; ?>" 
                                    data-title1="<?php echo $row->title; ?>" data-info1="<?php echo $row->information; ?>" 
                                    data-status="<?php echo $row->newsStatus; ?>" data-img="<?php echo $row->newsImage; ?>" 
                                    data-oldimg="<?php echo $splitFile[5]; ?>" 
                                    class="btn btn-light btn-sm border border-dark rounded waves-effect waves-light text-center image m-b-20">Edit</a>
                                </td>
                                <td>
                                <?Php echo "<a href = '".$detail."'  class='btn btn-danger btn-sm border border-dark rounded waves-effect waves-light text-center image m-b-20' onclick='return confirm(\"Are you sure, you want to delete?\")'>Delete</a>";?>
                                </td>
                            </tr>
                         <?php } } else { ?>
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
        </section>
      </div>
    </div>
  </div>
  <!-- add event modal -->

  <div class="modal fade" id="newsitem" tabindex="-1" role="dialog" aria-labelledby="newsitem" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add News Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <?php echo form_open_multipart('dashboard/addNews', ['class' => 'form-material', 'data-parsley-validate' => '']); ?>
                <div class="form-group">
                    <label>Title</label>    
                    <input type="text" name="title" class="form-control" id="title1" required>
                    
                </div>

                <div class="form-group">
                    <label>Information</label>
                    <textarea class="form-control" name="info" id="info1"  rows="4" style="resize:none;" required></textarea>
                </div>
                <div class="form-group">
                    <label>Upload news banner</label>
                    <input type="file" name="banner" class="form-control-file" id="banner" required/>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20">Add Event</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- end add event modal -->

    <!-- edit event modal -->

    <div class="modal fade" id="editNews" tabindex="-1" role="dialog" aria-labelledby="editNews" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit News Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <div class="row">
            <div class="col-md-4 offset-md-1" style="margin-bottom:50px;">
                <img src="" id="imageLocation" height="200px" width="300px"/>
            </div>
            </div>

            <?php echo form_open_multipart('dashboard/updatenews', ['class' => 'form-material']); ?>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title1" class="form-control" value="" id="title">
                </div>
                <div class="form-group">
                    <label>Information</label>
                    <textarea class="form-control" name="info1" id="info" rows="4" value="" style="resize:none;"></textarea>
                </div>

                <div class="form-group">
                  <label class="control-label">Status</label>
                  <div class="">
                    <select name="status" class="form-control input-lg status" style="width: 462px;" required></select>
                  </div>
                </div>

                <fieldset class="form-group">
                    <label>Upload news banner</label>
                    <input type="file" name="flier" class="form-control-file">
                </fieldset>

                <input type="hidden" name="id" value="">
                <input type="hidden" name="imageName" value="">
                
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-md btn-block waves-effect waves-light text-center m-b-20"><i class="fa fa-check-square-o"></i>Save</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- end edit event modal -->
  