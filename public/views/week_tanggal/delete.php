<!-- Modal  edit data  -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="DeleteModalLabel">Edit data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                <form  id ="formedit"class ="form form-horizontal">
           
                        <div class="row col-md-12 mb-3">  
                                    <label for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-4">
                                        <select disabled class ="form-control" id="selectahun_delete"></select>                             
                                    </div>
                        </div>
               <div class="row col-md-12 mb-3">  
                       <label for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                       <div class="col-sm-4">
                         <select disabled class ="form-control" id="selecbulan_delete"></select>                                
                       </div>
               </div>
               <div class="row col-md-12 mb-3"> 
                       <label class="col-sm-2 col-form-label">Week</label>
                       <div class ="col-md-6">
                         <?php  for($i=1; $i <=4; $i++ ):?>
                           <div class="form-check form-check-inline">
                           <input disabled class="form-check-input checkweek" type="checkbox" id="w<?=$i?>_delete" name="week_delete" value="w<?=$i?>" >
                           <label  disabled class="form-check-label" for="w<?=$i?>_delete">W<?=$i?></label>
                           </div>
                         <?php endfor;?>
                       </div>
               </div>
               <div class =" row col-md-12 mb-3">
                   <label for="tgl_week_awal_delete" class="col-sm-2 col-form-label" >Tgl Awal</label>
                       <div class = "col-md-2">
                       <select  disabled type="text" id="tgl_week_awal_delete" class="form-control"></select>
                       </div>
                       <label for="tgl_week_akhir_delete" class="col-sm-2 col-form-label">Tgl Akhir</label>
                       <div class ="col-md-2">
                           <select disabled type="text" id="tgl_week_akhir_delete" class="form-control"></select>
                       </div>
             
               </div>
               </div>
                   <div class="col-sm-11 d-flex justify-content-end">
                           <button  type="sumbit" name="sumbit" class="btn btn-danger me-1 mb-3"  data-bs-dismiss="modal" id="DeleteData">Delete</button>
                           <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal" id="close_tambah2">Close</button>
                         </div>
</form>
                </div>
              </div>
    </div>
<!-- end modal edit -->


<script>
$(document).ready(function(){
  const dateya = new Date();
    let bulandefault = dateya.getMonth()+1;
    let tahundefault = dateya.getFullYear();
    let tahun = tahundefault;

  get_tahun_delete();
  get_bulan_delete();
  get_tanggal_delete();
  $("#selectahun").val(tahun);

  let bln = bulan_angka(bulandefault);
  $("#selecbulan").val(bln);
});
    $(document).on("click",".checkweek",function(){
      $('.checkweek').not(this).prop('checked', false); 

    })
  
    //tambah data
  $("#DeleteData").on('click',function(e){
    e.preventDefault();
    let tahun = $("#selectahun_delete").find(":selected").val();
    let bulan = $("#selecbulan_delete").find(":selected").val();
    let wilayah = $("input[type=checkbox][name=week_delete]:checked").val();
    let tgl_awal = $("#tgl_week_awal_delete").find(":selected").val();
    let tgl_akhir = $("#tgl_week_akhir_delete").find(":selected").val();

    $.ajax({
      url:'models/master_bulanWeek/delete_data.php',
      method:'POST',
       data:{tahun:tahun,bulan:bulan,wilayah:wilayah,tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
       cache:true,
       dataType:'json',
       success:function(result){
            let status = result.error;
                  Swal.fire({
                    position: 'top-center',
                  icon: 'success',
                  title: status,
                  showConfirmButton: false,
                    timer:30000
                  }).then(
                    location.reload()
                  ); 
                  
       }
    });

  });
 //restet tambah
 $("#close_tambah").on("click",function(e){
                    e.preventDefault();
                    $("#formtambah").trigger("reset");
                  })
                  $("#close_tambah2").on("click",function(e){
                    
                    e.preventDefault();
                    $("#formtambah").trigger("reset");
                  })
      //reset tambah

function get_tahun_delete(){
 let startyear = 2020;
 let date = new Date().getFullYear();
 
 let endyear = date + 2;
 
 for(let i = startyear; i <=endyear; i++){
   let selected = (i !== date) ? 'selected' : date; 
  $("#selectahun_delete").append($(`<option />`).val(i).html(i).prop('selected', selected));

 }
}

function get_bulan_delete(){
  let seletBulan = $("#selecbulan_delete");
  const namaBulan = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  for(let a = 0 ; a < namaBulan.length; a++){
    let option = $('<option>',{
      value: namaBulan[a] ,
      text: namaBulan[a]
    });
    seletBulan.append(option);
  }
}


function bulan_angka(angkaBulan){
  const namaBulan2 = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  // Pastikan angkaBulan berada dalam rentang 1 hingga 12
  if (angkaBulan >= 1 && angkaBulan <= 12) {
    return namaBulan2[angkaBulan - 1];
  } else {
    return "Bulan tidak valid";
  }

}


//untuk no tanggal awal dan akhir

function get_tanggal_delete(){
  var tgl_awal = $("#tgl_week_awal_delete");
    var tgl_akhir = $("#tgl_week_akhir_delete");
    // Loop dari angka 1 sampai 31
    for (var i = 1; i <= 31; i++) {
      // Buat elemen option untuk setiap angka
      var option = $("<option></option>").attr("value", i).text(i);
      var option2 = $("<option></option>").attr("value", i).text(i);

      // Tambahkan elemen option ke dalam dropdown
      tgl_awal.append(option);
      tgl_akhir.append(option2);
    }
}

</script>