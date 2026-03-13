<?php
include("config.php");

$moviesQuery = mysqli_query($conn, "SELECT * FROM videos WHERE category='movie' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Movies - MovieFlix</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dark">

<header class="navbar">
    <div class="logo">MovieFlix</div>
    <nav>
        <a href="index.php">Home</a>
        <a class="active" href="movies.php">Movies</a>
        <a href="anime.php">Anime</a>
        <a href="series.php">Series</a>
    </nav>
    <form class="search-box">
        <input type="text" placeholder="Search movies, anime, series...">
    </form>
</header>

<section class="row">
    <h2>Movies</h2>
    <div class="cards">
        <?php while ($v = mysqli_fetch_assoc($moviesQuery)) { ?>
            <a href="watch.php?id=<?= $v['id'] ?>" class="card">
                <img src="assets/<?= $v['thumbnail'] ?>">
                <p><?= htmlspecialchars($v['title']) ?></p>
            </a>
        <?php } ?>
    </div>
</section>

</body>
</html>
