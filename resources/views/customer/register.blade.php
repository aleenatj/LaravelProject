<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Body Fitness</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-image: url('../front-assets/images/fitness.jpg'); */
            background-size: cover;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(247, 247, 247);
        }
        .register-container {
           max-width: 800px;
            margin: 0 auto;
            margin-top: 50px;
            background-color: rgb(41, 43, 44);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .register-container h2 {
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
        .btn-register {
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
        .btn-register:hover {
            background-color: rgb(224, 70, 9);
        }
        .btn-login {
            text-align: center;
            margin-top: 20px;
            color: white;
        }
        .btn-login a {
            color: grey;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2>Registration</h2>
            <form action="{{route('customer.processRegister')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="name" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-register">Register</button>
            </form>
            <div class="btn-login">
                <p class="account">Already have an account? <a href="{{route('customer.login')}}">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
