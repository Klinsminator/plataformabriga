@if(count($errors) > 0)
    <div class="wrap-input100 validate-input">
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
