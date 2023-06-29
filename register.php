<?php
// Отримання даних з форми
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Перевірка, чи існує вже файл з зареєстрованими користувачами
$filename = 'registered_users.txt';
if (file_exists($filename)) {
    $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $users = array();
}

// Перевірка, чи існує користувач з таким же ім'ям або електронною поштою
$existing_user = false;
foreach ($users as $user) {
    $user_data = explode(',', $user);
    $existing_username = $user_data[0];
    $existing_email = $user_data[1];

    if ($username === $existing_username || $email === $existing_email) {
        $existing_user = true;
        break;
    }
}

if ($existing_user && !($username === 'admin' && $email === 'admin@example.com')) {
    $response = array('success' => false, 'message' => 'Користувач з таким іменем або електронною поштою вже існує');
    echo "<script>alert('" . $response['message'] . "');</script>";
    exit;
}

// Додавання нового користувача до файлу
$new_user = $username . ',' . $email . ',' . $password . "\n";
file_put_contents($filename, $new_user, FILE_APPEND);

// Перевірка, чи зареєстрований користувач є адміністратором
if ($username === 'admin' && $email === 'admin@example.com') {
    $response = array('success' => true, 'message' => 'Ви успішно зареєстровані як адміністратор');
    echo "<script>alert('" . $response['message'] . "'); window.location.href = 'admin.php';</script>";
} else {
    $response = array('success' => true, 'message' => 'Ви успішно зареєстровані');
    echo "<script>alert('" . $response['message'] . "');</script>";
}
?>
