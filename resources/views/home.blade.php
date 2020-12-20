@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
      @if(Auth::user()->account_type == "professional")
        @include('professional.index')
      @else
        @include('client.index', [
        'main_categories' => $main_categories
        ])
      @endif
    </div>
</div>
@endsection
