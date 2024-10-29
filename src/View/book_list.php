<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book['id'] ?></td>
                <td><?= $book['title'] ?></td>
                <td><?= $book['author'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>