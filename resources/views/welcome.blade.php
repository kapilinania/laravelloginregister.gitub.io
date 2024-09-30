<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #343a40;
        }
        button {
            margin: 5px;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Welcome to the Application</h1>

        <!-- Show Login and Register buttons if the user is not authenticated -->
        @guest
            <div class="text-center">
                <a href="{{ route('login') }}">
                    <button class="btn btn-primary">Login</button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="btn btn-success">Register</button>
                </a>
            </div>
        @endguest

        <!-- Display user list if logged in -->
        @auth
            <h2 class="text-center">User List</h2>
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            {{-- <td>{{ $user->id }}</td> --}}
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Logout Form -->
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        @endauth
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
