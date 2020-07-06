<div class="row">
@if(count($errors) > 0)
    <div class="text-center margin-bottom-20 center_div">
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('message'))
    <span class="text-center margin-bottom-20 center_div" style="color: green">
        {{Session::get('message')}}
    </span>
@endif
</div>
