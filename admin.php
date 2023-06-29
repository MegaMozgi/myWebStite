<?php
// Отримання списку зареєстрованих користувачів
$filename = 'registered_users.txt';
if (file_exists($filename)) {
    $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $users = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
            background-image: url(/images/back.jpg);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }
        
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        .name-column {
            width: 50%;
        }
        
        .email-column {
            width: 50%;
        }
    </style>
</head>
<body>
    <h1>Registered Users</h1>
    <table>
        <tr>
            <th class="name-column">Name</th>
            <th class="email-column">Email</th>
        </tr>
        <?php foreach ($users as $user) {
            $user_data = explode(',', $user);
            $username = $user_data[0];
            $email = $user_data[1];

            // Пропускаємо адміністратора
            if ($username === 'admin' && $email === 'admin@example.com') {
                continue;
            }
        ?>
        <tr>
            <td class="name-column"><?php echo $username; ?></td>
            <td class="email-column"><?php echo $email; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
