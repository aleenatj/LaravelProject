<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Body Fitness</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../front-assets/images/fitness.jpg');
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 50px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: rgb(224, 70, 9);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        /* .btn-login:hover {
            background-color: rgb(224, 70, 9) ;
        } */
        .btn-register {
            text-align: center;
            margin-top: 20px;
            color: white;
        }
        .btn-register a {
            color: grey;
            text-decoration: none;
        }
     
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>ONLYAPPROVED</h2>
            <form action="{{route('customer.authenticate')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-login">Login</button><br><br>
                <a href="{{route('google-auth')}}" class="btn btn-google btn-user btn-block text-primary">
            <i class="fa-brands fa-google"></i><span> </span>Login with Google
            </a>
            </form>
            <div class="btn-register">
                <p class="account">Don't have an account? <a href="{{route('customer.register')}}">Register</a></p>
            </div>
            
        </div>
    </div>
</body>
</html>
