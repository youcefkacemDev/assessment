<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validateCSRFToken();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = saveUser($name, $email, $password);

    $successMessage = 'user ' . $name . ' created successfully ';
}

function validateCSRFToken()
{
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('invalid CSRF token');
    } else {
        return true;
    }
}

function connection()
{
    $dsn = "mysql:host=assessment-mysql-1;dbname=assessment;charset=utf8mb4";
    $username = "root";
    $password = "password";

    try {
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "connection failed: " . $e->getMessage();
    }

    return $connection;
}

function saveUser(string $name, string $email, string $password)
{
    $connection = connection();

    $sql = ("insert into users (name, email, password) values(:name, :email, :password);");

    $statement = $connection->prepare($sql);

    $statement->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    $result = ['message' => 'user inserted successfully'];

    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>csrf</title>
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

        .alert {
            padding: 12px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <section>
        <div class="form-container">
            <h2>Create User</h2>

            <?php if ($successMessage): ?>
                <div class="alert"><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
</body>

</html>