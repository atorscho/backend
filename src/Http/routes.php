<?php

Route::group([
    'namespace' => 'Atorscho\Backend\Http\Controllers'
], function () {

    /**
     * Install Process
     */
    get('/backend/install.php', 'InstallerController@step1');

});
