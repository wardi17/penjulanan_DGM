<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" />


<div id="">
<?php include 'views/pages/burger.php' ?>
<?php include 'views/tampil_manylist/tampil_listing.php' ?>
<?php include 'views/tampil_manylist/tampil_manylisting.php' ?>
<?php include 'views/tampil_manylist/tampil_finalmanylisting.php' ?>
<?php include 'views/tampil_manylist/tampil_tahunfinallisting.php' ?>
<?php include 'views/barang_rizek/tampil_rizek.php' ?>
<?php 
include 'views/edit_data_penjualan/many_listing_edit.php';
include 'views/edit_data_penjualan/listing_edit.php';

$tahunfilter = (isset($_GET["tahunfilter"]))? $_GET["tahunfilter"] : '';
?>
<!-- <script type="text/javascript" src="views/laporan_penjualan/lpr_penjualan.js"></script> -->

<!-- <div>
            <button id="sidebarToggle">Toggle Menu</button>
</div> -->
<div class="container-fluid">
<div class ="col-md-12 col-12">

   <input type="hidden" id="tahuncomp" class="form-control" value="<?=$tahunfilter?>">

    <div id="header_data"></div>
	 <div class="col-md-12 row">
      <div id="filtetahun" class="col-md-6 text-start" >
        <div class ="col-md-2">
        <select class ="form-control" id="selectahun">
        </select>
        </div>
        
         
        </div>
     
      <!-- <div class="mb-2">
        <button id="deleteall" class="btn btn-danger">delete all</button>
      </div> -->
    </div>
      <br>
	  
    <div id ="data_tabelfull"></div>
    
      
		<div class="text-end mt-0">
				<p id="kategory"><p>
			
		</div>
    
  <div id="edit_data"></div>
</div>


</div>

<script>


  
  function getjenis(){
	
    $.ajax({
          url:'models/master_jenis_eo/tampildata.php',
          method:'POST',
          dataType:'json',      
          success:function(response){
			
                let datas_js =``;
                datas_js +=`
                <label id="labeltfml" style="pointer-events: none !important;" class=" btn text-center">TFML : </label>
                `;
                let katg =[];
                let  kat =[];
              $.each(response,function(key,value){
                let nama_toko = value.nama_toko;
                let id_toko = nama_toko.replace(".","");
                let sub_str = nama_toko.substring(0,1);
                datas_js +=`
                <button  id="${id_toko}"class="btn text-center " value="${nama_toko}">${sub_str}.<a id="${id_toko}_total"></a></button>
                    `;
              katg += id_toko + ",";
           
              });
              datas_js += `<button id="All" class="btn  text-center" value="All">A.<a id="ALL_total"></a></button>`
              datas_js += ` <button id="barang_rizek" class="btn  text-center" value="brg_rizek">BTL.<a id="RIZEK_total"></a></button>`
              $("#kategory").empty().html(datas_js);

			  
              // let str_ktg =
              //  katg.slice(0,-1);
              katg += "All";
              katg += ",barang_rizek";
          
             Clikkageogry(katg);
        }

        });
    }

  function Clikkageogry(nama_toko){
   
    const myarray = nama_toko.split(",");
    
      for(let kode of myarray){
          let id ="#"+kode;
        if(kode !== "barang_rizek"){
          $(id).on("click",function(e){
              e.preventDefault();
                $("#FullMLTahunModal").modal('show');
              let data = $(id).val();
              datatfml(data);
            });
        }else{
          $(id).on("click",function(e){
              e.preventDefault();
              $("#BarangRizekModal").modal('show');
                data_barangRizek();
            });
        }
        $(id).css('font-size', '14px');
      
      }
      
      $("#labeltfml").css('font-size', '14px');
    }

    function tabelfullml(data){
      let tltfml =`
              <h5 class="modal-title" id="modal_1Label">TFML ${data}</h5>`;
              $("#titletfml").empty().html(tltfml);
              let headmlful =`  <table id="datatfml" class='display table-info' style='width:100%'>                    
                      <thead  id='thead'class ='thead'>
                        <tr>
                                <th style='width:20%'>Kode Barang</th>
                                  <th>Nama Barang</th>
                                  <th>Qty</th>
                        </tr>
                      </thead>
                    </table>`;
              $("#tabel_tfml").empty().html(headmlful);
    }

    function datatfml(data){
      tabelfullml(data);
        $.ajax({
            url :'models/manylist/total_tfml.php',
            method: 'POST',
            data:{data:data},
            dataType:'json',
            success: function(result){ 
              $("#datatfml").DataTable({
                  destroy :true,
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
                          {'data':'qty', className: "text-end", },

                      ]
                })
            }
          });
          $("#datatfml").css('font-size', '14px');
    }

    function data_barangRizek(){
      $.ajax({
      url :'models/master_listing/barang_tidaklaku.php',
      method: 'POST',
      dataType:'json',
      success: function(result){ 
         let rizek =`
         <h5 class="modal-title" id="modal_1Label">Barang Tidak Laku</h5>`;
         $("#titlerizek").empty().html(rizek);
        let headrizek =`  <table id="dataRizek" class='display table-info' style='width:100%'>                    
                <thead  id='thead'class ='thead'>
                  <tr>
                          <th style='width:20%'>Kode Barang</th>
                            <th>Nama Barang</th>
                  </tr>
                </thead>
              </table>`;
        $("#tabel_Rizek").empty().html(headrizek);
        $("#dataRizek").DataTable({
            destroy :true,
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

                ]
          })
       }
       
    })
    $("#dataRizek").css('font-size', '14px');
  }




</script>

<script>
  $(document).ready(function(){
	  
	let tahunComp = $("#tahuncomp").val();
	
	 if(tahunComp !==""){
		 getbulan(tahunComp);
		 ktg_tfml(tahunComp);
		 get_tahun();
		 $("#selectahun").val(tahunComp); 
	 }else{
		
	 const dateya = new Date();
		let bulandefault = dateya.getMonth()+1;
		let tahundefault = dateya.getFullYear();
		let tahun = tahundefault;
		getbulan(tahun);
		ktg_tfml(tahun)
		get_tahun();
		 
		$("#selectahun").val(tahun); 		
	 }

	
	$("#selectahun").change(function(){

		let tahun = $(this).val();
		getbulan(tahun);
	});
});

function getbulan(tahun){


  $.ajax({
        url:'models/laporan_penjualan/get_bulanjs.php',
        method:'POST',
        data:{tahun:tahun},
        dataType:'json',      
        success:function(result){
			get_header(tahun);
			
			            let dataTable =``;
             let dataid ="";
            $.each(result,function(key,value){
            let bln_angka =value.bulan_angka;
              dataid +=bln_angka+",";
              

            });
            let str = dataid.slice(0, -1);
             let split = str.split(",");
             var uniqueArray = $.grep(split, function(element, index) {
                return index === $.inArray(element, split);
              });
            
              $.each(uniqueArray,function(a,b){
                let bulan_trakhir = 0;
                if(a === uniqueArray.length - 1){
                   bulan_trakhir = b;
                }
                 let tb_name ="tabel"+b;
                  let bulan  = getBulan(b);
                  let substr_bulan = bulan.substr(0,3);
                 dataTable +=`
                          <table id="${tb_name}" class='display table-info' style='width:100%'>                    
                                        <thead  id='thead'class ='thead'>
                                          <tr>
                                          <th>${substr_bulan} ${tahun}</th>
                                                    <th>IL</th>
                                                    <th>Week 1</th>
                                                    <th>L1</th>
                                                    <th>ML1</th>
                                                    <th>Week 2</th>
                                                    <th>L2</th>
                                                    <th>ML2</th>
                                                    <th>Week 3</th>
                                                    <th>L3</th>
                                                    <th>ML3</th>
                                                    <th>Week 4</th>
                                                    <th>L4</th>
                                                    <th>ML4</th>
                                                    <th>Total</th>
                                                    <th>Target</th>
                                                    <th>Ach %</th>
                                                    <th>Growth</th>
                                                    <th>FL</th> 
                                                    <th>FML</th>    
                                          </tr>
                                        </thead>
                                        </table> <br/>`;
                          showdata1(tb_name,bulan,tahun,bulan_trakhir);
              });

              $("#data_tabelfull").empty().html(dataTable);
			  getjenis();
              ktg_tfml(tahun);
			
         
        
        }
             
      });
}

function get_header(tahun){
    let data_headr =`
    <br><br>
    <div  class="text-center"><h4>Penjualan E-Commerce DGM BMI ${tahun}</h4></div><br>
    <div id="tabeldata"></div>
    `;
    $("#header_data").html(data_headr);

  }
function getBulan(bln_angka){
  
    let bln ="";
    if(bln_angka =="1"){
       bln ="January";
    }else if(bln_angka =="2"){
      bln ="February";
    }else if(bln_angka =="3"){
      bln ="March";
    }else if(bln_angka =="4"){
      bln ="April";
    }else if(bln_angka =="5"){
      bln ="May";
    }else if(bln_angka =="6"){
      bln ="June";
    }else if(bln_angka =="7"){
      bln ="July";
    }else if(bln_angka =="8"){
      bln ="August";
    }else if(bln_angka =="9"){
      bln ="September";
    }else if(bln_angka =="10"){
      bln ="October";
    }else if(bln_angka =="11"){
      bln ="November";
    }else if(bln_angka =="12"){
      bln ="December";
    }

    return bln;
}



  function get_tables(bulan,tahun,tabel){
    let id ="#"+tabel;
  
    let substr_bulan = bulan.substr(0,3);
    let dataTable =`
    <table id="${bulan}" class='display table-info' style='width:100%'>                    
                  <thead  id='thead'class ='thead'>
                    <tr>
                              <th>${substr_bulan}</th>
                              <th>IL</th>
                              <th>Week 1</th>
                              <th>L1</th>
                              <th>ML1</th>
                              <th>Week 2</th>
                              <th>L2</th>
                              <th>ML2</th>
                              <th>Week 3</th>
                              <th>L3</th>
                              <th>ML3</th>
                              <th>Week 4</th>
                              <th>L4</th>
                              <th>ML4</th>
                              <th>Total</th>
                              <th>Target</th>
                              <th>Ach %</th>
                              <th>Growth</th>
                              <th>FL</th> 
                              <th>FML</th>    
                    </tr>
                  </thead>
                </table>
  
     
    `;
  
    $(id).empty().html(dataTable);
  };
  

  function showdata1(tb_name,bulan,tahun,bulan_trakhir){

    let id ="#"+tb_name;
    //$(id).DataTable().destroy();
      $.ajax({
      url: 'models/laporan_penjualan/tampildata.php',
      method :'POST',
      data:{'page':bulan,'tahun':tahun,'bulan_trakhir':bulan_trakhir},
        cache:true,
        dataType:'json',
          success: function(response){
			  
			  
              $(id).DataTable({
                rowReorder: {
                  selector: 'td:nth-child(2)'
              },
              responsive: true,
                "ordering": false,
                 "destroy":true,
                  dom: 'Plfrtip',
                    scrollCollapse: true,
                    paging:false,
                    "bPaginate":false,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false,
                    dom: 'lrt',
                    fixedColumns:   {
                       // left: 1,
                        right: 1
                    },
                    style_cell:{'fontSize':5, 'font-family':'sans-serif'},
                    "order":[[0,'desc']],
                    data: response,
                    'rowCallback': function(row, data, index){
						  let total = data.total;
						const nama_toko = data.nama_toko;
						let weekmaxt = data.weekmaxt;
					    let maxtotal = data.totalmaxt;
						
						  if(data.nama_toko =="TOKOPEDIA"){
							  if(total == maxtotal){
								$(row).find('td:eq(14)').css("background-color","#3cb371");
						        $(row).find('td:eq(14)').css('color', 'white');
							  }
						   }else if(data.nama_toko =="SHOPEE"){
							     if(total == maxtotal){
								$(row).find('td:eq(14)').css("background-color","#F94C10");
											  $(row).find('td:eq(14)').css('color', 'white');
							  }
						   }else if(data.nama_toko =="LAZADA"){
							 if(total == maxtotal){
								$(row).find('td:eq(14)').css("background-color","#4D2DB7");
											  $(row).find('td:eq(14)').css('color', 'white');
							  }
						   }
						// untuk waran perminggun
					
						  if(nama_toko =="TOKOPEDIA"){
							let week1 = data.w1;
							let maxweek1 = data.maxweek1;
								if(week1 == maxweek1){
										$(row).find('td:eq(2)').css("background-color","#3cb371");
										$(row).find('td:eq(2)').css('color', 'white');
										
								
								 if(week1 == weekmaxt){
									$(row).find('td:eq(2)').css("background-color","#74E291");
									 $(row).find('td:eq(2)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(2)').css("background-color","");	
								}
							 let week2 = data.w2;
							 let maxweek2 = data.maxweek2
							
							  if(week2 == maxweek2){
										$(row).find('td:eq(5)').css("background-color","#3cb371");
										$(row).find('td:eq(5)').css('color', 'white');
								  if(week2 == weekmaxt){
									$(row).find('td:eq(5)').css("background-color","#74E291");
									 $(row).find('td:eq(5)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(5)').css("background-color","");	
								}
							 let week3 = data.w3;
							 let maxweek3 = data.maxweek3;
							
							  if(week3 == maxweek3){
										$(row).find('td:eq(8)').css("background-color","#3cb371");
										$(row).find('td:eq(8)').css('color', 'white');
								if(week3 == weekmaxt){
									$(row).find('td:eq(8)').css("background-color","#74E291");
									 $(row).find('td:eq(8)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(8)').css("background-color","");	
								}
								
							 let week4 = data.w4;
							 let maxweek4 = data.maxweek4;
							
							  if(week4 == maxweek4){
										$(row).find('td:eq(11)').css("background-color","#3cb371");
										$(row).find('td:eq(11)').css('color', 'white');
								 if(week4 == weekmaxt){
									$(row).find('td:eq(11)').css("background-color","#D4D925");
									 $(row).find('td:eq(11)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(11)').css("background-color","");	
								}
								
						  }else if(nama_toko == "SHOPEE"){
							let week1 = data.w1;
							let maxweek1 = data.maxweek1;
								if(week1 == maxweek1){
										$(row).find('td:eq(2)').css("background-color","#F94C10");
										$(row).find('td:eq(2)').css('color', 'white');
								 if(week1 == weekmaxt){
									$(row).find('td:eq(2)').css("background-color","#F1C93B");
									 $(row).find('td:eq(2)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(2)').css("background-color","");	
								}
							 let week2 = data.w2;
							 let maxweek2 = data.maxweek2
							
							  if(week2 == maxweek2){
										$(row).find('td:eq(5)').css("background-color","#F94C10");
										$(row).find('td:eq(5)').css('color', 'white');
								if(week2 == weekmaxt){
									$(row).find('td:eq(5)').css("background-color","#F1C93B");
									 $(row).find('td:eq(5)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(5)').css("background-color","");	
								}
							 let week3 = data.w3;
							 let maxweek3 = data.maxweek3;
							
							  if(week3 == maxweek3){
										$(row).find('td:eq(8)').css("background-color","#F94C10");
										$(row).find('td:eq(8)').css('color', 'white');
								 if(week3 == weekmaxt){
									$(row).find('td:eq(8)').css("background-color","#F1C93B");
									 $(row).find('td:eq(8)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(8)').css("background-color","");	
								}
								
							 let week4 = data.w4;
							 let maxweek4 = data.maxweek4;
							
							  if(week4 == maxweek4){
										$(row).find('td:eq(11)').css("background-color","#F94C10");
										$(row).find('td:eq(11)').css('color', 'white');
								if(week4 == weekmaxt){
									$(row).find('td:eq(11)').css("background-color","#F1C93B");
									 $(row).find('td:eq(11)').css('color', 'white');
								  }
								}else{
										$(row).find('td:eq(11)').css("background-color","");	
								}
								
						}else if(nama_toko == "LAZADA"){
							let week1 = data.w1;
							let maxweek1 = data.maxweek1;
								if(week1 == maxweek1){
										$(row).find('td:eq(2)').css("background-color","#4D2DB7");
										$(row).find('td:eq(2)').css('color', 'white');
									 if(week1 == weekmaxt){
										$(row).find('td:eq(2)').css("background-color","#78C1F3");
										 $(row).find('td:eq(2)').css('color', 'white');
									  }
								}else{
										$(row).find('td:eq(2)').css("background-color","");	
								}
							 let week2 = data.w2;
							 let maxweek2 = data.maxweek2
							
							  if(week2 == maxweek2){
										$(row).find('td:eq(5)').css("background-color","#4D2DB7");
										$(row).find('td:eq(5)').css('color', 'white');
										 if(week2 == weekmaxt){
											$(row).find('td:eq(5)').css("background-color","#78C1F3");
											$(row).find('td:eq(5)').css('color', 'white');
										}
								}else{
										$(row).find('td:eq(5)').css("background-color","");	
								}
							 let week3 = data.w3;
							 let maxweek3 = data.maxweek3;
							
							  if(week3 == maxweek3){
										$(row).find('td:eq(8)').css("background-color","#4D2DB7");
										$(row).find('td:eq(8)').css('color', 'white');
										if(week3 == weekmaxt){
											$(row).find('td:eq(8)').css("background-color","#78C1F3");
											$(row).find('td:eq(8)').css('color', 'white');
										}
								}else{
										$(row).find('td:eq(8)').css("background-color","");	
								}
								
							 let week4 = data.w4;
							 let maxweek4 = data.maxweek4;
							
							  if(week4 == maxweek4){
										$(row).find('td:eq(11)').css("background-color","#4D2DB7");
										$(row).find('td:eq(11)').css('color', 'white');
									    if(week4 == weekmaxt){
											$(row).find('td:eq(11)').css("background-color","#78C1F3");
											$(row).find('td:eq(11)').css('color', 'white');
										}
								}else{
										$(row).find('td:eq(11)').css("background-color","");	
								}
								
						}else if(nama_toko == "TOTAL"){
              $(row).find('td:eq(0)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(1)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(2)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(3)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(4)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(5)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(6)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(7)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(8)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(9)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(10)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(11)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(12)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(13)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(14)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(15)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(16)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(17)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(18)').css("background-color","#F6FB7A");
                          $(row).find('td:eq(19)').css("background-color","#F6FB7A");

						              $(row).find('td:eq(0)').css('color', 'black');
                          $(row).find('td:eq(1)').css('color', 'black');
                          $(row).find('td:eq(2)').css('color', 'black');
                          $(row).find('td:eq(3)').css('color', 'black');
                          $(row).find('td:eq(4)').css('color', 'black');
                          $(row).find('td:eq(5)').css('color', 'black');
                          $(row).find('td:eq(6)').css('color', 'black');
                          $(row).find('td:eq(7)').css('color', 'black');
                          $(row).find('td:eq(8)').css('color', 'black');
                          $(row).find('td:eq(9)').css('color', 'black');
                          $(row).find('td:eq(10)').css('color', 'black');
                          $(row).find('td:eq(11)').css('color', 'black');
                          $(row).find('td:eq(12)').css('color', 'black');
                          $(row).find('td:eq(13)').css('color', 'black');
                          $(row).find('td:eq(14)').css('color', 'black');
                          $(row).find('td:eq(15)').css('color', 'black');
                          $(row).find('td:eq(16)').css('color', 'black');
                          $(row).find('td:eq(17)').css('color', 'black');
                          $(row).find('td:eq(18)').css('color', 'black');
                          $(row).find('td:eq(19)').css('color', 'black');

                      let subtotal =data.total;
                     let subtotalmax = data.subtotalmax;
                   
                     if(subtotal == subtotalmax){
                         $(row).find('td:eq(14)').css("background-color","#A91D3A");
                         $(row).find('td:eq(14)').css('color', 'white');
                       }else{
                        $(row).find('td:eq(14)').css("background-color","#F6FB7A");
                        $(row).find('td:eq(14)').css('color', 'black');
                       }
            }
                     
                      var temp=data.growth;
                          
                            if(temp < 0){
                                $(row).find('td:eq(17)').css('color', 'red');
                            }else{
                              $(row).find('td:eq(17)').css('color', 'black');
  
                            }
                          
                          },
                          columns: [
                       
                              { 'data': 'nama_toko' },
                            
                              {
                                 data: 'l0', className: "text-end", render: $.fn.dataTable.render.number(',', '.', 0, '')
                              },
                               {
                                 data: 'w1',  
                                 className:"text-end",
                                 "render":function(data,type,row){
                                  let nama = row.nama_toko;
                                  let bulan = row.bulan;
                                  let tahun = row.tahun;
                                  let period = 'w1';
                                  let targer = row.target;
                                  let amount = row.w1;
                                  // console.log(row.w1);
                                  let list  = 'l1';
                                  let ml1 = row.ml1;
                                  let l1  = row.l1;
                                  let ml = 'ml1';
                                  let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {
                                            if(type === 'display'){
                                                        html = `<span type="button" style="cursor:pointer" class="editdata" 
                                                        data-li ="${l1}" data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-period="${period}"
                                                        data-target="${targer}" data-amount="${amount}" data-list="${list}" data-ml ="${ml}" data-ml1="${ml1}"
                                                      >${data}</span>`;
                                                       }
                                            }
                                                    return html
                                    },
                                 },
                                
  
                               {
                                 data: 'l1', className: "text-end", 
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let li = 'l1';
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {  
                                      if(type === 'display'){
                                                      html = `<span type="button" style="cursor:pointer" class="ListingData" 
                                                      data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-li="${li}" 
                                                      data-bs-toggle="modal" data-bs-target="#ListingDataModal">${data}</span>`;
                                                          }
                                                  }
                                                    return html
                                  },
                              },
                              {
                                 data: 'ml1', className: "text-end",
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let ml = 'ml1';
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {  
                                          if(type === 'display'){
                                                html = `<span type="button" style="cursor:pointer" class="WeekData_ml" 
                                                data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-ml="${ml}" 
                                                data-bs-toggle="modal" data-bs-target="#MLDataMlModal">${data}</span>`;
                                                    }
                                          }
                                    return html
                                  },
                              },
                               {
                                 data: 'w2', className: "text-end",
                                 "render":function(data,type,row){
                                  let nama = row.nama_toko;
                                  let bulan = row.bulan;
                                  let tahun = row.tahun;
                                  let period = 'w2';
                                  let targer = row.target;
                                  let amount = data;
                                  let list  = 'l2';
                                  let ml = 'ml2';
                                  let ml2 = row.ml2;
                                  let l2 = row.l2;
                                  let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {
                                          if(type === 'display'){
                                                          html = `<span type="button" style="cursor:pointer" class="editdata" 
                                                          data-li ="${l2}"  data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-period="${period}"
                                                          data-target="${targer}" data-amount="${amount}" data-list="${list}" data-ml ="${ml}" data-ml2 ="${ml2}"
                                                        >${data}</span>`;
                                                              }
                                        }
                                                              return html
                                      },
                               },
                                {
                                 data: 'l2', className: "text-end", 
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let li = 'l2';
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {  
                                          if(type === 'display'){
                                                html = `<span type="button" style="cursor:pointer" class="ListingData" 
                                                data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-li="${li}" 
                                                data-bs-toggle="modal" data-bs-target="#ListingDataModal">${data}</span>`;
                                                    }
                                      }
                                                    return html
                                  },
  
                                },
                                {
                                 data: 'ml2', className: "text-end",
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let ml = 'ml2'; 
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else { 
                                          if(type === 'display'){
                                                          html = `<span type="button" style="cursor:pointer" class="WeekData_ml" 
                                                          data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-ml="${ml}" 
                                                          data-bs-toggle="modal" data-bs-target="#MLDataMlModal">${data}</span>`;
                                                              }
                                        }
                                                    return html
                                  },
                              },
                                 {
                                 data: 'w3', className: "text-end", 
                                 "render":function(data,type,row){
                                  let nama = row.nama_toko;
                                  let bulan = row.bulan;
                                  let tahun = row.tahun;
                                  let period = 'w3';
                                  let targer = row.target;
                                  let amount = data;
                                  let list  = 'l3';
                                  let ml = 'ml3';
                                  let ml3 = row.ml3;
                                  let l3 = row.l3;
                                  let html=``;
                                  let cari ='_tot';
                                  let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {
                                        if(type === 'display'){
                                                  html = `<span type="button" style="cursor:pointer" class="editdata" 
                                                  data-li ="${l3}" data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-period="${period}"
                                                  data-target="${targer}" data-amount="${amount}" data-list="${list}" data-ml ="${ml}" data-ml3 ="${ml3}"
                                                 >${data}</span>`;
                                                      }
                                          }
                                                      return html
                                                  },
                               },
                                {
                                 data: 'l3', className: "text-end", 
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let li = 'l3';
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {  
                                          if(type === 'display'){
                                                html = `<span type="button" style="cursor:pointer" class="ListingData" 
                                                data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-li="${li}" 
                                                data-bs-toggle="modal" data-bs-target="#ListingDataModal">${data}</span>`;
                                                    }
                                        }
                                                    return html
                                  },
                                },
                                
                                {
                                 data: 'ml3', className: "text-end",
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let ml = 'ml3';
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {  
                                        if(type === 'display'){
                                                        html = `<span type="button" style="cursor:pointer" class="WeekData_ml" 
                                                        data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-ml="${ml}" 
                                                        data-bs-toggle="modal" data-bs-target="#MLDataMlModal">${data}</span>`;
                                                            }
                                      }
                                                    return html
                                  },
                              },
                                 {
                                 data: 'w4', className: "text-end",
                                 "render":function(data,type,row){
                                  let nama = row.nama_toko;
                                  let bulan = row.bulan;
                                  let tahun = row.tahun;
                                  let period = 'w4';
                                  let targer = row.target;
                                  let amount = data;
                                  let list  = 'l4';
                                  let ml ='ml4';
                                  let ml4 = row.ml4;
                                  let l4 = row.l4;
                                  let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {
                                          if(type === 'display'){
                                                  html = `<span type="button" style="cursor:pointer" class="editdata" 
                                                  data-li ="${l4}" data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-period="${period}"
                                                  data-target="${targer}" data-amount="${amount}" data-list="${list}" data-ml ="${ml}" data-ml4="${ml4}"
                                                 >${data}</span>`;
                                                      }
                                      }
                                                      return html
                                                    
                                                  },
                               },
                                {
                                 data: 'l4', className: "text-end", 
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let li = 'l4'; 
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else { 
                                      if(type === 'display'){
                                                      html = `<span type="button" style="cursor:pointer" class="ListingData" 
                                                      data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-li="${li}" 
                                                      data-bs-toggle="modal" data-bs-target="#ListingDataModal">${data}</span>`;
                                                          }
                                                  }
                                                    return html
                                  },
                                },
                                {
                                 data: 'ml4', className: "text-end",
                                 "render": function(data,type,row){
                                let nama = row.nama_toko;
                                let bulan = row.bulan;
                                let tahun = row.tahun;
                                let ml = 'ml4'; 
                                let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else { 
                                        if(type === 'display'){
                                                        html = `<span type="button" style="cursor:pointer" class="WeekData_ml" 
                                                        data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" data-ml="${ml}" 
                                                        data-bs-toggle="modal" data-bs-target="#MLDataMlModal">${data}</span>`;
                                                            }
                                          }
                                                    return html
                                  },
                                },
                                 {
                                 data: 'total', className: "text-end"                              },
                               {
                                 data: 'target', className: "text-end",render: $.fn.dataTable.render.number(',', '.', 0, ''),
                                 
                               },
                               {
                                 data: 'ach', className: "text-end", render: $.fn.dataTable.render.number(',', '.', 2, '')
                               },
                               {
                                 data: 'growth', className: "text-end", render: $.fn.dataTable.render.number(',', '.', 2, '')
  
                               },
                                {
                                 data: 'lt', className: "text-end", render: $.fn.dataTable.render.number(',', '.', 0, '')
                                },
                                {
                                 data: 'fml', className: "text-end",
                                 "render": function(data,type,row){
                                  let nama = row.nama_toko;
                                  let bulan = row.bulan;
                                  let tahun = row.tahun;
                                  let html=``;
                                let cari ='_tot';
                                let index = data.indexOf(cari);
                                      if (index !== -1) {
                                        let newText = data.replace(cari, ''); 
                                          html =`<span>${newText}</span>`;
                                      } else {
                                    
                                          if(type === 'display'){
                                                  html = `<span type="button" style="cursor:pointer" class="fullData_ml" 
                                                  data-nama="${nama}" data-bulan="${bulan}" data-tahun="${tahun}" 
                                                  data-bs-toggle="modal" data-bs-target="#FullDataMlModal">${data}</span>`;
                                                      }
                                        }
                                                      return html
                                    },
                                  
                                }
  
                          ]      
             
             });
            
          
                
      }
  
      });
    
      //$(id).css('font-size', '14px');
  }


  var $sidebarAndWrapper = $("#sidebar,#wrapper");

//edit data 
$(document).on("click",".editdata",function(){
  let nama = $(this).data('nama');
  let bulan = $(this).data('bulan');
  let tahun = $(this).data('tahun');
  let target = $(this).data('target');
  let ml = $(this).data('ml');
  
  let ttl_ml = '';
  if(ml == 'ml1'){
    ttl_ml = $(this).data('ml1');
  }else if(ml == 'ml2'){
    ttl_ml = $(this).data('ml2');
  }else if(ml == 'ml3'){
    ttl_ml = $(this).data('ml3');
  }else if(ml == 'ml4'){
    ttl_ml = $(this).data('ml4');
  }


  let list = $(this).data('list');

  let  li = '';
  if(list == 'l1'){
    li = $(this).data('li');
  }else if(list == 'l2'){
    li = $(this).data('li');
  }else if(list == 'l3'){
    li = $(this).data('li');
  }else if(list == 'l4'){
    li = $(this).data('li');
  }
   let amount = $(this).data('amount')
  let period = $(this).data('period');

  $("#edit_data").show();
  $("#data_tabelfull").hide();
  $("#header_data").hide();
  $("#filtetahun").hide();
  $("#kategory").hide();
  $("#edit_data").load('views/edit_data_penjualan/edit_data.php?',{nama:nama,period:period,bulan:bulan,
    tahun:tahun,target:target,ttl_ml:ttl_ml,li:li,amount:amount});
});


function ktg_tfml(tahun){

  $.ajax({
    url:'models/manylist/datalist_kategori.php',
    method:'POST',
    data:{tahun:tahun},
    dataType:'json',
    success: function(reslut){
   
      $.each(reslut,function(key,val){
        let key_rep = key.replace(".","");
      let id ="#"+key_rep+"_total";
      $(id).empty().html(val);

      if(key == "ALL"){
        let id ="#"+key+"_total";
        $(id).empty().html(val);
      }else if(key == "RIZEK"){
        let id ="#"+key+"_total";
        $(id).empty().html(val);
      }

      });
  
    }
  })
  }
//end edit data



function get_tahun(){
 
  let startyear = 2020;
  let date = new Date().getFullYear();
  
  let endyear = date + 2;
  
  for(let i = startyear; i <=endyear; i++){
    var selected = (i !== date) ? 'selected' : date; 

   $("#selectahun").append($(`<option />`).val(i).html(i).prop('selected', selected));

  }
}


		function SetTotalMax(data){
			
			let nama = data.nama_toko;
			
			if(nama =="TOKOPEDIA"){
				let total = data.total;
				let total_tok =[];
				
				total_tok.push(total);
				
			
				
			}
			
			
		}
</script>