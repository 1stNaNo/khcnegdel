<footer id="footer" style="margin: 0; padding: 20px 20px 0 20px; background: #fff;">
  <div class="contactMap">
      <div id="googlemapsFullWidthInside" class="google-map mt-none mb-none" style="height: 280px;"></div>
  </div>
  <div class="contactText">
    <div style="width: 100%; height: 280px;">
      <h4 class="heading-primary">{{trans('resource.contact')}}</h4>
      <ul class="list list-icons list-icons-style-3 mt-xlg">
        <li><i class="fa fa-map-marker"></i> <strong>{{trans('resource.address')}}: </strong> {{$contact->title}}</li>
        <li><i class="fa fa-phone"></i> <strong>{{trans('resource.phone')}}: </strong> {{$contact->phone}}</li>
        <li><i class="fa fa-envelope"></i> <strong>{{trans('resource.email')}}: </strong> <a href="mailto:mail@example.com">{{$contact->email}}</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-copyright" style="margin: 0;">
    <div class="row">
      {{-- <div class="col-md-1">
        <a href="index.html" class="logo">
          <img alt="Porto Website Template" class="img-responsive" src="img/logo-footer.png">
        </a>
      </div> --}}
      <div class="col-md-12" style="height: 30px; padding: 20px 50px 50px; margin: 0;">
        <p>{{trans('resource.copyright')}}</p>
      </div>
    </div>
  </div>
</footer>
<script type="text/javascript">
$(function () {
    map = new google.maps.Map(document.getElementById('googlemapsFullWidthInside'), {
      zoom: 15,
      center: {
        lat: {{$contact->lat}},
        lng: {{$contact->long}}
      }
    });

    var marker = new google.maps.Marker({
      position: {
        lat: {{$contact->lat}},
        lng: {{$contact->long}}
      },
      map: map,
      animation: google.maps.Animation.DROP,
    });
});
</script>
<!-- Vendor -->

<!-- Theme Base, Components and Settings -->
<script src="/js/theme.js"></script>

<!-- Current Page Vendor and Views -->

<script src="/js/views/view.home.js"></script>

<!-- Theme Custom -->
<script src="/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/js/theme.init.js"></script>
