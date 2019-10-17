<h1>Admin page</h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Task #</th>
        <th scope="col">Title</th>
        <th scope="col">Text</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($vars as $array): ?>
        <tr>
            <th scope="row"><?= $array['id'] ?></th>
            <td><?= $array['title'] ?></td>
            <td><a href="?controller=Admin&action=edit&id=<?= $array['id'] ?>"><?= $array['content'] ?></a></td>
            <td><?= (!$array['status']) ? 'Done' : 'Edited by admin' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>