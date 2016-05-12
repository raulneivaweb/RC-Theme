<?php
/* ==========================================================================
   File Security Check
   ========================================================================== */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( __('You do not have sufficient permissions to access this page', 'nexothemes') );
}




/* ==========================================================================
   Cleanup Header
   ========================================================================== */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// remove emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );




/* ==========================================================================
   Title WordPress
   ========================================================================== */
// add support
add_theme_support( 'title-tag' );

// if is old wp version insert old school title tag
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function theme_slug_render_title() { ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
<?php }
    add_action( 'wp_head', 'theme_slug_render_title' );
}




/**
 * Remove comments style
 * @version 1.0
 */
function my_remove_recent_comments_style() {
    // global wp widget factory
    global $wp_widget_factory;

    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'my_remove_recent_comments_style');




/**
 * Libera opções no editor WordPress
 * Libera font family e font size para editor de texto WordPress
 */
/* Adiciona font family e font size ao editor WordPress
   ========================================================================== */
if ( ! function_exists( 'wpex_mce_buttons' ) ) {
    function wpex_mce_buttons( $buttons ) {
        array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
        return $buttons;
    }
}
add_filter( 'mce_buttons_2', 'wpex_mce_buttons' );




/* Tamanho de fontes personalizados
   ========================================================================== */
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
    function wpex_mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );




/* Thumbnail suport to posts only
   ========================================================================== */
add_theme_support( 'post-thumbnails', array('post'));

/* Custom size thumbnail added on WordPress
   ========================================================================== */
add_image_size('acf', 75, 75, true);




/**
 * Function Resize Image with default function WordPress
 * @version 1.0
 */
if (!function_exists('nexo_resize')) {
    function nexo_resize($attach_id = null, $img_url = null, $width, $height, $crop = false) {

        // this is an attachment, so we have the ID
        if ($attach_id) {
            $image_src = wp_get_attachment_image_src($attach_id, 'full');
            $file_path = get_attached_file($attach_id);

            // this is not an attachment, let's use the image url

        }
        else if ($img_url) {
            $file_path = parse_url($img_url);
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

            // Look for Multisite Path
            if (file_exists($file_path) === false) {
                global $blog_id;
                $file_path = parse_url($img_url);
                if (preg_match("/files/", $file_path['path'])) {
                    $path = explode('/', $file_path['path']);
                    foreach ($path as $k => $v) {
                        if ($v == 'files') {
                            $path[$k - 1] = '/wp-content/blogs.dir/' . $blog_id;
                        }
                    }
                    $path = implode('/', $path);
                }
                $file_path = $_SERVER['DOCUMENT_ROOT'] . $path;
            }

            //$file_path = ltrim( $file_path['path'], '/' );
            //$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
            $orig_size = getimagesize($file_path);
            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }
        $file_info = pathinfo($file_path);

        // check if file exists
        $base_file = $file_info['dirname'] . '/' . $file_info['filename'] . '.' . $file_info['extension'];
        if (!file_exists($base_file)) return;
        $extension = '.' . $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];
        $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if (($image_src[1] > $width) || ($image_src[1] >= $width && $crop == true)) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if (file_exists($cropped_img_path)) {
                $cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);
                $vt_image = array('url' => $cropped_img_url, 'width' => $width, 'height' => $height);
                return $vt_image;
            }

            // $crop = false or no height set
            if ($crop == false OR !$height) {

                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
                $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                // checking if the file already exists
                if (file_exists($resized_img_path)) {
                    $resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);
                    $vt_image = array('url' => $resized_img_url, 'width' => $proportional_size[0], 'height' => $proportional_size[1]);
                    return $vt_image;
                }
            }

            // check if image width is smaller than set width
            $img_size = getimagesize($file_path);
            if ($img_size[0] <= $width) $width = $img_size[0];

            // Check if GD Library installed
            if (!function_exists('imagecreatetruecolor')) {
                echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
                return;
            }

            // no cache files - let's finally resize it
            //$new_img_path = image_resize( $file_path, $width, $height, $crop );
            $editor = wp_get_image_editor($file_path);
            if (is_wp_error($editor)) return $editor;
            $editor->set_quality(100);
            $resized   = $editor->resize($width, $height, $crop);
            $dest_file = $editor->generate_filename(NULL, NULL);
            $saved     = $editor->save($dest_file);
            if (is_wp_error($saved)) return $saved;
            $new_img_path = $dest_file;
            $new_img_size = getimagesize($new_img_path);
            $new_img      = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

            // resized output
            $vt_image = array('url' => $new_img, 'width' => $new_img_size[0], 'height' => $new_img_size[1]);
            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array('url' => $image_src[0], 'width' => $width, 'height' => $height);
        return $vt_image;
    }
}




/**
 * Aplica sharpen nas imagens que serão recortadas
 * @version 1.0
 */
function nexo_sharpen_image( $resized_file ) {

    $image = imagecreatefromstring( file_get_contents( $resized_file ) );

    $size = @getimagesize( $resized_file );
    if ( !$size )
        return new WP_Error('invalid_image', __('Could not read image size'), $file);
    list($orig_w, $orig_h, $orig_type) = $size;
    switch ( $orig_type ) {
        case IMAGETYPE_JPEG:
            $matrix = array(
                array(apply_filters('sharpen_resized_corner',-1.2), apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_corner',-1.2)),
                array(apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_center',20), apply_filters('sharpen_resized_side',-1)),
                array(apply_filters('sharpen_resized_corner',-1.2), apply_filters('sharpen_resized_side',-1), apply_filters('sharpen_resized_corner',-1.2)),
            );
            $divisor = array_sum(array_map('array_sum', $matrix));
            $offset = 0;
            imageconvolution($image, $matrix, $divisor, $offset);
            imagejpeg($image, $resized_file,apply_filters( 'jpeg_quality', 90, 'edit_image' ));
            break;
        case IMAGETYPE_PNG:
            return $resized_file;
        case IMAGETYPE_GIF:
            return $resized_file;
    }

    // we don't need images in memory anymore
    imagedestroy( $image );

    return $resized_file;
}
add_filter('image_make_intermediate_size', 'nexo_sharpen_image',900);




/**
 * Extract url from first image on post
 * @version 1.0
 */
function nexo_first_img($width = 300, $height = 300) {
    // global post
    global $post;

    $first_img = '';
    ob_start();
    ob_end_clean();
    $output    = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

    // if has a image on post
    if($output >= 1) {
        $first_img = $matches[1][0];
    } else {
        $first_img = 'http://placehold.it/' . $width . 'x' . $height . '\/333333\/ffffff';
    }

    return $first_img;
}




/**
 * Function to easy added thumbnail on theme
 * @param  string   $size       Default sizes WordPress or custom sizes added using function add_image_size()
 * @param  int      $width      Width image
 * @param  int      $height     Height image
 * @param  boolean  $crop       If true the image is cut center and center position, can use array to cut position
 * @param  boolean  $url        If true the function show image tag "img" with url image, if false, show only url of the image
 * @version 1.0
 */
function nexo_thumbnail($size = '', $thumb_id = '' , $width = null, $height = null, $crop = false, $url = false) {
    /**
     * Global posts
     */
    global $post;

    /**
     * Se definido thumb id
     */
    if($thumb_id) {
        /**
         * Se tiver definido tamanho registrado
         * nas funções do tema usar as funções
         */
        if($size) {
            /**
             * Thumbnail URL
             * @var string
             */
            $thumbnail_url = wp_get_attachment_image_src($thumb_id, $size);
            $thumbnail_url = $thumbnail_url[0];

            /**
             * Se URL true mostrar apenas url da imagem
             * @var boolean
             */
            if($url == true) {
                echo $thumbnail_url;
            } else {
                echo '<img src="'.$thumbnail_url.'">';
            }
        } else {
            /**
             * Gera url da imagem recortada
             * @var string
             */
            $image = nexo_resize( $thumb_id, '', $width, $height, $crop );

            /**
             * Se URL true mostrar apenas url da imagem
             * @var boolean
             */
            if($url == true) {
                echo $image['url'];
            } else {
                echo '<img src="'.$image['url'].'">';
            }
        }
    }
    /**
     * Se não tiver definido thumb id
     */
    else {
        /**
         * Se definido thumbnail no artigo
         */
        if(has_post_thumbnail()) {
            /**
             * Id da imagem destacada
             * @var int
             */
            $thumb_id = get_post_thumbnail_id();

            /**
             * Se tiver definido tamanho registrado
             * nas funções do tema usar as funções
             */
            if($size) {
                /**
                 * Thumbnail URL
                 * @var string
                 */
                $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(), $size);
                $thumbnail_url = $thumbnail_url[0];

                /**
                 * Se URL true mostrar apenas url da imagem
                 * @var boolean
                 */
                if($url == true) {
                    echo $thumbnail_url;
                } else {
                    echo '<img src="'.$thumbnail_url.'">';
                }
            } else {
                /**
                 * Gera url da imagem recortada
                 * @var string
                 */
                $image = nexo_resize( $thumb_id, '', $width, $height, $crop );

                /**
                 * Se URL true mostrar apenas url da imagem
                 * @var boolean
                 */
                if($url == true) {
                    echo $image['url'];
                } else {
                    echo '<img src="'.$image['url'].'">';
                }
            }
        } else {
            /**
             * Se URL true mostrar apenas url da imagem
             * @var boolean
             */
            if($url == true) {
                echo nexo_first_img($width, $height);
            } else {
                echo '<img src="'.nexo_first_img($width, $height).'">';
            }
        }
    }
}




/**
 * Função para resumo de conteúdo
 * @param  string   $content Conteúdo que será resumido
 * @param  int      $limit   Número de caracteres
 * @param  boolean  $link    Se vai mostrar link de leia mais ou não
 * @version 1.0
 */
function nexo_resumo($content = null, $limit = null, $link = false) {

    // global post
    global $post;

    /*
        @content: var content
        @limit: number
    */
    if($link == true) {
        //   Resumo com link leia mais
        // ==========================================================================
        if(strlen(strip_tags($content)) > $limit) {
            echo mb_substr(strip_tags($content), 0, $limit, "utf-8") .'... <a href="'.get_permalink().'">'.__('[Read more]', 'nexothemes').'</a>';
        } else {
            echo strip_tags($content);
        }
    } else {
        //   Excerpt without more link
        // ==========================================================================
        if(strlen(strip_tags($content)) > $limit) {
            echo mb_substr(strip_tags($content), 0, $limit, "utf-8") .' ...';
        } else {
            echo strip_tags($content);
        }
    }
}




/**
 * Paginação Wordpress
 * @version 1.0
 */
function nexo_pagenavi() {
    // global query
    global $wp_query, $wp_rewrite;

    $pages = '';
    $max   = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged'))
    $current                 = 1;
    $a['base']               = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total']              = $max;
    $a['current']            = $current;
    $total                   = 1;
    $a['mid_size']           = 3;
    $a['end_size']           = 1;
    $a['prev_text']          = '<span class="number">«</span>';
    $a['next_text']          = '<span class="number">»</span>';
    $a['show_all']           = false;
    $a['before_page_number'] = '<span class="number">';
    $a['after_page_number']  = '</span>';

    if ($max > 1) {
        if($total == 1) {
            $pages = '<span class="pages">'.__('Pages', 'nexothemes').' ' . $current . ' de ' . $max . '</span>';
        }
        echo '<div class="pagenavi">'.$pages . paginate_links($a).'<div class="clear"></div></div>';
    }
}



/* ==========================================================================
   Included other functions theme
   ========================================================================== */
foreach ( glob( dirname( __FILE__ ) . '/functions/*.php' ) as $file ) {
    require_once( $file, true );
} ?>