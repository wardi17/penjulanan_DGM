   <!-- modal untuk detail ml tampil -->
   <div class="modal fade" id="modalLI" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="modalLILabel">Data List week Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeLI();" aria-label="Close"></button>
    
      </div>
      <div class="modal-body">
      <div id="title_Li"></div>
                <div class="text-end">
                <button type="button" onclick="TambahLI();" class="btn  text-end">
                <i class="text-primary fa-regular fa-file"></i>
                </button>
                </div>
                <input type="hidden" class="form-control mb-3" id="katgori_list_w" value="">
                <input type="hidden" class="form-control mb-3" id="bulan_list_w" value="">
                <input type="hidden" class="form-control mb-3" id="tahun_list_w" value="">
                <input type="hidden" class="form-control mb-3" id="wilayah_list_w" value="">
                <input type="hidden" class="form-control mb-3" id="kode_list_w" value="">
        <!-- batas tabel -->
        <div id="tabelList_w"></div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeLI();" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal detail LI  tampil-->



<!-- tambah detail ml  tambah-->
<div class="modal fade" id="TambahListWeek" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahListWeeklLabel">Edit List week</h5>
        <button type="button" onclick="closelistW();" class="btn-close" data-bs-dismiss="modal" onclick="closeListWeekTambah();" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" class="form-control mb-3" id="ktg_list_tambah" value="">    
      <input type="hidden" class="form-control mb-3" id="bln_list_tambah" value="">
      <input type="hidden" class="form-control mb-3" id="thn_list_tambah" value="">
        <input type="hidden" class="form-control mb-3" id="wil_list_tambah" value="">
        <input type="hidden" class="form-control mb-3" id="kode_list_tambah" value="">
        <form  id ="formtambah_li"  class ="form form-horizontal">
           
           <div class="row col-md-12 mb-3">  
                       <label for="kode_list" class="col-sm-3 col-form-label">Kode Barang</label>
                       <div class="col-sm-6">
                         <input type="text" class="form-control"style="font-size:18px"  name="kode_list" id="kode_list" value="" required>
                       </div>
               </div>
               <div class="row col-md-12">  
                       <label for="ket_list" class="col-sm-3 col-form-label">Keterangan</label>
                       <div class="col-sm-6">
                         <input type="text" class="form-control" style="font-size:18px"  name="ket_list" id="ket_list" value="" required>
                       </div>
               </div>
                 
                
            </form>
          </div>
            <div class="modal-footer col-sm-11 d-flex justify-content-end">
                           <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3"  data-bs-dismiss="modal" id="SimpanList_Week">Save</button>
                           <button type="button" onclick="closelistW();" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal">Close</button>
              </div>
    </div>
  </div>
</div>
 <!-- end tambah detail ml tambah -->
 
 <script>
  function get_LI_edit(sub_w){

    let id ="#btn_Li"+sub_w
    $(id).on("click",function(e){
        e.preventDefault();
 
       get_dataLi();
       });
  }


    function get_dataLi(){ 
   
    let id = $("input[type=checkbox][name=nama_toko]:checked").val();
    let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();
    let tahun = $("#selectahun").find(":selected").val();
    let bulan = $("#selecbulan").find(":selected").val();
 
    let kode_ml = "";
    if(wilayah == "w1"){
      kode_li ="L1";
    }else if(wilayah == "w2"){
      kode_li ="L2";
    }else if(wilayah == "w3"){
      kode_li ="L3";
    }else if(wilayah == "w4"){
      kode_li ="L4";
    }
  
    if(id  && wilayah !== undefined){
      
      $("#modalLI").modal('show');
      $("#tahun_list_w").val(tahun)
      $("#katgori_list_w").val(id);
      $("#bulan_list_w").val(bulan);
      $("#wilayah_list_w").val(wilayah);
      $("#kode_list_w").val(kode_li);
      let list = `
      <h6>E-Commerce:  &nbsp; ${id} | &nbsp; Bulan :&nbsp;  ${bulan}
      | &nbsp; Tahun :&nbsp;  ${tahun} | &nbsp; Period :&nbsp;  ${wilayah.toUpperCase()}
      | &nbsp; List :&nbsp;  ${kode_li}
      </h6>
      `
      $("#title_Li").empty().html(list);
      get_headListweek();
      get_detailList(id,tahun,bulan,kode_li);
    }else{
                      Swal.fire({         
                              position: 'top-center',
                              icon: 'error',
                              title:"E-commer  harus di centang ",
                            });
    }
  }

  function TambahLI(){
    $("#modalLI").modal('hide');
    $("#TambahListWeek").modal('show');
     let nama_toko = $("#katgori_list_w").val();
     let thn = $("#tahun_list_w").val();
     let wyh = $("#wilayah_list_w").val();
     let bln = $("#bulan_list_w").val();
     let list = $("#kode_list_w").val();
 
     $("#ktg_list_tambah").val(nama_toko);
     $("#bln_list_tambah").val(bln);
     $("#thn_list_tambah").val(thn);
     $("#wil_list_tambah").val(wyh);
     $("#kode_list_tambah").val(list);
  }


  //close tambah list week
function closelistW(){
  $("#TambahListWeek").modal('hide');
  $("#modalLI").modal('show');
}
function closeLI(){
  $("#modalLI").modal('hide');
  let li= $("#kode_list_w").val();
 let tahun= $("#tahun_list_w").val();
 let bulan= $("#bulan_list_w").val();
 let nama_toko= $("#katgori_list_w").val();


    $.ajax({
        url:'models/listweek/total_li_week.php',
        method:'POST',
        data:{li:li,tahun:tahun,bulan:bulan,nama_toko:nama_toko},
        dataType:'json',      
        success:function(result){
          let ttl_ml = result;
          if(li == 'L1'){
            $("#totalLi1").empty().html(ttl_ml);
          }else
          if(li == 'L2'){
            $("#totalLi2").empty().html(ttl_ml);
          }else
          if(li == 'L3'){
            $("#totalLi3").empty().html(ttl_ml);
          }else
          if(li == 'L4'){
            $("#totalLi4").empty().html(ttl_ml);
          }
        }
      });
}
//end close tambah list week
// cols listing weeek


//simpan listring
$(document).on("click","#SimpanList_Week",function(e){
  e.preventDefault();
  let nama_toko = $("#ktg_list_tambah").val();
  let bulan= $("#bln_list_tambah").val();
  let tahun = $("#thn_list_tambah").val();
  let wilayah = $("#wil_list_tambah").val();
  let li = $("#kode_list_tambah").val();
  let kode = $("#kode_list").val();
  let ket = $("#ket_list").val();



  $.ajax({
      url:'models/listweek/tambahdata.php',
        type:'POST',
        dataType:'json',
        data :{nama_toko:nama_toko,bulan:bulan,tahun:tahun,wilayah:wilayah,
          li:li,kode:kode,ket:ket},
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
                            $("#formtambah_li").trigger('reset');
                            $("#modalLI").modal('show');
                           $("#TambahListWeek").modal('hide');
                           get_headListweek();
                           get_detailList(nama_toko,tahun,bulan,li);

                          }); 

          
  
        }
  });


})

//end listring

function get_headListweek(){
  let headml =`  <table id="datatbl_li" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                  <tr>
                            <th style='width:20%'>Kode Barang</th>
                            <th>Ket Barang</th>
                  </tr>
                </thead>
              </table>`;
        $("#tabelList_w").empty().html(headml);
}


function get_detailList(nama_toko,tahun,bulan,li){
  $.ajax({
        url:'models/listweek/tampildata_list.php',
        method:'POST',
        data:{id:nama_toko,tahun:tahun,bulan:bulan,li:li},
        dataType:'json',      
        success:function(result){
          $("#datatbl_li").DataTable({
            destroy : true,
            "ordering": false,
            bAutoWidth: false,
            //paging:true,
            pageLength: 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                  fixedColumns:   {
                     // left: 1,
                      right: 1
                  },
              
                "order":[[0,'desc']],

                data :result,
                columns:[
                    {'data':'kode_barang'},
                    {'data':'ket_barang'},
                ]
          });
        }
  })
}
 </script>