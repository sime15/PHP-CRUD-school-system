
<!-- KOD ZA MAIN MENU-->
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <!-- 1 - heder -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- 2 - naslov u meniju -->
            <a class="navbar-brand" href="">Osnovno obrazovanje</a>
        </div>

        <!-- 3 - linkovi na stranice u meniju -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <? ($active_menu_item == 'ucenici') ? (print 'class="active"' and $menyUrl = "index.php" ): print ""; ?>><a href="index.php">Ucenici</a></li>
                <li <? ($active_menu_item == 'skole') ? (print 'class="active"' and $menyUrl = "skole.php" ): print ""; ?>><a href="skole.php">Skole</a></li>
                <li <? ($active_menu_item == 'statistika') ? (print 'class="active"' and $menyUrl = "statistika.php" ): print ""; ?>><a href="statistika.php">Statistika</a></li>
            </ul>

            <!-- 4 - search polje u meniju, dodat atribut id radi skrivanja ovog polja u fajlu statistika.php -->
            <ul class="nav navbar-nav navbar-right" id="hide-search-<?=$active_menu_item?>">
                <div class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control submitEnter" id="search-term-<?=$active_menu_item ?>" placeholder="Search" data-url="http://jpdesign.ba/sime_test/ucenici/<?=$menyUrl ?>" autocomplete="off" value="<?=$search_term; ?>">
                    </div>

                    <!-- 5 - dropdown meni kod pretrage -->
                    <div class="dropdown" id="search-results" style="display: none;">
                        <ul class="dropdown-menu" id="search-result-list" style="display: block;">

                        </ul>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>