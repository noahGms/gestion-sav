@extends("layouts.base")

@section("content")
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-4 mb-0">
                <a class="text-dark text-decoration-none" href="{{route('customers.index')}}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span>Client n°{{$customer->id}} - {{$customer->fullname}}</span>
            </p>
        </div>
    </div>
@endsection
