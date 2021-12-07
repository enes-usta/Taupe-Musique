<?php
function CompteLayout()
{
    ?>
    <div style="padding-left:8px; padding-right:8px;">
        <?= isAdmin() ? '<a class="btn btn-default" href="'.parse_url('/Admin', PHP_URL_PATH) .'">Administration</a><br /><br />' : "" ?>
        <?= isLogged() ? '<a class="btn btn-default" href="'.parse_url('/Account', PHP_URL_PATH).'">Mon compte</a><br/><br/>' : '' ?>
    </div>
    <?php
}
