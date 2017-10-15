<div id="window_orderconf" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <form action="/sys/order/save" id="orderconfregister_form" class="form-horizontal form-bordered" method="post">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a class="panel-action panel-action-toggle" href="#" data-panel-toggle=""></a>
              <a class="panel-action panel-action-dismiss" href="#" data-panel-dismiss=""></a>
            </div>
            <h2 class="panel-title">Захиалга бүртгэл</h2>
          </header>

          <div class="panel-body">
            <div id="conf-container">

            </div>
            <input type="hidden" value="" name="order_id"/>
            <hr class="tall">
            <div class="row">
              <div class="col-md-8">
                <textarea class="form-control" id="comment" name="comment" placeholder="Тайлбар" resize="false"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
                <button class="btn pull-right" type="button" onclick="uPage.close('window_orderconf')">Хаах</button>
                <button class="btn btn-primary pull-right" type="button" onclick="$('#orderconfregister_form').submit()">Баталгаажуулах</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <script>
    $(function(){
      var checkErr = false;
      var data = {};
      var $obj_data = '';

      $('#window_orderregister').find('.product_size').each(function(i, v){
        var j = 0;
        $(this).find('.product_size_sub').each(function(k, a){
          if($(this).val().length != 0){
            var errClass = (isNaN($(this).val())) ? 'has-error':' ';
            var errText = (isNaN($(this).val())) ? '<label class="error" for="company">Тоо оруулна уу.</label>':' ';
            $obj_data += '<div class="row form-group '+errClass+'"><div class="col-md-4"><input class="form-control" type="text" name="product" disabled="true" value="'+$(this).parent().parent().parent().find('[name=product]').val()+'"/></div>';
            $obj_data += '<input class="" type="hidden" name="product_id['+i+']" value="'+$(this).parent().parent().find('[name=product_id]').val()+'"/>';
            $obj_data += '<input class="" type="hidden" name="is_split['+i+']" value="'+$(this).parent().parent().find('#is_split').val()+'"/>';
            $obj_data += '<input class="" type="hidden" name="unit_id['+i+']" value="'+$(this).parent().parent().parent().find('#unit_id').val()+'"/>';
            $obj_data += '<div class="col-md-1"><input class="form-control" type="text" name="unit" disabled="true" value="'+$(this).parent().parent().parent().find('#unit_id').text()+'"/></div>';

            if($(this).parent().parent().find('#is_split').val() == 0){
              $obj_data += '<div class="col-md-4"><input type="hidden" name="product_size['+i+']" value="'+$(this).val()+'"/><input class="form-control" type="text" name="" disabled="true" value="'+$(this).val()+'"/></div><div>'+errText+'</div>';
            }else{
              $obj_data += '<div class="col-md-3"><input type="hidden" name="product_size['+i+']['+j+']" value="'+$(this).val()+'"/><input type="hidden" name="day['+i+']['+j+']" value="'+(k+1)+'"/><input class="form-control" type="text" name="product_size['+i+']['+j+']" disabled="true" value="'+$(this).val()+'"/></div><div class="col-md-1">'+(k+1)+' өдөр</div></div>'+errText+'</div>';
            }
            $obj_data += '</div>';
            j++;
          }
        });
        $('#window_orderconf').find('[name=order_id]').val($('#window_orderregister').find('[name=order_id]').val());
      });
      $("#conf-container").html($obj_data);
    });

    </script>
  </form>

</div>
