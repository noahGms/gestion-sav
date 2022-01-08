@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('items.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>I'item n°{{$item->id}}</span>
            </p>
            <a href="{{route('items.edit', $item)}}" class="btn btn-primary btn-md rounded-pill">
                <i class="fas fa-plus"></i> Modifier
            </a>
        </div>
    </div>
@endsection
