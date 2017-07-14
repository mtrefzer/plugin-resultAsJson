<?php
/**
 * Plugin resultAsJson for phpMussel.
 *
 * PLUGIN INFORMATION BEGIN
 *         Plugin Name: resultAsJson.
 *       Plugin Author: Michael Trefzer.
 *      Plugin Version: 1.0.1
 *    Download Address: https://github.com/mtrefzer/plugin-resultAsJson
 *     Min. Compatible: 1.0.0-DEV
 *     Max. Compatible: -
 *        Tested up to: 1.0.0-DEV
 *       Last Modified: 2017.07.13
 * PLUGIN INFORMATION END
 *
 * This plugin sends the detection data as JSON response.
 */
/**
 * Prevents direct access (the plugin should only be called from the phpMussel
 * plugin system).
 */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}
/** Fallback for missing "resultAsJson" configuration category. */
if (!isset($phpMussel['Config']['resultAsJson'])) {
    $phpMussel['Config']['resultAsJson'] = array();
}
/** Fallback for missing "use_json" configuration directive. */
if (!isset($phpMussel['Config']['resultAsJson']['use_json'])) {
    $phpMussel['Config']['resultAsJson']['use_json'] = false;
}
/** Fallback for missing "use_json_flag" configuration directive. */
if (!isset($phpMussel['Config']['resultAsJson']['use_json_flag'])) {
    $phpMussel['Config']['resultAsJson']['use_json_flag'] = '';
}
/**
 * Registers the `phpMussel_resultAsJson` closure to the `before_html_out`
 * hook.
 */
$phpMussel['Register_Hook']('phpMussel_resultAsJson', 'before_html_out');

/**
 * @return bool Returns always true, because only Headers are set and the html output is changed
 */
$phpMussel_resultAsJson = function () use (&$phpMussel) {
    if ($phpMussel['Config']['resultAsJson']['use_json'] &&
        (strlen($phpMussel['Config']['resultAsJson']['use_json_flag']) == 0
            || isset($_REQUEST[$phpMussel['Config']['resultAsJson']['use_json_flag']]))
    ) {
        $content = array('origin'           => $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                         'objects_scanned'  => $phpMussel['memCache']['objects_scanned'],
                         'detections_count' => $phpMussel['memCache']['detections_count'],
                         'scan_errors'      => $phpMussel['memCache']['scan_errors'],
                         'killdata'         => $phpMussel['killdata'],
                         'detections'       => trim($phpMussel['whyflagged']));

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        $phpMussel['HTML'] = json_encode($content);
    }
    return true;
};
