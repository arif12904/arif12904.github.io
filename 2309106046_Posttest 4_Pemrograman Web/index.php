<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posttest 4</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h2 class="logo">GETAS</h2>
        <nav>
            <div class="hamburger-menu" id="hamburgerMenu">
                <div class="strip"></div>
                <div class="strip"></div>
                <div class="strip"></div>
            </div>
            <div class="sidebar" id="sideBar">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="aboutme.html">About</a></li>
                    <li><a href="#product">Product</a></li>
                    <button id="toggleMode"><img src="asset/moon.png" alt="moon" id="toggleicon"</button>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="content">
            <h2 class="heading-content">Haaaa hari gini masih bingung cari tas?<br>Yuk temukan solusinya di <span>GETAS</span></h2>
            <p>Haaaaa! Bingung cari tas yang kece? Di GETAS, kami punya solusinya! Dari tas kekinian hingga tas formal, semua ada di sini. Yuk, temukan tas impianmu!</p>
            <button class="cta">BUY NOW</button>
        </div>
    </main>

    <section class="product" id="product">
        <h2>Our Product</h2>
        <div class="items">
            <div class="card">
                <img src="asset/tas_eiger.jpg" alt="" width="100px">
                <h4>Eiger Forlough</h4>
                <h5>RP444.320</h5>
                <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam ipsa minima fuga?</h6>
                <button>Buy Now</button>
            </div>

            <div class="card">
                <img src="asset/tory.webp" alt="" width="100px">
                <h4>Tory Burch Emerson</h4>
                <h5>RP2.800.000</h5>
                <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam ipsa minima fuga?</h6>
                <button>Buy Now</button>
            </div>

            <div class="card">
                <img src="asset/braun-buffel.jpg" alt="" width="100px">
                <h4>Braun Buffel</h4>
                <h5>RP530.000</h5>
                <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam ipsa minima fuga?</h6>
                <button>Buy Now</button>
            </div>
        </div>
        <h2 class="btn-show"><a href="#">Show More</a></h2>
    </section>

    <section class="form">
        <h3>Form Keluhan Pelanggan</h3>
        <form action="index.php" method="post">
            <label for="name">Nama</label><br>
            <input type="text" name="name" id="name" placeholder="Arif Septian" required><br>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="arifseptian@gmail.com" required><br>
            <label for="tel">No Telpon</label><br>
            <input type="tel" name="tel" id="tel" placeholder="+628140575288" required><br>
            <label for="keluhan">Keluhan</label><br>
            <textarea name="keluhan" id="keluhan" placeholder="Keluhan Anda" required></textarea><br>
            <button type="submit" value="submit" name="submit">Submit</button>
        </form>
    </section>

    <?php    
        if(isset($_POST["submit"]) && $_POST["submit"] == "submit"){ ?>
        <div class="modal-keluhan" id="modal">
            <div class="modal-content">
                <h2>Keluhan anda berhasil disampaikan</h2>
                <div class="check">✅</div>
                <div class="content-form">
                    <p>Nama: <?php echo(htmlspecialchars($_POST["name"]));?></p>
                    <p>Email: <?php echo(htmlspecialchars($_POST["email"]));?></p>
                    <p>No Telepon: <?php echo(htmlspecialchars($_POST["tel"]));?></p>
                    <p>Isi Keluhan: <?php echo(htmlspecialchars($_POST["keluhan"]));?></p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <footer>
        <h2>Copyright © 2024 GETAS</h2>
    </footer>

    <script src="script.js"></script>
</body>
</html>