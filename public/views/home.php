<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" />

<style> 

.highcharts-exporting-group{
        visibility: hidden;
    }

    .highcharts-figure,
    .highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
    }

    .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
    }

    .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
    }

    .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
    padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
    background: #f1f7ff;
    }

 .nowrap{
    white-space: nowrap !important;
 }


        /* ini untuk mengilangak scrollbar di samping */
    .scrollbar::-webkit-scrollbar
        {
            width: 1px;
            background-color: #FFFFFF;
        }
        .scrollbar::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,.9);
            background-color: #FFFFFF;
        }

        /* end scrolbar */
 /* unutk tabel comment mengilangkan garis head dan footer  */
    .dataTables_scrollBody {
            overflow-x: hidden !important;
             
        border-top: none !important;
        border-bottom: none !important;
        }
     
 /* end tabel comment */
 
 .tanggal-icon {
  position: relative;
  width: 40px;
  height: 40px;
  background-color: #ccc;
  border-radius: 50%;
}

.tanggal {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 16px;
  font-weight: bold;
}
.board{
    font-weight: bold;
}
</style>



<div id="main">
          <?php include 'views/pages/burger.php';
            require_once ("models/dahasboard/tampildata.php");
          ?>
            

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div  id="katalog" class="row">
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div id="grafik"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                       
                        <div class="card-body">
                            <div id="tabelhead_sm"></div>
                            <div id="tabelheaddetail"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
         
            <div class="card">
                <div class="card-header">
                </div>
   
               
                <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel_comment" class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                     
                                            <th>Name</th>
                                            <th>Comment<button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal">
                                            <i class="fa-regular fa-file"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $datacome = $data->get_data(); 
                                    ?>
                                    <?php 
                                    $tanggal ="";
                                     $nama ="";
                                     $comment ="";
                                       while(odbc_fetch_row($datacome)){
                                            $tanggal = rtrim(odbc_result($datacome,"tanggal"));
                                             $nama = rtrim(odbc_result($datacome,"user_name"));
                                             $comment = rtrim(odbc_result($datacome,"comment"));
                                        ?>
                                             <tr>
                                           
                                            <td class="col-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="row">
                                                    <p class="font-bold ms-3 mb-2"><?=$nama?></p>
                                                    <p class="font-bold ms-3 mb-2"><?=date("d-F-Y",strtotime($tanggal))?></p>
                                                    </div>
                                                  
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-2"><?=$comment?></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
           
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="id_user" id="id_user" value="<?=$rows['id_user']?>">
        <input type="hidden" name="username" id="username" value="<?=$rows['nama']?>">

        <textarea type="text" class="form-control" name="com_mesage" id="com_mesage"></textarea>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" id="kirim">Kirim</button>
        <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
        const dateya = new Date();
        let bulan = dateya.getMonth()+1;
        let tahun = dateya.getFullYear();
        get_datagrafik(tahun,bulan);
        getdata(tahun,bulan);
            //untuk tabel sameri
            tabel_sameri(tahun);
                //end
                get_header(tahun);
        //untuk tabel comment
        $("#tabel_comment").DataTable({
                        "ordering": false,
                    "destroy":true,
                        //dom: 'Plfrtip',
                        scrollCollapse: true,
                        paging:false,
                        "bPaginate":false,
                    "bLengthChange": false,
                        "bFilter": true,
                        "bInfo": false,
                        "bAutoWidth": false,
                        dom: 'lrt',
                    "scrollY": "400px",
                    "scrollCollapse": true,
                    "initComplete": function(settings, json) {
                    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
            }      
        });


    $('.dataTables_length').addClass('bs-select');
    //end 


    $("#kirim").on("click",function(e){ 
     
        e.preventDefault();
        let kirim = $("#com_mesage").val();
        let user = $("#username").val();
        let id_user = $("#id_user").val();
        $.ajax({
            url:'models/dahasboard/comment.php',
            type:'POST',
            dataType :'json',
            data :{user:user,kirim:kirim,user_id:id_user},
            success:function(result){
           
               window.location.href ="index.php?page=home";
            }
        });
    });
// and kirim
    $("#close").on("click",function(){
       $("#com_mesage").val('');
    });
//
});
    //untuk menamilkan grafik
    function get_datagrafik(tahun,bulan){
            $.ajax({
                    url:'models/report_eo/data_grafik_eo.php',
                    method:'POST',
                    data:{tahun:tahun,bulan:bulan},
                    dataType:'json',      
                    success:function(result){
                    get_grafik(result,tahun)
                    }
                });

        }

    function get_grafik(result,tahun){
            let text_t = 'Grafik Executive Order '+' '+ tahun;
            Highcharts.chart('grafik', {
            title: {
                text: text_t,
                align: 'center'
            },
            subtitle: {
                text: '',
                align: 'left'
            },

            yAxis: {
                title: {
                    text: ''
                }
            },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },


                plotOptions: {
                        series: {
                            cursor: 'pointer',
                            point: {
                                events: {
                                    click: function() {
                                        alert ('Category: '+ this.category +', value: '+ this.y);
                                    }
                                }
                            }
                        }
            },
        
        //untuk get data
                series:
                    $.each(result,function(key,value){
                    value
                    }),
        //end get data                   
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });

    }

 // end grafik
//untuk menamilkan data katalog di atas  perbulan
function getdata(tahun,bulan){
             $.ajax({
            url:'models/dahasboard/ds_kategory.php',
            method:'POST',
            data:{tahun:tahun,bulan:bulan},
         
            dataType:'json',
            success:function(result){
               
            const data = result.reverse();
           let katalog =``;
        
            $.each(data,function(key,val){
         
                let bln_h = val['bulan_h'];
                let bln = val['bulan'];
                let jenis = val['data'];
                let jenis2 = val['data'];

                let o =``;
                let m =``;
                let d =``;
                let t =``;
                for(let js of jenis){
                 
                    if( js['OWNER']){
                      
                        if(js['OWNER'] == undefined){
                        break;
                        }
                        o +=js['OWNER'];
                    }
                    if(js['MANAGER']){
                        if(js['MANAGER']== undefined){
                                break;
                            }
                        m +=js['MANAGER'];
                    }
                    if(js['DIREKSI']){
                        if(js['DIREKSI']== undefined){
                                break;
                            }
                        d +=js['DIREKSI'];
                    }
                }
                t = parseInt(o)+ parseInt(m) + parseInt(d);
             
               
                let rgb1 ="#B9EDDD";
  
                katalog +=`
                        <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div style="background-color:${rgb1}"  class="stats-icon mb-2">${bln}</div>
                                    </div>
                                    <div class="col-md-10 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">${bln_h}</h6>
                                        <h6 style="font-size:12px" class="font-semibold  mb-2"id="bln_data">O.${o} &nbsp;  M.${m} &nbsp; D.${d}</h6>
                                        <h6 style="font-size:12px" id="color1" class="font-extrabold text-center">${t} &nbsp;&nbsp;</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
               
                 
            });
            $("#katalog").empty().html(katalog);  
        //     let bulan_s = data.bulan;
        // let katalog =``;
        // for(let bulan_s of data){
        //     let bulans = bulan_s['bulan'];
        //     let bulan_k = bulan_s['bulan_angka'];
        //     let kjn = bulan_s['ttl_kunjungan'];
        //     let pss = bulan_s['ttl_proses'];
        //     let ssi = bulan_s['ttl_ssi'];
        //     let tem = bulan_s['ttl_eml'];
        //     let blm_ssi = (ssi - kjn);
            
        //     let rgb1 ="#B9EDDD";
        //     let rgb2 ="#B9EDDD";
        //     let rgb3 ="#B9EDDD";
        //     let rgb4 ="#B9EDDD";


        //              if(bulan_k == 'Januari'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb1} font-weight:" class="stats-icon  mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color1" class="font-extrabold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Februari'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex mb-2 justify-content-start ">
        //                                 <div  style="background-color:${rgb1}" class="stats-icon mb-2">${bulan_k}</div>  
        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color2" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Maret'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-3 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb2}" class="stats-icon mb-0">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color3" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'April'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div  style="background-color:${rgb3}" class="stats-icon  mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color4" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Mei'){
                   
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb4}"  class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color5"  class=" font-semibold text-center"> ${blm_ssi}</h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Juni'){
        //                     katalog +=`
        //                      <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb1}"  class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color6"  class=" font-semibold text-center"> ${blm_ssi}</h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                     `;
        //             }
                 
        //              if(bulans == 'Juli'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div  style="background-color:${rgb2}"  class="stats-icon  mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color7" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Agustus'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb3}"class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6  style="font-size:12px"id="color8" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'September'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb4}" class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6  style="font-size:12px" id="color9" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Oktober'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb1}"class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color10" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'November'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb2}" class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color11" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        //              if(bulans == 'Desember'){
        //                 katalog +=`
        //                 <div class="col-6 col-lg-3 col-md-6">
        //                 <div class="card">
        //                     <div class="card-body px-4 py-4-5">
        //                         <div class="row">
        //                             <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
        //                             <div style="background-color:${rgb3}"class="stats-icon mb-2">${bulan_k}</div>

        //                             </div>
        //                             <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
        //                                 <h6 class="text-muted font-semibold mb-4">${bulans}</h6>
        //                                 <h6 style="font-size:12px" class="font-semibold  mb-2">K${kjn} &nbsp E${tem} &nbsp P${pss} &nbsp S${ssi} &nbsp</h6>
        //                                 <h6 style="font-size:12px" id="color12" class="font-semibold text-center"> ${blm_ssi} </h6>
        //                             </div>
        //                         </div>
        //                     </div>
        //                 </div>
        //                 </div>
        //                 `;
        //              }
        
                    
        // }

        // $("#katalog").empty().html(katalog);  
        // const datas = result.reverse();
       
     
        // for(let item of datas){
        //     let kjn = item['ttl_kunjungan'];
        //     let ssi = item['ttl_ssi'];
        //     let bulan_k = item['bulan_angka'];

        //     if(bulan_k == 1){
        //         if(ssi < kjn){
        //             $("#color1").css("color","red");
        //         }else{
        //             $("#color1").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 2){
        //         if(ssi < kjn){
        //             $("#color2").css("color","red");
        //         }else{
        //             $("#color2").css("color","black");
        //         }
        //     }

        //     if(bulan_k == 3){
        //         if(ssi < kjn){
        //             $("#color3").css("color","red");
        //         }else{
        //             $("#color3").css("color","black");
        //         }
        //     }

        //     if(bulan_k == 4){
        //         if(ssi < kjn){
        //             $("#color4").css("color","red");
        //         }else{
        //             $("#color4").css("color","black");
        //         }
        //     }
    
        //     if(bulan_k == 5){
        //         if(ssi < kjn){
        //             $("#color5").css("color","red");
        //         }else{
        //             $("#color5").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 6){
        //         if(ssi < kjn){
        //             $("#color6").css("color","red");
        //         }else{
        //             $("#color6").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 7){
        //         if(ssi < kjn){
        //             $("#color7").css("color","red");
        //         }else{
        //             $("#color7").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 8){
        //         if(ssi < kjn){
        //             $("#color8").css("color","red");
        //         }else{
        //             $("#color8").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 9){
        //         if(ssi < kjn){
        //             $("#color9").css("color","red");
        //         }else{
        //             $("#color9").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 10){
        //         if(ssi < kjn){
        //             $("#color10").css("color","red");
        //         }else{
        //             $("#color10").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 11){
        //         if(ssi < kjn){
        //             $("#color11").css("color","red");
        //         }else{
        //             $("#color11").css("color","black");
        //         }
        //     }
        //     if(bulan_k == 12){
        //         if(ssi < kjn){
        //             $("#color12").css("color","red");
        //         }else{
        //             $("#color12").css("color","black");
        //         }
        //     }
        // }
     }
    });
//untuk kirim data

}

function data_katalog(bln,dts){
    
}
//untuk tampil head tabel sameri
function get_head_sm(){
        
        let dataTable =`
        <section class="section">
                <div class="card">
                        <div class="card-header">
                        </div>
                
                    <div class="card-body">
                    <p id="title" class="page-title">
                    </p>
                    <table  id="tabel_sm" class='display table-info' >                    
                                    <thead  id='thead'class ='thead'>
                                    <tr>
                                                <th>Tahun</th>
                                                <th>Status</th>
                                                <th>Jumlah</th>
    
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table><br>
                                </div>
                            </div>
                        </section>

        `;
    $("#tabelhead_sm").empty().html(dataTable);
};

function tabel_sameri(tahun){

    get_head_sm();

    $.ajax({
    url:'models/report_eo/report_sameri.php',
    method : 'POST',
    data :{tahun:tahun},
    dataType :'json',
    success : function(result){
       data_sameri(result);
    }
    });

}


function data_sameri(result){
    $("#tabel_sm").DataTable({
                    "ordering": false,
                    "destroy":true,
                    responsive: true,
                    columnDefs: [
                                    {
                                        targets:[0,1,2],
                                        styleName: 'text-sm-start'}
                                    ],
                        fixedColumns:   {
                        // left: 1,
                            right: 1
                        },
                    "order":[[0,'desc']],
                    // 'rowCallback': function(row, data, index){
                    //    // console.log(data);
                    //     let status = data.jenis;

                    //     if(status == "kunjungan"){
                    //         $(row).find('td:eq(0)').css('color', '#0dcaf0');
                    //         $(row).find('td:eq(1)').css('color', '#0dcaf0');
                    //         $(row).find('td:eq(2)').css('color', '#0dcaf0');
                    //     }
                    //     if(status == "selesai"){
                    //         $(row).find('td:eq(0)').css('color', '#20c997');
                    //         $(row).find('td:eq(1)').css('color', '#20c997');
                    //         $(row).find('td:eq(2)').css('color', '#20c997');
                    //     }
                    //     if(status == "proses"){
                    //         $(row).find('td:eq(0)').css('color', '#6610f2');
                    //         $(row).find('td:eq(1)').css('color', '#6610f2');
                    //         $(row).find('td:eq(2)').css('color', '#6610f2');
                    //     }
                    //     if(status == "email"){
                    //         $(row).find('td:eq(0)').css('color', '#fd7e14');
                    //         $(row).find('td:eq(1)').css('color', '#fd7e14');
                    //         $(row).find('td:eq(2)').css('color', '#fd7e14');
                    //     }
                    
                    // },
                        data: result,
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                            
                
                            columns: [
                            { 'data': 'tahun' },
                            // { 'data': 'jenis' },
                            {'data':'jenis'},
                            { 'data': 'jumlah',
                                'render':function(data,type,row){
                            
                            let  html =`<span  type="button" style="cursor:pointer"type="submit" onclick="detail_jenis('${row.tahun}','${row.jenis}'); return true" target="_blank">${data}</span>`;
                             return html;
                         }
                            },
                        
                            
                            ]      
                
            });
        
}
//end tampil head sameri

//detail data

function detail_jenis(tahun,jenis){
   $.ajax({
    url:'models/report_eo/report_detail.php',
    method:'POST',
    data:{tahun:tahun,jenis:jenis},
    dataType:'json',
    success:function(result){
        $("#tabelheaddetail").show();
        $("#tabelhead_sm").hide();
        get_tablesdetail();
        datatabeldtl(result)
    }
   })
}


//end data detail
     

function get_header(tahun){
    let data_headr =`
    <h5 class="text-center">Data Executive Order </h5>
    `;
    $("#title").html(data_headr);
}

function get_tablesdetail(tahun){
          let dataTable =`
          <section class="section">
                  <div class="card">
                  <div class="card-header"></div>
                  <div  class="page-heading mb-3">
                      <div class="page-title">
                      <h5 class="text-center">Detail data Executive Order </h5>
                      </div></div>
                      <div class="card-body">
                      <button onclick="goBack();" class="btn btn-lg mb-2"><i class="fa-solid fa-arrow-left"></i></button>
                      <table id="tabeldetail" class="display table-info">                    
                                      <thead  id='thead'class ='thead'>
                                      <tr>      
                                                 <th style="width:50%">Subject Email</th>
                                                 <th style="width:8%">Id</th>
                                                 <th>Prioritas</th>
                                                 <th>Pencetus</th>
                                                 <th>Pengirim</th>
                                                 <th style="width:15%">Tanggal</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table><br>
                                  </div>
                              </div>
                          </section>

          `;
      $("#tabelheaddetail").empty().html(dataTable);
  };


  function datatabeldtl(result){
  $("#tabeldetail").DataTable({
                    "ordering": false,
                    "destroy":true,
                    bAutoWidth: false, 
                    "order":[[0,'desc']],
                    
                        data: result,
               
                        pageLength: 5,
                        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                        // "columnDefs": [
                        //   { "width": "3%", "targets": 2 },
                        //   { "width": "20%", "targets": 7 }
                        //   ],

                            columns: [
                              { 'data': 'subject' },
                              { 'data': 'id_eo' },
                              { 'data': 'importance' },
                              { 'data': 'pencetus' },
                              {'data': 'from_email'},
                              {"render": function(data,type,row){
                                  let tgl = row.tanggal;
                                  let jam = row.jam;
                                  let date = tgl+"&ensp;&ensp;"+jam;
                                  return date;
                              }},
                            //   { 'data': 'attach_af',
                            //                     "render" : function(data,type,row,meta){
                            //                         let attach_bf = row.attach_bf;
                                            
                            //                         let link  =``;
                            //                         for(let at_af of attach_bf){
                            //                             link += at_af['nama_document'];
                                                      
                            //                         }
                            //                         console.log(link)
                            //                     }
                            //                     //     console.log(attach_bf)
                            //                     //     if(type === 'display'){
                            //                     //         data = '<a href="' + data + '" target="_blank">' + data + '</a>';
                            //                     //     }
                            //                     //     return data;
                            //                     // }
                            // },
                            
                            ]      
                
              });
}



function goBack() {
        $("#tabelhead_sm").show();
      $("#tabelheaddetail").hide();
    
    }


 </script>


</div>