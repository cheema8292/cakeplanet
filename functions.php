<?php
function start_session()
{
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session');

/**
 * cakeplanet.com functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cakeplanet.com
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cakeplanet_com_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on cakeplanet.com, use a find and replace
		* to change 'cakeplanet-com' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('cakeplanet-com', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'cakeplanet-com'),
        )
    );

    /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'cakeplanet_com_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'cakeplanet_com_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cakeplanet_com_content_width()
{
    $GLOBALS['content_width'] = apply_filters('cakeplanet_com_content_width', 640);
}
add_action('after_setup_theme', 'cakeplanet_com_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cakeplanet_com_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'cakeplanet-com'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'cakeplanet-com'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'cakeplanet_com_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function cakeplanet_com_scripts()
{
    wp_enqueue_style('cakeplanet-com-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('cakeplanet-com-style', 'rtl', 'replace');

    wp_enqueue_script('cakeplanet-com-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cakeplanet_com_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
function enqueue_bootstrap()
{
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');



// Create the products table on theme activation
// Create products table on theme activation or page load.
function create_products_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        weight DECIMAL(10,2),
        image_url TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Run on theme switch to ensure table creation.
add_action('after_switch_theme', 'create_products_table');
// ALSO ensure table creation when the site loads (for testing purposes).
add_action('init', 'create_products_table');



function create_database_tables()
{
    global $wpdb;

    // Set table names (use WordPress table prefix for consistency)
    $customers_table = $wpdb->prefix . 'customers';
    $order_items_table = $wpdb->prefix . 'order_items';

    // Include the wpdb class for database queries
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // SQL query to create the customers table
    $customers_sql = "CREATE TABLE IF NOT EXISTS $customers_table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        phone1 VARCHAR(15) NOT NULL,
        phone2 VARCHAR(15),
        email VARCHAR(100) NOT NULL,
        address TEXT NOT NULL,
        location VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;";

    // SQL query to create the order_items table
    $order_items_sql = "CREATE TABLE IF NOT EXISTS $order_items_table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT NOT NULL,
        product_id VARCHAR(50) NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (customer_id) REFERENCES $customers_table(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;";

    // Execute the queries to create the tables
    dbDelta($customers_sql);
    dbDelta($order_items_sql);
}

// Hook the function to run on theme activation
add_action('after_switch_theme', 'create_database_tables');

add_action('init', 'create_database_tables');

function register_product_menu()
{
    add_menu_page(
        'Manage Products',      // Page title
        'Products',             // Menu title
        'manage_options',       // Capability
        'manage-products',      // Menu slug
        'render_product_page',  // Callback function
        'dashicons-cart',       // Icon
        6                       // Position
    );
    add_menu_page(
        'Manage Categories',      // Page title
        'Categories',             // Menu title
        'manage_options',         // Capability
        'manage-categories',      // Menu slug
        'render_category_page',   // Callback function
        'dashicons-category',     // Icon
        7                         // Position
    );
}
add_action('admin_menu', 'register_product_menu');

function render_product_page()
{
    if (isset($_GET['delete_id'])) {
        delete_product(intval($_GET['delete_id']));
    }

    render_product_form();
    render_product_list();
}
function render_product_form()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products';
    $categories_table = $wpdb->prefix . 'categories'; // Add this line
    $edit_product = null;

    // Fetch categories
    $categories = $wpdb->get_results("SELECT * FROM $categories_table");

    if (isset($_GET['edit_id'])) {
        $edit_id = intval($_GET['edit_id']);
        $edit_product = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $edit_id));
    }

    $title = $edit_product ? $edit_product->title : '';
    $description = $edit_product ? $edit_product->description : '';
    $price = $edit_product ? $edit_product->price : '';
    $weight = $edit_product ? $edit_product->weight : '';
    $image_url = $edit_product ? $edit_product->image_url : '';
    $selected_category = $edit_product ? $edit_product->category_id : ''; // New line to handle category

?>
    <div class="wrap">
        <h1><?php echo $edit_product ? 'Edit Product' : 'Add New Product'; ?></h1>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $edit_product ? $edit_product->id : ''; ?>">
            <table class="form-table">
                <tr>
                    <th><label for="product_title">Title</label></th>
                    <td><input type="text" name="product_title" id="product_title" required class="regular-text"
                            value="<?php echo esc_attr($title); ?>"></td>
                </tr>
                <tr>
                    <th><label for="product_description">Description</label></th>
                    <td><textarea name="product_description" id="product_description" rows="5"
                            class="large-text"><?php echo esc_textarea($description); ?></textarea></td>
                </tr>
                <tr>
                    <th><label for="product_price">Price ($)</label></th>
                    <td><input type="number" name="product_price" id="product_price" step="0.01" required
                            class="regular-text" value="<?php echo esc_attr($price); ?>"></td>
                </tr>
                <tr>
                    <th><label for="product_weight">Weight (lbs)</label></th>
                    <td><input type="number" name="product_weight" id="product_weight" step="0.01" class="regular-text"
                            value="<?php echo esc_attr($weight); ?>"></td>
                </tr>
                <tr>
                    <th><label for="product_category">Category</label></th>
                    <td>
                        <select name="product_category" id="product_category" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo esc_attr($category->id); ?>"
                                    <?php selected($selected_category, $category->id); ?>>
                                    <?php echo esc_html($category->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="product_image">Image</label></th>
                    <td>
                        <input type="file" name="product_image" accept="image/*">
                        <?php if ($image_url): ?>
                            <p>Current Image: <img src="<?php echo esc_url($image_url); ?>" width="50"></p>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <?php submit_button($edit_product ? 'Update Product' : 'Save Product'); ?>
        </form>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $edit_product ? update_product_data() : save_product_data();
    }
}


function save_product_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products';

    // Process file upload
    $image_url = '';
    if (!empty($_FILES['product_image']['name'])) {
        $uploadedfile = $_FILES['product_image'];
        $upload_overrides = ['test_form' => false];

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
        if ($movefile && !isset($movefile['error'])) {
            $image_url = esc_url($movefile['url']);
        }
    }

    $wpdb->insert($table_name, [
        'title' => sanitize_text_field($_POST['product_title']),
        'description' => sanitize_textarea_field($_POST['product_description']),
        'price' => floatval($_POST['product_price']),
        'weight' => floatval($_POST['product_weight']),
        'image_url' => $image_url,
        'category_id' => intval($_POST['product_category']), // New line to save category
    ]);

    echo '<div class="updated"><p>Product saved successfully!</p></div>';
}

function update_product_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products';

    // Process file upload
    $image_url = '';
    if (!empty($_FILES['product_image']['name'])) {
        $uploadedfile = $_FILES['product_image'];
        $upload_overrides = ['test_form' => false];

        $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
        if ($movefile && !isset($movefile['error'])) {
            $image_url = esc_url($movefile['url']);
        }
    }

    $id = intval($_POST['product_id']);
    $data = [
        'title' => sanitize_text_field($_POST['product_title']),
        'description' => sanitize_textarea_field($_POST['product_description']),
        'price' => floatval($_POST['product_price']),
        'weight' => floatval($_POST['product_weight']),
        'category_id' => intval($_POST['product_category']), // New line to update category
    ];

    if ($image_url) {
        $data['image_url'] = $image_url; // Update image only if new image is uploaded
    }

    $wpdb->update($table_name, $data, ['id' => $id]);

    echo '<div class="updated"><p>Product updated successfully!</p></div>';
}

function handle_image_upload()
{
    if (!empty($_FILES['product_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $upload = wp_handle_upload($_FILES['product_image'], ['test_form' => false]);
        return $upload['url'] ?? '';
    }
    return '';
}
function delete_product($product_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products';
    $wpdb->delete($table_name, ['id' => $product_id]);
}
function render_product_list()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products';
    $products = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Image</th><th>Title</th><th>Price</th><th>Actions</th></tr></thead><tbody>';

    foreach ($products as $product) {
        $image = !empty($product->image_url) ? esc_url($product->image_url) : 'https://via.placeholder.com/50'; // Placeholder if no image

        echo '<tr>';
        echo '<td><img src="' . $image . '" alt="' . esc_attr($product->title) . '" width="50" height="50"></td>';
        echo '<td>' . esc_html($product->title) . '</td>';
        echo '<td>' . esc_html($product->price) . '</td>';
        echo '<td>
                <a href="?page=manage-products&edit_id=' . $product->id . '">Edit</a> |
                <a href="?page=manage-products&delete_id=' . $product->id . '">Delete</a>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
}


// category start here
function create_categories_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'create_categories_table');

function render_category_page()
{
    global $wpdb;

    // Handle category deletion
    if (isset($_GET['delete_id'])) {
        delete_category(intval($_GET['delete_id']));
    }

    // Display the form and category list
    render_category_form();
    render_category_list();
}

// Category form for adding and editing
function render_category_form()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories';
    $edit_category = null;

    if (isset($_GET['edit_id'])) {
        $edit_id = intval($_GET['edit_id']);
        $edit_category = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $edit_id));
    }

    $name = $edit_category ? $edit_category->name : '';

    ?>
    <div class="wrap">
        <h1><?php echo $edit_category ? 'Edit Category' : 'Add New Category'; ?></h1>
        <form method="post">
            <input type="hidden" name="category_id" value="<?php echo $edit_category ? $edit_category->id : ''; ?>">
            <table class="form-table">
                <tr>
                    <th><label for="category_name">Category Name</label></th>
                    <td><input type="text" name="category_name" id="category_name" required class="regular-text"
                            value="<?php echo esc_attr($name); ?>"></td>
                </tr>
            </table>
            <?php submit_button($edit_category ? 'Update Category' : 'Save Category'); ?>
        </form>
    </div>
<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $edit_category ? update_category_data() : save_category_data();
    }
}

// Save new category
function save_category_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories';

    $name = sanitize_text_field($_POST['category_name']);

    $wpdb->insert($table_name, [
        'name' => $name,
    ]);

    echo '<div class="updated"><p>Category saved successfully!</p></div>';
}

// Update existing category
function update_category_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories';

    $id = intval($_POST['category_id']);
    $name = sanitize_text_field($_POST['category_name']);

    $wpdb->update($table_name, [
        'name' => $name,
    ], ['id' => $id]);

    echo '<div class="updated"><p>Category updated successfully!</p></div>';
}

// Delete a category
function delete_category($category_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories';
    $wpdb->delete($table_name, ['id' => $category_id]);
}

// Render the category list
function render_category_list()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories';
    $categories = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Name</th><th>Actions</th></tr></thead><tbody>';

    foreach ($categories as $category) {
        echo '<tr>';
        echo '<td>' . esc_html($category->name) . '</td>';
        echo '<td>
                <a href="?page=manage-categories&edit_id=' . $category->id . '">Edit</a> |
                <a href="?page=manage-categories&delete_id=' . $category->id . '">Delete</a>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
}

function get_first_three_categories()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'categories'; // Adjust if your category table name is different
    return $wpdb->get_results("SELECT * FROM $table_name LIMIT 3");
}
function get_products_by_category($category_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'products'; // Adjust if your product table name is different
    return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE category_id = %d", $category_id));
}

add_action('wp_ajax_place_order', 'place_order');
add_action('wp_ajax_nopriv_place_order', 'place_order');

function place_order()
{
    global $wpdb;

    // Check if the request contains valid JSON
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        wp_send_json_error(['message' => 'Invalid input data.']);
        wp_die();
    }

    // Extract customer information
    $customer = $data['customer'];
    $first_name = sanitize_text_field($customer['firstName']);
    $last_name = sanitize_text_field($customer['lastName']);
    $phone1 = sanitize_text_field($customer['phone1']);
    $phone2 = sanitize_text_field($customer['phone2']);
    $email = sanitize_email($customer['email']);
    $address = sanitize_text_field($customer['address']);
    $location = sanitize_text_field($customer['location']);

    // Insert customer data into the customers table
    $customers_table = $wpdb->prefix . 'customers';
    $result = $wpdb->insert($customers_table, [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'phone1' => $phone1,
        'phone2' => $phone2,
        'email' => $email,
        'address' => $address,
        'location' => $location,
        'created_at' => current_time('mysql')
    ]);

    if ($result === false) {
        wp_send_json_error(['message' => 'Failed to insert customer data.']);
        wp_die();
    }

    // Get the inserted customer's ID
    $customer_id = $wpdb->insert_id;

    // Insert cart items into the order_items table
    $order_items_table = $wpdb->prefix . 'order_items';
    foreach ($data['cart'] as $item) {
        $wpdb->insert($order_items_table, [
            'customer_id' => $customer_id,
            'product_id' => sanitize_text_field($item['id']),
            'quantity' => intval($item['quantity']),
            'price' => floatval($item['price']),
            'created_at' => current_time('mysql')
        ]);
    }

    // If everything is successful, send a success response
    wp_send_json_success(['message' => 'Order placed successfully!']);
    wp_die();
}
