@extends("layouts.settings")

@section("title")
    <p class="fs-4 mb-0">
        <a class="text-dark text-decoration-none" href="{{route('states.index')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Modifier l'état n°{{$state->id}}</span>
    </p>
@endsection

@section("settings-content")
    <form action="{{route('states.update', $state)}}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{ old('name') ?? $state->name }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Couleur</label>
            <input class="form-control form-control-color @error('color') is-invalid @enderror" name="color" id="color" type="color"
                   value="{{ old('color') ?? $state->color }}"/>
            @error('color')
            <div class="invalid-feedback">
                {{ $errors->first('color') }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            @foreach($colors as $color)
                <span onclick="setColorFromAlreadyUsed('{{$color->color}}')" class="badge text-{{LightOrDarkColor::getTextColor($color->color)}}" style="background-color: {{$color->color}}; cursor: pointer;">
                    {{ $color->color }}
                </span>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection

<script>
    function setColorFromAlreadyUsed(color) {
        const input = document.getElementById('color')
        input.value = color
    }
</script>
