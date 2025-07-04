   <!-- modal untuk full many list week 1 bulan -->
   <div class="modal fade" id="FullDataMlModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="modal_1Label">Full Many List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
    
      </div>
      <div class="modal-body">
      
        <!-- batas tabel -->
        <div id="tabelml_full"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    //buttons untuk  data full fml
$(document).on("click",".fullData_ml",function(){
    let tahun = $(this).data('tahun');
    let bulan = $(this).data('bulan');
    let nama = $(this).data('nama')

    $.ajax({
      url :'models/manylist/total_ml.php',
      method: 'POST',
      data:{nama:nama,tahun:tahun,bulan:bulan},
      dataType:'json',
      success: function(result){
       
        let headmlful =`  <table id="datamlful" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                  <tr>
                          <th style='width:10%'>Kode Barang</th>
                            <th  style='width:20%'>Nama Barang</th>
                            <th style='width:10%'>Qty</th>
                  </tr>
                </thead>
              </table>`;
        $("#tabelml_full").empty().html(headmlful);
        $("#datamlful").DataTable({
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
                    {'data':'kode'},
                    {'data':'nama'},
                    {'data':'qty', className: "text-end"},
                ]
          })
          $("#datamlful").css('font-size', '14px');

      }
    })
})
</script>