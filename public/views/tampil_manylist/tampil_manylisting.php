   <!-- modal untuk full many list week 1 bulan -->
   <div class="modal fade" id="MLDataMlModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="modal_1Label">Many List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"  aria-label="Close"></button>
    
      </div>
      <div class="modal-body">
      
        <!-- batas tabel -->
        <div id="tabelml_week"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

    //end data full fml
function headWeedData_ml(){
  let headmlful =`  <table id="dataml_ml" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                  <tr>
                          <th style='width:10%'>Kode Barang</th>
                          <th style='width:20%'>Nama Barang</th>
                          <th style='width:10%'>Qty</th>
                  </tr>
                </thead>
              </table>`;
        $("#tabelml_week").empty().html(headmlful);
}

//button data untuk week ml  tabelml_week
$(document).on("click",".WeekData_ml",function(){
    let tahun = $(this).data('tahun');
    let bulan = $(this).data('bulan');
    let nama = $(this).data('nama');
    let ml = $(this).data('ml');
    $("#FullDataMlModal").hide();
    headWeedData_ml();
    $.ajax({
      url :'models/manylist/week_ml.php',
      method: 'POST',
      data:{nama:nama,tahun:tahun,bulan:bulan,ml:ml},
      dataType:'json',
      success: function(result){
       
          $("#dataml_ml").DataTable({
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
                      {'data':'nama_barang'},
                      {'data':'qty',className: "text-end"},

                  ]
          });
          $("#dataml_ml").css('font-size', '14px');

      }
    })
})
//end data  week ml
</script>