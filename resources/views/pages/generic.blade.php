@extends('layouts.app')
@section('title', $page->title)
@section('meta_description', $page->meta_description_en)
@section('content')
@include('partials.page-banner', ['title' => $page->title])
<section class="section-pad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-muted fs-5">{!! nl2br(e($page->content)) !!}</div>
            </div>
        </div>
    </div>
</section>
@endsection
