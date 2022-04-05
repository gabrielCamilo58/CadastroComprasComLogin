@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $erro)
            <p>{{$erro}}</p>
        @endforeach
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-warning">
        <ul>
            <li>{{Session::get('message')}}</li>
        </ul>
    </div>
@endif