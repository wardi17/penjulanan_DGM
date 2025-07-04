<!-- untuk data  listing  body--->
<div class="modal fade" id="ListingDataModal" tabindex="-1" aria-labelledby="ListingDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ListingDataModalLabel">Data List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <!-- <div class="text-end">
                <button type="button" id="edit_list" class="btn  text-end">
                      <i class="text-primary fa-regular fa-file"></i>
                </button>
            </div> -->
          <div id="tabelist"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!--- end data  listing  body -->

 <script>

$(document).on("click",".ListingData",function(){
 
 let nama_toko = $(this).data('nama');
 let bulan = $(this).data('bulan');
 let tahun = $(this).data('tahun');
 let li = $(this).data('li');

 headli_dp();
 $.ajax({
     url:'models/listweek/tampildata_list.php',
     method:'POST',
     data:{id:nama_toko,tahun:tahun,bulan:bulan,li:li},
     dataType:'json',      
     success:function(result){
       $("#datatbl_li_dp").DataTable({
         destroy : true,
         "ordering": true,
         bAutoWidth: false,
         //paging:true,
         pageLength: 5,
         lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
               fixedColumns:   {
                  // left: 1,
                   right: 1
               },
           
             "order":[[0,'asc']],

             data :result,
             columns:[
                 {'data':'kode_barang'},
                 {'data':'ket_barang'},
             ]
       });
     }
})
});

function headli_dp(){
  let headml =`  <table id="datatbl_li_dp" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                  <tr>
                            <th style='width:20%'>Kode Barang</th>
                            <th>Ket Barang</th>
                  </tr>
                </thead>
              </table>`;
        $("#tabelist").empty().html(headml);
}
 </script>