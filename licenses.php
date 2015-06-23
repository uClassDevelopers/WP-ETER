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

//Set connection to wpdb and needed variables
global $wpdb;
$table_name = $wpdb->prefix . 'eter_start';

//Insert updated content in to database
if(!empty($_POST)) {
    $wpdb->update( 
	$table_name, 
	array( 
		'row' => 'value1',	// integer (number) 
		'position' => 'value2',	// integer (number) 
		'title' => 'value2',	// string 
		'url' => 'value2',	// string 
		'image_url' => 'value2',	// string 
		'content' => 'value2',	// string 
		'is_dyn' => 'value2',	// integer (number) 
		'dyn_link' => 'value2'	// string  
	), 
	array( 'id' => $_POST["id"]), 
	array( 
		'%s',	// value 1... -> 8
		'%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%d',
        '%s'
	), 
	array( '%d' ) 
);
}
?>
<!-- GET daneden animate.css --> 
<link href="<? bloginfo('stylesheet_directory');?>/animate.min.css" rel="stylesheet"/>

<a class="animated zoomInDown" style="float: right; margin: 1%; color: #A0A0A0; text-decoration: none; font-weight: bold;" href="http://uclass.se/">
    Made by uClassDevs<img style="vertical-align: middle; height: 50px;" src="<? bloginfo('stylesheet_directory');?>/uclass_logo.png" alt="uClass Logo"/>
</a>
<div style="margin: 1%; clear: both;">
    <h1>ETER iOS Application Options</h1>
    <h1>| Startsida</h1>
    <div style="margin-left: 2%; ">
    <h2>Välj innehåll Bildkarusell</h2>
    <div style="text-align: center;">
        <div id="top_images" style="width: 90%; background: #FDFDFD none repeat scroll 0% 0%; box-shadow: 0px 1px 0px 0px #ADADAD; margin: 1.5%; padding: 2%; display: inline-block; text-align: left;">
            <?php foreach( $wpdb->get_results("SELECT * FROM `".$table_name."` WHERE row = 3 ;") as $key => $rows):
            // each column will be accessible by these
            $row= $rows->row;
            $position = $rows->position;
            $title = $rows->title;
            $url = $rows->url;
            $image_url = $rows->image_url;
            ?>
            <h3><?php echo $title; ?> | Rad: <?php echo $row; ?></h3>
            <li><img style="vertical-align: middle;" src="<?php echo $image_url; ?>" alt="Kunde inte ladda bilden"></li>
            <hr style="border: 1px solid #A0A0A0; margin: 1%;">
        </div>
    </div>
    <? endforeach; ?>
        
    <h2>Välj innehåll Rad 1</h2>
    <div style="text-align: center;" id="f_row">
        <?php foreach( $wpdb->get_results("SELECT * FROM `".$table_name."` WHERE row = 1 ;") as $key => $rows):
        // each column will be accessible by these
        $row= $rows->row;
        $position = $rows->position;
        $title = $rows->title;
        $url = $rows->url;
        $image_url = $rows->image_url;
        $content = $rows->content;
        $is_dyn = $rows->is_dyn;
        $dyn_link = $rows->dyn_link;
        ?>
    
            <div style="width:25%; margin: 1.5%; padding: 0.5%; background: #FDFDFD none repeat scroll 0% 0%; box-shadow: 0px 1px 0px 0px #ADADAD; display: inline-block; ">
                <h3>Title: <input type="text" value="<?php echo $title; ?>"></h3>
                <p>URL: <input type="text" value="<?php echo $url; ?>"></p>
                <p>Image url: <input type="text" value="<?php echo $image_url; ?>"></p>
                <p><span style="text-align: left;">Fritext:</span><br> <textarea></textarea></p>
            </div>
        <? endforeach; ?>
    </div>
    <h2>Välj innehåll Rad 2</h2>
    <div style="text-align: center;" id="s_row">
                <?php foreach( $wpdb->get_results("SELECT * FROM `".$table_name."` WHERE row = 2 ;") as $key => $rows):
        // each column will be accessible by these
        $row= $rows->row;
        $position = $rows->position;
        $title = $rows->title;
        $url = $rows->url;
        $image_url = $rows->image_url;
        $content = $rows->content;
        $is_dyn = $rows->is_dyn;
        $dyn_link = $rows->dyn_link;
        ?>
    
            <div style="width:25%; margin: 1.5%; padding: 0.5%; background: #FDFDFD none repeat scroll 0% 0%; box-shadow: 0px 1px 0px 0px #ADADAD; display: inline-block; ">
                <h3>Title: <input type="text" value="<?php echo $title; ?>"></h3>
                <p>URL: <input type="text" value="<?php echo $url; ?>"></p>
                <p>Image url: <input type="text" value="<?php echo $image_url; ?>"></p>
                <p><span style="text-align: left;">Fritext:</span><br> <textarea></textarea></p>
            </div>
        <? endforeach; ?>

    </div>
        <input type="submit" value="Spara ändringar" class="button action">
</div>
</div>