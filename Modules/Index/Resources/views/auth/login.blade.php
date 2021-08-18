@extends('HomePage.layout')

@section('content')

    <div class='row'>
        <div class="col-md-3"></div>
        <div class='col-md-6'>
    
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Log In
                </div>
                <div class="card-body">
                    @include('app.components.errors')
                    <form class="form"
                          method="POST"
                          action="{{ route('login') }}">
                        
                        {{ csrf_field() }}
            
                        <div class="form-group ">
                            <label for="email"
                                   class="col-md-4 control-label">E-Mail Address</label>
                
                                <input id="email"
                                       type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
            
                        <div class="form-group">
                            <label
                                    for="password"
                                    class="col-md-4 control-label">Password</label>
                
                                <input id="password"
                                       type="password"
                                       class="form-control"
                                       name="password"
                                       required>
                                
                        </div>
            
                        <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               name="remember"
                                                {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                        </div>
            
                        <div class="form-group">
                                <input type="submit"
                                       value="Log Me In"
                                       style="background-color: #046D8B !important; border-color: #046D8B !important;"
                                       class="btn btn-primary btn-lg">
                        </div>
                    <br>
                        <a class="btn btn-link" href="https://blueprint.malleyindustries.com/password/reset">
                                    Forgot Your Password? (redirects to Blueprint)
                                </a>
                    </form>
                </div>
            </div>
            
            
        </div>
        
        
        <div class="col-md-3"></div>
    </div>

    <br>



@endsection




