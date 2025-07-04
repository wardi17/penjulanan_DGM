<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<!-- Javascript Bootstrap Datepicker -->


<?php include 'views/pages/burger.php' ?>
<?php include 'views/data_penjualan/many_listing.php' ?>
<?php include 'views/data_penjualan/listing.php' ?>

<style>


table {
  border-collapse: collapse;
  width: 100%;
}

td {
  text-align: start;
}


</style>



<div id="main">
<div class ="col-md-12 col-12">
  <div class="card">
    <div class="card-header">
    <h5> GET DATA</h5>
    </div>
    <div class="card-content">
      <div class="card-body">
      <form  id ="formtambah" class ="form form-horizontal">
        <div class="row col-md-12-col-12">

                      <div class="row col-md-10 mb-3">
                                <label for="nama_toko" class="col-sm-2 col-form-label">E-Commerce</label>
                               <div id="nama_toko"class="col-sm-6"></div>
                      </div>
                      <div class="row col-md-10 mb-3">  
                                <label for="selectahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-2">
                                  <select class ="form-control" id="selectahun"></select>                             
                              </div>
                      </div>  
                      <div class="row col-md-10 mb-3">  
                                <label for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-2">
                                  <select class ="form-control" id="selecbulan"></select>                                
                                </div>
                        </div>
                      <div class="row col-md-10 mb-3">
                      <label class="col-sm-2 col-form-label">Period</label>
                            <div class ="col-md-4">
                                  <?php  for($i=1; $i <=4; $i++ ):?>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input checkpriode" type="checkbox" id="w<?=$i?>" name="wilayah" value="w<?=$i?>" >
                                    <label class="form-check-label" for="w<?=$i?>">W<?=$i?></label>
                                    </div>
                                  <?php endfor;?>
                                </div>
                            <div id ="tanggalweek"class="col-md-6 row"></div>
                      </div> 
                      <div class="row col-md-10 mb-3">
                                <label for="saler" class="col-sm-2 col-form-label">Target</label>
                                <div class="col-sm-2">
                                  <input type="number"  class="form-control" name ="target" id="target" value="0" required>
                              </div>
                      </div>
                      <div class="row col-md-10 mb-3">
                          <label class="col-sm-2 col-form-label">Listing</label>
                          <div id="Listing" class="col-sm-4"></div>
                    </div>
                      <div class =" row col-md-10 mb-3">
                        <div class ="col-md-2">
                            <button type="button" id="get_Amount" class="btn btn-primary">Proses Transaki</button>
                        </div>
                    </div>
                      <div class="row col-md-10 mb-3">
                          <label class="col-sm-2 col-form-label">Many Listing</label>
                          <div id="manyList" class="col-sm-4"></div>
                      </div>

                     

              
                    <div class="row col-md-10 mb-3">
                                <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-2">
                                <input   type ="hidden" class="form-control" id="tahuntambah" value="" ></input>
                                <input  type ="hidden"  class="form-control" id="bulanTambah" value="" ></input>
                                <input  disabled class="form-control" name ="amount" id="amount" value="" required></input>
                                </div>
                    </div>
                
                
        

        </div>
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Createdata">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" id="clear">Clear</button>
                                  </div>
          </form>
      </div>
    </div>
  </div>
  </div>
</div>


<script>

$(document).ready(function(){
  const dateya = new Date();
    let bulandefault = dateya.getMonth()+1;
    let tahundefault = dateya.getFullYear();
    let tahun = tahundefault;
    get_data_jenis();
    get_tahun();
    get_bulan();
    $("#selectahun").val(tahun);
    let bln = bulan_angka(bulandefault);

    $("#selecbulan").val(bln);
    const getDatePickerTitle = elem => {
  // From the label or the aria-label
  const label = elem.nextElementSibling;
  let titleText = '';
  if (label && label.tagName === 'LABEL') {
    titleText = label.textContent;
  } else {
    titleText = elem.getAttribute('aria-label') || '';
  }
  return titleText;
}

const elems = document.querySelectorAll('.datepicker_input');
for (const elem of elems) {
  const datepicker = new Datepicker(elem, {
    'format': 'dd/mm/yyyy', // UK format
    title: getDatePickerTitle(elem)
  });
}     

//untuk check box ecommerc
$(document).on("click",".checkNamaToko",function(){
    $('.checkNamaToko').not(this).prop('checked', false); 
  });

//untuk check box prode
$(document).on("click",".checkpriode",function(){
    $('.checkpriode').not(this).prop('checked', false); 
  });




  $("#get_Amount").on("click",function(){
    let nama_toko = $("input[type=checkbox][name=nama_toko]:checked").val();
    let thn = $("#selectahun").find(":selected").val();
 
    let bln = $("#selecbulan").find(":selected").val();

    let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();

    if(nama_toko == undefined){
      Swal.fire({         
        position: 'top-center',
        icon: 'error',
        title:"E-commer  harus di centang ",
      });
    }else{

      TambahML(nama_toko,thn,bln,wilayah);

     
   }
  });


    //on change checkpriode
    $(document).on('change',".checkpriode",function(){
    
      let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();
      let tahun = $("#selectahun").find(":selected").val();
      let bulan = $("#selecbulan").find(":selected").val();
        
      let sub_w = wilayah.substring(2,1);
      let manylist =`
      <div class="row">
        <label class="col-md-2 col-form-label" style="text-align:justify" for="ml${sub_w}">ML${sub_w}</label>                               
      <p class="col-md-3 col-form-label" id="totalml${sub_w}"style ="color:orange; font-weight:bolder">0
      </p>
            <p class="col-md-1 form-check-label" style="text-align:justify">
              <button id="btn_ML${sub_w}"  class="btn "><i class="fa-solid fa-binoculars"></i></button>
            </p>
      </div>
      `;
      $("#manyList").empty().html(manylist);
 

      let list =`
      <div class="row">
        <label class="col-md-2 col-form-label" style="text-align:justify" for="li${sub_w}">L${sub_w}</label>                               
      <p class="col-md-1 col-form-label" id="totalLi${sub_w}"style ="color:orange; font-weight:bolder">0
      </p>
            <p class="col-md-1 form-check-label" style="text-align:justify">
              <button id="btn_Li${sub_w}"  class="btn"><i class="fa-solid fa-binoculars"></i></button>
            </p>
      </div>
      `;
      $("#Listing").empty().html(list);

     // get_dataLi(sub_w);
     get_dataMl(sub_w);
     get_LI(sub_w);
      // untuk tanggal_week

      let tgl_week =`
                      <div class="col-md-4">
                              <input type="text"  disabled class="form-control" name ="tglawal_week" id="tglawal_week">
                            </div>
                            <div class="col-md-4">
                              <input type="text" disabled class="form-control" name ="tglakhir_week" id="tglakhir_week">
                            </div>
      `;
      $("#tanggalweek").empty().html(tgl_week);
      get_tanggal_week(tahun,bulan,wilayah)
    })
    // untuk manylisting
});
//bata  document ready

//get data ML

  function myformat(date){
    let d = date.split('/')[0];
    let m = date.split('/')[1];
    let y = date.split('/')[2];
    let format = y + "-" + m + "-" + d;
   
    return format;
  }


/// jeuri mala
// simpan data 


function get_tahun(){
 
  let startyear = 2020;
  let date = new Date().getFullYear();
  
  let endyear = date + 2;
  
  for(let i = startyear; i <=endyear; i++){
    let selected = (i !== date) ? 'selected' : date; 
   $("#selectahun").append($(`<option />`).val(i).html(i).prop('selected', selected));
 
  }
 }
 
 function get_bulan(){
   let seletBulan = $("#selecbulan");
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

// UNTUK MENAMILKAN DATA jenis
function get_data_jenis(){

  $.ajax({
        url:'models/master_jenis_eo/tampildata.php',
        method:'POST',
        dataType:'json',      
        success:function(response){
              let datas_js =``;
            $.each(response,function(key,value){
              let nama_toko = value.nama_toko;
              let id_js = value.nama_toko;
              datas_js +=`
                          <div class="form-check form-check-inline col-md-5">
                                          <input class="form-check-input checkNamaToko" for ="${id_js}" type="checkbox" id="${id_js}"name="nama_toko" value="${id_js}">
                                          <label class="form-check-label" for ="${id_js}" >${nama_toko}</label>
                              </div>
                            
                  `;
              
            });
            $("#nama_toko").empty().html(datas_js);  
        
      }

      });
}
//END DATA jenis


//simpan data yang sudah di get 

$(document).on("click","#Createdata",function(e){

  e.preventDefault();
   
  let bulan = $('#bulanTambah').val();
  let tahun = $('#tahuntambah').val();

  let nama_toko = $("input[type=checkbox][name=nama_toko]:checked").val();

  let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();


  let ml ="";
  let target = $("#target").val();
  let amount = $("#amount").val();
  let li = '';
  if(wilayah == "w1"){
    li = "l1";
    ml = "ml1";
  }else if(wilayah == "w2"){
    li = "l2";
    ml ="ml2";
  }else if(wilayah == "w3"){
    li = "l3";
    ml = "ml3"
  }
  else if(wilayah == "w4"){
    li = "l4";
    ml = "ml4"
  }

    $.ajax({
      url:'models/data/tambahdata.php',
      type:'POST',
      dataType:'json',
      data :{nama_toko:nama_toko,bulan:bulan,tahun:tahun,target:target,amount:amount,
        li:li,wilayah:wilayah,ml:ml},
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
                Swal.fire({         
                          position: 'top-center',
                          icon: 'success',
                          title: pesan,
                        }).then(function(){ 
                          location.reload();
                        }); 

    

      }  
    });

});
//

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



function TambahML(nama_toko,thn,bln,wilayah){

  if(wilayah == "w1"){
    ml = "ml1";
  }else if(wilayah == "w2"){
    ml ="ml2";
  }else if(wilayah == "w3"){
    li = "l3";
    ml = "ml3"
  }
  else if(wilayah == "w4"){
    ml = "ml4";
  }

$.ajax({
    url:'models/manylist/get_dataManyList.php',
    method : 'POST',
    data : {nama_toko:nama_toko,thn:thn,bln:bln,wilayah:wilayah,ml:ml},
    dataType:'json',
    beforeSend :function(){
            
            Swal.fire({
              title: 'Loading...',
              html: 'Sedang get Amaount...',
              allowEscapeKey: false,
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading()
            }
              });
          }, 
    success:function(response){
      totalMl(nama_toko,thn,bln,ml,wilayah)
    }
})



}


function totalMl(nama_toko,tahun,bulan,ml,wilayah){
  $.ajax({
      url:'models/manylist/total_ml_week.php',
      method:'POST',
      data:{ml:ml,tahun:tahun,bulan:bulan,nama_toko:nama_toko},
      dataType:'json',
    
      success:function(result){
      let ttl_ml = result;
        if(ml == 'ml1'){

          $("#totalml1").empty().html(ttl_ml);
        }else
        if(ml == 'ml2'){
          $("#totalml2").empty().html(ttl_ml);
        }else
        if(ml == 'ml3'){
          $("#totalml3").empty().html(ttl_ml);
        }else
        if(ml == 'ml4'){
          $("#totalml4").empty().html(ttl_ml);
        }
        get_dataAmount(tahun,bulan,nama_toko,wilayah);

      }
    });
}



function get_dataAmount(thn,bln,nama_toko,wilayah){
  $.ajax({
            url : 'models/get_datatransaksi/get_data.php',
            method : 'POST',
            data :{thn:thn,bln:bln,nama_toko:nama_toko,week:wilayah},
            dataType :'json',
         
            success:function(response){
              Swal.fire({         
                position: 'top-center',
                icon: 'success',
                title: 'berhasil',
              }).then(function(){ 
              
              let thn= response.tahun;
              let bln= response.bulan;
              let amt= response.amount;

              $("#tahuntambah").val(thn);
              $("#bulanTambah").val(bln);  
              $("#amount").val(amt);
              });
            }
        })
}


//untuk tampil tanggal week 
function   get_tanggal_week(tahun,bulan,period){
    $.ajax({
          url :"models/master_bulanWeek/tampil_tanggal_week.php",
          method : 'POST',
          data :{tahun:tahun,bulan:bulan,week:period},
          dataType :'json',
          success:function(response){
              $.each(response,function(key,value){
                let tgl_awal = value.tgl_awal;
                let tgl_akhir = value.tgl_akhir;
                $("#tglawal_week").val(tgl_awal);
                $("#tglakhir_week").val(tgl_akhir);

              });
          }
        })
  }
</script>
