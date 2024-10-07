<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('CSS/login.css')}}">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    @if(session('error'))
        
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>{{session('error')}}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
       
    @endif
<div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-5">
            <h1 class="text-center">TSS Consultancy Pvt.Ltd</h1>
                    <p class="text-center custom-text-color">Reset Password</p>
                <div class="shadow p-4">
                   
                    <form action="{{ url('/forgot-password') }}" method='post'>
                        @csrf
                        <!-- <div class="mb-3"> 
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="useremail" class="form-control" id="email" placeholder="email@domain.com" >
                            <span class="text-danger">
                                @error('useremail')
                                    {{$message}}
                                @enderror
                            </span>
                        </div> -->
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <label for="password"  class="form-label">Password</label>
                        </div>
                        <div class="mb-3 ">
                            <input type="password" name="userpassword" class="form-control" id="password" placeholder="Password" > 
                            <span class="text-danger">
                                @error('userpassword')
                                    {{$message}}
                                @enderror
                            </span> 
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <label for="confirmpassword"  class="form-label">Confirm Password</label>
                        </div>
                        <div class="mb-3 ">
                            <input type="confirmpassword" name="confirmuserpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password" > 
                            <span class="text-danger">
                                @error('confirmuserpassword')
                                    {{$message}}
                                @enderror
                            </span> 
                        </div>
                        <!-- <div class="mb-3  d-flex justify-content-end ">
                            <a href="forgot_password.html" class="text-decoration-none">Forgot Password?</a>
                        </div> -->
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                        <!-- <div class="text-center mt-3">
                            <a href="signup.php" class="text-decoration-none">Don't have an account?</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
