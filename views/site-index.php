<h1>Tasks</h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Task #</th>
        <th scope="col">Title</th>
        <th scope="col">Text</th>
        <th scope="col"><a href="?orderby=status">Status</a></th>
        <th scope="col"><a href="?orderby=name">User Name</a></th>
        <th scope="col"><a href="?orderby=email">User Email</a></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($vars as $array): ?>
    <tr>
        <th scope="row"><?= $array['id'] ?></th>
        <td><?= $array['title'] ?></td>
        <td><?= $array['content'] ?></td>
        <td><?= (!$array['status']) ? 'Done' : 'Edited by admin' ?></td>
        <td><?= $array['name'] ?></td>
        <td><?= $array['email'] ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

