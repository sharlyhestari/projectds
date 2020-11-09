<script>

function get_list_document(){
    id  =   "aaaa";
    nickname_sistem   = $("#nickname_sistem").val();
    nickname_customer = $("#nickname_customer").val();
    url ='<?php echo base_url();?>documentation/C_documentation/get_list_document';
    $.ajax({
      url   : url,
      type  : "POST",
      data  : {"nickname_sistem":nickname_sistem,'nickname_customer':nickname_customer}, //"username" merupakan variabel yg akan disesuaikan dg  $_POST ('username')
      dataType: "JSON",
      success : function(data)
            {
            $("#data").html("");
              
              $("#data").append(data.html);
            },
      error   : function (jqXHR,textStatus,errorThrown)
            {
              
            }
    });
}

function save_data(){
  var data22 = $( "#tes5" ).serialize();
  console.log(data22);
  url ='<?php echo base_url();?>documentation/C_documentation/simpan';
  $.ajax({
      type: "POST",
      url : url,
      data: data22,
      dataType: "json",
      success: function(data) {
         
      },
      error: function() {
          alert('error handling here');
      }
  });


}

</script>

<script type="text/javascript">

$(document).ready(function(){
  $('#nickname_sistem').on('change', function(){
    var id_sistem = $(this).val();
    if(id_sistem == ''){
      $('#nickname_customer').prop('disabled',true);
    }
    else{
      $('#nickname_customer').prop('disabled',false);
      $.ajax({
        url:"<?php echo base_url() ?>documentation/C_documentation/select_customer",
        type: "POST",
        data: {'id_sistem' : id_sistem},
        dataType: 'json',
        success:function(data){
          $('#nickname_customer').html(data);
        },
        error:function(){
          alert('Error occur..!');
        }
      });
    }
  });

  $('#nickname_sistem2').on('change', function(){
    var id_sistem2 = $(this).val();
    if(id_sistem2 == ''){
      $('#nickname_customer2').prop('disabled',true);
    }
    else{
      $('#nickname_customer2').prop('disabled',false);
      $.ajax({
        url:"<?php echo base_url() ?>documentation/C_documentation/select_customer",
        type: "POST",
        data: {'id_sistem' : id_sistem2},
        dataType: 'json',
        success:function(data){
          $('#nickname_customer2').html(data);
        },
        error:function(){
          alert('Error occur..!');
        }
      });
    }
  });

    $("form#tes5").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        url ='<?php echo base_url();?>documentation/C_documentation/simpan';
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (data) {
                alert(data);
                $('#tes5').trigger("reset");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});

function form_tambah_data(){
  $('#data_tambah').toggleClass("d-none");
  $('#data_list').toggleClass("d-none");
}


</script>