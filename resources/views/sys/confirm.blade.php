
<div id="window_confirm" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>
              @if($view)
                <h2 class="panel-title">Захиалгын мэдээлэл</h2>
              @else
                <h2 class="panel-title">Баталгаажуулалт</h2>
              @endif
            </header>
            <div class="panel-body">
              <input type="hidden" name="order_id" value="{{$order_id}}"/>
              <div class="table-responsive">
                <table class="table mb-none">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Нэр</th>
                      <th>Ангилал</th>
                      <th>Хэмжих нэгж</th>
                      <th>Тоо хэмжээ</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @if(count($prods) > 0)
                      @foreach($prods as $prod)
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$prod->cat_name}}</td>
                          <td>{{$prod->product_name}}</td>
                          <td>{{$prod->unit_name}}</td>
                          <td>{{$prod->size}}</td>
                          <td>{{$prod->split_name}}</td>
                        </tr>
                        @php $i++ @endphp
                      @endforeach
                    @else
                      <tr>
                        <td colspan="5" style="text-align: center;"><strong>Мэдээлэл байхгүй байна</strong></td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <br>
              <div class="row">
                <div class="col-md-3" style="text-align: right;">Нэмэлт мэдээлэл : </div>
                <div class="col-md-9">
                  <textarea class="form-control" id="order_comment" name="comment" style="resize: none;" cols="6" @if($view) disabled @endif>{{$order->comment}}</textarea>
                </div>
              </div>
            
            </div>
            
            <br>
            <div class="row">
              <div class="col-md-12">
                <div style="float: right;">
                  @if(!$view)
                  <button type="button" class="btn btn-primary" onclick="confirmOrderFinal()">Баталгаажуулах</button>
                  @endif
                  <button type="button" class="btn btn-warning" onclick="uPage.close('window_confirm')">{{trans('resource.buttons.close')}}</button>
                </div>
              </div>
            </div>
          </section>
      </div>
  </div>
  <script>
      function confirmOrderFinal(){
        var r = confirm("Баталгаажуулах уу?");
        if(r){
          $.post('/sys/order/confirm', {'id' : $('#window_confirm').find('[name=order_id]').val(), 'comment' : $('#order_comment').val() }, function(data){
            if(data.status){
              uPage.close('window_confirm');
              uPage.close('window_orderregister');
              umsg.success('Амжилттай баталгаажлаа!');
              baseGridFunc.reload("order_grid");
              $("#orderAddBtn").remove();
            }
          });
        }
      }
  </script>
 
</div>
