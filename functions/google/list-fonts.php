<?php
/**
* list-fonts.php
* @package wordpress-stripped
* 
* This file is for testing purposes only.
* When required it will list out all the fonts that are hosting on http://www.google.com/webfonts
* 
*/
$client = new apiClient();
$client->setApplicationName("Google WebFonts PHP Starter Application");

$service = new apiWebfontsService($client);
$fonts = $service->webfonts->listWebfonts();

// START FONTS - FOR TESTING ONLY
foreach( $fonts['items'] as $font ){
	echo '<strong>' . $font['family'] . '</strong><br />';
	if( $font['variants'] ) {
		echo 'Variants: ';
		foreach( $font['variants'] as $key => $value ) {
			echo $value . ', ';
		}
		echo '<br />';
	}
	if( $font['subsets'] ) {
		echo 'Subsets: ';
		foreach( $font['subsets'] as $key => $value ) {
			echo $value . ', ';
		}
		echo '<br />';
	}
	echo '<br />';
}
// END FONTS