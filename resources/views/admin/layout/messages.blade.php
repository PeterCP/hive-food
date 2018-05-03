@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger c-font-24">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success c-font-24">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger c-font-24">
        {{session('error')}}
    </div>
@endif