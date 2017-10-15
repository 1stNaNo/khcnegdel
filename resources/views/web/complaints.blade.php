@extends('layouts.main.main_noslide')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" id="complaintsSuccess">
      {{trans('resource.saved')}}
    </div>
  @endif
  {{-- <div class="alert alert-danger hidden" id="complaintsError">
    <strong>Error!</strong> There was an error sending your message.
  </div> --}}

  <h2 class="mb-sm mt-sm">{{trans('resource.sendComplaints')}}</h2>
  <form id="complaintsForm" action="/svcomplaints" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          <label>{{trans('resource.name')}} *</label>
          <input type="text" value="" data-msg-required="{{trans('resource.enterName')}}" maxlength="100" class="form-control" name="name" id="name" required>
        </div>
        <div class="col-md-6">
          <label>{{trans('resource.email')}} *</label>
          <input type="email" value="" data-msg-required="{{trans('resource.enterEmail')}}" data-msg-email="{{trans('resource.enterEmail')}}" maxlength="100" class="form-control" name="email" id="email" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <div class="col-md-12">
          <label>{{trans('resource.complaints')}} *</label>
          <textarea maxlength="5000" data-msg-required="{{trans('resource.enterComplaints')}}" rows="10" class="form-control" name="message" id="message" required></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="submit" value="{{trans('resource.post')}}" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
      </div>
    </div>
  </form>

  <script type="text/javascript">
  (function($) {

    'use strict';

    /*
    Contact Form: Basic
    */
    $('#complaintsForm:not([data-type=advanced])').validate({
      submitHandler: function(form) {

        var $form = $(form),
          $messageSuccess = $('#complaintsSuccess'),
          $messageError = $('#complaintsError'),
          $submitButton = $(this.submitButton);

        $submitButton.button('loading');

        // Ajax Submit
        $.ajax({
          type: 'POST',
          url: $form.attr('action'),
          data: {
            name: $form.find('#name').val(),
            email: $form.find('#email').val(),
            message: $form.find('#message').val()
          },
          dataType: 'json',
          complete: function(data) {

            if (typeof data.responseJSON === 'object') {
              if (data.responseJSON.response == 'success') {

                $messageSuccess.removeClass('hidden');
                $messageError.addClass('hidden');

                // Reset Form
                $form.find('.form-control')
                  .val('')
                  .blur()
                  .parent()
                  .removeClass('has-success')
                  .removeClass('has-error')
                  .find('label.error')
                  .remove();

                if (($messageSuccess.offset().top - 80) < $(window).scrollTop()) {
                  $('html, body').animate({
                    scrollTop: $messageSuccess.offset().top - 80
                  }, 300);
                }

                $submitButton.button('reset');

                return;

              }
            }

            $messageError.removeClass('hidden');
            $messageSuccess.addClass('hidden');

            if (($messageError.offset().top - 80) < $(window).scrollTop()) {
              $('html, body').animate({
                scrollTop: $messageError.offset().top - 80
              }, 300);
            }

            $form.find('.has-success')
              .removeClass('has-success');

            $submitButton.button('reset');

          }
        });
      }
    });
  });
  </script>

@endsection
