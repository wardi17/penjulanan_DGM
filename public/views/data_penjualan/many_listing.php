   <!-- modal untuk detail ml tampil -->
   <div class="modal fade" id="modalML" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="modalMLLabel">Detail ML</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeMl();" aria-label="Close"></button>
    
      </div>
      <div class="modal-body">
      <div id="titleml_edit"></div>
                <div class="text-end">
                <button type="button" onclick="TambahML();" class="btn  text-end">
                <i class="text-primary fa-regular fa-file"></i>
                </button>
                </div>
        <input type="hidden" class="form-control mb-3" id="katgori_dtl" value="">
        <input type="hidden" class="form-control mb-3" id="bulan_dtl" value="">
        <input type="hidden" class="form-control mb-3" id="tahun_dtl" value="">
        <input type="hidden" class="form-control mb-3" id="wilayah_dtl" value="">
        <input type="hidden" class="form-control mb-3" id="kode_ml" value="">
        <!-- batas tabel -->
        <div id="tabelml"></div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeMl();" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal detail ml  tampil-->




 <script>
  
$(document).ready(function(){
    // Ambil elemen select dengan ID myDropdown
    var tgl_awal = $("#tgl_ml_awal");
    var tgl_akhir = $("#tgl_ml_akhir");
    // Loop dari angka 1 sampai 31
    for (var i = 1; i <= 31; i++) {
      // Buat elemen option untuk setiap angka
      var option = $("<option></option>").attr("value", i).text(i);
      var option2 = $("<option></option>").attr("value", i).text(i);

      // Tambahkan elemen option ke dalam dropdown
      tgl_awal.append(option);
      tgl_akhir.append(option2);

    }
});
function get_dataMl(sub_w){
 
    let id ="#btn_ML"+sub_w
    $(id).on("click",function(e){
        e.preventDefault();
        let nma = ``;
        $("input[type=checkbox][name=nama_toko]:checked").each(function(){
          let nama = $(this).attr("id");
          nma +=$("label[for='"+nama+"']").text();
        })
       

      get_dataTambahMl(nma);
       });
  }

  function get_dataTambahMl(nma){
  
    let id = $("input[type=checkbox][name=nama_toko]:checked").val();
    let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();
    let tahun = $("#selectahun").find(":selected").val();
 
    let bulan = $("#selecbulan").find(":selected").val();
   
 
    let kode_ml = "";
    if(wilayah == "w1"){
      kode_ml ="Ml1";
    }else if(wilayah == "w2"){
      kode_ml ="Ml2";
    }else if(wilayah == "w3"){
      kode_ml ="Ml3";
    }else if(wilayah == "w4"){
      kode_ml ="Ml4";
    }
  
    if(id  && wilayah !== undefined){
      
      $("#modalML").modal('show');
      $("#tahun_dtl").val(tahun)
      $("#katgori_dtl").val(nma);
      $("#bulan_dtl").val(bulan);
      $("#wilayah_dtl").val(wilayah);
      $("#kode_ml").val(kode_ml);
      let list = `
      <h6>E-Commerce:  &nbsp; ${nma} | &nbsp; Bulan :&nbsp;  ${bulan}
      | &nbsp; Tahun :&nbsp;  ${tahun} | &nbsp; Period :&nbsp;  ${wilayah.toUpperCase()}
      | &nbsp; Many List :&nbsp;  ${kode_ml}
      </h6>
      `
      $("#titleml_edit").empty().html(list);
      get_headMl();
      get_detailMl(nma,tahun,bulan,kode_ml);
    }else{
                      Swal.fire({         
                              position: 'top-center',
                              icon: 'error',
                              title:"E-commer  harus di centang ",
                            });
    }
  }








function bulan_inggris(angkaBulan){
  const namaBulan = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  // Pastikan angkaBulan berada dalam rentang 1 hingga 12
  if (angkaBulan >= 1 && angkaBulan <= 12) {
    return namaBulan[angkaBulan - 1];
  } else {
    return "Bulan tidak valid";
  }

}

function closeMl(){

  let ml= $("#kode_ml").val();

  let tahun= $("#tahun_dtl").val();
  let bulan= $("#bulan_dtl").val();
  let nama_toko= $("#katgori_dtl").val();



  $("#modalML").modal('hide');


    $.ajax({
        url:'models/manylist/total_ml_week.php',
        method:'POST',
        data:{ml:ml,tahun:tahun,bulan:bulan,nama_toko:nama_toko},
        dataType:'json',      
        success:function(result){
        let ttl_ml = result;
      
          if(ml == 'Ml1'){

            $("#totalml1").empty().html(ttl_ml);
          }else
          if(ml == 'Ml2'){
            $("#totalml2").empty().html(ttl_ml);
          }else
          if(ml == 'Ml3'){
            $("#totalml3").empty().html(ttl_ml);
          }else
          if(ml == 'Ml4'){
            $("#totalml4").empty().html(ttl_ml);
          }
        }
      });
}


function TambahML(){

  let nama_toko = $("#katgori_dtl").val();

  let bln = $("#bulan_dtl").val();
  let thn = $("#tahun_dtl").val();
  let wl = $("#wilayah_dtl").val();
  let kode_ml = $("#kode_ml").val();

  $.ajax({
      url:'models/manylist/get_dataManyList.php',
      method : 'POST',
      data : {nama_toko:nama_toko,thn:thn,bln:bln,wilayah:wl,ml:kode_ml},
      dataType:'json',
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
      success:function(response){
          Swal.fire({         
          position: 'top-center',
          icon: 'success',
          title: 'berhasil get manylisting',
        }).then(function(){ 

          get_headMl();
          get_detailMl(nama_toko,thn,bln,kode_ml)
        });

      }
  })



}




//end 

function get_headMl(){
  let headml =`  <table id="dataml" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                  <tr>
                            <th style='width:50%'>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                  </tr>
                </thead>
              </table>`;
        $("#tabelml").empty().html(headml);
}
//tampil data detail ml
function  get_detailMl(id,tahun,bulan,kode_ml){

  $.ajax({
        url:'models/manylist/tampildata_ManyList.php',
        method:'POST',
        data:{id:id,tahun:tahun,bulan:bulan,kode_ml:kode_ml},
        dataType:'json',      
        success:function(result){
          $("#dataml").DataTable({
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
              
                "order":[[0,'desc']],

                data :result,
                columns:[
                    {'data':'kode_barang'},
                    {'data':'nama_barang'},
                    {'data':'qty'},
                ]
          });
        }
  })
}
//end data detail ml 
 </script>