@extends("layouts.base")

@section("content")
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                @yield("title")
                @yield("button")
            </div>
        </div>
        <div class="card-body">
            @yield("settings-content")
        </div>
    </div>
@endsection
