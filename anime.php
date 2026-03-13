<?php
include("config.php");

$animeQuery = mysqli_query($conn, "SELECT * FROM videos WHERE category='anime' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Anime - MovieFlix</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dark">

<header class="navbar">
    <div class="logo">MovieFlix</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="movies.php">Movies</a>
        <a class="active" href="anime.php">Anime</a>
        <a href="series.php">Series</a>
    </nav>
    <form class="search-box">
        <input type="text" placeholder="Search movies, anime, series...">
    </form>
</header>

<section class="row">
    <h2>Anime</h2>
    <div class="cards">
        <?php while ($v = mysqli_fetch_assoc($animeQuery)) { ?>
            <a href="watch.php?id=<?= $v['id'] ?>" class="card">
                <img src="assets/<?= $v['thumbnail'] ?>">
                <p><?= htmlspecialchars($v['title']) ?></p>
            </a>
        <?php } ?>
    </div>
</section>

</body>
</html>
