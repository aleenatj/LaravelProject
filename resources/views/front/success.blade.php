<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Successful</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 100px;
      text-align: center;
    }
    .success-icon {
      color: #28a745;
      font-size: 100px;
    }
    #buttons{
        background-color: rgb(224, 70, 9) ;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="success-icon">
    <i class="fas fa-check-circle"></i>
  </div>
  <h1>Your Order Was Successful!</h1>
  <p>Thank you for your purchase.</p>
  <a href="{{route('front.home')}}" class="btn btn-primary" id="buttons">Continue Shopping</a>
</div>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
