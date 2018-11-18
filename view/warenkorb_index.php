<div class="row">
    <div id="owl-example" class="owl-carousel">
        <div class="text-center item">
            <?php $counter = 0; ?>
            <?php foreach ($angebote as $angebot): ?>
                <?php if ($angebot->anzahl != 0): ?>
                    <?php if ($_SESSION['bestellteAnzahl'][$counter] != 0): ?>
                        <div class="col-md-4 projekte-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                            <article>
                                <br>
                                <header class="entry-header">
                                    <h2 class="entry-title"><?= $angebot->name; ?></h2>
                                </header>
                                <div class="entry-content">
                                    <P>Menge: <?= $_SESSION['bestellteAnzahl'][$counter]; ?></P>
                                    <?php if(!filter_var($angebot->preis*$_SESSION['bestellteAnzahl'][$counter], FILTER_VALIDATE_INT)): ?>
                                        <P>Preis: <?= $angebot->preis*$_SESSION['bestellteAnzahl'][$counter].'0'; ?></P>
                                    <?php else: ?>
                                        <P>Preis: <?= $angebot->preis*$_SESSION['bestellteAnzahl'][$counter].'.-'; ?></P>
                                    <?php endif; ?>
                                </div>
                                <br>
                            </article>
                        </div>
                    <?php endif; ?>
                    <?php $counter++ ?>
                <?php endif;?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<a class="btn btn-success" href="order">Bestellen</a>