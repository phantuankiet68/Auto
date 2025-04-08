<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nature Login Form</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="container">
  <div class="login-box">
    <h2>Login</h2>

    <form>
      <div class="input-box">
        <input type="email" required>
        <label>Email</label>
      </div>

      <div class="input-box">
        <input type="password" required>
        <label>Password</label>
      </div>

      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</div>

</body>
</html>
