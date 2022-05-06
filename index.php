<?php
/*
Plugin Name: Import Custom Posts from XLSX
Plugin URI: http://schoolmanagement.com.pk
Description: Add posts to custom post type from xlsx files. After activating go to Settings -> XLSX to CPT menu and upload your excel file. All rows will be added to separate posts in project listings post type.
Author: Muhammad Bilal
Version: 1.0.0
*/


if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'Bilal_Plugin_XLSX_CPT');

    function Bilal_Plugin_XLSX_CPT() {
            add_options_page('XLSX to CPT', 'XLSX to CPT', 'administrator',
            'XLSX to XPT', 'Bilal_XLSX_to_CPT');
        }

    function Bilal_XLSX_to_CPT(){
		require_once __DIR__.'/SimpleXLSX.php';
		global $wpdb;
		$table = $wpdb->prefix . "taura_tokens";
		echo '<h1>Upload a XLSX file to load its data</h1><pre>';
		if ( $_FILES['first']['tmp_name']!= '' && $xlsx = SimpleXLSX::parse($_FILES['first']['tmp_name']) ) {
// 			print_r( $xlsx->rows() );
			foreach (array_slice($xlsx->rows(),1) as $csvdata) {
				$pincode = $csvdata[0];
				$sql = "INSERT INTO '$table' (token) VALUES ('$pincode')";
				$success = $wpdb->query($sql);
				echo "Inserted token: " . $pincode .  "<br>";
				die();
			}
		}
		

        ?>

<div>


    <form name="Image" enctype="multipart/form-data" action="" method="post">
        <p>Please upload the xlsx file:<br> <input type="file" name="first" id="first" /></p>
        <p><input type="submit" /></p>


    </form>
</div>

<?php
    }
}


?>