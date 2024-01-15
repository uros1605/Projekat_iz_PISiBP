<?php
include "klase.php";
if (isset($_SESSION["id_korisnika"])) {
    if (isset($_POST["draft"])) {
        $naslov = $_POST["naslov"];
        $sadrzaj = $_POST["sadrzaj"];
        $rubrika_id = $_POST["rubrika"];
        $datum_vreme = date("Y-m-d h:i:s");
        include "upload_slika.php";
        if ($uploadOk == 1) {
            $slika_url = "slike/" . htmlspecialchars(basename($_FILES["slika"]["name"]));
            $metode->sacuvajVest($_SESSION["id_korisnika"], $rubrika_id, $naslov, $sadrzaj, $datum_vreme, "draft", $slika_url);
            $potvrda = "Članak je sačuvan kao draft";
            $id_unete_vesti = $metode->getPoslednjaVest()["id_vesti"];
            $tagovi = $_POST["tagovi"];

            $tagovi_niz = explode(",", $tagovi);
            foreach ($tagovi_niz as $tag) {
                $metode->unesiTag($id_unete_vesti, trim($tag));
            }
        }
    }

    if (isset($_POST["submit"])) {
        $naslov = $_POST["naslov"];
        $sadrzaj = $_POST["sadrzaj"];
        $rubrika_id = $_POST["rubrika"];
        $datum_vreme = date("Y-m-d h:i:s");
        include "upload_slika.php";
        if ($uploadOk == 1) {
            $slika_url = "slike/" . htmlspecialchars(basename($_FILES["slika"]["name"]));
            $metode->sacuvajVest($_SESSION["id_korisnika"], $rubrika_id, $naslov, $sadrzaj, $datum_vreme, "odobrenje", $slika_url);
            $potvrda = "Članak je poslat na odobrenje";
            $id_unete_vesti = $metode->getPoslednjaVest()["id_vesti"];
            $tagovi = $_POST["tagovi"];

            $tagovi_niz = explode(",", $tagovi);
            foreach ($tagovi_niz as $tag) {
                $metode->unesiTag($id_unete_vesti, trim($tag));
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Napiši članak</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.tiny.cloud/1/3wrh81rf47kz5uhx860nh15rygis6s6puk10pm3qr4nuspua/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                    <?php
                    if (isset($potvrda)) {
                        echo "<h4>$potvrda</h4>";
                    }
                    ?>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label><strong>Glavna slika :</strong></label>
                            <input type="file" name="slika" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label><strong>Naslov:</strong></label>
                            <input type="text" name="naslov" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label><strong>Rubrika:</strong></label>
                            <select name="rubrika">
                                <?php
                                $novinar_rubrike = $metode->getNovinarRubrike($_SESSION["id_korisnika"]);
                                while ($rubrika_novinar = $novinar_rubrike->fetch_assoc()) {
                                    $rubrika_info = $metode->getRubrikaByID($rubrika_novinar["id_rubrike"]);
                                    echo "<option value=$rubrika_info[id_rubrike]>$rubrika_info[naziv]</option>";
                                }

                                ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label><strong>Sadržaj</strong></label>
                            <textarea name="sadrzaj" id="mytextarea" class="form-control"></textarea><br>
                        </div>
                        <div class="mb-3">
                            <label><strong>Tagovi:</strong></label>
                            <input type="text" name="tagovi" class="form-control">
                        </div>
                        <div class="d-flex justtify-content-center">
                            <input type="submit" name="submit" value="Pošalji na odobrenje" class="btn btn-success">
                            <input type="submit" name="draft" value="Sačuvaj kao draft" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>

        </section>

        <script>
            const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'upload.php');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status === 403) {
                        reject({
                            message: 'HTTP Error: ' + xhr.status,
                            remove: true
                        });
                        return;
                    }

                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    resolve(json.location);
                };

                xhr.onerror = () => {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            });

            tinymce.init({
                selector: '#mytextarea',
                plugins: [
                    'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                    'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                    'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | formatpainter casechange styleselect | bold italic backcolor | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
                // without images_upload_url set, Upload tab won't show up
                images_upload_url: 'upload.php',

                // override default upload handler to simulate successful upload
                images_upload_handler: image_upload_handler_callback


            });
        </script>
</body>
</html>

<?php
}

else{
    header("location:index.php");
}