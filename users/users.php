<?php
/**
 * User: TheCodeholic
 * Date: 3/19/2019
 * Time: 9:27 AM
 */

function getUsers()
{
    return json_decode(file_get_contents(__DIR__ . '/users.json'), true);
}

function getUserById($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

function createUser($data)
{
    $users = getUsers();

    $data['id'] = rand(1000000, 2000000);

    $users[] = $data;

    putJson($users);

    return $data;
}

function updateUser($data, $id)
{
    $updateUser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateUser = array_merge($user, $data);
        }
    }

    putJson($users);

    return $updateUser;
}

function deleteUser($id)
{
    $users = getUsers();

    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            array_splice($users, $i, 1);
        }
    }

    putJson($users);
}

function uploadImage($file, $user)
{
    if (isset($_FILES['picture']) && $_FILES['picture']['name']) {
        if (!is_dir(__DIR__ . "/images")) {
            mkdir(__DIR__ . "/images");
        }
        // Get the file extension from the filename
        $fileName = $file['name'];
        // Search for the dot in the filename
        $dotPosition = strpos($fileName, '.');
        // Take the substring from the dot position till the end of the string
        $extension = substr($fileName, $dotPosition + 1);

        move_uploaded_file($file['tmp_name'], __DIR__ . "/images/{$user['id']}.{$extension}");

        $user['extension'] = $extension;
        updateUser($user, $user['id']);
    }
}

function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function validateUser($user, &$errors)
{
    $isValid = true;
    // Start of validation
    if (!$user['name']) {
        $isValid = false;
        $errors['name'] = 'El nombre es obligatorio';
    }
    if (!$user['username'] || strlen($user['username']) < 6 || strlen($user['username']) > 16) {
        $isValid = false;
        $errors['username'] = 'El usuario es requerido y debe tener entre 6 y 16 caracteres';
    }
    if (!empty($user['email']) && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'Debe ser una dirección de correo electrónico válida';
    }

    if (!empty($user['phone']) && !preg_match('/^[\d\s\-\+\(\)]+$/', $user['phone'])) {
        $isValid = false;
        $errors['phone'] = 'Este debe ser un número de teléfono válido';
    }
    // End Of validation

    return $isValid;
}
