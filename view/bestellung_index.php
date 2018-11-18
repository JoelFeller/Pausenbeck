<!-- als Kunde angemeldet -->
<?php if($user->admin == 0): ?>
    <?php foreach ($bestellungen as $bestellung): ?>
        <?php if($bestellung->uid == $_SESSION['id']): ?>
            <div class="row">
                <div class="col-md-4 projekte-post blog-large wow fadeInLeft">
                    <article>
                        <?php if(!isset($previouscode))$previouscode = 18192; ?>
                        <?php if($bestellung->code != $previouscode): ?>
                            <h2 class="entry-title"><?= $bestellung->code; ?></h2>
                        <?php endif; ?>
                        <?php $previouscode = $bestellung->code; ?>
                        <P><?= $bestellung->anzahl; ?>
                        <?php foreach ($waren as $ware): ?>
                            <?php if($ware->aid == $bestellung->aid): ?>
                                <?= $ware->name; ?>
                                <?php if(!filter_var($ware->preis*$bestellung->anzahl, FILTER_VALIDATE_INT)): ?>
                                    für <?= $ware->preis*$bestellung->anzahl.'0 CHF'; ?></P>
                                <?php else: ?>
                                    für <?= $ware->preis*$bestellung->anzahl.'.- CHF'; ?></P>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </article>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
<!-- als Admin angemeldet -->
<?php if($user->admin == 1): ?>
    <?php foreach ($bestellungen as $bestellung): ?>
        <div class="row">
            <div class="col-md-4 projekte-post blog-large wow fadeInLeft">
                <article>
                    <?php if(!isset($previouscode))$previouscode = 18192; ?>
                    <?php if($bestellung->code != $previouscode): ?>
                        <h2 class="entry-title"><?= $bestellung->code; ?></h2>
                        <a class="btn btn-primary" href="deleteBestellung?code=<?=$bestellung->code?>">X</a>
                    <?php endif; ?>
                    <?php $previouscode = $bestellung->code; ?>
                    <P><?= $bestellung->anzahl; ?>
                        <?php foreach ($waren as $ware): ?>
                        <?php if($ware->aid == $bestellung->aid): ?>
                        <?= $ware->name; ?>
                        <?php if(!filter_var($ware->preis*$bestellung->anzahl, FILTER_VALIDATE_INT)): ?>
                        für <?= $ware->preis*$bestellung->anzahl.'0 CHF'; ?></P>
                <?php else: ?>
                    für <?= $ware->preis*$bestellung->anzahl.'.- CHF'; ?></P>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                </article>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
