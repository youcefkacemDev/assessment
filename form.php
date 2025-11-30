<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form AJAX</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 350px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #4F46E5;
            box-shadow: 0 0 5px rgba(79, 70, 229, 0.3);
        }

        .btn {
            width: 100%;
            background: #4F46E5;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3b36c4;
        }
    </style>
</head>

<body>

    <section>
        <div class="form-container">
            <h2>Create User</h2>

            <form onsubmit="register(event)">
                <div class="input-group">
                    <label>Name</label>
                    <input id="name" type="text" name="name" placeholder="Enter your name" required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input id="email" type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn">Create Account</button>
            </form>
        </div>
    </section>

    <script>
        function register(event) {
            event.preventDefault();

            name = event.target['name'].value;
            email = event.target['email'].value;
            password = event.target['password'].value;

            var data = {
                "name": name,
                "email": email,
                "password": password
            };

            fetch("http://localhost:8000/UsersRequest.php/users", {
                    method: "POST",
                    body: JSON.stringify(data)
                })
                .then(function(response) {
                    const result = response.json();

                    if (response.ok) {
                        alert('user created successfully');
                        event.target['name'].value = '';
                        event.target['email'].value = '';
                        event.target['password'].value = '';
                    }
                    else{
                        alert('error ' + result.message);
                    }
                })
                .catch(error => {
                    alert('connection failed ' + error.message);
                });
        }
    </script>

    <?php

    ?>
</body>

</html>