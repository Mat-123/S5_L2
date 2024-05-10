<?php
require_once __DIR__ . '/includes/header.php';

if (isset($_COOKIE['language'])) {
    $language = $_COOKIE['language'];
} else {
    $language = 'it';
}

$sql = "SELECT title_$language AS title, content_$language AS content FROM db_news";

$stmt = $pdo->prepare($sql);
$stmt->execute();

?>

<div class="row">
    <?php
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                        <p class="card-text"><?php echo $row["content"]; ?></p>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "Nessun contenuto trovato.";
    }
    ?>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
