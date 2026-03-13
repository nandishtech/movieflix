<?php
include("config.php");

if (!isset($_GET['q']) || trim($_GET['q']) === "") {
    die("No search query");
}

$q = mysqli_real_escape_string($conn, $_GET['q']);

$sql = "SELECT * FROM videos WHERE title LIKE '%$q%' OR category LIKE '%$q%'";
$result = mysqli_query($conn, $sql);

function getThumbnail($thumb) {
    if (!$thumb || !file_exists("assets/".$thumb)) {
        return "assets/default.jpg";
    }
    return "assets/".$thumb;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Search - MovieFlix</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body class="dark">

<header class="navbar">
    <div class="logo">MovieFlix</div>
    <a href="index.php" style="color:white;">Home</a>
</header>

<section class="row">
<h2>Search results for "<?php echo htmlspecialchars($q); ?>"</h2>

<div class="cards">
<?php if (mysqli_num_rows($result) > 0) {
    while ($v = mysqli_fetch_assoc($result)) { ?>
    <a href="watch.php?id=<?php echo $v['id']; ?>" class="card">
        <div class="card-img">
            <img src="<?php echo getThumbnail($v['thumbnail']); ?>">
        </div>
        <div class="card-title"><?php echo htmlspecialchars($v['title']); ?></div>
    </a>
<?php } } else {
    echo "<p style='color:#aaa;padding:20px;'>No results found</p>";
} ?>
</div>
</section>

</body>
</html>
