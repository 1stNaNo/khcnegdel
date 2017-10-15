@extends('layouts.main.main')

@section('content')

    <hr class="tall" style="margin: 5px 0">

  <!-- LASTEST NEWS START -->
    <div class="row" style="height: 554px;">
      <div class="col-md-12">
        <div class="tabs">
          <ul class="nav nav-tabs nav-justified">
            <li class="active">
              <a href="#new10" data-toggle="tab" class="text-center"><i class="fa fa-star"></i> {{trans('resource.latestNews')}}</a>
            </li>
            <li>
              <a href="#popularn10" data-toggle="tab" class="text-center"><i class="fa fa-eye"></i> {{trans('resource.most_viewed')}}</a>
            </li>
            <li>
              <a href="#comment10" data-toggle="tab" class="text-center"><i class="fa fa-commenting-o"></i> {{trans('resource.most_comment')}}</a>
            </li>
          </ul>
          <div class="tab-content" style="height: 520px;">
            {{-- <div class="nano-content"> --}}
              <div id="new10" class="tab-pane active">
                <div class="nano" style="height: 500px;">
                  <div class="nano-content">
                    @foreach($news as $item)
                        <div class="newsCont" onclick="window.location.href='/post/{{$item->id}}'">
                          <img src="{{$item->thumbnail}}"/>
                          <div class="newsCap">
                            <p>{{$item->title}}</p>
                            <p class="additional">
                              <i class="fa fa-calendar-check-o"></i> {{$item->insert_date}}
                              <i class="fa fa-eye"></i> {{$item->views}}
                              <i class="fa fa-commenting-o"></i> {{$item->comment_count}}</p>
                          </div>
                        </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div id="popularn10" class="tab-pane">
                <div class="nano" style="height: 500px;">
                  <div class="nano-content">
                    @foreach($viewnews as $item)
                        <div class="newsCont" onclick="window.location.href='/post/{{$item->id}}'">
                          <img src="{{$item->thumbnail}}"/>
                          <div class="newsCap">
                            <p>{{$item->title}}</p>
                            <p class="additional">
                              <i class="fa fa-calendar-check-o"></i> {{$item->insert_date}}
                              <i class="fa fa-eye"></i> {{$item->views}}
                              <i class="fa fa-commenting-o"></i> {{$item->comment_count}}</p>
                          </div>
                        </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div id="comment10" class="tab-pane">
                <div class="nano" style="height: 500px;">
                  <div class="nano-content">
                    @foreach($commentnews as $item)
                        <div class="newsCont" onclick="window.location.href='/post/{{$item->id}}'">
                          <img src="{{$item->thumbnail}}"/>
                          <div class="newsCap">
                            <p>{{$item->title}}</p>
                            <p class="additional">
                              <i class="fa fa-calendar-check-o"></i> {{$item->insert_date}}
                              <i class="fa fa-eye"></i> {{$item->views}}
                              <i class="fa fa-commenting-o"></i> {{$item->comment_count}}</p>
                          </div>
                        </div>
                    @endforeach
                  </div>
                </div>
              </div>
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </div>
    {{-- web links --}}



@endsection

@section('contentFull')
  <section class="parallax section section-text-light section-parallax section-center" data-stellar-background-ratio="0.5" style="background-image: url(img/custom-header-bg.jpg);" style="padding: 20px 0;">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h4 style="text-align: left;">{{trans('resource.link')}}</h4>
          <div class="owl-carousel owl-theme show-nav-title" data-plugin-options='{"items": 8, "margin": 10, "loop": false, "nav": true, "dots": false}'>
            @foreach($weblinks as $item)
              <a target="_blank" href="{{$item->link}}" style="text-decoration: none;">
                <div>
                  <img style="height: 80px;" alt="" class="img-responsive img-rounded" src="{{$item->img}}">
                  <p style="text-decoration: none;">{{$item->source}}</p>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-default section-center" style="maring: 0; padding: 0;">
    <div class="container" style="max-width: 900px">
      <div class="row">
        <div class="col-md-12">
          <div id="pie" style="">
              <div id="pieChartContainerPoll" style="max-width: 400px; margin: 0 auto; float: left;"></div>
              @if(!empty($poll))
                {{ csrf_field() }}
                <blockquote class="with-borders pollCont">
                  <blockquote class="">
                    <h6 class=""><strong>{{$poll->source}}</strong></h6>
                  </blockquote>
                  <div id="poll-list" style="text-align: left;">
                  @foreach($answers as $a)
                    @if(Session::get('poll'))
                      <div><label class="rd-label">{{$a->source}}</label>&nbsp;-&nbsp;<label class="rd-label pull-right">{{$a->total}}</label></div>
                    @else
                      <div class="radio"><label><input type="radio" name="answer" value="{{$a->id}}"> {{$a->source}}</label></div>
                    @endif
                  @endforeach
                  </div>
                  @if(!Session::get('poll'))
                  <button class="btnPollSubmit btn btn-borders btn-default mr-xs mb-sm" type="button" onclick="submitpoll({{$poll->id}})">{{trans('resource.poll.givepoll')}}</button>
                  @endif
                </blockquote>
              @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">

    function submitpoll(poll_id){
      if($("[name=answer]").val() != undefined && $("[name=answer]").val() != null){
          $.post("/submitpoll", {'answer_id': $("[name=answer]:checked").val(), 'poll_id' : poll_id, '_token' : $("[name='_token']").val()}, function(data){
              $obj = "";
              $.each(data, function(i, v){
                  $obj += '<div><label class="rd-label">'+v.source+'</label>&nbsp;-&nbsp;<label class="rd-label pull-right" >'+v.total+'</label></div>';
              });
              $(".btnPollSubmit").remove();
              $("#poll-list").html($obj);
              refreshPollDashboard();
          });
      }
    }

    $(function () {
        refreshPollDashboard();
    });

    function refreshPollDashboard(){
      $.post("/pollInfo", {'_token' : $('[name="_token"]').val()}, function(data){


          var chartData = [];

          $.each(data, function(i, v){
              var tmpObj = {};
              tmpObj['name'] = v.source;
              tmpObj['value'] = v.total;
              console.log(tmpObj);
              chartData.push(tmpObj);
          });

          console.log(chartData);

          $("#pieChartContainerPoll").dxPieChart({
              dataSource: chartData,
              series: {
                  argumentField: 'name',
                  valueField: 'value',
                  type: 'doughnut',
                  label: {
                      visible: true,
                      connector: { visible: true },
                      format: {
                          type: 'largeNumber',
                          precision: 0
                      }
                  }
              },
              palette: 'Ocean',
              adaptiveLayout: {
                  width: 300
              },
              legend: {
                  horizontalAlignment: 'center',
                  verticalAlignment: 'bottom'
              }

          });



      });
    }
  </script>
@endsection
