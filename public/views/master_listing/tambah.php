<!-- untuk modal tambah data master listing  -->
<div class="modal fade" id="TambahMaster_Modal" tabindex="-1" aria-labelledby="TambahMaster_ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="TambahMaster_ModalLabel">Tambah Master listing</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" id ="close_master_list2" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  id ="form_master_listing"  class ="form form-horizontal">
           
           <div class="row col-md-12 mb-3">  
                       <label for="kode_barang_mst" class="col-sm-2 col-form-label">Kode Barang</label>
                       <div class="col-sm-4">
                         <input type="text" class="form-control"style="font-size:18px"  name="kode_barang_mst" id="kode_barang_mst" value="" required>
                       </div>
               </div>
               <div class="row col-md-12 mb-3">  
                       <label for="nama_barang_mst" class="col-sm-2 col-form-label">Nama Barang</label>
                       <div class="col-sm-4">
                         <input type="text" class="form-control" style="font-size:18px"  name="nama_barang_mst" id="nama_barang_mst" value="" required>
                       </div>
               </div>
               <div class="row col-md-12 mb-3">  
                       <label for="bulan_barang_mst" class="col-sm-2 col-form-label">Bulan Posting</label>
                       <div class="col-sm-4">
                         <input type="text" class="form-control" style="font-size:18px"  name="bulan_barang_mst" id="bulan_barang_mst" value="" required>
                       </div>
               </div>
               <!-- <div class="row col-md-12 mb-3">  
                       <label for="status_mst" class="col-sm-2 col-form-label">Status</label>
                       <div class ="col-md-4">
                          <div class="form-check form-check-inline">
                          <input class="form-check-input checkstatus" type="checkbox" id="yes"name="status-mst" value="yes">
                          <label class="form-check-label" for="shopee">YES</label>
                        </div>
                  
                    </div>
               </div> -->
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="Simpan_mst-liting">Save</button>
        <button type="button" class="btn btn-secondary" id="close_master_list"data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
 <!-- end modal tambah  master listing --->
 <script>
$(document).ready(function(){

    // untuk simpan data tambah master
$("#Simpan_mst-liting").on("click",function(){
  let kode =$("#kode_barang_mst").val();
  let nama =  $("#nama_barang_mst").val();
 let bulan_list = $("#bulan_barang_mst").val();
  $.ajax({
      url:'models/master_listing/tambahdata.php',
        type:'POST',
        dataType:'json',
        data :{kode:kode,nama:nama,bulan_list:bulan_list},
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
                            $("#TambahMaster_Modal").modal('hide');
                          
                           get_datamstlisting();
                          
                          }); 

          
        }
  });
});
})

 </script>