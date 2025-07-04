<div id="main">
<?php include 'views/pages/burger.php' ?>
<?php include 'views/week_tanggal/tambah.php'?>
<?php include 'views/week_tanggal/edit.php'?>
<?php include 'views/week_tanggal/delete.php'?>
  <div id="header_data"></div>
  <div class ="col-md-12 col-12">
      <!-- <h3 class="text-center">Target upload</h3> -->
            <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-lg" id="tambahData">
                            <i class="fa-regular fa-file"></i>
                            </button>    
                        
            </div>
    
  </div>
 
    <!-- Basic Tables start -->
    <div id="tabelhead"></div>
    <!-- Basic Tables end -->

</div>



  <!-- Modal delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class ="modal-content"> 
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EditModalLabel">Delete data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                  <form id="formdelete">
                  <div class="row col-md-12 mb-3">  
                              <label for="kode_delete" class="col-sm-4 col-form-label">Kode</label>
                              <div class="col-sm-5">
                                <input disabled type="text" class="form-control"  name="kode_delete" id="kode_delete" value="" required>
                              </div>
                      </div>
                      <div class="row col-md-12 mb-3">  
                              <label for="kjn_delete" class="col-sm-4 col-form-label">Nama Toko</label>
                              <div class="col-sm-6">
                                <input  disabled type="text" class="form-control "  name="kjn_delete" id="kjn_delete" value="" required>
                              </div>
                      </div>
                      <div class="col-sm-11 d-flex justify-content-end">
                            <button type="sumbit" id="delete" class="btn btn-primary text-center me-1 md-3" data-bs-dismiss="modal" name="delete_user">Yes</button> 
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                        
                  </form>
                </div>
              </div>
    </div>
  </div>
<!-- end form delete  -->



<script>
$(document).ready(function(){
  get_header();
           
    // $('input').keyup(function() {
    //     this.value = this.value.toLocaleUpperCase();
    // });

  //end tambah data
    // delete data 
    $(document).on("click",".open-delete",function(){
      let row = jQuery(this).closest('tr');
        let columns = row.find('td'); 
    
        columns.addClass('row-highlight');
        jQuery.each(columns, function(key, item) { 
            switch(key){
              case 0:
           let kode = item.innerHTML;
           $(".modal-body #kode_delete").val(kode);
            break;
            case 1:
            let kjn = item.innerHTML;
            $(".modal-body #kjn_delete").val(kjn);
            break;
          }
        
        });
       
     


    });

    $("#delete").on("click",function(e){
        e.preventDefault();
        let kode = $("#kode_delete").val();
    
        $.ajax({
            url:"models/master_jenis_eo/delete_data.php",
            type:"POST",
            data:{kode:kode},
                dataType:'json',                  
            success: function(result){ 
              let status = result.error;
                  Swal.fire({
                    position: 'top-center',
                  icon: 'success',
                  title: status,
                
                  }); 
                  get_data_jenis_kjn();
            }
        
        })
    });
    //end delete data
    //edit data
    $(document).on("click",".open-edit",function(){
     
    
          let row = jQuery(this).closest('tr');
          let columns = row.find('td'); 
          columns.addClass('row-highlight'); 
          jQuery.each(columns, function(key, item) { 
              switch(key){
                case 0:
                  let kode = item.innerHTML;
                  $(".modal-body #kode_edit").val(kode);
                  break;
                case 1:
                  let nama = item.innerHTML;
                  $(".modal-body #nama_edit").val(nama);
                  break;
                
              }

    });
   

  
});



  });
  // untuk tambah data baru dan show modal tambah 
  $(document).on("click","#tambahData",function(){
        $("#TambaModal").modal("show");
    });

    $(document).on("click","#editData",function(){
        let thn = $(this).data('thn');
        let bln = $(this).data('bln');
        let week = $(this).data('week');
        let tgl_awal = $(this).data('tgl_awal');

        let tgl_akhir = $(this).data('tgl_akhir');
        
        $("#EditModal").modal("show");

        $(".modal-body #selectahun_edit").val(thn);
        $(".modal-body #selecbulan_edit").val(bln);
     
        if(week == "w1"){
          let wk = "#"+week+"_edit";
          let w2 ="#w2_edit";
          let w3 ="#w3_edit";
          let w4 ="#w4_edit";
          $(wk).prop("checked",true);
          $(w2).prop("checked",false);
          $(w3).prop("checked",false);  
          $(w4).prop("checked",false);
        }

        if(week == "w2"){
          let wk = "#"+week+"_edit";
          let w1 ="#w1_edit";
          let w3 ="#w3_edit";
          let w4 ="#w4_edit";
          $(wk).prop("checked",true);
          $(w1).prop("checked",false);
          $(w3).prop("checked",false);  
          $(w4).prop("checked",false);
        }
        if(week == "w3"){
          let wk = "#"+week+"_edit";
          let w1 ="#w1_edit";
          let w2 ="#w2_edit";
          let w4 ="#w4_edit";
          $(wk).prop("checked",true);
          $(w1).prop("checked",false);
          $(w2).prop("checked",false);  
          $(w4).prop("checked",false);
        }
        if(week == "w4"){
          let wk = "#"+week+"_edit";
          let w1 ="#w1_edit";
          let w2 ="#w2_edit";
          let w3 ="#w3_edit";
          $(wk).prop("checked",true);
          $(w1).prop("checked",false);
          $(w2).prop("checked",false);  
          $(w3).prop("checked",false);
        }

        let tgl_start = myformat(tgl_awal);
        let tgl_end = myformat(tgl_akhir);

        $(".modal-body #tgl_week_awal_edit").val(tgl_start);
        $(".modal-body #tgl_week_akhir_edit").val(tgl_end);

        
    });

    $(document).on("click","#deleteData",function(){
        let thn = $(this).data('thn');
      
        let bln = $(this).data('bln');
        let week = $(this).data('week');
        let tgl_awal = $(this).data('tgl_awal');

        let tgl_akhir = $(this).data('tgl_akhir');
        
        $("#DeleteModal").modal("show");

        $(".modal-body #selectahun_delete").val(thn);
        $(".modal-body #selecbulan_delete").val(bln);
     
        if(week == "w1"){
          let wk = "#"+week+"_delete";
          let w2 ="#w2_delete";
          let w3 ="#w3_delete";
          let w4 ="#w4_delete";
          $(wk).prop("checked",true);
          $(w2).prop("checked",false);
          $(w3).prop("checked",false);  
          $(w4).prop("checked",false);
        }

        if(week == "w2"){
          let wk = "#"+week+"_delete";
          let w1 ="#w1_delete";
          let w3 ="#w3_delete";
          let w4 ="#w4_delete";
          $(wk).prop("checked",true);
          $(w1).prop("checked",false);
          $(w3).prop("checked",false);  
          $(w4).prop("checked",false);
        }
        if(week == "w3"){
          let wk = "#"+week+"_delete";
          let w1 ="#w1_delete";
          let w2 ="#w2_delete";
          let w4 ="#w4_delete";
          $(wk).prop("checked",true);
          $(w1).prop("checked",false);
          $(w2).prop("checked",false);  
          $(w4).prop("checked",false);
        }
        if(week == "w4"){
          let wk = "#"+week+"_delete";
          let w1 ="#w1_delete";
          let w2 ="#w2_delete";
          let w3 ="#w3_delete";
          $(wk).prop("checked",true);
          $(w1).prop("checked",false);
          $(w2).prop("checked",false);  
          $(w3).prop("checked",false);
        }

        let tgl_start = myformat(tgl_awal);
        let tgl_end = myformat(tgl_akhir);

        $(".modal-body #tgl_week_awal_delete").val(tgl_start);
        $(".modal-body #tgl_week_akhir_delete").val(tgl_end);

        
    });

function get_header(){
    let data_headr =`

    <div  class="page-heading mb-3">
    <div class="page-title">
    <h4 class="text-center">Master Week</h4>
    </div></div>

    `;
    $("#header_data").html(data_headr);
    get_tables();
    
}
function get_tables(){
  get_dataWeek();
    //   let id ="#"+tabel;
    //   let substr_bulan = bulan.substr(0,3);
        let dataTable =`
        <section class="section">
                <div class="card">
                    <div class="card-body">
                    <table id="tabel1" class='display table-info' style='width:100%'>                    
                                    <thead  id='thead'class ='thead'>
                                    <tr>
                                                <th style="width:2%">Tahun</th>
                                                <th style="width:2%">Bulan</th>
                                                <th style="width:2%">Week</th>
                                                <th style="width:2%">Tgl Awal</th>
                                                <th style="width:2%">Tgl Akhir</th>

                                                <th style="width:1%">
                                                <p class="text-center">Action</p></th>  
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table><br>
                                </div>
                            </div>
                        </section>

        `;
    $("#tabelhead").empty().html(dataTable);
};

function get_dataWeek(){

let dataTable =``;
$.ajax({
        url:'models/master_bulanWeek/tampildata.php',
        method:'POST',
        dataType:'json',      
        success:function(response){
      
         $("#tabel1").DataTable({
            
            "ordering": false,
            "destroy":true,
            // dom: 'Plfrtip',
            //     scrollCollapse: true,
            paging:true,
            //     "bPaginate":false,
            //     "bLengthChange": false,
            //     "bFilter": true,
            //     "bInfo": false,
            //     "bAutoWidth": false,
            //     dom: 'lrt',
                fixedColumns:   {
                // left: 1,
                    right: 1
                },

              // columnDefs: [{ 
              //       target: 3, 
              //     render: DataTable.render.datetime( "D MMM, YYYY" ) 
              //   }],
               order: [[3, 'desc']],
                pageLength: 4,
                lengthMenu: [[4,8, 20, -1], [4,8, 20, 'All']],
                            
                data: response,
                    columns: [
                        { 'data': 'tahun' },
                        { 'data': 'bulan' },
                        { 'data': 'wilayah' },
                        { 'data': 'tgl_awal' },
                        { 'data': 'tgl_akhir' },
                        { "render": function (data,type,row) { // Tampilkan kolom aksi
                     
                        let html =``;
                          if(type ==='display'){
                            let thn  = row.tahun;
                            let bln = row.bulan;
                           let  week = row.wilayah;
                           let  tgl_awal = row.tgl_awal;
                           let  tgl_akhir = row.tgl_akhir;
                             html  =`<button type="button" id="editData" data-thn="${thn}" data-bln="${bln}" data-week="${week}" 
                                      data-tgl_awal="${tgl_awal}" data-tgl_akhir="${tgl_akhir}" 
                                      class="btn btn-lg btn-space"><i class="fa-regular fa-pen-to-square"></i></button>`
                            html  +=`<button type="button" id="deleteData" data-thn="${thn}" data-bln="${bln}" data-week="${week}" 
                                    data-tgl_awal="${tgl_awal}" data-tgl_akhir="${tgl_akhir}" 
                                    class="btn btn-lg btn-space"><i class="fa-regular fa-trash-can"></i></button>`
                          } 
                          return html
                         }
                        },
                    ]      
        
        });
        }
});      
} 

function myformat(tgl_awal){
  let tgl = tgl_awal.split('/')[0];
  let parint = parseInt(tgl);
  return parint;
}
</script>