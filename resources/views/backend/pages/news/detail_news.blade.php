@extends('backend.index')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0">
      <span class="text-muted fw-light">News /</span><span class="fw-medium"> Detail</span>
    </h4>
      <!-- Add Product -->

      <div class="row">
        <!-- First column-->
        <div class="col-12 col-lg-10">
            <div class="card mb-3">
            <img class="card-img-top w-100 h-px-600" src="{{ !empty($news->image)?asset($news->image):'https://via.placeholder.com/400x400&text=400x400'}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $news->title_en }}</h5>
                <p class="card-text">
                    {{ $news->description_en }}
                </p>
                <p class="card-text">
                <small class="text-muted">{{  $news->created_at->diffForHumans() }}</small>
                </p>
            </div>
            </div>
        </div>
      </div>
    </div>

@endsection
