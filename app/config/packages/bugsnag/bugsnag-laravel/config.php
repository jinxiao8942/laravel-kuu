<?php 

return array(
    /**
     * Set your Bugsnag API Key.
     * You can find your API Key on your Bugsnag dashboard.
     */
    'api_key' => '3101dcac84c973812a90c61ee8c5edea',
    // 'api_key' => '',

    /**
     * Set which release stages should send notifications to Bugsnag
     * E.g: array('development', 'production')
     */
//    'notify_release_stages' => null,
    'notify_release_stages' => ['production', 'staging'],

);
