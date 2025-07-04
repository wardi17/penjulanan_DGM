<div id="main">
<?php include 'views/pages/burger.php' ?>
<?php include 'views/master_listing/tambah.php' ?>
<?php include 'views/master_listing/edit.php' ?>

  <div id="header_data"></div>
  <div class ="col-md-12 col-12">
      <!-- <h3 class="text-center">Target upload</h3> -->
            <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#TambahMaster_Modal">
                            <i class="fa-regular fa-file"></i>
                            </button>    
                        
            </div>
    
  </div>
 
    <!-- Basic Tables start -->
    <div id="tabelMasterlist"></div>
    <!-- Basic Tables end -->

</div>



<script>
$(document).ready(function(){
get_datamstlisting();

$(".checkstatus").on("click",function(){
    $('.checkstatus').not(this).prop('checked', false); 
  });   
$(document).on("click",".open-MstListing",function(){
  $("#Mst_listModal").modal('hide');
  let kode = $(this).data('kode');
  let nama = $(this).data('nama');
  let status = $(this).data('status');
  let bln = $(this).data('bln_post');

  $("#kode_barang_mst_edit").val(kode);
  $("#nama_barang_mst_edit").val(nama);
  $("#post_barang_mst_edit").val(bln);
  let s ="#"+ status + "_edit";
  if(status == "Y"){
    $(s).prop("checked",true);
      $("#N_edit").prop("checked",false);
  }else{
    $(s).prop("checked",true);
      $("#Y_edit").prop("checked",false);
  }

})
});

function get_datamstlisting(){

$.ajax({
      url:'models/master_listing/tampildata.php',
      method:'POST',
      dataType:'json',      
      success:function(result){
       
        let headml =` 
        <section class="section">
                <div class="card">
                    <div class="card-body">
            <table id="datamst" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                    <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Bulan Posting</th>
                            <th>Status</th>
                            <th>Action</th>
                    </tr>
                </thead>
                </table>
                </div>
            </div>
        </section> 
            `;
      $("#tabelMasterlist").empty().html(headml);
        $("#datamst").DataTable({
          pageLength: 5,
                      lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                fixedColumns:   {
                   // left: 1,
                    right: 1
                },
              "order":[[0,'asc']],

              data :result,
              columns:[
                  {data:'kode_barang'},
                  {data:'nama_barang'},
                  {data:'bulan_posting'},
                  {data:'status'},
                  {
                    "render": function(data,type,row){
                     
                      let kode = row.kode_barang;
                      let nama = row.nama_barang;
                      let bln_post = row.bulan_posting;
                      let status = row.status;
                      let html  =`<button type="button" data-kode="${kode}" data-nama="${nama}" data-bln_post="${bln_post}" data-status="${status}"   class=" open-MstListing btn btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#MstListingModal"><i class="fa-regular fa-pen-to-square"></i></button>`

                      return html;
                    }
                  }
              ]
        })
      }
})
}
</script>