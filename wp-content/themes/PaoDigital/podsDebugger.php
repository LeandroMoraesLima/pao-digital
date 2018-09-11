<?php 

class podsDebugger {

    //display debug data in wordpress admin footer
    public static function initialize() {
        add_action('admin_footer', array('podsDebugger', 'display_debug_data'));
    }

    //function saving debug data to file
    public static function log_debug_data($data) {
        //create small file which will hold our data
        $handle = fopen(ABSPATH . '/podsdebug.log', 'a+');
        //write our data to that file
        fwrite($handle, '<pre>' . $data . '</pre>');
        fclose($handle);
    }

    //function displaying debug data
    public static function display_debug_data() {
        //echo file contants
        echo $dbg = file_get_contents(ABSPATH . '/podsdebug.log');
    // and erase file afterwards
        $handle = fopen(ABSPATH . '/debug.log', 'w');
        fclose($handle);
    }
}

?>