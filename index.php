<?php
include("config.php");

// Featured video (latest upload)
$featuredQuery = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC LIMIT 1");
$featured = mysqli_fetch_assoc($featuredQuery);

// Latest uploads
$latestQuery = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC LIMIT 12");

// Movies section
$moviesQuery = mysqli_query($conn, "SELECT * FROM videos WHERE category='movie' ORDER BY id DESC LIMIT 12");

// Anime section
$animeQuery = mysqli_query($conn, "SELECT * FROM videos WHERE category='anime' ORDER BY id DESC LIMIT 12");

// Series section
$seriesQuery = mysqli_query($conn, "SELECT * FROM videos WHERE category='series' ORDER BY id DESC LIMIT 12");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MovieFlix</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dark">

<header class="navbar">
    <div class="logo">MovieFlix</div>
    <nav>
        <a class="active" href="index.php">Home</a>
        <a href="movies.php">Movies</a>
        <a href="anime.php">Anime</a>
        <a href="series.php">Series</a>
    </nav>
    <form class="search-box">
        <input type="text" placeholder="Search movies, anime, series...">
    </form>
</header>

<?php if ($featured) { ?>
<section class="hero" style="background-image:url('assets/<?= $featured['thumbnail'] ?>')">
    <div class="hero-overlay">
        <h1><?= htmlspecialchars($featured['title']) ?></h1>
        <p>This is where a featured movie or show would go!</p>
        <div class="hero-buttons">
            <a href="watch.php?id=<?= $featured['id'] ?>" class="btn play">▶ Play</a>
            <a href="watch.php?id=<?= $featured['id'] ?>" class="btn info">More Info</a>
        </div>
    </div>
</section>
<?php } ?>

<section class="row">
    <h2>Latest Uploads</h2>
    <div class="cards">
        <?php while ($v = mysqli_fetch_assoc($latestQuery)) { ?>
            <a href="watch.php?id=<?= $v['id'] ?>" class="card">
                <img src="assets/<?= $v['thumbnail'] ?>">
                <p><?= htmlspecialchars($v['title']) ?></p>
            </a>
        <?php } ?>
    </div>
</section>

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

<section class="row">
    <h2>Series</h2>
    <div class="cards">
        <?php while ($v = mysqli_fetch_assoc($seriesQuery)) { ?>
            <a href="watch.php?id=<?= $v['id'] ?>" class="card">
                <img src="assets/<?= $v['thumbnail'] ?>">
                <p><?= htmlspecialchars($v['title']) ?></p>
            </a>
        <?php } ?>
    </div>
</section>

</body>
</html>
