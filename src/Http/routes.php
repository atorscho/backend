<?php

Route::group([
    'namespace' => 'Atorscho\Backend\Http\Controllers'
], function () {

    /**
     * Install Process
     */
    get('/backend/install.php', ['uses' => 'InstallerController@step1']);
    //get('/backend/install.php', ['uses' => 'InstallerController@step2']);

});
