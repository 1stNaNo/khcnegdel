
<div class="subCont{{$class}}">
  <script type="text/javascript">
    $(document).ready(function(){
      $.ajax({
        url: '{{$page}}',
        type: 'GET',
        data: {'modal' : 1},
        dataType: 'html',
        success: function(data){
          $(".subCont" + "{{$class}}").html(data);
        }
      });
    });
  </script>
</div>

@include('sub.'.$sub)
