
<div class="subCont{{$class}}">
  <script type="text/javascript">
    $(document).ready(function(){
      $(".subCont" + "{{$class}}").load('{{$page}}', {"modal": 1});
    });
  </script>
</div>

@include('sub.'.$sub)
