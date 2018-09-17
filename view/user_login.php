<div id="user-create">
    <?php
    $form = new Form('/user/dologin');
    echo $form->text()->label('Benutzername')->name('username');
    echo $form->password()->label('Passwort')->name('password');
    echo $form->submit()->label('login')->name('submit');
    $form->end();
    ?>
</div>