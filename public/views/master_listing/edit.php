<div class="modal fade" id="MstListingModal" tabindex="-1" aria-labelledby="MstListingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="MstListingModalLabel">Edit Master listing</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_master_list_edit2" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  id ="form_master_listing"  class ="form form-horizontal">
           
           <div class="row col-md-12 mb-3">  
                       <label for="kode_barang_mst_edit" class="col-sm-2 col-form-label">Kode Barang</label>
                       <div class="col-sm-4">
                         <input disabled type="text" class="form-control"style="font-size:18px"  name="kode_barang_mst_edit" id="kode_barang_mst_edit" value="" required>
                       </div>
               </div>
               <div class="row col-md-12 mb-3">  
                       <label for="nama_barang_mst_edit" class="col-sm-2 col-form-label">Nama Barang</label>
                       <div class="col-sm-4">
                         <input  type="text" class="form-control" style="font-size:18px"  name="nama_barang_mst_edit" id="nama_barang_mst_edit" value="" required>
                       </div>
               </div>
               <div class="row col-md-12 mb-3">  
                       <label for="post_barang_mst_edit" class="col-sm-2 col-form-label">Bulan Posting</label>
                       <div class="col-sm-4">
                         <input type="text" class="form-control" style="font-size:18px"  name="post_barang_mst_edit" id="post_barang_mst_edit" value="" required>
                       </div>
               </div>
               <div class="row col-md-12 mb-3">  
                       <label for="status_mst_edit" class="col-sm-2 col-form-label">Status</label>
                       <div class ="col-md-4">
                          <div class="form-check form-check-inline">
                          <input class="form-check-input checkstatus" type="checkbox" id="Y_edit"name="status-mst" value="Y">
                          <label class="form-check-label" for="Y_edit">YES</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input checkstatus" type="checkbox" id="N_edit" name="status-mst" value="N">
                          <label class="form-check-label" for="N_edit">NO</label>
                        </div>
                    </div>
               </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="SimpanEdit_mst-liting">Save</button>
        <button type="button" class="btn btn-danger" id="delete_master_list"data-bs-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-secondary" id="close_master_list_edit"data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<script>

    //untuk edit simpan data master listing
$("#SimpanEdit_mst-liting").on("click",function(){
  let kode =$("#kode_barang_mst_edit").val();
  let nama =  $("#nama_barang_mst_edit").val();
 let bulan_list = $("#post_barang_mst_edit").val();
 let status = $("input[type=checkbox][name=status-mst]:checked").val();


  $.ajax({
      url:'models/master_listing/updatedata.php',
        type:'POST',
        dataType:'json',
        data :{kode:kode,nama:nama,bulan_list:bulan_list,status:status},
        beforeSend :function(){
            
            Swal.fire({
              title: 'Loading...',
              html: 'Please wait...',
              allowEscapeKey: false,
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading()
            }
              });
          },
        success:function(result){
          let pesan = result.error;
              let nilai = result.nilai;
                  Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: pesan,
                          }).then(function(){ 
                            $("#form_master_listing").trigger('reset');
                            $("#MstListingModal").modal('hide');
                           get_datamstlisting();
                          
                          }); 

          
        }
  });
});

//hapus datamaster liting 
$("#delete_master_list").on("click",function(){
    let kode = $("#kode_barang_mst_edit").val();
  $.ajax({
      url:'models/master_listing/deletedata.php',
        type:'POST',
        dataType:'json',
        data :{kode:kode},
        beforeSend :function(){
            
            Swal.fire({
              title: 'Loading...',
              html: 'Please wait...',
              allowEscapeKey: false,
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading()
            }
              });
          },
        success:function(result){
     
          let pesan = result.error;
              let nilai = result.nilai;
                  Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: pesan,
                          }).then(function(){ 
                            $("#form_master_listing").trigger('reset');
                            $("#MstListingModal").modal('hide');
                           get_datamstlisting();
                          
                          }); 

          
        }
  });
})
//end data hapus masterlisting
</script>