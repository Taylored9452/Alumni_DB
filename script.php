<script type="text/javascript">
  $('#provinces').change(function() {
    var id_province = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_province,function:'provinces'},
      success: function(data){
          $('#amphures').html(data); 
          $('#districts').html(' '); 
          $('#districts').val(' ');  
          $('#zip_code').val(' '); 
      }
    });
  });
 
  $('#amphures').change(function() {
    var id_amphures = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_amphures,function:'amphures'},
      success: function(data){
          $('#districts').html(data);  
      }
    });
  });
 
   $('#districts').change(function() {
    var id_districts= $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_districts,function:'districts'},
      success: function(data){
          $('#zip_code').val(data)
      }
    });
  
  });

  $('#tbcampus').change(function() {
    var id_campus = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {groupid:id_campus,function:'tbcampus'},
      success: function(data){
          $('#tbgroup').html(data); 
          $('#tbbranch').html(' '); 
          $('#tbcourse').html(' ');   
      }
    });
  });
 
  $('#tbgroup').change(function() {
    var id_group = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {branchid:id_group,function:'tbgroup'},
      success: function(data){
          $('#tbbranch').html(data);  
      }
    });
  });
 
  $('#tbbranch').change(function() {
    var id_branch = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {courseid:id_branch,function:'tbbranch'},
      success: function(data){
          $('#tbcourse').html(data);  
      }
    });
  });

  $('#province').change(function() {
    var id_province = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_province,function:'province'},
      success: function(data){
          $('#amphure').html(data); 
          $('#district').html(' '); 
          $('#district').val(' ');  
          $('#zip_code1').val(' '); 
      }
    });
  });
 
  $('#amphure').change(function() {
    var id_amphures = $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_amphures,function:'amphure'},
      success: function(data){
          $('#district').html(data);  
      }
    });
  });
 
   $('#district').change(function() {
    var id_districts= $(this).val();
 
      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_districts,function:'district'},
      success: function(data){
          $('#zip_code1').val(data)
      }
    });
  
  });

</script>