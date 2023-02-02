<form action="/users/store" method="POST">
    <input type="text" placeholder="name" name="name">
    <input type="email" placeholder="email" name="email" required>
    <input type="password" placeholder="password" name="password">
    <input type="submit" value="Registrar">
</form>

<table>
    <thead>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>password</th>
        <th>created_at</th>
        <th>updated_at</th>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['name']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['password']; ?></td>
            <td><?= $user['created_at']; ?></td>
            <td><?= $user['updated_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>