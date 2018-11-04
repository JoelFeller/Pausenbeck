<!-- als Kunde angemeldet -->
<?php if($user->admin == 0): ?>
    <div class="row">
        <div id="owl-example" class="owl-carousel">
            <div class="text-center item">
                <?php foreach ($angebote as $angebot): ?>
                    <?php if ($angebot->anzahl != 0): ?>
                        <div class="col-md-4 projekte-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                            <article>
                                <br>
                                <header class="entry-header">
                                    <h2 class="entry-title"><?= $angebot->name; ?></h2>
                                </header>
                                <div class="entry-content">
                                    <P>Menge: <?= $angebot->anzahl; ?></P>
                                    <P>Preis: <?= $angebot->preis; ?></P>
                                    <a class="btn btn-primary" href="">+</a>
                                    <a class="btn btn-primary" href="">-</a>
                                </div>
                                <br>
                            </article>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
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
                                <a class="btn btn-primary" href="dropStock?aid=<?=$angebot->aid?>&anz=<?= $angebot->anzahl; ?>">-</a>
                            </div>
                            <br>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
