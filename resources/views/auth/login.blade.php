<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-container {
            max-width: 400px;
            margin: 50px auto;
        }
        .card-body {
            padding: 2rem;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">Login</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('auth.handle') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="action" value="login" class="btn btn-primary">Login</button>
                        <button type="submit" name="action" value="register" class="btn btn-secondary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
