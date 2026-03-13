<?php
include("admin_layout.php");
include("../config.php");

$result = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC");
?>

<h1>Manage Videos</h1>

<a href="upload.php" class="btn"> Upload Video</a>
<a href="change_password.php" class="btn btn-secondary">🔒 Change Password</a>

<table>
<tr>
    <th>Title</th>
    <th>Category</th>
    <th>Actions</th>
</tr>

<?php while ($v = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= htmlspecialchars($v['title']) ?></td>
    <td><?= htmlspecialchars($v['category']) ?></td>
    <td class="actions">
        <a href="edit_video.php?id=<?= $v['id'] ?>">Edit</a>
        <a href="delete_video.php?id=<?= $v['id'] ?>" 
           onclick="return confirm('Delete this video?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

</div>
</div>
</body>
</html>
