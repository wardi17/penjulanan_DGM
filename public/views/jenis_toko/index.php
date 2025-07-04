<div id="main" style='width:50%'>
<?php include 'views/pages/burger.php' ?>
  <div id="header_data"></div>
  <div class ="col-md-12 col-12">
      <!-- <h3 class="text-center">Target upload</h3> -->
            <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#TambaModal">
                            <i class="fa-regular fa-file"></i>
                            </button>    
                        
            </div>
    
  </div>
 
    <!-- Basic Tables start -->
    <div id="tabelhead"></div>
    <!-- Basic Tables end -->

</div>

<!-- Modal  tambah baru -->
<div class="modal fade" id="TambaModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="close_tambah" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form  id ="formtambah"  class ="form form-horizontal">
                    <div class="row col-md-12 mb-3">  
                                <label for="kode_kjn" class="col-sm-4 col-form-label">Kode</label>
                                <div class="col-sm-5">
                                  <input type="text" class="form-control"  name="kode_kjn" id="kode_kjn" value="" required>
                                </div>
                        </div>
                        <div class="row col-md-12">  
                                <label for="nama_kjn" class="col-sm-4 col-form-label">Nama Toko</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control"  name="nama_kjn" id="nama_kjn" value="" required>
                                </div>
                        </div>
                          
                        </div>
                            <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3"  data-bs-dismiss="modal" id="Createdata">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" data-bs-dismiss="modal" id="close_tambah2">Close</button>
                                  </div>
      </form>
        </div>
</div>
</div>
<!-- end modal tambah -->

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

<!-- Modal  edit data  -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class ="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="EditModalLabel">Edit data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                <form  id ="formedit"  class ="form form-horizontal">
                  <div class="row col-md-12 mb-4">  
                              <label for="kode_edit" class="col-sm-4 col-form-label">Kode </label>
                              <div class="col-sm-3">
                                <input disabled type="text" class="form-control"  name="kode_edit" id="kode_edit" value="" required>
                              </div>
                      </div>
                      <div class="row col-md-12">  
                              <label for="nama_edit" class="col-sm-4 col-form-label">Nama Toko</label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control"  name="nama_edit" id="nama_edit" value="" required>
                              </div>
                      </div>
                </div>
                        <div class="col-sm-11 d-flex justify-content-end">
                                    <button  type="sumbit" name="sumbit" class="btn btn-primary me-1 mb-3" data-bs-dismiss="modal" id="Editdata">Save</button>
                                    <button type="button" class="btn btn-secondary me-1 mb-3" id="close" data-bs-dismiss="modal">Close</button>
                        </div>
                        
                  </form>
                </div>
              </div>
    </div>
<!-- end modal edit -->

<script>
$(document).ready(function(){

    get_data_jenis_kjn();
    // $('input').keyup(function() {
    //     this.value = this.value.toLocaleUpperCase();
    // });
//tambah data
  $("#Createdata").on('click',function(e){
    e.preventDefault();
 
    let kode = $("#kode_kjn").val();
    let nama = $("#nama_kjn").val();
    $.ajax({
      url:'models/master_jenis_eo/tambahdata.php',
      method:'POST',
       data:{kode:kode,nama:nama},
       cache:true,
       dataType:'json',
       success:function(result){
            let status = result.error;
                  Swal.fire({
                    position: 'top-center',
                  icon: 'success',
                  title: status,
                
                  }); 
                  $("#formtambah").trigger('reset');
                  get_data_jenis_kjn();
       }
    })
  });
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
$("#close").on("click",function(e){
  e.preventDefault();
  $("#formedit").trigger("reset");
})
    $("#Editdata").on("click",function(e){
        e.preventDefault();
       
        let  kode = $("#kode_edit").val();
        let  nama = $("#nama_edit").val();
    

        $.ajax({
            url:'models/master_jenis_eo/edit_data.php',
            type:'POST',
            dataType:'json',
            data :{kode:kode,nama:nama},
        
            success:function(result){
              let status = result.error;
                  Swal.fire({
                    position: 'top-center',
                  icon: 'success',
                  title: status,
                
                  }); 
                  get_data_jenis_kjn();
          
            }
        });
    });
//end edit
  });




function get_data_jenis_kjn(){

    let dataTable =``;
    $.ajax({
            url:'models/master_jenis_eo/tampildata.php',
            method:'POST',
            dataType:'json',      
            success:function(response){
             get_header();
             get_tables();

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
                    pageLength: 5,
                    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                                
                    data: response,
                        columns: [
                            { 'data': 'kode_jenis' },
                            { 'data': 'nama_toko' },
                     
                         
                            { "render": function ( data, type) { // Tampilkan kolom aksi
                              let html  ='<button type="button"   class=" open-edit btn btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#EditModal"><i class="fa-regular fa-pen-to-square"></i></button>'
                            html += '<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>'
                            return html
                             }
                            },
                        ]      
            
            });
            }
    });      
} 
function get_header(){
    let data_headr =`

    <div  class="page-heading mb-3">
    <div class="page-title">
    <h4 class="text-center">Master Jenis Toko </h4>
    </div></div>

    `;
    $("#header_data").html(data_headr);
}
function get_tables(){
    //   let id ="#"+tabel;
    //   let substr_bulan = bulan.substr(0,3);
        let dataTable =`
        <section class="section">
                <div class="card">
                    <div class="card-body">
                    <table id="tabel1" class='display table-info' style='width:100%'>                    
                                    <thead  id='thead'class ='thead'>
                                    <tr>
                                                <th style="width:2%">Kode</th>
                                                <th style="width:2%">Nama Toko</th>
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

</script>