<?php
/**
 * WPackIO Repro
 *
 * @package     wpackioRepro
 * @author      Adam Bergman
 * @copyright   2019 Adam Bergman
 * @license     MIT
 *
 * @wordpress-plugin
 * Plugin Name: WPackIO Repro
 * Plugin URI:  https://github.com/adambrgmn/wpackio-repro
 * Description: Reporpduction of an issue with WPackIO
 * Version:     1.0.0
 * Author:      Adam Bergman
 * Author URI:  https://github.com/adambrgmn
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
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
            'plugin',
            __FILE__
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
