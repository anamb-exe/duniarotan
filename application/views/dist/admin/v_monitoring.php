<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Data Monitoring</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/components.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/navbody');
?>
<!-- Datatables4 -->
<link rel="stylesheet" href="<?php echo base_url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/modules/datatables/datatables.min.css') ?>">  
  
  <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel"></h3>
          </div>
        <div class="modal-body">
          <div class="box-body pad">
            <form  id="form"  class="form-horizontal">
                <div class="form-body"> 
                      <input type="hidden" class="form-control" name="id" >
                  <div class="form-group">
                    <label>Kode Monitoring</label>
                      <input type="text" class="form-control" placeholder="Masukan Kode" name="kode" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                   <div class="form-group">
                      <label for="sel1">Pilih Nama Order:</label>
                      <select class="form-control" name="order" id="kendaraan">
                          <?php
                          foreach ($order as $value) {
                              echo "<option value='$value->kode'>$value->nama</option>";
                          }
                          ?>
                      </select>
                  </div>    
                  <div class="form-group">
                    <label>Foto</label>
                      <input type="file" class="form-control" name="photo" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>     
                   <div class="form-group">
                    <label>Keterangan</label>
                      <input type="text" class="form-control" placeholder="Masukan Keterangan" name="keterangan" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
              </div>
            </form>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Monitoring</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Monitoring</div>
            </div>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Monitoring</h4>
                    <div class="float-right">
                    <button class="btn btn-light float-right" onclick="reload_table()" data-toggle="tooltip"  data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <button type="button" class="btn btn-success float-right" onclick="add_kategori()" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                      Tambah
                    <span class="glyphicon glyphicon-file"></span></button>  
                  </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table">
                        <thead>
                          <tr>
                              <th>No</th>
                              <th>Kode Monitoring</th>
                              <th>Nama Order</th>
                              <th>Foto</th>
                              <th>Tanggal</th>
                              <th>Keterangan</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>

      <div class="modal fade" id="modal_img">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
          <div class="box-body pad">
            <form id="img" class="needs-validation" role="form"><div class="form-row">
                <div class="col-md-12 mb-3">
                  <div class="form-group" id="photo-preview">
                      <div class="col-md-12">
                        (No photo)
                        <span class="help-block"></span>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!-- AdminLTE App -->
  
<script src="<?php echo base_url('assets/modules/jquery.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/modules/datatables/datatables.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/modules/jquery-ui/jquery-ui.min.js') ?>"></script> 
<script src="<?php echo base_url('assets/js/page/modules-datatables.js') ?>"></script> 

 <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script>

  <!-- Template JS File -->
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

  <script type="text/javascript">
        var table;
        var tablemodal;
        var save_method;

         $(document).ready(function() {
          table = $('#table').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('Monitoring/setView'); ?>",
                "type": "POST",
            },
            "columns": [

              { "data": "no" },  
              { "data": "kode" },  
              { "data": "order" },
              { "data": "foto" },
              { "data": "tanggal" },
              { "data": "keterangan" },
              { "data": "action" }
            ],
            "order": [[0, 'asc']]
          });
        });


    function reload_table()
    {
    table.ajax.reload(null,false); //reload datatable ajax
    }

    function add_kategori()
    {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Input Monitoring'); // Set Title to Bootstrap modal title
    }
    
    function edit_data(id)
    {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Monitoring/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
    $('[name="id"]').val(data.id);
    $('[name="kode"]').val(data.kode);
    $('[name="nama"]').val(data.nama);
    $('[name="tanggal"]').val(data.tanggal);
    $('[name="keterangan"]').val(data.keterangan);
    $('[name="order"]').val(data.order);
    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Edit Data Monitoring'); // Set title to Bootstrap modal title
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }

    function save()
    {
    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    
    if(save_method == 'add') {
    url = "<?php echo base_url('Monitoring/ajax_add')?>";
    } else {
    url = "<?php echo base_url('Monitoring/ajax_update')?>";
    }
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
    if(data.status) //if success close modal and reload ajax table
    {
    $('#modal_form').modal('hide');
    reload_table();
    }
    
    $('#btnSave').text('Save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    $('#btnSave').text('save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    }
    });
    }
    // ajax adding data to database
    // $.ajax({
    // url : url,
    // type: "POST",
    // data: $('#form').serialize(),
    // dataType: "JSON",
    // success: function(data)
    // {
    //   console.clear();
    //   console.log(data);
    // if(data.status) //if success close modal and reload ajax table
    // {
    // $('#modal_form').modal('hide');
    // reload_table();
    // }
    
    // $('#btnSave').text('Save'); //change button text
    // $('#btnSave').attr('disabled',false); //set button enable
    
    // },
    // error: function (jqXHR, textStatus , errorThrown)
    // {
    // alert('Error adding / update data');
    // $('#btnSave').text('save'); //change button text
    // $('#btnSave').attr('disabled',false); //set button enable
    
    // }
    // });
    

    function delete_data(id)
    {
    if(confirm('Yakin Hapus Data ?'))
    {
    // ajax delete data to database
    $.ajax({
    url : "<?php echo base_url('Monitoring/ajax_delete')?>/" +id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
    //if success reload ajax table
    $('#modal_form').modal('hide');
    reload_table();
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error deleting data');
    }
    });
    
    }
    }

    function img_data(id)
    {
    $('#img')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    url : "<?php echo site_url('Monitoring/ajax_edit')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('#modal_img').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Proses'); // Set title to Bootstrap modal title
    
    $('#photo-preview').show(); // show photo preview modal
    if(data.foto != null)
    {
        $('#photo-preview div').html('<img src="<?php echo base_url();?>/assets/foto/'+data.foto+'" style="width:100%;">'); // show photo
    }
    else
    {
      
    }

    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }
</script>

