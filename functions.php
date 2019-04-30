<?php
/**
 * wpackio-repro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpackio-repro
 */

namespace AdamBrgmn\WPackioRepro;

use \WPackio\Enqueue;

require __DIR__ . '/vendor/autoload.php';

class Scripts
{
    public function __construct()
    {
        $this->enqueue = new \WPackio\Enqueue(
            'wpackioRepro',
            'dist',
            '1.0.0',
            'theme',
            false,
            'child'
        );

        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
    }

    public function enqueueScripts()
    {
        $this->enqueue->enqueue('app', 'main', []);
    }
}

new Scripts();

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});
