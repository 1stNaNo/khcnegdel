<div id="window_orderregister" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <script src="/js/jstree.js"></script>
  <link rel="stylesheet" href="/css/style.css" />
  <form action="/sys/order/save" id="orderreg_form" class="form-horizontal form-bordered">
    <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}" />
    <div class="row">

      <div class="col-md-3 scroll">
        <section class="panel">
          <header class="panel-heading">
            <h2 class="panel-title">Бүлэг</h2>
          </header>
          <div class="panel-body">
            <div id="treeBasic">
            </div>
          </div>
        </section>
      </div>  
      <div class="col-md-6 scroll">
        <section class="panel">
          <header class="panel-heading">
            <h2 class="panel-title">Бараа бүтээгдэхүүн</h2>
          </header>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-8">
                <div class="input-group input-search">
                  <input class="form-control" name="q" placeholder="Хайлт..." type="text" id="search-field">
                  <span class="input-group-btn">
                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                  </span>
                </div><br>  
              </div>
            </div>
            
            <div id="products">
              @foreach($products as $p)
              <div class="row">
                <div class="col-md-1"></div><div class="col-md-8"><input type="text" value="{{$p->name}}" class="form-control pull-left prod-search" disabled="disabled"></div>
                <div class="col-md-3"><button type="button" class="btn btn-success" onclick="callPopup({{$p->split}}, {{$p->id}})">+</button></div>
              </div><br>
              @endforeach
            </div>
          </div>
        </section>
      </div>
      <div class="col-md-3 scroll">
        <section class="panel">
          <header class="panel-heading">
            <h2 class="panel-title">Бараа бүтээгдэхүүн</h2>
          </header>
          <div class="panel-body" id="items">
            @foreach($ordered_prod as $o)
              <div class="alert alert-success">
                <button type="button" class="close" onclick="deleteItem({{$o->id}}, $(this))" aria-hidden="true">×</button>
                <strong>{{$o->product_name}}</strong> <p>{{$o->size}} - {{$o->unit_name}}</p>
              </div>
            @endforeach
          </div>
        </section>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div style="float: right;">
          <button type="button" class="btn btn-primary" onclick="confirmIndex()">Баталгаажуулах</button>
          <button type="button" class="btn btn-warning" onclick="uPage.close('window_orderregister')">{{trans('resource.buttons.close')}}</button>
        </div>
      </div>
    </div>
  </form>
  <div class="modal fade" id="myModal" role="dialog" style="">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Тоо хэмжээ оруулна уу.</h4>
        </div>
        <div class="modal-body" id="modal-body1">
          
        </div>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
    var arr = [
      {"id" : "0", "parent" : "#", "text" : "Бүгд"},
      @foreach($category as $c)
        @if($c->parent_id == 0)
          { "id" : "{{$c->id}}", "parent" : "#", "text" : "{{$c->name}}" },
        @else
          { "id" : "{{$c->id}}", "parent" : "{{ $c->parent_id }}", "text" : "{{$c->name}}" },
        @endif
      @endforeach
    ];

    $('#treeBasic').jstree({ 
      'core' : {
        'data' : arr
      }
    });

    $("#search-field").keyup(function(e){
      var searchval = $(this).val();

      $('.prod-search').parent().parent().show();

      $('.prod-search').each(function(){
        if($(this).val().toLowerCase().indexOf(searchval.toLowerCase()) >= 0){
        }else{
          $(this).parent().parent().hide();
        }
      });

      
    });

    $('#treeBasic').on("select_node.jstree", function (e, data) {
      $.ajax({
        url : '/sys/order/producttypes',
        type : 'post',
        data : {
          'ca_id' : data.selected[0]
        },
        success : function(d){
          var prods = '';
          $.each(d.products, function(i, v){
            prods += '<div class="row">';
            prods += '<div class="col-md-1"></div><div class="col-md-8"><input type="text" value="'+v.name+'" class="form-control pull-left prod-search" disabled="disabled"></div>';
            prods += '<div class="col-md-3"><button type="button" class="btn btn-success" onclick="callPopup('+v.split+', '+v.id+')">+</button></div>';
            prods += '</div><br>';
          })
          $('#products').html(prods);
        }
      });
    });

    function callPopup(split, id){
      $.ajax({
        url : '/sys/order/popupamount',
        type : 'post',
        data : {
          'split' : split,
          'product_id' : id,
          'order_id' : $('#order_id').val()
        },
        success : function(data){
          $("#modal-body1").html(data);
          $("#myModal").modal('show');
        }
      });
      
    }

    function saveorder(){
      var check = false;
      if($('#orderregister_form').find('[name="split"]').val() == 1){
        $('#orderregister_form').find('.day').each(function(){
          if($(this).val()){
            if(!isNaN($(this).val()))
              check = true;
          }
        });
      }else{
        if($('#orderregister_form').find('[name=size]').val()){
          if(!isNaN($('#orderregister_form').find('[name=size]').val()))
            check = true;
        }
      }


      if(check){
        $.ajax({
          url : '/sys/order/save',
          type : 'post',
          data : $('#orderregister_form').serialize(),
          success : function(data){
            $("#myModal").modal('hide');
            $('#order_id').val(data.order_id);
            reloadItems();
          }
        });
      }else{
        umsg.error('Талбарыг зөв бөглөнө үү!');
      }
    }

    function deleteItem(id, item){
      if(confirm('Та усгтахдаа итгэлтэй байна уу?')){
        $.ajax({
          url : '/sys/order/delete',
          type : 'post',
          data : {
            id : id
          },
          success : function(data){
            if(data.status){
              item.parent().remove();
              umsg.success('Амжилттай устлаа!');
            }
          }
        });
      }
    }

    function reloadItems($orderId){
      $.post('/sys/order/reload',{
        'id' : $('#order_id').val()
      } ,function(data){
        var item = "";

        $.each(data.items, function(i ,v){
          item += '<div class="alert alert-success">';
          item += '<button type="button" class="close" onclick="deleteItem('+v.id+', $(this))" aria-hidden="true">×</button>';
          item += '<strong>'+v.product_name+'</strong> <p>'+v.size+' - '+v.unit_name+'</p>';
          item += '</div>';
        });

        $("#items").html(item);
        
      });
    }

    function confirmIndex(){
      uPage.call('/sys/order/confirmindex',{ 'id' : $("#order_id").val() });
    }

  </script>
  <style>
    .scroll{
      overflow: scroll;
      height: 100%;
    }
  </style>
</div>
