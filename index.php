<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Mailer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .alert-container {
            margin-bottom: 20px;
            width: 400px;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="container mt-3 d-flex justify-content-center align-items-center">
        <?php
        if (isset($_SESSION["type"]) && ($_SESSION["type"] == "success" || $_SESSION["type"] == "danger")) {
            $alertClass = ($_SESSION["type"] == "success") ? "alert-success" : "alert-danger";
            echo '<div class="alert ' . $alertClass . ' alert-container d-flex">';
            echo $_SESSION["message"];
            echo '</div>';

            // Clear the session variables
            unset($_SESSION["type"]);
            unset($_SESSION["message"]);
        }
        ?>
    </div> 

    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-6">
            <form action="islem.php" method="post" enctype="multipart/form-data"> <!-- Corrected enctype attribute -->
                    <div class="form-group">
                        <label for="receiverEmail">Alıcı Email Addres</label>
                        <input type="email" class="form-control" name="receiverEmail" id="receiverEmail" aria-describedby="emailHelp" placeholder="Alıcı Email Adres">
                    </div>
                    <div class="form-group">
                        <label for="senderEmail">Gönderenin Email Adresi</label>
                        <input type="email" class="form-control" name="senderEmail" id="senderEmail" aria-describedby="emailHelp" placeholder="Gönderen Email Adres">
                    </div>
                    <div class="form-group">
                        <label for="topicEmail">Email Konusu</label>
                        <input type="text" class="form-control" name="topicEmail" id="topicEmail" aria-describedby="emailHelp" placeholder="Email Konusu">
                    </div>
                    <div class="form-group">
                        <label for="message">Mesaj</label>
                        <textarea type="text" class="form-control" name="message" id="message" aria-describedby="emailHelp" placeholder="Mesaj"></textarea>
                    </div>
                    <div>
                    <label for="formFileLg" class="form-label">Dosya</label>
                    <input class="form-control form-control-lg mb-5" name="file" style="width: 300px;" type="file">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Gönder</button>
                    <button type="delete" class="btn btn-danger" id="deleteButton">Sil</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
