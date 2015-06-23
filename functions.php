<?php
/*
Copyright 2015 uClass Developers Daniel Holm & Adam Jacobs Feldstein

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

//Setup eter_start table in wpdb
global $eter_start_db_version;
$eter_start_db_version = '1.0'; //Set version of table

//Create the table and colums, also set correct formats on the columns
function eter_start_install() {
	global $wpdb;
	global $eter_start_db_version;

	$table_name = $wpdb->prefix . 'eter_start';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		row int NOT NULL,
        postion int NOT NULL,
		title tinytext NULL,
		url text NULL,
        image_url text NULL,
        content text NULL,
        is_dyn int NOT NULL,
        dyn_link text NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'eter_start_db_version', $eter_start_db_version );
}

//Populate the dtabase with startdata
function eter_start_install_data() {
	global $wpdb;
	
    $placeholder_row ='1';
	$placeholder_position = '1';
	$placeholder_title = 'ETER-iOS!';
    $placeholder_url ='#tab/guides';
    $placeholder_image_url = 'http://eter.rudbeck.info/wp-content/uploads/2014/05/ETER-logga_100_overstrykning.png';
    $placeholder_content = 'it is working';
    $placeholder_is_dyn ='0';
    $placeholder_dyn_link = '';
    
	
	$table_name = $wpdb->prefix . 'eter_start';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'row' => $placeholder_row, 
			'position' => $placeholder_position, 
			'title' => $placeholder_title, 
			'url' => $placeholder_url, 
			'image_url' => $placeholder_image_url, 
			'content' => $placeholder_content, 
			'is_dyn' => $placeholder_is_dyn, 
			'dyn_link' => $placeholder_dyn_link, 
		) 
	);
}
//Setup eter_start table in wpdb
global $eter_courses_slider_db_version;
$eter_courses_slider_db_version = '1.0'; //Set version of table

//Create the table and colums, also set correct formats on the columns
function eter_courses_slider_install() {
	global $wpdb;
	global $eter_courses_slider_db_version;

	$table_name = $wpdb->prefix . 'eter_courses_slider';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		row int NOT NULL,
        postion int NOT NULL,
		title tinytext NULL,
		url text NULL,
        image_url text NULL,
        content text NULL,
        is_dyn int NOT NULL,
        dyn_link text NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'eter_courses_slider_db_version', $eter_courses_slider_db_version );
}

//Populate the dtabase with startdata
function eter_courses_slider_install_data() {
	global $wpdb;
	
    $placeholder_row ='1';
	$placeholder_position = '1';
	$placeholder_title = 'ETER-iOS!';
    $placeholder_url ='#tab/guides';
    $placeholder_image_url = 'http://eter.rudbeck.info/wp-content/uploads/2014/05/ETER-logga_100_overstrykning.png';
    $placeholder_content = 'it is working';
    $placeholder_is_dyn ='0';
    $placeholder_dyn_link = '';
    
	
	$table_name = $wpdb->prefix . 'eter_courses_slider';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'row' => $placeholder_row, 
			'position' => $placeholder_position, 
			'title' => $placeholder_title, 
			'url' => $placeholder_url, 
			'image_url' => $placeholder_image_url, 
			'content' => $placeholder_content, 
			'is_dyn' => $placeholder_is_dyn, 
			'dyn_link' => $placeholder_dyn_link, 
		) 
	);
}
//Do the db setup after theme selection 'eter_courses_slider_install', 'eter_courses_slider_install_data'
add_action("after_switch_theme", 'eter_start_install', 'eter_courses_install_data');
add_action("after_switch_theme", 'eter_courses_slider_install', 'eter_courses_slider_install_data');

//Setup a widget on dashboard describing css display none classes
function eter_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'eter_dashboard_widget',         // Widget slug.
                 'ETER',         // Title.
                 'eter_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'eter_add_dashboard_widgets' );
function eter_dashboard_widget_function() {

// Display whatever you want to tell.
	echo "<p>Det går att dölja innehåll från appen eller webbsidan. Detta görs genom att byta innehållsredigerarens läge från visuell till text, och sedan innefatta innehållen för repsektive plattform inom en lämplig utav dessa: </p><code>&lt;div class='app'&gt; Innehåll &lt/div&gt;  &lt;div class='webb'&gt; Innehåll &lt/div&gt; </code>. <p>'app' visas bara i appen och 'webb' visas bara på webben.</p>";
}

// Sidebar Menu configuration
add_action('admin_menu', 'addEterMenu');
function addEterMenu() {
    add_menu_page('ETER iOS Mobile App Options', 'ETER iOS Mobile App Options', 0, 'eter-ios-mobile-options', 'eterMenu');
    add_submenu_page('eter-ios-mobile-options', 'ETER Startpage', 'ETER Startpage', 'manage_options', 'eter-ios-mobile-options' );
    add_submenu_page('eter-ios-mobile-options', 'ETER Courses', 'ETER Courses', 0, 'eter-courses', 'eterCourses' );
    add_submenu_page('eter-ios-mobile-options', 'ETER Licences', 'ETER Licences', 0, 'eter-Licences', 'eterLicences' );
}
function eterMenu() {
    include 'eter-options.php';
}
function eterCourses() {
    include 'eter-courses.php';
}
function eterLicences() {
	
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h1>Licence for WP-ETER</h1>';
        echo '<h3>Copyright 2015 uClass Developers Daniel Holm & Adam Jacobs Feldstein</h3>';
        echo'
        <p>
            Licensed under the Apache License, Version 2.0 (the "License");
            you may not use this file except in compliance with the License.
            You may obtain a copy of the License at
        </p>
        ';
    echo'
       <a href="http://www.apache.org/licenses/LICENSE-2.0">http://www.apache.org/licenses/LICENSE-2.0</a>
       ';
    echo'
        <p>
            Unless required by applicable law or agreed to in writing, software
            distributed under the License is distributed on an "AS IS" BASIS,
            WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
            See the License for the specific language governing permissions and
            limitations under the License.
        </p>';
    echo'
        <h1>Licences for included software</h1>
        <h3>jQuey</h3>
        <p>Copyright 2010, John Resig</p>
        <p>Dual licensed under the MIT or GPL Version 2 licenses.</p>
        <a href="http://jquery.org/license">http://jquery.org/license</a>      
    ';
    echo'
    <h3>daneden Animate.css</h3>
    <p>Animate.css is licensed under the MIT license. (<a href="http://opensource.org/licenses/MIT">http://opensource.org/licenses/MIT</a>)</p>
    <p>Browse source on github: <href="https://github.com/daneden/animate.css">daneden/animate.css
</a></p>
    ';
	echo '</div>';

}
//Remove comment when development/ testing
//$wpdb->show_errors(); 
?>