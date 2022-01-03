@extends("layouts.base")

@section("content")
    <p class="fs-4">
        <a class="text-dark text-decoration-none" href="{{route('types.index')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Modifier le type n°{{$type->id}}</span>
    </p>
    <form action="{{route('types.update', $type)}}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{ old('name') ?? $type->name }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select class="form-select @error('category_id') is-invalid @enderror" aria-label="Catégorie" id="category_id" name="category_id">
                @if(!$type->category)
                    <option value="" selected>Selectionner une catégorie</option>
                @endif
                @foreach($categories as $category)
                    <option @if(optional($type->category)->id === $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">
                {{ $errors->first('category_id') }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
