<?php
function eter_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'eter_dashboard_widget',         // Widget slug.
                 'ETER',         // Title.
                 'eter_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'eter_add_dashboard_widgets' );
function eter_dashboard_widget_function() {

	// Display whatever it is you want to show.
	echo "<p>Det går att dölja innehåll från appen eller webbsidan. Detta görs genom att byta innehållsredigerarens läge från visuell till text, och sedan innefatta innehållen för repsektive plattform inom en lämplig utav dessa: </p><code>&lt;div class='app'&gt; Innehåll &lt/div&gt;  &lt;div class='webb'&gt; Innehåll &lt/div&gt; </code>. <p>'app' visas bara i appen och 'webb' visas bara på webben.</p>";
}
add_action('admin_menu', 'addEterMenu');

function addEterMenu() {
    add_menu_page('Eter Mobile App Options', 'Eter Mobile App Options', 4, 'mobile-options', 'pluginMenu');
    add_submenu_page('mobile-options', 'Option1', 'Option1', 4, 'mobile-option-1', 'option1');
}

function pluginMenu() {
    include 'firstpage.php';
}

function option1() {
    echo "Option1";
}
?>