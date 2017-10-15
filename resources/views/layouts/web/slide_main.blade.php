<div class="slider-container rev_slider_wrapper" style="height: 550px; margin-top: -89px;">
  <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 800, "gridheight": 550}'>
    <ul>
      @foreach($slidernews as $sn)
        <li data-transition="fade">

          <img src="{{$sn->thumbnail}}"
            alt=""
            data-bgposition="center center"
            data-bgfit="cover"
            data-bgrepeat="no-repeat"
            class="rev-slidebg">

          <a href="/post/{{$sn->id}}">
            <div class="tp-caption top-label"
              data-x="center" data-hoffset="0"
              data-y="bottom" data-voffset="+85"
              data-start="300"
              style="z-index: 5;
                     min-width: 800px;
                     max-width: 800px;
                     white-space: normal;
                     font-size: 16px;
                     line-height: 22px;
                     font-weight: 400;
                     background: rgba(255, 255, 255, 0.7);
                     color: #2e2e2e;
                     text-align:center;
                     padding : 10px;
                     width:100% !important;"
              data-transform_in="y:[-300%];opacity:0;s:500;">{{$sn->title}}
            </div>
          </a>

        </li>
      @endforeach
    </ul>
  </div>
</div>
