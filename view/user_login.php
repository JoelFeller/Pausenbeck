<div id="user-create">
    <?php
    $form = new Form('/user/dologin');
    echo $form->text()->label('Email')->name('email');
    echo $form->password()->label('Passwort')->name('password');
    echo $form->submit()->label('login')->name('submit');
    $form->end();
    ?>
</div>