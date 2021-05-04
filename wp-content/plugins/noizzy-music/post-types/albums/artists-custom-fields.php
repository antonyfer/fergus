<?php
function edge_artists_add_custom_meta_field() {
	?>
    <div class="form-field">
        <label for="artist_order"><?php esc_html_e( 'Order', 'noizzy-music' ); ?></label>
        <input type="text" name="artist_order" id="artist_order" value="">
        <p class="description"><?php esc_html_e( 'Enter a order number for this artist','noizzy-music' ); ?></p>
    </div>

    <div class="form-field">
        <label for="artist_url"><?php esc_html_e( 'Button URL', 'noizzy-music' ); ?></label>
        <input type="text" name="artist_url" id="artist_url" value="">
        <p class="description"><?php esc_html_e( 'Enter a url for buy ticket button','noizzy-music' ); ?></p>
    </div>

    <div class="form-field">
        <label scope="row" valign="top"><label for="artist_fb"><?php esc_html_e( 'Facebook Profile', 'noizzy-music' ); ?></label></label>
        <input type="text" name="artist_fb" id="artist_fb" value="">
        <p class="description"><?php esc_html_e( 'Enter Facebook profile link for this artist','noizzy-music' ); ?></p>
    </div>

    <div class="form-field">
        <label scope="row" valign="top"><label for="artist_insta"><?php esc_html_e( 'Instagram Profile', 'noizzy-music' ); ?></label></label>
        <input type="text" name="artist_insta" id="artist_insta" value="">
        <p class="description"><?php esc_html_e( 'Enter Instagram profile link for this artist','noizzy-music' ); ?></p>
    </div>

    <div class="form-field">
        <label scope="row" valign="top"><label for="artist_tw"><?php esc_html_e( 'Twitter Profile', 'noizzy-music' ); ?></label></label>
        <input type="text" name="artist_tw" id="artist_tw" value="">
        <p class="description"><?php esc_html_e( 'Enter Twitter profile link for this artist','noizzy-music' ); ?></p>
    </div>

    <div class="form-field">
        <label scope="row" valign="top"><label for="artist_yt"><?php esc_html_e( 'Youtube Profile', 'noizzy-music' ); ?></label></label>
        <input type="text" name="artist_yt" id="artist_yt" value="">
        <p class="description"><?php esc_html_e( 'Enter Youtube profile link for this artist','noizzy-music' ); ?></p>
    </div>

    <div class="form-field">
        <label for="artist_image"><?php esc_html_e('Image', 'noizzy-music'); ?></label>
        <input type="hidden" id="artist_image" name="artist_image" class="custom_media_url" value="">
        <div id="artist-image-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary artist_tax_media_button" id="artist_tax_media_button" name="artist_tax_media_button" value="<?php esc_html_e( 'Add Image', 'noizzy-music' ); ?>" />
            <input type="button" class="button button-secondary artist_tax_media_remove" id="artist_tax_media_remove" name="artist_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'noizzy-music' ); ?>" />
        </p>
    </div>

	<?php
}
add_action( 'album-artist_add_form_fields', 'edge_artists_add_custom_meta_field', 10, 2 );

function edge_artists_edit_custom_meta_field($term, $tax) {

	$artist_order    = get_term_meta( $term->term_id, 'artist_order', true );
    $artist_fb       = get_term_meta( $term->term_id, 'artist_fb', true );
    $artist_insta    = get_term_meta( $term->term_id, 'artist_insta', true );
    $artist_tw       = get_term_meta( $term->term_id, 'artist_tw', true );
    $artist_yt       = get_term_meta( $term->term_id, 'artist_yt', true );
	$artist_image_id = get_term_meta ( $term -> term_id, 'artist_image', true );
    $artist_url = get_term_meta ( $term -> term_id, 'artist_url', true );

	?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="artist_order"><?php esc_html_e( 'Order', 'noizzy-music' ); ?></label></th>
        <td>
            <input type="text" name="artist_order" id="artist_order" value="<?php echo esc_attr( $artist_order ) ? esc_attr( $artist_order ) : ''; ?>">
            <p class="description"><?php esc_html_e( 'Enter a order number for this artist','noizzy-music' ); ?></p>
        </td>
    </tr>

    <tr class="form-field">
       <th scope="row" valign="top"><label for="artist_url"><?php esc_html_e( 'Button URL', 'noizzy-music' ); ?></label></th>
        <td>
            <input type="text" name="artist_url" id="artist_url" value="<?php echo esc_attr( $artist_url ) ? esc_attr( $artist_url ) : ''; ?>">
            <p class="description"><?php esc_html_e( 'Enter a url for buy ticket button','noizzy-music' ); ?></p>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="artist_fb"><?php esc_html_e( 'Facebook Profile', 'noizzy-music' ); ?></label></th>
        <td>
            <input type="text" name="artist_fb" id="artist_fb" value="<?php echo esc_attr( $artist_fb ) ? esc_attr( $artist_fb ) : ''; ?>">
            <p class="description"><?php esc_html_e( 'Enter Facebook profile link for this artist','noizzy-music' ); ?></p>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="artist_insta"><?php esc_html_e( 'Instagram Profile', 'noizzy-music' ); ?></label></th>
        <td>
            <input type="text" name="artist_insta" id="artist_insta" value="<?php echo esc_attr( $artist_insta ) ? esc_attr( $artist_insta ) : ''; ?>">
            <p class="description"><?php esc_html_e( 'Enter Instagram profile link for this artist','noizzy-music' ); ?></p>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="artist_tw"><?php esc_html_e( 'Twitter Profile', 'noizzy-music' ); ?></label></th>
        <td>
            <input type="text" name="artist_tw" id="artist_tw" value="<?php echo esc_attr( $artist_tw ) ? esc_attr( $artist_tw ) : ''; ?>">
            <p class="description"><?php esc_html_e( 'Enter Twitter profile link for this artist','noizzy-music' ); ?></p>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="artist_yt"><?php esc_html_e( 'Youtube Profile', 'noizzy-music' ); ?></label></th>
        <td>
            <input type="text" name="artist_yt" id="artist_yt" value="<?php echo esc_attr( $artist_yt ) ? esc_attr( $artist_yt ) : ''; ?>">
            <p class="description"><?php esc_html_e( 'Enter Youtube profile link for this artist','noizzy-music' ); ?></p>
        </td>
    </tr>

    <tr class="form-field">
        <th scope="row">
            <label for="artist_image"><?php esc_html_e( 'Image', 'noizzy-music' ); ?></label>
        </th>
        <td>
			<?php  ?>
            <input type="hidden" id="artist_image" name="artist_image" value="<?php echo $artist_image_id; ?>">
            <div id="artist-image-wrapper">
				<?php if ( $artist_image_id ) { ?>
					<?php echo wp_get_attachment_image ( $artist_image_id, 'thumbnail' ); ?>
				<?php } ?>
            </div>
            <p>
                <input type="button" class="button button-secondary artist_tax_media_button" id="artist_tax_media_button" name="artist_tax_media_button" value="<?php esc_html_e( 'Add Image', 'noizzy-music' ); ?>" />
                <input data-termid="<?php echo $term->term_id; ?>" data-taxonomy="<?php echo $tax; ?>" type="button" class="button button-secondary artist_tax_media_remove" id="artist_tax_media_remove" name="artist_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'noizzy-music' ); ?>" />
            </p>
        </td>
    </tr>

	<?php
}
add_action( 'album-artist_edit_form_fields', 'edge_artists_edit_custom_meta_field', 10, 2 );


function edge_save_artist_custom_meta_field( $term_id ) {
    $fileds = array('artist_order', 'artist_fb','artist_insta','artist_tw', 'artist_yt','artist_image', 'artist_url');

	foreach ( $fileds as $value ) {
		if( isset( $_POST[$value] ) && '' !== $_POST[$value] ){
			add_term_meta ( $term_id, $value, $_POST[$value] );
		}
    }
}
add_action( 'created_album-artist', 'edge_save_artist_custom_meta_field', 10, 2 );

function edge_update_artist_custom_meta_field ( $term_id) {
	$fileds = array('artist_order', 'artist_fb','artist_insta','artist_tw', 'artist_yt', 'artist_image', 'artist_url');

	foreach ( $fileds as $value ) {
		if( isset( $_POST[$value] ) && '' !== $_POST[$value] ){
			update_term_meta ( $term_id, $value, $_POST[$value] );
		}else {
			update_term_meta ( $term_id, $value, '' );
		}
	}
}
add_action( 'edited_album-artist', 'edge_update_artist_custom_meta_field', 10, 2 );


function load_wp_media_files() {
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files');


function add_script() {

	?>
    <script type="text/javascript">
        jQuery(document).ready( function($) {

            function qode_media_upload(button_class) {
                var _custom_media = true,
                    _orig_send_attachment = wp.media.editor.send.attachment;
                $('body').on('click', button_class, function(e) {
                    var button_id = '#'+$(this).attr('id');
                    var button = $(button_id);
                    _custom_media = true;
                    wp.media.editor.send.attachment = function(props, attachment){
                        if ( _custom_media ) {
                            $('#artist_image').val(attachment.id);
                            $('#artist-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                            $('#artist-image-wrapper .custom_media_image').attr('src',attachment.sizes.thumbnail.url).css('display','block');
                        } else {
                            return _orig_send_attachment.apply( button_id, [props, attachment] );
                        }
                    }
                    wp.media.editor.open(button);
                    return false;
                });
            }
            qode_media_upload('.artist_tax_media_button.button');
            $('body').on('click','.artist_tax_media_remove',function(){
                var $this = $(this);

                /** Make sure the user didn't hit the button by accident and they really mean to delete the image **/
                if( $('#artist_image').val() !== '' && confirm( 'Are you sure you want to delete this file?' ) ) {
                    var result = $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        type: 'GET',
                        data: {
                            action: 'edge_tax_del_image',
                            term_id: $this.data('termid'),
                            taxonomy: $this.data('taxonomy')
                        },
                        dataType: 'text'
                    });

                    result.success( function( data ) {
                        $('#edge-uploaded-image').remove();
                    });
                    result.fail( function( jqXHR, textStatus ) {
                        console.log( "Request failed: " + textStatus );
                    });

                    $('#artist_image').val('');
                    $('#artist-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                }

            });
            // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
            $(document).ajaxComplete(function(event, xhr, settings) {
                var queryStringArr = settings.data.split('&');
                if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                    var xml = xhr.responseXML;
                    $response = $(xml).find('term_id').text();
                    if($response!=""){
                        // Clear the thumb image
                        $('#artist-image-wrapper').html('');
                    }
                }
            });
        });
    </script>
<?php }
add_action( 'admin_print_footer_scripts', 'add_script', 100 );

/** Metabox Delete Image **/
function edge_tax_del_image() {

	/** If we don't have a term_id, bail out **/
	if( ! isset( $_GET['term_id'] ) ) {
		echo esc_html__( 'Not Set or Empty', 'noizzy-music' );
		exit;
	}

	$term_id = $_GET['term_id'];
	$imageID = get_term_meta( $term_id, 'artist_image', true );  // Get our attachment ID

	if( is_numeric( $imageID ) ) {                              // Verify that the attachment ID is indeed a number
		wp_delete_attachment( $imageID );                       // Delete our image
		delete_term_meta( $term_id, 'artist_image' );// Delete our image meta
		exit;
	}

	echo esc_html__( 'Contact Administrator', 'noizzy-music' ); // If we've reached this point, something went wrong - enable debugging
	exit;
}
add_action( 'wp_ajax_edge_tax_del_image', 'edge_tax_del_image' );


/** Delete Associated Media Upon Term Deletion **/
function edge_delete_associated_term_media( $term_id, $tax ){
	global $wp_taxonomies;

	if( isset( $term_id, $tax, $wp_taxonomies ) && isset( $wp_taxonomies[$tax] ) ) {
		$imageID = get_term_meta( $term_id, 'artist_image', true );

		if( is_numeric( $imageID ) ) {
			wp_delete_attachment( $imageID );
		}
	}
}
add_action( 'pre_delete_term', 'edge_delete_associated_term_media', 10, 2 );



//add new column in admin
function add_album_artist_columns($columns){
	$columns['menu_order'] = 'Menu Order';
	return $columns;
}
add_filter('manage_edit-album-artist_columns', 'add_album_artist_columns');

//fill new column in admin
function add_album_artist_column_content($content,$column_name,$term_id){

	switch ($column_name) {
		case 'menu_order':
			$content = get_term_meta ($term_id, 'artist_order', true );
			break;
		default:
			break;
	}
	return $content;
}
add_filter('manage_album-artist_custom_column', 'add_album_artist_column_content',10,3);

