@extends('layouts.main.main_noslide')

@section('content')

<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 style="color:white;">{{$category->source}}</h3>
      </div>
    </div>
  </div>
</section>

<div class="blog-posts">

  @foreach($news as $n)

    <article class="post post-large">
      <a href="/post/{{$n->id}}" class="text-decoration-none block-link pt-md">
        <!-- <div class="post-content">
          <h2></h2>
        </div> -->
        <div class="post-image">
          <span class="thumb-info thumb-info-hide-wrapper-bg">
            <span class="thumb-info-wrapper">
              <img class="img-responsive" src="{{$n->thumbnail}}" alt="">
              <span class="thumb-info-title">
                <span class="thumb-info-inner">{{$n->title}}</span>
              </span>
            </span>
          </span>
        </div>
      </a>

      <div class="post-content">
        <div class="post-meta">
          <span><i class="fa fa-comments"></i> {{$n->comment_count}}</span>
          <span><i class="fa fa-eye"></i> {{$n->views}}</span>
          <span class="pull-right"><i class="fa fa-calendar-check-o"></i> {{$n->insert_date}}</span>
        </div>
      </div>
    </article>
  @endforeach

  <ul class="pagination pagination-md pull-right">
    @if ($news->lastPage() > 1)
      <li><a href="{{ ($news->currentPage() == 1) ? '#' : $news->url(1) }}">«</a></li>
      @for ($i = 1; $i <= $news->lastPage(); $i++)
        <li class="{{ ($news->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $news->url($i) }}">{{$i}}</a></li>
      @endfor
      <li><a href="{{ ($news->currentPage() == $news->lastPage()) ? ' #' : $news->url($news->currentPage()+1) }}">»</a></li>
    @else
      <li><a href="">«</a></li>
      <li class='active'><a href="">1</a></li>
      <li><a href="">»</a></li>
    @endif

  </ul>

</div>

@endsection
