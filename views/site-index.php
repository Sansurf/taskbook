<h1>Tasks</h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Task #</th>
        <th scope="col">Title</th>
        <th scope="col">Text</th>
        <th scope="col">Status</th>
        <th scope="col">User Name</th>
        <th scope="col">User Email</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($vars as $array): ?>
    <tr>
        <th scope="row"><?= $array['id'] ?></th>
        <td><?= $array['title'] ?></td>
        <td><?= $array['content'] ?></td>
        <td><?= (!$array['status']) ? 'New' : 'Done' ?></td>
        <td><?= $array['name'] ?></td>
        <td><?= $array['email'] ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

