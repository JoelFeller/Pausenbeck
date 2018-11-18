<!-- als Kunde angemeldet -->
<?php if($user->admin == 0): ?>
    <div class="row">
        <div id="owl-example" class="owl-carousel">
            <div class="text-center item">
                <?php if(!isset($_SESSION['init']))$_SESSION['bestellteAnzahl'] = array(); ?>
                <?php if(!isset($_SESSION['init']))$_SESSION['bestellteWare'] = array(); ?>
                <?php $counter = 0; ?>
                <?php foreach ($angebote as $angebot): ?>
                    <?php if ($angebot->anzahl != 0): ?>
                        <?php if(!isset($_SESSION['init']))array_push($_SESSION['bestellteAnzahl'], 0); ?>
                        <?php if(!isset($_SESSION['init']))array_push($_SESSION['bestellteWare'], $angebot->name); ?>
                        <div class="col-md-4 projekte-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                            <article>
                                <br>
                                <header class="entry-header">
                                    <h2 class="entry-title"><?= $angebot->name; ?></h2>
                                </header>
                                <div class="entry-content">
                                    <P>Menge: <?= $angebot->anzahl; ?></P>
                                    <P>Preis: <?= $angebot->preis; ?></P>
                                    <?php if($angebot->anzahl == $_SESSION['bestellteAnzahl'][$counter]): ?><a class="btn btn-danger" href="">+</a>
                                    <?php else: ?> <a class="btn btn-primary" href="raiseBestellt?pos=<?=$counter?>">+</a> <?php endif; ?>
                                    <?php if($_SESSION['bestellteAnzahl'][$counter] == 0): ?><a class="btn btn-danger" href="">-</a>
                                    <?php else: ?> <a class="btn btn-primary" href="dropBestellt?pos=<?=$counter?>">-</a> <?php endif; ?>
                                    <?php $counter++; ?>
                                </div>
                                <br>
                            </article>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php $_SESSION['init'] = true; ?>
<?php endif; ?>
<!-- als Admin angemeldet -->
<?php if($user->admin == 1): ?>
    <div class="row">
        <div id="owl-example" class="owl-carousel">
            <div class="text-center item">
                <?php foreach ($angebote as $angebot): ?>
                    <div class="col-md-4 projekte-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <br>
                            <header class="entry-header">
                                <h2 class="entry-title"><?= $angebot->name; ?></h2>
                            </header>
                            <div class="entry-content">
                                <P>Menge: <?= $angebot->anzahl; ?></P>
                                <P>Preis: <?= $angebot->preis; ?></P>
                                <a class="btn btn-primary" href="raiseStock?aid=<?=$angebot->aid?>&anz=<?= $angebot->anzahl; ?>">+</a>
                                <?php if($angebot->anzahl == 0): ?><a class="btn btn-danger" href="">-</a>
                                <?php else: ?> <a class="btn btn-primary" href="dropStock?aid=<?=$angebot->aid?>&anz=<?= $angebot->anzahl; ?>">-</a> <?php endif; ?>
                            </div>
                            <br>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>