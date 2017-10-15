@extends('layouts.admin')

@section('content')
<div id="window_mapRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('Холбоо барих')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="mapRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ (!empty($contact)) ? $contact->id : '' }}"/>

                @foreach($langs as $lang)
                  <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('resource.address')}} {{$lang->lang_key}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="title[{{$lang->lang_key}}]" value="{{!empty($contactMany) ? $contactMany->whereIn('lang', $lang->lang_key)->first()->title : ''}}" />
                    </div>
                  </div>
                @endforeach

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.phone')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" class="" value="{{(!empty($contact->phone)) ? $contact->phone : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.email')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="email" class="" value="{{(!empty($contact->email)) ? $contact->email : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Өргөрөг')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="latitude" class="" value="{{(!empty($contact->lat)) ? $contact->lat : '47.918821'}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Уртраг')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="longitude" class="" value="{{(!empty($contact->long)) ? $contact->long : '106.917530'}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <div id="map" style="height: 400px;"></div>
                  </div>
                </div>

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="syscontact.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_mapRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
  <script type="text/javascript">
      $(document).ready(function(){

        $(".uselect2").select2();
        initMap();
      });

      var syscontact = {
        save: function(){
            $.ajax({
                url: '/admin/contact/save',
                type: "POST",
                dataType: "json",
                data : $("#mapRegister_form").serializeObject(),
                success: function(data){
                    if(data.type == 'success'){
                      umsg.success(messages.saved);
                    }else{
                      uvalidate.setErrors(data);
                    }
                }
            });
        }
      }

      var map;
      var cityCircle;

      function initMap() {
        var uluru = {lat: parseFloat($("#mapRegister_form [name='latitude']").val()), lng: parseFloat($("#mapRegister_form [name='longitude']").val())};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
        });

         cityCircle =  new google.maps.Circle();

        //  setCircle(map, uluru, $("#mapRadius").val());

        google.maps.event.addListener(marker, 'dragend', function (event) {
          $("#mapRegister_form [name='latitude']").val(this.getPosition().lat());
          $("#mapRegister_form [name='longitude']").val(this.getPosition().lng());

          
        });

        // $("#mapRadius").change(function(){
        //   setCircle(map, {lat: $("#mapRegister_form [name='latitude']").val(), lng: $("#mapRegister_form [name='longitude']").val()}, $("#mapRadius").val());
        // });
      }

      function setCircle(map, center, radius){

        if(radius == ""){
          radius = 0;
        }

        cityCircle.setOptions({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: center,
            radius: Math.sqrt(radius) * 100
        });
      }
  </script>
</div>
@endsection
