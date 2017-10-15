@extends('layouts.main.main_noslide')

@section('content')

<div class="blog-posts">

    <article class="post post-large">

      <div class="post-image">
        <span class="thumb-info thumb-info-hide-wrapper-bg">
          <span class="thumb-info-wrapper">
            <img class="img-responsive" src="{{$news->thumbnail}}" alt="">
          </span>
        </span>
      </div>

      <section class="page-header">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <h4 style="color: white; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;">{{$news->title}}</h4>
            </div>
          </div>
        </div>
      </section>

      <div class="post-content">
        <div class="post-meta">
          <span><i class="fa fa-comments"></i> {{$news->comment_count}}</span>
          <span><i class="fa fa-eye"></i> {{$news->views}}</span>
          <span><a href="/category/{{$news->cat_id}}" class="text-decoration-none"><i class="fa fa-tag"></i> {{$news->ca_title}}</a></span>
          <span class="pull-right"><i class="fa fa-calendar-check-o"></i> {{$news->insert_date}}</span>
        </div>
      </div>

      <hr class="tall">
      <!-- POST BODY -->
      <div class="post-content">
        {!!$news->source!!}
      </div>


      <!-- COMMENT START -->
      <div class="post-block post-comments clearfix">
        <h3 class="heading-primary"><i class="fa fa-comments"></i>Сэтгэгдэл ({{$news->comment_count}})</h3>

        <ul class="comments">
          @foreach($comments as $c)
          <li>
            <div class="comment">
              <div class="img-thumbnail">
                <img class="avatar" alt="" src="/img/avatar-2.jpg">
              </div>
              <div class="comment-block">
                <div class="comment-arrow"></div>
                <span class="comment-by">
                  <strong>{{$c->name}}</strong>
                </span>
                <p>{{$c->comment}}</p>
                <span class="date pull-right">{{$c->insert_date}}</span>
              </div>
            </div>
          </li>
          @endforeach
        </ul>

      </div>

      <!-- COMMENT END -->
      <!-- LEAVE COMMENT START-->
      <div class="post-block post-leave-comment">
        <h3 class="heading-primary">Сэтгэгдэл үлдээх</h3>

        <form action="/savecomment" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="post_id" value="{{$news->id}}"/>
          <div class="row">
            <div class="form-group">
              <div class="col-md-6">
                <label>Нэр *</label>
                <input type="text" value="" maxlength="100" class="form-control" name="name" id="name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-md-12">
                <label>Сэтгэгдэл *</label>
                <textarea maxlength="5000" rows="10" class="form-control" name="comment" id="comment"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input type="submit" value="Илгээх" class="btn btn-primary btn-lg" data-loading-text="Уншиж байна...">
            </div>
          </div>
        </form>
      </div>
      <!-- LEAVE COMMENT END -->

    </article>

</div>

@endsection
