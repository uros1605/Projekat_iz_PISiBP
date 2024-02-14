<section class="wrapper_crno">
    <div class="container">
        <header class="header">
            <a href="index.php"><img src="slike/logo.png" alt="" style="height: 40px;"></a>
            <a href="admin/index.php" class="login"><i class="fa fa-user ikonica"></i><span>Ulogujte se</span></a>
            <ul>
                <li><a href="index.php">Naslovna</a></li>
                <?php
                $rubrike = $metode->getSveRubrike();
                while ($rubrika = $rubrike->fetch_assoc()) {
                    echo "<li><a href=rubrika.php?id_rubrike=$rubrika[id_rubrike]>$rubrika[naziv]</a></li>";
                }
                ?>
            </ul>
            <form action="search.php" method="post">
                <input type="search" name="search" placeholder="pretraga">
                <input type="date" name="datum">
                <input type="submit" name="submit" value="Pronađi vest">
            </form>
        </header>
    </div>
</section>