<?php  
include '../../models/master_jenis_eo/tampiljenis.php';
$katgeor = $datajenis->datajenis();

?>

<!-- <script type="text/javascript" src="views/edit_data_penjualan/edit_data.js"></script> -->
<button onclick="goBack()" type="button" class="btn btn-lg mb-4"><i class="fa-solid fa-chevron-left"></i></button>
    <h5> EDIT DATA</h5>
    <div class="card-content">
      <div class="card-body">
      <form  id ="formedit" class ="form form-horizontal">
      <div class="row col-md-12-col-12">

<div class="row col-md-10 mb-3">
          <label for="nama_toko" class="col-sm-2 col-form-label">E-Commerce</label>
          <div class="col-sm-6">
                                <?php  foreach($katgeor as $file):  
                                  $id_ktg = str_replace(".","",$file);
                               ?>
  
                               <div class="form-check form-check-inline col-md-5">
                                          <input disabled class="form-check-input checkNamaToko" for ="<?=$file[0]?>" type="checkbox" id="<?=$id_ktg[0]?>_edit"name="nama_toko" value="<?=$file[0]?>">
                                          <label class="form-check-label" for ="<?=$id_ktg[0]?>"><?=$file[0]?></label>
                              </div>
                                <?php endforeach;?>  
          </div>
</div>
<div class="row col-md-10 mb-3">  
          <label for="selectahun_edit" class="col-sm-2 col-form-label">Tahun</label>
          <div class="col-sm-2">
            <select disabled  class ="form-control" id="selectahun_edit"></select>                             
        </div>
</div>  
<div class="row col-md-10 mb-3">  
          <label for="selecbulan" class="col-sm-2 col-form-label">Bulan</label>
          <div class="col-sm-2">
            <select disabled class ="form-control" id="selecbulan"></select>                                
          </div>
  </div>
    <div class="row col-md-10 mb-3">
        <label class="col-sm-2 col-form-label">Period</label>
             <div class ="col-md-4">
                <?php  for($i=1; $i <=4; $i++ ):?>
                  <div class="form-check form-check-inline">
                  <input disabled class="form-check-input checkpriode" type="checkbox" id="w<?=$i?>_edit" name="wilayah" value="w<?=$i?>" >
                  <label class="form-check-label" for="w<?=$i?>">W<?=$i?></label>
                  </div>
                <?php endfor;?>
              </div>
        
          <div class="col-md-6 row">
            <div class="col-md-4">
              <input type="text"  disabled class="form-control" name ="tglawal_week" id="tglawal_week">
            </div>
            <div class="col-md-4">
              <input type="text" disabled class="form-control" name ="tglakhir_week" id="tglakhir_week">
            </div>
        </div>
      </div>
</div> 
<div class="row col-md-10 mb-3">
          <label for="saler" class="col-sm-2 col-form-label">Target</label>
          <div class="col-sm-2">
            <input type="number"  class="form-control" name ="target_edit" id="target_edit" value="0" required>
        </div>
</div>

<div class="row col-md-10 mb-3">
    <label class="col-sm-2 col-form-label">Listing</label>
    <div id="Listing_edit" class="col-sm-4"></div>
</div>
<div class =" row col-md-10 mb-3">
  <div class ="col-md-2">
      <button type="button" id="get_Amount" class="btn btn-primary">Proses Transaksi</button>
  </div>
</div>
<div class="row col-md-10 mb-3">
    <label class="col-sm-2 col-form-label">Many Listing</label>
    <div id="manyList_edit" class="col-sm-4"></div>
</div>

<div class="row col-md-10 mb-3">
          <label for="amount" class="col-sm-2 col-form-label">Amount</label>
          <div class="col-sm-2">
          <input   type ="hidden" class="form-control" id="tahunEdit" value="" ></input>
          <input  type ="hidden"  class="form-control" id="bulanEdit" value="" ></input>
          <input  disabled class="form-control" name ="amount_edit" id="amount_edit" value="" required></input>
          </div>
</div>




</div>
    
                            </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" id="Updatedata">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" onclick="goBack()" >Batal</button>
                                  </div>
          </form>
      </div>
    </div>

<script>
$(document).ready(function(){
  //untuk check box ecommerc
$(document).on("click",".checkNamaToko",function(){
    $('.checkNamaToko').not(this).prop('checked', false); 
  });

 //untuk check box prode
$(document).on("click",".checkpriode",function(){
    $('.checkpriode').not(this).prop('checked', false); 
  }); 
  

  let nama  ="<?=$_POST['nama']?>";

  let period  ="<?=$_POST['period']?>";
  let bulan  ="<?=$_POST['bulan']?>";
  let tahun  ="<?=$_POST['tahun']?>";
  let target  ="<?=((float)$_POST['target']/4) ?>";
  let ttl_ml  ="<?=$_POST['ttl_ml']?>";
  let li  ="<?=$_POST['li']?>";
  let amount = "<?=$_POST['amount'] ?>";

  let sub_name = nama.replace(".","");
  let id_toko = "#"+sub_name+"_edit";

  let id_period = "#"+period+"_edit";
  $(id_toko).prop("checked",true);
  $(id_period).prop("checked",true);

  get_tanggal_week(tahun,bulan,period);
  get_dataAmonut(nama,bulan,tahun,period);

  let wilayah = period;
  let sub_w = wilayah.substring(2,1);
    get_tahun();
    get_bulan();
    $("#selectahun_edit").val(tahun);
    $("#selecbulan").val(bulan);

if ($(id_period).is(":checked"))
{
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
      $("#manyList_edit").empty().html(manylist);
 

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
      $("#Listing_edit").empty().html(list);

      get_dataMl_edit(sub_w);
       get_LI_edit(sub_w);
      
    }

    // untuk manylisting
    //untuk tampil total manylisting
    let id_ttlml = "#totalml"+sub_w;
      $(id_ttlml).empty().html(ttl_ml);

  $("#target_edit").val(target);
  $("#tahunEdit").val(tahun);
  $("#bulanEdit").val(bulan);




  //untuk edit get amount
    $("#get_Amount").on("click",function(){
      let nama_toko = $("input[type=checkbox][name=nama_toko]:checked").val();
      let thn = $("#selectahun_edit").find(":selected").val();
      let bln = $("#selecbulan").find(":selected").val();
      let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();
   
      if(nama_toko == undefined){
        Swal.fire({         
          position: 'top-center',
          icon: 'error',
          title:"E-commer  harus di centang ",
        });
      }else{
        UpdateML(nama_toko,thn,bln,wilayah);
        
    }
    });

//batas document ready
});
  function goBack(){
  $("#header_data").show();
  $("#data_tabelfull").show();
  $("#filtetahun").show();
  $("#kategory").show();
  $("#edit_data").hide();
  //$("#selectahun").empty();
	//get_tahun();
  let tahunx  ="<?=$_POST['tahun']?>";
	//getbulan(tahun);
    //ktg_tfml(tahun)
  $("#selectahun").val(tahunx)
}


function get_tahun(){
 
 let startyear = 2020;
 let date = new Date().getFullYear();
 
 let endyear = date + 2;
 
 for(let i = startyear; i <=endyear; i++){
   let selected = (i !== date) ? 'selected' : date; 
  $("#selectahun_edit").append($(`<option />`).val(i).html(i).prop('selected', selected));

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
 
function UpadteEmount(thn,bln,nama_toko,wilayah){
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

                $("#tahunEdit").val(thn);
                $("#bulanEdit").val(bln);  
                $("#amount_edit").val(amt);
                });
              }
          })
}

 function UpdateML(nama_toko,thn,bln,wilayah){
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
      UpadteEmount(tahun,bulan,nama_toko,wilayah);
    }
    
  });
}

//simpan data yang sudah di get 

$(document).on("click","#Updatedata",function(e){
        e.preventDefault();
      
        let bulan = $('#bulanEdit').val();
        let tahun = $('#tahunEdit').val();

        let nama_toko = $("input[type=checkbox][name=nama_toko]:checked").val();

        let wilayah = $("input[type=checkbox][name=wilayah]:checked").val();


        let ml ="";
        let target = $("#target_edit").val();
        let amount = $("#amount_edit").val();
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
						//goBack();
                        //location.reload();
						let halaman_sebelum ="https://27.123.222.151:886/Penjualan_DGM/public/index.php";
						let thnfilter ="?tahunfilter=";
						
						 let urldata = halaman_sebelum+thnfilter+tahun;
 
							window.location.replace(urldata)
                      }); 

  

    }  
  });

});

//untuk get emount
  function get_dataAmonut(nama,bulan,tahun,period){
      $.ajax({
        url :"models/data/get_amountedit.php",
        method : 'POST',
        data :{tahun:tahun,bulan:bulan,nama_toko:nama,week:period},
        dataType :'json',
        success:function(response){
          $("#amount_edit").val(response);

        }
      })
  }
//

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


