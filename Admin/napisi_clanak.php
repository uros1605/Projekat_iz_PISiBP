<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Napiši članak</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <section> 
    <?php
    echo "<h2>$_SESSION[uloga]</h2>";
    include "menu.php";

    ?>
    <div class="main">
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label><strong>Naslov:</strong></label>
                    <input type="text" name="naslov" class="form-control">
                </div>
                <div class="mb-1">
                    <label><strong>Sadržaj</strong></label>
                    <textarea name="sadrzaj" id="mytextarea" class="form-control"></textarea><br>
                </div>
                <div class="d-flex justtify-content-center">
                    <input type="submit" name="submit" value="Pošalji na odobrenje"class="btn btn-success">
                    <a href="#"><button class="btn btn-secondary">Sačuvaj kao draft</button></a>
                </div>
            </form>
        </div>
    </div>
    
    </section>

    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'allychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'

            toolbar: 'undo redo | formatpainter casechange styleselect | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | allycheck code table help'
                 
        });
    </script>
</body>
</html>

<?php
}

else{
    header("location:index.php");
}