<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel"></h3>
          </div>
        <div class="modal-body">
          <div class="box-body pad">
            <form  id="form"  class="form-horizontal">
              <input type="hidden" value="" name="id"/>

      <div class="modal-body">
          <div class="box-body pad">
            <form  id="form"  class="form-horizontal">
              <input type="hidden" value="" name="id"/>

                <div class="form-body"> 
                      <input type="hidden" class="form-control" name="id" >
                  <div class="form-group">
                    <label>Kode</label>
                      <input type="text" class="form-control" placeholder="Masukan Kode" name="kode" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>     
                  <div class="form-group">
                    <label>Nama Menu</label>
                      <input type="text" class="form-control" placeholder="Masukan Nama Menu" name="nama" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>  
                    
                    <div class="custom-file">
                    <label class="custom-file-label" for="customFile">Gambar</label>
                      <input type="file" class="custom-file-input" placeholder="Masukan Gambar" name="gambar" required>
                  </div>  

                  <div class="form-row">   
                  <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <label>Harga</label>
                      <input type="text" class="form-control" placeholder="Masukan Harga" name="harga" required>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>
                 </div>

                 <div class="col-md-12 mb-3">
                  <div class="form-group">
                    <label for="customFile">Aktif</label> 
                      <select name="aktif" class="form-control" placeholder="PILIH" required="">
                      <option value="">-</option>
                      <option value="T">True</option>
                      <option value="F">False</option>
                      </select>
                      <i class="form-control-feedback"></i><span class="text-warning" ></span>
                  </div>   
                  </div>
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

  <section class="content-header">
    <h1>
      Data Menu
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Menu</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          
        </div>
        <div class="box box-info">
          <div class="box-header">
             <!--  <button class="btn btn-primary pull-right" odata-toggle="modal" data-target="#modal-default" data-toggle="tooltip" data-placement="top" title="Tambah Data"><span class="glyphicon glyphicon-file"></span>Tambah</button> -->
              <button class="btn btn-default " onclick="reload_table()" data-toggle="tooltip"  data-placement="top" title="Reload Table"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
              <button type="button" class="btn btn-primary pull-right" onclick="add_kategori()" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                Tambah
              <span class="glyphicon glyphicon-file"></span></button>
          </div>

          <div class="box-body">
            
            <div class="table-responsive mailbox-messages">                    
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aktif</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('dist/_partials/footer'); ?>

<script type="text/javascript">
        var table;
        var tablemodal;
        var save_method;

        $(document).ready(function() {
          table = $('#table').DataTable({  
            "processing": true, 
            "ajax": {
                "url": "<?php echo base_url('menu/setView'); ?>",
                "type": "POST",
            },
            "columns": [

              { "data": "no" },  
              { "data": "kode_menu" },  
              { "data": "nama_menu" },
              { "data": "harga_menu" },
              { "data": "gambar" },
              { "data": "aktif" },
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
    $('.modal-title').text('Input kategori'); // Set Title to Bootstrap modal title
    }
    
    function edit_data(id)
    {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    url : "<?php echo base_url('menu/ajax_edit')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="id"]').val(data.ID);
    $('[name="kode"]').val(data.kode_menu);
    $('[name="nama"]').val(data.nama_menu);
    $('[name="harga"]').val(data.harga_menu);
    $('[name="gambar"]').val(data.gambar);
    $('[name="aktif"]').val(data.aktif);
    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Edit Data kategori'); // Set title to Bootstrap modal title
    
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
    url = "<?php echo base_url('menu/ajax_add')?>";
    } else {
    url = "<?php echo base_url('menu/ajax_update')?>";
    }
    // ajax adding data to database
    $.ajax({
    url : url,
    type: "POST",
    data: $('#form').serialize(),
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

    function delete_data(id)
    {
    if(confirm('Yakin Hapus Data ?'))
    {
    // ajax delete data to database
    $.ajax({
    url : "<?php echo base_url('menu/ajax_delete')?>/" +id,
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
</script>

</body>
</html>