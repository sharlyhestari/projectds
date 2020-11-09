  <script>
    //$('#tableUser').DataTable(); 
    var load_user;
    $( document ).ready(function() {//untuk manggil isi table ajax secara otomatis saat menu di load
  	tampilkanUser();

});

    // $('#tableUser').DataTable(); 

function tampilkanUser(){

    load_user= $('#sampleTable').DataTable( {
        "ajax": {
                    "url": "<?php echo base_url('admin/ConfigurationUser/overall_list');?>",
					"data": {},
                    "type": "POST"
                },
		"aaSorting": [],
		"columns": [
			           { "data" : "no"	},
                 { "data": "username"},
            		 { "data": "email"},
            		 { "data": "status"},
            		 { "data" : "aksi", "orderable": false},
            		 { "data" : "role", "orderable": false},
                ],
       "processing"     : true,
       "serverSide"     : true,
       'iDisplayLength' : 10,
       "bLengthChange"  : true,
       "bFilter"        : true,
       "bInfo"          : true,
	   "bDestroy"         : true,
	   "searching"        : true,
	   dom: 'Bfrtip',  
        buttons: [
             {
            extend: 'columnVisibility',
            text: 'Show all',
            visibility: true
        },
        {
            extend: 'columnVisibility',
            text: 'Hide all',
            visibility: false
        },
		{
			extend: 'colvis',
            columns: ':gt(0)'
		}
        ]
    });
}


function tambahUser(){
  
    var username = $("#username").val();
    var password = $("#password").val();
    var email    = $("#email").val();

      url = "<?php echo base_url('admin/ConfigurationUser/c_tambahUser')?>"
      $.ajax({
      url   : url,
      type  : "POST",
      data  : {"username":username,"password":password,"email":email}, //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      dataType: "JSON",
      success : function(data)
            {
              if(data=='success'){
                // alert('success');
               // window.location = '/welcome';
              
              $('#exampleModal').modal('hide');
              swal ( "Success" ,  "You have already insert user" , "success")
              // $("formAddUser").trigger("reset");
              $('#formAddUser')[0].reset();
              load_user.ajax.reload();


              }
              else{
                //swal ( "Failed" ,  "Your username or password wrong!" ,  "error" )
             
                // alert('failed');
              }
            },
      error   : function (jqXHR,textStatus,errorThrown)
            {
              //alert(hasil);
            }
          });
  }

  function editUser(){//for save after edit

      var values = $("#formEditUser").serialize();
      console.log(values);
      url ="<?php echo base_url('admin/ConfigurationUser/c_edit_user')?>";
      $.ajax({
      url   : url,
      type  : "POST",
      dataType : "json",
      //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      data  : values,  //ambil variavel values
      dataType: "JSON",
      success : function(data)
            {
              $('#exampleModal2').modal('hide');
              swal ( "Success" ,  "You have already edit user" , "success")
              load_user.ajax.reload(null,false);
            },
      error   : function (jqXHR,textStatus,errorThrown)
            {
             alert('Something is wrongs');
            }
          });
  }



  function get_data_update(id){
    // var username = $("#username").val();
    // var password = $("#password").val();
    // var email    = $("#email").val();
    url ='<?php echo base_url();?>admin/ConfigurationUser/c_get_user';
    $.ajax({
      url   : url,
      type  : "POST",
      data  : {"id":id}, //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      dataType: "JSON",
      success : function(data)
            {
              $("#username2").val(data[0].username);
              $("#email2").val(data[0].email);
              $("#id").val(data[0].id);
            },
      error   : function (jqXHR,textStatus,errorThrown)
            {
              //alert(hasil);
            }
    });
  }

  function get_data_role(id){
    // var username = $("#username").val();
    // var password = $("#password").val();
    // var email    = $("#email").val();
    url ='<?php echo base_url();?>admin/ConfigurationUser/c_get_role';
    $.ajax({
      url   : url,
      type  : "POST",
      data  : {"id":id}, //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      dataType: "JSON",
      success : function(data)
            {
              $("#role_menu5").html(data.username);
              $("#id_user").val(data.id_user);
              $("#accordionExample").html(data.m);
            },
      error   : function (jqXHR,textStatus,errorThrown)
            {
              //alert(hasil);
            }
    });
  }

  function get_status(id,username,status){
   // var a=$('#switch'+id+'input').hasClass('tgl-sw-light-checked');
   //    if(a==true){
   //      swal("User "+username+" diaktifkan");
   //              editStatus(id,1);      
   //    }
   //    else{
   //      swal("User "+username+" dinonaktifkan");
   //              editStatus(id,0);      
   //    }}
   // else {
   //  //echo "test";
   //   swal("User "+username+" dinonaktifkan");
   //     editStatus(id,0);
        // swal("User "+username+" diaktifkan");
        // editStatus(id,1);
   // }

   url ='<?php echo base_url();?>admin/ConfigurationUser/c_get_status';
    $.ajax({
      url   : url,
      type  : "POST",
      data  : {"id":id,"username":username,"status":status}, 
      //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      dataType: "JSON",
      success : function(data)
            {

              if(status==1){
                // console.log(status);
               swal("User "+username+" dinonaktifkan");
                editStatus(id,0);
              }
              else{
                // console.log(status);
               swal("User "+username+" diaktifkan");
                editStatus(id,1);
              }

            
          
            },
      error   : function (jqXHR,textStatus,errorThrown)
            {
              //alert(hasil);
            }});
  }
  


  function editStatus(id,status){
    url = "<?php echo base_url('admin/ConfigurationUser/c_edit_status')?>"
    $.ajax({
      url   : url,
      type  : "POST",
      data  : {"id":id,"status":status}, //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      dataType: "JSON",
      success : function(data){
                // if(data=='success'){
                //   alert('success');
                  
                // else{               
                // }
              },
      error   : function (jqXHR,textStatus,errorThrown){
                //alert(hasil);
              }
    });
  }
  ////////////

  function save_role_access(){
    var values      = $("#formRoleMenu").serialize();
    // console.log(values);
    url = "<?php echo base_url('admin/ConfigurationUser/c_edit_role')?>";
    $.ajax({
    	url	  : url,
    	type	: "post",
    	data	: values,
    	success	: function (response) {
        swal ( "Success" ,  "You have already edit role menu" , "success")
        $('#exampleModal3').modal('hide');
    	},
    	error: function(jqXHR, textStatus, errorThrown) {
    		console.log(textStatus, errorThrown);
                $.notify({ message: "Error System. Please Contact Admin" },{ type: 'warning' });
        }
     });  
  }
</script>
}
