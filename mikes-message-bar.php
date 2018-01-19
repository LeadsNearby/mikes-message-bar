<?php
/* Plugin Name: Mikes Message Bar
Plugin URI: http://leadsnearby.com/
Description: Creates the most amazing fixed message bar in the world without slowing down your site.

Version: 2.0.5
Author: Michael Layao
Author URI: http://leadsnearby.com/
License: GPLv2 or later
*/

require_once( plugin_dir_path( __FILE__ ) . '/updater/github-updater.php' );

if ( is_admin() ) {
    new GitHubPluginUpdater( __FILE__, 'LeadsNearby', "mikes-message-bar" );
}
//Enqueue Font Awesome
function register_font_awesome() {
	wp_register_style( 'font_awesome', plugins_url( 'assets/css/font-awesome-4.7.0/css/font-awesome.min.css', __FILE__ ) );
	wp_enqueue_style( 'font_awesome' );
}

//Enqueue CSS
function load_custom_wp_admin_style($hook) {
        // Load only on ?page=mypluginname
        if($hook != 'toplevel_page_mikes-message-bar-options') {
                return;
        }
        wp_enqueue_style( 'mikes_message_bar_admin_css', plugins_url('assets/css/mikes-message-bar-admin.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

//Enqueue JS

function load_mikes_message_bar_js() {
        wp_enqueue_script( 'mikes_message_bar_js', plugins_url('mikes-message-bar.js', __FILE__) );
}
add_action( 'wp_footer', 'load_mikes_message_bar_js' );

//Include Titan Framework
require_once( 'titan-framework/titan-framework-embedder.php' );

add_action( 'tf_create_options', 'mikes_message_bar_options' );
	function mikes_message_bar_options() {
// Initialize Titan & options here
	$titan = TitanFramework::getInstance( 'mikes_message_bar' );
//Create Admin Panel
	$panel = $titan->createAdminPanel( array(
		'name' => 'Mikes Message Bar Options',
	) ); 


//Create Admin Options

    //GENERAL TAB
    
    $generalTab = $panel->createTab( array(
        'name' => 'General Settings',
    ) );
	$generalTab->createOption( array(
        'type' => 'custom',
        'custom' =>'<img id="big-mike" src="'.plugins_url( 'assets/img/Mike_200x200.png', __FILE__ ).'"><p>Welcome to the best message bar plugin on the planet! I pity those who don\'t use Mike\'s Message Bar. Let\'s get started with your general message bar settings below. </p>',
    ) );
	$generalTab->createOption( array(
		'name' => 'Static Bar Option',
		'id' => 'static_option',
		'type' => 'checkbox',
		'desc' => 'By default the bar appears on scroll. Checking this box will make the bar visible at all times.',
		'default' => false,
		) );
	$generalTab->createOption( array(
		'name' => 'Message Bar Z-Index',
		'id' => 'message_bar_z_index',
		'type' => 'text',
		'desc' => 'Choose the Z-Index',
		'default' => '9999999999999999',		
		) );
	$generalTab->createOption( array(
		'name' => 'Message Bar Background Color',
		'id' => 'message_bar_background_color',
		'type' => 'color',
		'desc' => 'Choose the background color for your message bar.',
		'default' => '#000',
		'alpha' => 'true',
		) ); 
	$generalTab->createOption( array(
		'name' => 'Message Bar Headline Font Size',
		'id' => 'message_bar_headline_font_size',
		'type' => 'text',
		'desc' => 'Choose the font size of your message bar text.',
		'default' => '20px',		
		) );
	$generalTab->createOption( array(
		'name' => 'Headline Color',
		'id' => 'message_bar_headline_color',
		'type' => 'color',
		'desc' => 'Choose the color of your message bar text.',
		'default' => '#fff',
		'alpha' => 'true',
		) ); 
	$generalTab->createOption( array(
		'name' => 'Headline Hover Color',
		'id' => 'message_bar_headline_hover',
		'type' => 'color',
		'desc' => 'Choose the color of your message bar text on hover.',
		'default' => '#fff',
		'alpha' => 'true',
		) );
	$generalTab->createOption( array(
		'name' => 'Font Awesome Icon Color',
		'id' => 'fa_icon_color',
		'type' => 'color',
		'desc' => 'Pick a color for your Font Awesome Icons.',
		'default' => '#fff',
		'alpha' => 'true',
	) );
	
	//LEFT CONTAINER TAB
	
	$leftTab = $panel->createTab( array(
        'name' => 'Left Container Options',
    ) );
    $leftTab->createOption( array(
        'type' => 'custom',
        'custom' =>'<img id="big-mike" src="'.plugins_url( 'assets/img/Mike_200x200.png', __FILE__ ).'"><p>Here is where you choose your options for the left message bar container.</p>',
    ) );
	$leftTab->createOption( array(
		'name' => 'Message Bar Left Headline',
		'id' => 'message_bar_left_headline',
		'type' => 'text',
		'desc' => 'Your Call to Action',
		'default' => '(919)758-8420'		
		) );
	$leftTab->createOption( array(
		'name' => 'Left Container Icon',
		'id' => 'left_container_icon',
		'type' => 'file',
		'desc' => 'Upload Your Icon (Optimal Dimensions:45 pixels x 45 pixels)',
	) );
	$leftTab->createOption( array(
		'name' => 'Left Container Font Awesome Icon',
		'id' => 'left_font_awesome_option',
		'type' => 'checkbox',
		'desc' => 'Click here to use a Font Awesome Icon.',
		'default' => true,
		) );
	$leftTab->createOption( array(
		'name' => 'Left Container Font Awesome Class',
		'id' => 'left_font_awesome_class',
		'type' => 'text',
		'desc' => 'Enter the class of the Font Awesome Icon you wish to use. Example:"fa-calendar". For the full list of icons click here -> <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>',
		'default' => 'fa-phone',		
	) );

	$leftTab->createOption( array(
		'name' => 'Left Container Link',
		'id' => 'left_container_link',
		'type' => 'text',
		'desc' => 'Button Link'	
		) );
	$leftTab->createOption( array(
		'name' => 'Left Container Apex Chat Option',
		'id' => 'left_apex_chat',
		'type' => 'checkbox',
		'desc' => 'Click here to use Apex Chat',
		'default' => false,
		) );
	$leftTab->createOption( array(
		'name' => 'Left Apex ID',
		'id' => 'left_apex_id',
		'type' => 'text',
		'desc' => 'Your Apex Chat ID',
		'default' => ''	
		) );
		
	//MIDDLE CONTAINER TAB
	
	$middleTab = $panel->createTab( array(
        'name' => 'Middle Container Options',
    ) );
    $middleTab->createOption( array(
        'type' => 'custom',
        'custom' =>'<img id="big-mike" src="'.plugins_url( 'assets/img/Mike_200x200.png', __FILE__ ).'"><p>Would you like to see the message bar in 3D? Well you can\'t. Here is where you choose your options for the middle message bar container.</p>',
    ) );
	$middleTab->createOption( array(
		'name' => 'Message Bar Middle Headline',
		'id' => 'message_bar_middle_headline',
		'type' => 'text',
		'desc' => 'Your Call to Action',
		'default' => 'Schedule Now'	
		) );

	$middleTab->createOption( array(
		'name' => 'Middle Container Icon',
		'id' => 'middle_container_icon',
		'type' => 'file',
		'desc' => 'Upload Your Icon (Optimal Dimensions:45 pixels x 45 pixels)',
	) );
	$middleTab->createOption( array(
		'name' => 'Middle Container Font Awesome Icon',
		'id' => 'middle_font_awesome_option',
		'type' => 'checkbox',
		'desc' => 'Click here to use a Font Awesome Icon.',
		'default' => true,
		) );
	$middleTab->createOption( array(
		'name' => 'Middle Container Font Awesome Class',
		'id' => 'middle_font_awesome_class',
		'type' => 'text',
		'desc' => 'Enter the class of the Font Awesome Icon you wish to use. Example:"fa-calendar". For the full list of icons click here -> <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>',
		'default' => 'fa-calendar',		
	) );
	$middleTab->createOption( array(
		'name' => 'Middle Container Link',
		'id' => 'middle_container_link',
		'type' => 'text',
		'desc' => 'Button Link'		
		) );
	$middleTab->createOption( array(
		'name' => 'Middle Container Apex Chat Option',
		'id' => 'middle_apex_chat',
		'type' => 'checkbox',
		'desc' => 'Click here to use Apex Chat',
		'default' => false,
		) );
	$middleTab->createOption( array(
		'name' => 'Middle Apex ID',
		'id' => 'middle_apex_id',
		'type' => 'text',
		'desc' => 'Your Apex Chat ID',
		'default' => ''	
		) );
		
	//RIGHT CONTAINER TAB
	
	$rightTab = $panel->createTab( array(
        'name' => 'Right Container Options',
    ) );
    $rightTab->createOption( array(
        'type' => 'custom',
        'custom' =>'<img id="big-mike" src="'.plugins_url( 'assets/img/Mike_200x200.png', __FILE__ ).'"><p>Would you like a baby unicorn? So would I. But, here is where you choose the options for your right message bar container.</p>',
    ) );
	$rightTab->createOption( array(
		'name' => 'Message Bar Right Headline',
		'id' => 'message_bar_right_headline',
		'type' => 'text',
		'desc' => 'Your Call to Action',
		'default' => 'Reviews'
		
		) );
	
	$rightTab->createOption( array(
		'name' => 'Right Container Icon',
		'id' => 'right_container_icon',
		'type' => 'file',
		'desc' => 'Upload Your Icon (Optimal Dimensions:45 pixels x 45 pixels)',
	) );
	$rightTab->createOption( array(
		'name' => 'Right Container Font Awesome Icon',
		'id' => 'right_font_awesome_option',
		'type' => 'checkbox',
		'desc' => 'Click here to use a Font Awesome Icon.',
		'default' => true,
		) );
	$rightTab->createOption( array(
		'name' => 'Right Container Font Awesome Class',
		'id' => 'right_font_awesome_class',
		'type' => 'text',
		'desc' => 'Enter the class of the Font Awesome Icon you wish to use. Example:"fa-calendar". For the full list of icons click here -> <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>',
		'default' => 'fa-star',		
	) );
	$rightTab->createOption( array(
		'name' => 'Right Container Link',
		'id' => 'right_container_link',
		'type' => 'text',
		'desc' => 'Button Link'		
		) );
	$rightTab->createOption( array(
		'name' => 'Right Container Apex Chat Option',
		'id' => 'right_apex_chat',
		'type' => 'checkbox',
		'desc' => 'Click here to use Apex Chat',
		'default' => false,
		) );
	$rightTab->createOption( array(
		'name' => 'Right Apex ID',
		'id' => 'right_apex_id',
		'type' => 'text',
		'desc' => 'Your Apex Chat ID',
		'default' => ''	
		) );
	$panel->createOption( array(
		'type' => 'save'
	) );



//Get Saved Options
	add_action( 'after_setup_theme', 'myFunction' );
		function myFunction() {
		$titan = TitanFramework::getInstance( 'my-theme' );
		$myTextOption = $titan->getOption( 'my_text_option' );
		$mySelectOption = $titan->getOption( 'my_select_option' );
		
		// Do stuff here
	}

//Create Bar
add_action( 'wp_footer', 'mikes_message_bar' );

function load_mikes_message_bar_style() {
        wp_enqueue_style( 'mikes_message_bar_css', plugins_url('mikes-message-bar.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'load_mikes_message_bar_style' );

function mikes_message_bar() {
$mikesbar = TitanFramework::getInstance( 'mikes_message_bar' );

//General Options
$bgcolor = $mikesbar->getOption( 'message_bar_background_color' );
$headlinefontsize = $mikesbar->getOption( 'message_bar_headline_font_size' );
$static = $mikesbar->getOption( 'static_option' );
$headlinecolor = $mikesbar->getOption( 'message_bar_headline_color');
$headlinehover = $mikesbar->getOption( 'message_bar_headline_hover');
$zindex = $mikesbar->getOption( 'message_bar_z_index');

	

//Left Options
$leftheadline = $mikesbar->getOption( 'message_bar_left_headline' );
$lefticon = $mikesbar->getOption( 'left_container_icon' );
$leftchat = $mikesbar->getOption( 'left_apex_chat' );
$leftchatid = $mikesbar->getOption( 'left_apex_id' );
$leftfaoption = $mikesbar->getOption( 'left_font_awesome_option');
$leftfaclass = $mikesbar->getOption( 'left_font_awesome_class');
if( wp_get_attachment_url( $lefticon ) ) {
	$lefticon = wp_get_attachment_url( $lefticon );
	} else {
	$lefticon = plugins_url('/assets/img/svg-bar-call.svg', __FILE__);
	}
$leftlink = $mikesbar->getOption( 'left_container_link' );
if( $leftlink ) {
	$leftlink_output = 'href="'.$leftlink.'"';
	} else {
	$leftlink_output = "onclick='event.preventDefault()'";	
	}


//Middle Options
$middleheadline = $mikesbar->getOption( 'message_bar_middle_headline' );
$middleicon = $mikesbar->getOption( 'middle_container_icon' );
$middlechat = $mikesbar->getOption( 'middle_apex_chat' );
$middlechatid = $mikesbar->getOption( 'middle_apex_id' );
$middlefaoption = $mikesbar->getOption( 'middle_font_awesome_option');
$middlefaclass = $mikesbar->getOption( 'middle_font_awesome_class');
if( wp_get_attachment_url( $middleicon ) ) {
	$middleicon = wp_get_attachment_url( $middleicon );
	} else {
	$middleicon = plugins_url('/assets/img/svg-bar-schedule.svg', __FILE__);
	}
$middlelink = $mikesbar->getOption( 'middle_container_link' );
if( $middlelink ) {
	$middlelink_output = 'href="'.$middlelink.'"';
	} else {
	$middlelink_output = "onclick='event.preventDefault()'";	
	}


//Right Options
$rightheadline = $mikesbar->getOption( 'message_bar_right_headline' );
$righticon = $mikesbar->getOption( 'right_container_icon' );
$rightchat = $mikesbar->getOption( 'right_apex_chat' );
$rightchatid = $mikesbar->getOption( 'right_apex_id' );
$rightfaoption = $mikesbar->getOption( 'right_font_awesome_option');
$rightfaclass = $mikesbar->getOption( 'right_font_awesome_class');
if( wp_get_attachment_url( $righticon ) ) {
	$righticon = wp_get_attachment_url( $righticon );
	} else {
	$righticon = plugins_url('/assets/img/svg-bar-reviews.svg', __FILE__);
	}
$rightlink = $mikesbar->getOption( 'right_container_link' );
if( $rightlink ) {
	$rightlink_output = 'href="'.$rightlink.'"';
	} else {
	$rightlink_output = "onclick='event.preventDefault()'";	
	}
	ob_start(); ?>

		<div id="mikes-message-bar" class="<?php if($static == true) { ?> static <?php } ?>"style="background-color:<?php echo $bgcolor; ?>; z-index:<?php echo $zindex; ?>">
			<div id="message-bar-inner-container">
				<div id="left-bar-container" style="border-right:1px solid <?php echo $headlinecolor; ?>">
					<?php if($leftchat == true) { ?>
						<a id="message-button-left" style="color:<?php echo $headlinecolor; ?>; --headline-hover:<?php echo $headlinehover; ?>; " target="blank" onclick="window.open('http://www.leadsnearbychat.com/pages/chat.aspx?companyId=<?php echo $leftchatid; ?>&amp;requestedAgentId=25&originalReferrer='+document.referrer+'&referrer='+window.location.href,'','width=500,height=600');" class="container-link" href=""><?php if($leftfaoption == true) { ?><i class="fa-icon fa <?php echo $leftfaclass; ?>" style="width:45px; font-size:40px" aria-hidden="true"></i><?php } else { ?><span class="left-icon"><img width="45px" height="45px" src="<?php echo $lefticon; ?>"></span> <?php } ?>
					<span class="message-bar-left-headline" style="font-size:<?php echo $headlinefontsize; ?>; color:<?php echo $leftheadlinecolor; ?>"><?php echo $leftheadline; ?></span></a> <?php } else { ?>
	 
					<a id="message-button-left" style="color:<?php echo $headlinecolor; ?>; --headline-hover:<?php echo $headlinehover; ?>; "  class="container-link" <?php echo $leftlink_output; ?>><?php if($leftfaoption == true) { ?><i class="fa-icon fa <?php echo $leftfaclass; ?>" aria-hidden="true"></i><?php } else { ?><span class="left-icon"><img width="45px" height="45px" src="<?php echo $lefticon; ?>"></span> <?php } ?>
					<span class="message-bar-left-headline" style="font-size:<?php echo $headlinefontsize; ?>; color:<?php echo $leftheadlinecolor; ?>"><?php echo $leftheadline; ?></span></a>
	<?php } ?>
				</div>
				<div id="middle-bar-container" style="border-right:1px solid <?php echo $headlinecolor; ?>">
					<?php if($middlechat == true) { ?>
						<a id="message-button-middle" style="color:<?php echo $headlinecolor; ?>; --headline-hover:<?php echo $headlinehover; ?>; " target="blank" onclick="window.open('http://www.leadsnearbychat.com/pages/chat.aspx?companyId=<?php echo $middlechatid; ?>&amp;requestedAgentId=25&originalReferrer='+document.referrer+'&referrer='+window.location.href,'','width=500,height=600');" class="container-link" href=""><?php if($middlefaoption == true) { ?><i class="fa-icon fa <?php echo $middlefaclass; ?>" style="width:45px; font-size:40px" aria-hidden="true"></i><?php } else { ?><span class="middle-icon"><img width="45px" height="45px" src="<?php echo $middleicon; ?>"></span> <?php } ?>
					<span class="message-bar-middle-headline" style="font-size:<?php echo $headlinefontsize; ?>; color:<?php echo $middleheadlinecolor; ?>"><?php echo $middleheadline; ?></span></a> <?php } else { ?>
	 
					<a id="message-button-middle" style="color:<?php echo $headlinecolor; ?>; --headline-hover:<?php echo $headlinehover; ?>; " class="container-link" <?php echo $middlelink_output; ?>><?php if($middlefaoption == true) { ?><i class="fa-icon fa <?php echo $middlefaclass; ?>" style="width:45px; font-size:40px" aria-hidden="true"></i><?php } else { ?><span class="middle-icon"><img width="45px" height="45px" src="<?php echo $middleicon; ?>"></span> <?php } ?>
					<span class="message-bar-middle-headline" style="font-size:<?php echo $headlinefontsize; ?>; color:<?php echo $middleheadlinecolor; ?>"><?php echo $middleheadline; ?></span></a>
	<?php } ?>
				</div>
				<div id="right-bar-container">
					<?php if($rightchat == true) { ?>
						<a id="message-button-right" style="color:<?php echo $headlinecolor; ?>; --headline-hover:<?php echo $headlinehover; ?>; " target="blank" onclick="window.open('http://www.leadsnearbychat.com/pages/chat.aspx?companyId=<?php echo $rightchatid; ?>&amp;requestedAgentId=25&originalReferrer='+document.referrer+'&referrer='+window.location.href,'','width=500,height=600');" class="container-link" href=""><?php if($rightfaoption == true) { ?><i class="fa-icon fa <?php echo $rightfaclass; ?>" style="width:45px; font-size:40px" aria-hidden="true"></i><?php } else { ?><span class="right-icon"><img width="45px" height="45px" src="<?php echo $righticon; ?>"></span> <?php } ?>
					<span class="message-bar-right-headline" style="font-size:<?php echo $headlinefontsize; ?>; color:<?php echo $rightheadlinecolor; ?>"><?php echo $rightheadline; ?></span></a> <?php } else { ?>
	 
					<a id="message-button-right" style="color:<?php echo $headlinecolor; ?>; --headline-hover:<?php echo $headlinehover; ?>; " class="container-link" <?php echo $rightlink_output; ?>><?php if($rightfaoption == true) { ?><i class="fa-icon fa <?php echo $rightfaclass; ?>" style="width:45px; font-size:45px" aria-hidden="true"></i><?php } else { ?><span class="right-icon"><img width="45px" height="45px" src="<?php echo $righticon; ?>"></span> <?php } ?>
					<span class="message-bar-right-headline" style="font-size:<?php echo $headlinefontsize; ?>; color:<?php echo $rightheadlinecolor; ?>"><?php echo $rightheadline; ?></span></a>
	<?php } ?>
				</div>
			</div>
		</div>

	<?php $html = ob_get_clean();

	echo $html;

}






//End Plugin Script
}
