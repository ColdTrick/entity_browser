<?php
	$graphics = $vars['url'] . 'mod/entity_browser/graphics/';
	$accordion_img = $vars['url'] . 'mod/entity_browser/views/default/js/accordion/img/';
?>

.basic  {
	font-family: verdana;
	border: 1px solid black;
}
.basic div {
	background-color: #eee;
}

.basic p {
	margin-bottom : 10px;
	border: none;
	text-decoration: none;
	font-weight: bold;
	font-size: 10px;
	margin: 0px;
	padding: 10px;
}
.basic a.tab {
	cursor:pointer;
	display:block;
	padding:5px;
	margin-top: 0;
	text-decoration: none;
	font-weight: bold;
	font-size: 12px;
	color: black;
	background-color: #00a0c6;
	border-top: 1px solid #FFFFFF;
	border-bottom: 1px solid #999;
	
	background-image: url(<?php echo $accordion_img;?>AccordionTab0.gif);
}
.basic a.tab:hover {
	background-color: white;
	background-image: url(<?php echo $accordion_img;?>AccordionTab2.gif);
}
.basic a.tab.selected {
	color: black;
	background-color: #80cfe2;
	background-image: url(<?php echo $accordion_img;?>AccordionTab2.gif);
}

table#entity_browser_list_entities
{
	margin: 10px 0;
}

table#entity_browser_list_entities td
{
	padding: 0 0 0 8px;
	height: 26px;
	line-height: 26px;
}

table#entity_browser_list_entities td:hover
{
	background-color: #EEEEEE;
}

table#entity_browser_list_entities td a:hover
{
	text-decoration: none;
}

.entity_browser_search_entity_form
{
	width: 300px;
}

.entity_browser_search_entity_form input[type="text"]
{
	width: 150px;
}

#entity_browser_load_mask
{
	width: 1120px;
	height: auto;
	float: left;
	
	border: 1px #DDDDDD solid;
}

#entity_browser_sidebar
{
	width: 178px;
	
	float: left;
}

#entity_browser_sidebar_objects_tree
{
	border: 1px solid #DDDDDD;
    float: left;
    margin: 0 0 10px;
    overflow: auto;
    width: 158px;
}

#entity_browser_displayed_sidebar_properties_container
{
	float: left;
	margin: 10px 0 10px 0;
}

#entity_browser_sidebar_search_options, 
#entity_browser_sidebar_displayed_properties,
#entity_browser_displayed_sidebar_export
{
	width: 178px;
	float: left;
}

#entity_browser_displayed_properties
{
	height: 250px;
    overflow: auto;
    width: 158px;
}

#entity_browser_show_selected_properties,
#entity_browser_export_current_selection_csv
{
	cursor: pointer;
}

.entity_browser_container
{
	width: 1120px; 
	min-height: 400px; 
	
	max-height: 800px;
	float: right;
	overflow: auto;
}

table#entity_browser_list_entities
{
	margin: 0px;
}

.entity_browser_ajax_loading
{
	background-image: url(<?php echo $graphics; ?>ajax_loader.gif);
	background-position: 50% 50%;
	background-repeat: no-repeat;
}

#entity_browser_tooltip
{
	height: 100px;
	width: 100px;
	background-color: red;
	position: absolute;
	z-index: 999999;
	display: none;
	padding: 10px;
}

table#entity_browser_list_entities td a
{
	display: block;
	width: 100%;
	height: 100%;
}

span.empty
{
	color: #D1D1D1;
}

.tooltip 
{
	display:none;
	background-color: #ffffff;
	border: 2px #DDDDDD solid;
	font-size:12px;
	max-width: 300px;
	padding:10px;
	
	-moz-box-shadow: 0px 0px 8px #C8C6D2;
	-webkit-box-shadow: 0px 0px 8px #C8C6D2;
	box-shadow: 0px 0px 8px #C8C6D2;
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#C8C6D2')";
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#C8C6D2');
}

/* LOAD MASK */
.loadmask {
    z-index: 100;
    position: absolute;
    top:0;
    left:0;
    -moz-opacity: 0.5;
    opacity: .50;
    filter: alpha(opacity=50);
    background-color: #CCC;
    width: 100%;
    height: 100%;
    zoom: 1;
}
.loadmask-msg {
    z-index: 20001;
    position: absolute;
    top: 0;
    left: 0;
    border:1px solid #6593cf;
    background: #c3daf9;
    padding:2px;
    
    top:20px !important;
}
.loadmask-msg div {
    padding:5px 10px 5px 25px;
    background: #fbfbfb url('../images/loading.gif') no-repeat 5px 5px;
    line-height: 16px;
	border:1px solid #a3bad9;
    color:#222;
    font:normal 11px tahoma, arial, helvetica, sans-serif;
    cursor:wait;
    
}
.masked {
    overflow: hidden !important;
}
.masked-relative {
    position: relative !important;
}
.masked-hidden {
    visibility: hidden !important;
}