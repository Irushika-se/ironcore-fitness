<?php
/**
 * Plugin Name: IronCore Fitness Setup
 * Description: Builds a complete gym website on activation (Home, About, Classes, Pricing, Schedule, Trainers, Contact, Privacy pages, menu and styling). Includes a settings page for business details, a free-trial booking system with a Trial Bookings inbox, SEO markup and a WhatsApp button.
 * Version: 2.0
 * Author: IronCore Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =====================================================================
 * 1. DATA (edit these lists to change classes, plans, schedule, trainers)
 * ===================================================================== */
function ic_classes() {
	return array(
		'Strength' => array(
			'sub'   => 'Build muscle and power',
			'items' => array( 'Weight Training' => 'Rs. 2,000', 'Powerlifting' => 'Rs. 2,500', 'Personal Training' => 'Rs. 4,000' ),
		),
		'Cardio' => array(
			'sub'   => 'Burn fat, build stamina',
			'items' => array( 'HIIT' => 'Rs. 1,800', 'Spinning' => 'Rs. 1,500', 'Zumba' => 'Rs. 1,200' ),
		),
		'Mind & Body' => array(
			'sub'   => 'Flexibility and recovery',
			'items' => array( 'Yoga' => 'Rs. 1,500', 'Pilates' => 'Rs. 1,800', 'Stretch & Recovery' => 'Rs. 1,000' ),
		),
		'Combat' => array(
			'sub'   => 'Fitness with a fighting spirit',
			'items' => array( 'Boxing' => 'Rs. 2,200', 'Kickboxing' => 'Rs. 2,200', 'Circuit Training' => 'Rs. 1,800' ),
		),
	);
}

function ic_class_names() {
	$names = array();
	foreach ( ic_classes() as $group ) {
		foreach ( $group['items'] as $name => $price ) {
			$names[] = $name;
		}
	}
	return $names;
}

// months, price (Rs.), features. The first plan is the base for the "save" amount.
function ic_plans() {
	return array(
		array( 'name' => 'Monthly', 'months' => 1, 'price' => 6000, 'featured' => false,
			'features' => array( 'Full gym floor access', 'All group classes', 'Free locker' ) ),
		array( 'name' => '3 Months', 'months' => 3, 'price' => 15000, 'featured' => true,
			'features' => array( 'Full gym floor access', 'All group classes', 'Free locker', 'Free fitness assessment' ) ),
		array( 'name' => 'Yearly', 'months' => 12, 'price' => 48000, 'featured' => false,
			'features' => array( 'Full gym floor access', 'All group classes', 'Free locker', 'Free fitness assessment', '2 guest passes' ) ),
	);
}

function ic_schedule() {
	return array(
		'Monday'    => array( '6:00 AM' => 'Weight Training', '6:00 PM' => 'HIIT', '7:30 PM' => 'Boxing' ),
		'Tuesday'   => array( '6:00 AM' => 'Yoga', '6:00 PM' => 'Spinning', '7:30 PM' => 'Powerlifting' ),
		'Wednesday' => array( '6:00 AM' => 'HIIT', '6:00 PM' => 'Zumba', '7:30 PM' => 'Kickboxing' ),
		'Thursday'  => array( '6:00 AM' => 'Pilates', '6:00 PM' => 'Weight Training', '7:30 PM' => 'Circuit Training' ),
		'Friday'    => array( '6:00 AM' => 'Spinning', '6:00 PM' => 'HIIT', '7:30 PM' => 'Boxing' ),
		'Saturday'  => array( '7:00 AM' => 'Circuit Training', '9:00 AM' => 'Yoga', '5:00 PM' => 'Zumba' ),
		'Sunday'    => array( '8:00 AM' => 'Stretch & Recovery', '10:00 AM' => 'Pilates' ),
	);
}

function ic_trainer_list() {
	return array(
		array( 'Kasun Perera', 'Head Coach', 'Strength and powerlifting' ),
		array( 'Nimali Silva', 'Group Fitness Coach', 'HIIT, Zumba and spinning' ),
		array( 'Dilan Fernando', 'Combat Coach', 'Boxing and kickboxing' ),
		array( 'Sanduni Jayasuriya', 'Wellness Coach', 'Yoga and pilates' ),
	);
}

function ic_faqs() {
	return array(
		array( 'Do I need experience to join?', 'No. Our coaches adjust every class to your level, and the free trial is a good way to start.' ),
		array( 'How does the free trial work?', 'Send a request on the Contact page with a class and a date. We confirm the time by email or phone. Your first session is free.' ),
		array( 'What should I bring?', 'Comfortable clothes, sports shoes and a water bottle. Towels and lockers are available.' ),
		array( 'Can I freeze or cancel my membership?', 'Please speak to the front desk. We will explain the options for your plan.' ),
		array( 'Do you offer personal training?', 'Yes. Personal Training sessions are available with our coaches by appointment.' ),
	);
}

/* =====================================================================
 * 2. SETTINGS (Settings > IronCore Fitness)
 * ===================================================================== */
function ic_fields() {
	return array(
		'name'         => array( 'Business name', 'text', 'IronCore Fitness' ),
		'description'  => array( 'Short description (used for search engines)', 'textarea', 'Gym with strength, cardio, yoga and boxing classes, certified coaches and a free trial session.' ),
		'phone'        => array( 'Phone number', 'text', '+94 77 123 4567' ),
		'whatsapp'     => array( 'WhatsApp number (digits only, with country code, e.g. 94771234567)', 'digits', '94771234567' ),
		'email'        => array( 'Email address', 'email', '' ),
		'address'      => array( 'Address', 'text', '123 Main Street, Colombo' ),
		'map'          => array( 'Google Maps embed (paste the iframe code or its src link)', 'map', '' ),
		'hours_week'   => array( 'Opening hours: Monday - Friday', 'text', '5:30 AM - 10:00 PM' ),
		'hours_sat'    => array( 'Opening hours: Saturday', 'text', '6:00 AM - 8:00 PM' ),
		'hours_sun'    => array( 'Opening hours: Sunday', 'text', '7:00 AM - 2:00 PM' ),
		'facebook'     => array( 'Facebook page URL', 'url', '' ),
		'instagram'    => array( 'Instagram URL', 'url', '' ),
		'youtube'      => array( 'YouTube URL', 'url', '' ),
		'tiktok'       => array( 'TikTok URL', 'url', '' ),
		'testimonials' => array( 'Member reviews: one per line as  Name | Review  (real reviews only; the section is hidden when empty)', 'textarea', '' ),
	);
}

function ic_opt( $key ) {
	$saved = get_option( 'ic_settings', array() );
	if ( is_array( $saved ) && isset( $saved[ $key ] ) && '' !== $saved[ $key ] ) {
		return $saved[ $key ];
	}
	$f = ic_fields();
	// Email falls back to the WordPress admin email.
	if ( 'email' === $key ) {
		return get_option( 'admin_email' );
	}
	return isset( $f[ $key ] ) ? $f[ $key ][2] : '';
}

function ic_sanitize_settings( $input ) {
	$out = array();
	$input = is_array( $input ) ? $input : array();
	foreach ( ic_fields() as $key => $f ) {
		$v = isset( $input[ $key ] ) ? wp_unslash( $input[ $key ] ) : '';
		switch ( $f[1] ) {
			case 'email':
				$v = sanitize_email( $v );
				break;
			case 'url':
				$v = esc_url_raw( $v );
				break;
			case 'digits':
				$v = preg_replace( '/\D/', '', $v );
				break;
			case 'textarea':
				$v = sanitize_textarea_field( $v );
				break;
			case 'map':
				if ( preg_match( '/src=["\']([^"\']+)["\']/i', $v, $m ) ) {
					$v = $m[1];
				}
				$v = esc_url_raw( trim( $v ) );
				if ( 0 !== strpos( $v, 'https://www.google.com/maps/embed' ) ) {
					$v = '';
				}
				break;
			default:
				$v = sanitize_text_field( $v );
		}
		$out[ $key ] = $v;
	}
	return $out;
}

add_action( 'admin_init', function () {
	register_setting( 'ic_settings_group', 'ic_settings', array( 'sanitize_callback' => 'ic_sanitize_settings' ) );
} );

add_action( 'admin_menu', function () {
	add_options_page( 'IronCore Fitness', 'IronCore Fitness', 'manage_options', 'ic-settings', 'ic_settings_page' );
} );

function ic_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="wrap"><h1>IronCore Fitness settings</h1><p>These details appear on your pages, footer buttons and search engine data.</p>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'ic_settings_group' );
	echo '<table class="form-table" role="presentation">';
	foreach ( ic_fields() as $key => $f ) {
		$val = ic_opt( $key );
		echo '<tr><th scope="row"><label for="ic_' . esc_attr( $key ) . '">' . esc_html( $f[0] ) . '</label></th><td>';
		if ( 'textarea' === $f[1] ) {
			echo '<textarea class="large-text" rows="4" id="ic_' . esc_attr( $key ) . '" name="ic_settings[' . esc_attr( $key ) . ']">' . esc_textarea( $val ) . '</textarea>';
		} else {
			echo '<input class="regular-text" type="text" id="ic_' . esc_attr( $key ) . '" name="ic_settings[' . esc_attr( $key ) . ']" value="' . esc_attr( $val ) . '">';
		}
		echo '</td></tr>';
	}
	echo '</table>';
	submit_button();
	echo '</form></div>';
}

/* =====================================================================
 * 3. SMALL SHORTCODES (read the settings, so pages stay up to date)
 * ===================================================================== */
add_shortcode( 'ic_name', function () {
	return esc_html( ic_opt( 'name' ) );
} );

add_shortcode( 'ic_hours', function () {
	$rows = array(
		'Monday - Friday' => ic_opt( 'hours_week' ),
		'Saturday'        => ic_opt( 'hours_sat' ),
		'Sunday'          => ic_opt( 'hours_sun' ),
	);
	$out = '<div class="ic-hours">';
	foreach ( $rows as $day => $time ) {
		$out .= '<div class="ic-price-row"><span class="ic-name">' . esc_html( $day ) . '</span><span class="ic-dots"></span><span class="ic-amt">' . esc_html( $time ) . '</span></div>';
	}
	return $out . '</div>';
} );

add_shortcode( 'ic_contact_info', function () {
	$out  = '<div class="ic-info"><h3>Visit us</h3><p>' . esc_html( ic_opt( 'address' ) ) . '</p></div>';
	$out .= '<div class="ic-info"><h3>Call or message</h3><p><a href="tel:' . esc_attr( preg_replace( '/[^\d+]/', '', ic_opt( 'phone' ) ) ) . '">' . esc_html( ic_opt( 'phone' ) ) . '</a>';
	if ( ic_opt( 'whatsapp' ) ) {
		$out .= '<br><a href="' . esc_url( 'https://wa.me/' . ic_opt( 'whatsapp' ) ) . '" target="_blank" rel="noopener">Chat on WhatsApp</a>';
	}
	$out .= '<br><a href="mailto:' . esc_attr( ic_opt( 'email' ) ) . '">' . esc_html( ic_opt( 'email' ) ) . '</a></p></div>';
	$out .= '<div class="ic-info"><h3>Opening hours</h3><p>Monday - Friday: ' . esc_html( ic_opt( 'hours_week' ) ) . '<br>Saturday: ' . esc_html( ic_opt( 'hours_sat' ) ) . '<br>Sunday: ' . esc_html( ic_opt( 'hours_sun' ) ) . '</p></div>';
	return $out;
} );

add_shortcode( 'ic_map', function () {
	$src = ic_opt( 'map' );
	if ( '' === $src ) {
		return '';
	}
	return '<div class="ic-map"><iframe src="' . esc_url( $src ) . '" title="Map showing our location" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>';
} );

add_shortcode( 'ic_social', function () {
	$out = '';
	foreach ( array( 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'tiktok' => 'TikTok' ) as $k => $label ) {
		if ( ic_opt( $k ) ) {
			$out .= '<a href="' . esc_url( ic_opt( $k ) ) . '" target="_blank" rel="noopener">' . esc_html( $label ) . '</a>';
		}
	}
	return '' === $out ? '' : '<div class="ic-social">' . $out . '</div>';
} );

add_shortcode( 'ic_testimonials', function () {
	$lines = array_filter( array_map( 'trim', explode( "\n", ic_opt( 'testimonials' ) ) ) );
	$out   = '';
	foreach ( $lines as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		if ( 2 === count( $parts ) && '' !== $parts[0] && '' !== $parts[1] ) {
			$out .= '<blockquote class="ic-quote"><p>&ldquo;' . esc_html( $parts[1] ) . '&rdquo;</p><cite>' . esc_html( $parts[0] ) . '</cite></blockquote>';
		}
	}
	return '' === $out ? '' : '<div class="ic-section"><h2>What our members say</h2><div class="ic-quotes">' . $out . '</div></div>';
} );

add_shortcode( 'ic_faq', function () {
	$out = '<div class="ic-faq">';
	foreach ( ic_faqs() as $f ) {
		$out .= '<details><summary>' . esc_html( $f[0] ) . '</summary><p>' . esc_html( $f[1] ) . '</p></details>';
	}
	return $out . '</div>';
} );

add_shortcode( 'ic_pricing', function () {
	$plans = ic_plans();
	$base  = $plans[0]['price'];
	$out   = '<div class="ic-plans">';
	foreach ( $plans as $p ) {
		$save = $base * $p['months'] - $p['price'];
		$out .= '<div class="ic-plan' . ( $p['featured'] ? ' ic-plan--featured' : '' ) . '">';
		if ( $p['featured'] ) {
			$out .= '<span class="ic-badge">Most popular</span>';
		}
		$out .= '<h3>' . esc_html( $p['name'] ) . '</h3><div class="ic-plan-price">Rs. ' . esc_html( number_format( $p['price'] ) ) . '</div>';
		$out .= '<p class="ic-sub">' . ( $save > 0 ? 'Save Rs. ' . esc_html( number_format( $save ) ) : 'Pay as you go, monthly' ) . '</p><ul>';
		foreach ( $p['features'] as $feat ) {
			$out .= '<li>' . esc_html( $feat ) . '</li>';
		}
		$out .= '</ul><a class="ic-btn" href="' . esc_url( home_url( '/contact/' ) ) . '">Start with a free trial</a></div>';
	}
	return $out . '</div>';
} );

add_shortcode( 'ic_schedule', function () {
	$out = '<div class="ic-schedule">';
	foreach ( ic_schedule() as $day => $slots ) {
		$out .= '<div class="ic-day"><h3>' . esc_html( $day ) . '</h3>';
		foreach ( $slots as $time => $class ) {
			$out .= '<div class="ic-slot"><span>' . esc_html( $time ) . '</span><strong>' . esc_html( $class ) . '</strong></div>';
		}
		$out .= '</div>';
	}
	return $out . '</div>';
} );

add_shortcode( 'ic_trainers', function () {
	$out = '<div class="ic-trainers">';
	foreach ( ic_trainer_list() as $t ) {
		$parts    = explode( ' ', $t[0] );
		$initials = strtoupper( substr( $parts[0], 0, 1 ) . substr( end( $parts ), 0, 1 ) );
		$out .= '<div class="ic-trainer"><div class="ic-avatar" aria-hidden="true">' . esc_html( $initials ) . '</div><h3>' . esc_html( $t[0] ) . '</h3><strong>' . esc_html( $t[1] ) . '</strong><p>' . esc_html( $t[2] ) . '</p></div>';
	}
	return $out . '</div>';
} );

/* =====================================================================
 * 4. TRIAL BOOKINGS (form, inbox, emails)
 * ===================================================================== */
function ic_statuses() {
	return array( 'New', 'Confirmed', 'Completed', 'Cancelled' );
}

add_action( 'init', function () {
	register_post_type( 'ic_booking', array(
		'labels'        => array( 'name' => 'Trial Bookings', 'singular_name' => 'Trial Booking', 'menu_name' => 'Trial Bookings', 'not_found' => 'No bookings yet.' ),
		'public'        => false,
		'show_ui'       => true,
		'menu_icon'     => 'dashicons-universal-access',
		'menu_position' => 26,
		'supports'      => array( 'title', 'editor' ),
		'capabilities'  => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'  => true,
	) );
} );

add_filter( 'manage_ic_booking_posts_columns', function () {
	return array( 'cb' => '<input type="checkbox">', 'title' => 'Booking', 'ic_class' => 'Class', 'ic_date' => 'Date', 'ic_contact' => 'Contact', 'ic_status' => 'Status', 'date' => 'Received' );
} );

add_action( 'manage_ic_booking_posts_custom_column', function ( $col, $id ) {
	if ( 'ic_class' === $col ) {
		echo esc_html( get_post_meta( $id, 'ic_class', true ) );
	} elseif ( 'ic_date' === $col ) {
		echo esc_html( get_post_meta( $id, 'ic_date', true ) );
	} elseif ( 'ic_contact' === $col ) {
		echo esc_html( get_post_meta( $id, 'ic_email', true ) ) . '<br>' . esc_html( get_post_meta( $id, 'ic_phone', true ) );
	} elseif ( 'ic_status' === $col ) {
		$s = get_post_meta( $id, 'ic_status', true );
		echo esc_html( $s ? $s : 'New' );
	}
}, 10, 2 );

add_action( 'add_meta_boxes', function () {
	add_meta_box( 'ic_status_box', 'Booking status', function ( $post ) {
		$s = get_post_meta( $post->ID, 'ic_status', true );
		$s = $s ? $s : 'New';
		wp_nonce_field( 'ic_status_save', 'ic_status_nonce' );
		echo '<select name="ic_status">';
		foreach ( ic_statuses() as $opt ) {
			echo '<option value="' . esc_attr( $opt ) . '"' . selected( $s, $opt, false ) . '>' . esc_html( $opt ) . '</option>';
		}
		echo '</select>';
	}, 'ic_booking', 'side' );
} );

add_action( 'save_post_ic_booking', function ( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! isset( $_POST['ic_status_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ic_status_nonce'] ) ), 'ic_status_save' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$s = isset( $_POST['ic_status'] ) ? sanitize_text_field( wp_unslash( $_POST['ic_status'] ) ) : 'New';
	if ( in_array( $s, ic_statuses(), true ) ) {
		update_post_meta( $post_id, 'ic_status', $s );
	}
} );

add_shortcode( 'ic_booking', function () {
	$status = isset( $_GET['ic_sent'] ) ? sanitize_text_field( wp_unslash( $_GET['ic_sent'] ) ) : '';
	ob_start();
	if ( '1' === $status ) {
		echo '<div class="ic-notice ic-ok" role="status">Thank you! Your free trial request has been received. We will confirm it by email or phone soon.</div>';
	} elseif ( '0' === $status ) {
		echo '<div class="ic-notice ic-err" role="alert">Please fill in your name, a valid email, a class, a date that is today or later, and tick the agreement box.</div>';
	} elseif ( '2' === $status ) {
		echo '<div class="ic-notice ic-err" role="alert">Too many requests from your connection. Please try again later or contact us on WhatsApp.</div>';
	}
	?>
	<form class="ic-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="ic_booking_submit">
		<input type="hidden" name="ic_back" value="<?php echo esc_url( get_permalink() ); ?>">
		<?php wp_nonce_field( 'ic_booking', 'ic_nonce' ); ?>
		<label>Your name <input type="text" name="ic_name" required maxlength="100" autocomplete="name"></label>
		<div class="ic-row">
			<label>Email address <input type="email" name="ic_email" required maxlength="100" autocomplete="email"></label>
			<label>Phone (optional) <input type="tel" name="ic_phone" maxlength="30" autocomplete="tel"></label>
		</div>
		<div class="ic-row">
			<label>Class
				<select name="ic_class" required>
					<option value="">Choose a class</option>
					<?php foreach ( ic_class_names() as $n ) : ?>
						<option value="<?php echo esc_attr( $n ); ?>"><?php echo esc_html( $n ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label>Preferred date <input type="date" name="ic_date" min="<?php echo esc_attr( current_time( 'Y-m-d' ) ); ?>" required></label>
		</div>
		<label>Message (optional) <textarea name="ic_message" rows="4" maxlength="1000"></textarea></label>
		<label class="ic-check"><input type="checkbox" name="ic_consent" value="1" required> I agree to be contacted about my request. See our <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a>.</label>
		<p class="ic-hp" aria-hidden="true"><label>Leave empty <input type="text" name="ic_website" tabindex="-1" autocomplete="off"></label></p>
		<button type="submit">Book my free trial</button>
	</form>
	<?php
	return ob_get_clean();
} );

function ic_booking_handle() {
	$back  = isset( $_POST['ic_back'] ) ? esc_url_raw( wp_unslash( $_POST['ic_back'] ) ) : home_url( '/' );
	$nonce = isset( $_POST['ic_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['ic_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'ic_booking' ) ) {
		wp_safe_redirect( add_query_arg( 'ic_sent', '0', $back ) );
		exit;
	}
	if ( ! empty( $_POST['ic_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'ic_sent', '1', $back ) );
		exit;
	}

	// Simple rate limit: 5 requests per hour per visitor.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'ic_rl_' . md5( $ip );
	$cnt = (int) get_transient( $key );
	if ( $cnt >= 5 ) {
		wp_safe_redirect( add_query_arg( 'ic_sent', '2', $back ) );
		exit;
	}
	set_transient( $key, $cnt + 1, HOUR_IN_SECONDS );

	$name    = isset( $_POST['ic_name'] ) ? sanitize_text_field( wp_unslash( $_POST['ic_name'] ) ) : '';
	$email   = isset( $_POST['ic_email'] ) ? sanitize_email( wp_unslash( $_POST['ic_email'] ) ) : '';
	$phone   = isset( $_POST['ic_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['ic_phone'] ) ) : '';
	$class   = isset( $_POST['ic_class'] ) ? sanitize_text_field( wp_unslash( $_POST['ic_class'] ) ) : '';
	$date    = isset( $_POST['ic_date'] ) ? sanitize_text_field( wp_unslash( $_POST['ic_date'] ) ) : '';
	$message = isset( $_POST['ic_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ic_message'] ) ) : '';
	$consent = ! empty( $_POST['ic_consent'] );

	$d       = DateTime::createFromFormat( 'Y-m-d', $date );
	$date_ok = $d && $d->format( 'Y-m-d' ) === $date && $date >= current_time( 'Y-m-d' );
	if ( '' === $name || ! is_email( $email ) || ! in_array( $class, ic_class_names(), true ) || ! $date_ok || ! $consent ) {
		wp_safe_redirect( add_query_arg( 'ic_sent', '0', $back ) );
		exit;
	}

	$body = "Name: $name\nEmail: $email\nPhone: $phone\nClass: $class\nPreferred date: $date\n\n$message";
	$id   = wp_insert_post( array(
		'post_type'    => 'ic_booking',
		'post_status'  => 'publish',
		'post_title'   => $class . ' on ' . $date . ' - ' . $name,
		'post_content' => $body,
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, 'ic_class', $class );
		update_post_meta( $id, 'ic_date', $date );
		update_post_meta( $id, 'ic_email', $email );
		update_post_meta( $id, 'ic_phone', $phone );
		update_post_meta( $id, 'ic_status', 'New' );
	}

	$biz = wp_specialchars_decode( ic_opt( 'name' ), ENT_QUOTES );
	// To the owner, with Reply-To set to the member.
	@wp_mail( ic_opt( 'email' ), '[' . $biz . '] New free trial request: ' . $class, $body, array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );
	// Confirmation to the member.
	$reply = "Hi $name,\n\nThanks for your interest in $biz. We received your free trial request for $class on $date and will confirm the time soon.\n\nIf you need us sooner, call " . ic_opt( 'phone' ) . ".\n\n$biz";
	@wp_mail( $email, 'We received your free trial request - ' . $biz, $reply, array( 'Reply-To: ' . ic_opt( 'email' ) ) );

	wp_safe_redirect( add_query_arg( 'ic_sent', '1', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_ic_booking_submit', 'ic_booking_handle' );
add_action( 'admin_post_ic_booking_submit', 'ic_booking_handle' );

/* =====================================================================
 * 5. FRONT END EXTRAS: SEO data, WhatsApp button
 * ===================================================================== */
add_action( 'wp_head', function () {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
		return; // An SEO plugin is handling this.
	}
	$desc = ic_opt( 'description' );
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( ic_opt( 'name' ) ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( file_exists( plugin_dir_path( __FILE__ ) . 'images/hero.jpg' ) ) {
		echo '<meta property="og:image" content="' . esc_url( plugin_dir_url( __FILE__ ) . 'images/hero.jpg' ) . '">' . "\n";
	}

	$same = array();
	foreach ( array( 'facebook', 'instagram', 'youtube', 'tiktok' ) as $k ) {
		if ( ic_opt( $k ) ) {
			$same[] = ic_opt( $k );
		}
	}
	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'HealthClub',
		'name'        => ic_opt( 'name' ),
		'description' => $desc,
		'url'         => home_url( '/' ),
		'telephone'   => ic_opt( 'phone' ),
		'email'       => ic_opt( 'email' ),
		'address'     => array( '@type' => 'PostalAddress', 'streetAddress' => ic_opt( 'address' ) ),
	);
	if ( $same ) {
		$schema['sameAs'] = $same;
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . '</script>' . "\n";
}, 5 );

add_action( 'wp_footer', function () {
	$wa = ic_opt( 'whatsapp' );
	if ( '' === $wa ) {
		return;
	}
	$text = rawurlencode( 'Hi, I would like to know more about ' . wp_specialchars_decode( ic_opt( 'name' ), ENT_QUOTES ) . '.' );
	echo '<a class="ic-whatsapp" href="' . esc_url( 'https://wa.me/' . $wa . '?text=' . $text ) . '" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">'
		. '<svg viewBox="0 0 32 32" width="24" height="24" aria-hidden="true"><path fill="#fff" d="M16 4C9.4 4 4 8.9 4 15c0 2.6 1 5 2.7 6.9L5.500 28l6.400-2.100c1.300.4 2.700.6 4.100.6 6.600 0 12-4.900 12-11S22.600 4 16 4z"/></svg><span>WhatsApp</span></a>';
} );

/* =====================================================================
 * 6. PAGE CONTENT
 * ===================================================================== */
function ic_page_html( $key ) {
	$book  = esc_url( home_url( '/contact/' ) );
	$serv  = esc_url( home_url( '/classes/' ) );
	$price = esc_url( home_url( '/pricing/' ) );

	if ( 'home' === $key ) {
		$tile = function ( $cls, $title, $text ) use ( $serv ) {
			return '<a class="ic-tile ic-tile--' . esc_attr( $cls ) . '" href="' . $serv . '"><div><h3>' . esc_html( $title ) . '</h3><span>' . esc_html( $text ) . '</span></div></a>';
		};
		return '<div class="ic-hero"><h1>[ic_name]</h1><p>Strength, cardio and coaching in one motivating space. Start with a free trial.</p><div class="ic-btns"><a class="ic-btn" href="' . $book . '">Book a free trial</a><a class="ic-btn ic-btn-ghost" href="' . $price . '">See pricing</a></div></div>'
			. '<div class="ic-stats"><div class="ic-stat"><strong>' . count( ic_class_names() ) . '</strong><span>Classes</span></div><div class="ic-stat"><strong>' . count( ic_trainer_list() ) . '</strong><span>Expert coaches</span></div><div class="ic-stat"><strong>7</strong><span>Days a week</span></div></div>'
			. '<div class="ic-section"><h2>Our classes</h2><div class="ic-tiles">'
			. $tile( 'strength', 'Strength', 'Build muscle and power' )
			. $tile( 'cardio', 'Cardio', 'Burn fat, build stamina' )
			. $tile( 'mind', 'Mind & Body', 'Flexibility and recovery' )
			. $tile( 'combat', 'Combat', 'Boxing and kickboxing' )
			. '</div></div>'
			. '<div class="ic-section ic-band"><h2>Why choose us</h2><div class="ic-features">'
			. '<div class="ic-feature"><div class="ic-ico">&#127947;</div><h3>Modern equipment</h3><p>Well-maintained machines and free weights.</p></div>'
			. '<div class="ic-feature"><div class="ic-ico">&#128170;</div><h3>Expert coaches</h3><p>Certified trainers who build a plan for you.</p></div>'
			. '<div class="ic-feature"><div class="ic-ico">&#128197;</div><h3>Flexible timetable</h3><p>Early morning to late evening classes, 7 days a week.</p></div>'
			. '</div></div>'
			. '<div class="ic-section"><h2>Meet the coaches</h2>[ic_trainers]</div>'
			. '[ic_testimonials]'
			. '<div class="ic-section"><h2>Opening hours</h2>[ic_hours]</div>'
			. '<div class="ic-section"><div class="ic-cta"><h2>Ready to get stronger?</h2><p>Pick a class and a date, and we will confirm your free trial.</p><a class="ic-btn" href="' . $book . '">Book now</a></div></div>';
	}

	if ( 'about' === $key ) {
		return '<div class="ic-banner ic-banner--about"><h1>About us</h1><p>A friendly gym for every fitness level.</p></div>'
			. '<div class="ic-section"><div class="ic-two"><div><h2 class="ic-left">Our story</h2><p>[ic_name] was started to give people in our community a clean, motivating place to train with proper guidance. Whether you are lifting for the first time or preparing for a competition, our coaches build a plan that fits you.</p><p>We keep classes small, equipment well maintained and the atmosphere welcoming, so you can focus on progress.</p></div><div class="ic-about-img" role="img" aria-label="Inside our gym"></div></div></div>'
			. '<div class="ic-section ic-band"><h2>What we believe</h2><div class="ic-features">'
			. '<div class="ic-feature"><h3>Safety first</h3><p>Good technique before heavy weight, every time.</p></div>'
			. '<div class="ic-feature"><h3>Every level welcome</h3><p>Beginners and experienced members train side by side.</p></div>'
			. '<div class="ic-feature"><h3>Real progress</h3><p>Clear goals, regular check-ins and honest advice.</p></div>'
			. '</div></div>'
			. '<div class="ic-section"><h2>Our coaches</h2>[ic_trainers]</div>'
			. '<div class="ic-section"><div class="ic-cta"><h2>Come and see for yourself</h2><p>Your first session is free.</p><a class="ic-btn" href="' . $book . '">Book a free trial</a></div></div>';
	}

	if ( 'classes' === $key ) {
		$cards = '';
		foreach ( ic_classes() as $group => $data ) {
			$rows = '';
			foreach ( $data['items'] as $name => $price_text ) {
				$rows .= '<div class="ic-price-row"><span class="ic-name">' . esc_html( $name ) . '</span><span class="ic-dots"></span><span class="ic-amt">' . esc_html( $price_text ) . '</span></div>';
			}
			$cards .= '<div class="ic-card"><h3>' . esc_html( $group ) . '</h3><p class="ic-sub">' . esc_html( $data['sub'] ) . '</p>' . $rows . '</div>';
		}
		return '<div class="ic-banner ic-banner--classes"><h1>Classes</h1><p>Drop-in prices per session. Members attend all group classes included in their plan.</p></div>'
			. '<div class="ic-section"><div class="ic-menu-grid">' . $cards . '</div><p class="ic-note">Prices are in Sri Lankan rupees. See the <a href="' . $price . '">membership plans</a> for better value.</p></div>'
			. '<div class="ic-section"><div class="ic-cta"><h2>Not sure where to start?</h2><p>Try any class free for one session.</p><a class="ic-btn" href="' . $book . '">Book a free trial</a></div></div>';
	}

	if ( 'pricing' === $key ) {
		return '<div class="ic-banner ic-banner--pricing"><h1>Membership plans</h1><p>Simple pricing. No hidden fees.</p></div>'
			. '<div class="ic-section">[ic_pricing]<p class="ic-note">Prices are in Sri Lankan rupees. Plans include all group classes and gym floor access.</p></div>'
			. '<div class="ic-section"><h2>Frequently asked questions</h2>[ic_faq]</div>'
			. '<div class="ic-section"><div class="ic-cta"><h2>Try before you join</h2><p>Book a free trial session with no obligation.</p><a class="ic-btn" href="' . $book . '">Book a free trial</a></div></div>';
	}

	if ( 'schedule' === $key ) {
		return '<div class="ic-banner ic-banner--schedule"><h1>Class schedule</h1><p>Weekly timetable. Times may change on public holidays.</p></div>'
			. '<div class="ic-section">[ic_schedule]</div>'
			. '<div class="ic-section"><div class="ic-cta"><h2>Found a class you like?</h2><p>Book your free trial for it.</p><a class="ic-btn" href="' . $book . '">Book now</a></div></div>';
	}

	if ( 'trainers' === $key ) {
		return '<div class="ic-banner ic-banner--trainers"><h1>Our trainers</h1><p>Certified coaches who keep you safe and motivated.</p></div>'
			. '<div class="ic-section">[ic_trainers]</div>'
			. '<div class="ic-section"><div class="ic-cta"><h2>Train with the best</h2><p>Book a free trial session with one of our coaches.</p><a class="ic-btn" href="' . $book . '">Book now</a></div></div>';
	}

	if ( 'privacy' === $key ) {
		return '<div class="ic-banner ic-banner--about"><h1>Privacy policy</h1><p>How we handle your information.</p></div>'
			. '<div class="ic-section ic-legal"><h3>What we collect</h3><p>When you send a free trial request we collect your name, email address, phone number (optional), chosen class, preferred date and any message you write.</p>'
			. '<h3>How we use it</h3><p>We use these details only to reply to your request, confirm your session and contact you about it. We do not sell your information.</p>'
			. '<h3>How long we keep it</h3><p>We keep requests for as long as needed to manage your booking and membership, then delete them.</p>'
			. '<h3>Your choices</h3><p>You can ask us to see, correct or delete your information at any time by contacting us at [ic_name] using the details on the Contact page.</p></div>';
	}

	// contact
	return '<div class="ic-banner ic-banner--contact"><h1>Book a free trial</h1><p>Choose a class and a preferred date. We will confirm your session by email or phone.</p></div>'
		. '<div class="ic-section"><div class="ic-contact-grid"><div>[ic_contact_info][ic_social]</div><div class="ic-formbox">[ic_booking]</div></div></div>'
		. '<div class="ic-section">[ic_map]</div>';
}

function ic_make_page( $title, $slug, $html ) {
	$existing = get_page_by_path( $slug );
	if ( $existing && 'trash' !== $existing->post_status ) {
		return $existing->ID;
	}
	$id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => "<!-- wp:html -->\n" . $html . "\n<!-- /wp:html -->",
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, 'site-sidebar-layout', 'no-sidebar' );
		update_post_meta( $id, 'site-content-layout', 'normal-width-container' );
		update_post_meta( $id, 'site-post-title', 'disabled' );
		return $id;
	}
	return 0;
}

/* =====================================================================
 * 7. SETUP ON ACTIVATION
 * ===================================================================== */
function ic_assign_menu() {
	$menu = wp_get_nav_menu_object( 'IronCore Menu' );
	if ( ! $menu ) {
		return;
	}
	$locs = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locs['primary'] ) ) {
		$locs['primary'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locs );
	}
}
add_action( 'after_switch_theme', 'ic_assign_menu' );

register_activation_hook( __FILE__, 'ic_setup' );
add_action( 'admin_init', 'ic_apply' );

function ic_setup() {
	$ids = array(
		'home'     => ic_make_page( 'Home', 'home', ic_page_html( 'home' ) ),
		'classes'  => ic_make_page( 'Classes', 'classes', ic_page_html( 'classes' ) ),
		'pricing'  => ic_make_page( 'Pricing', 'pricing', ic_page_html( 'pricing' ) ),
		'schedule' => ic_make_page( 'Schedule', 'schedule', ic_page_html( 'schedule' ) ),
		'trainers' => ic_make_page( 'Trainers', 'trainers', ic_page_html( 'trainers' ) ),
		'about'    => ic_make_page( 'About', 'about', ic_page_html( 'about' ) ),
		'contact'  => ic_make_page( 'Contact', 'contact', ic_page_html( 'contact' ) ),
		'privacy'  => ic_make_page( 'Privacy Policy', 'privacy', ic_page_html( 'privacy' ) ),
	);

	update_option( 'blogname', ic_opt( 'name' ) );
	update_option( 'blogdescription', 'Strength, cardio and coaching' );
	if ( $ids['home'] ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}

	if ( ! wp_get_nav_menu_object( 'IronCore Menu' ) ) {
		$menu_id = wp_create_nav_menu( 'IronCore Menu' );
		if ( ! is_wp_error( $menu_id ) ) {
			$pos = 1;
			$items = array( 'home' => 'Home', 'classes' => 'Classes', 'pricing' => 'Pricing', 'schedule' => 'Schedule', 'trainers' => 'Trainers', 'about' => 'About', 'contact' => 'Free Trial' );
			foreach ( $items as $k => $label ) {
				if ( $ids[ $k ] ) {
					wp_update_nav_menu_item( $menu_id, 0, array(
						'menu-item-title'     => $label,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $ids[ $k ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $pos++,
						'menu-item-classes'   => 'contact' === $k ? 'ic-book-btn' : '',
					) );
				}
			}
		}
	}
	ic_assign_menu();
	ic_apply();
	flush_rewrite_rules();
}

function ic_apply() {
	ic_assign_menu();

	// CSS: main file added once.
	$current = wp_get_custom_css();
	$file    = plugin_dir_path( __FILE__ ) . 'css/ironcore-fitness.css';
	if ( false === strpos( $current, '/* IRONCORE FITNESS CSS */' ) && file_exists( $file ) ) {
		$current .= "\n" . file_get_contents( $file );
	}

	// Photo backgrounds: rebuilt whenever the set of image files in images/ changes.
	$dir  = plugin_dir_path( __FILE__ ) . 'images/';
	$url  = plugin_dir_url( __FILE__ ) . 'images/';
	$have = array();
	foreach ( array( 'hero', 'strength', 'cardio', 'mind', 'combat', 'cta' ) as $n ) {
		if ( file_exists( $dir . $n . '.jpg' ) ) {
			$have[ $n ] = esc_url_raw( $url . $n . '.jpg' );
		}
	}
	$sig = md5( wp_json_encode( $have ) );
	if ( get_option( 'ic_img_sig' ) !== $sig ) {
		$current = preg_replace( '#\n?/\* IRONCORE IMAGES \*/.*?/\* END IRONCORE IMAGES \*/#s', '', $current );
		$pick = function ( $first, $second ) use ( $have ) {
			return isset( $have[ $first ] ) ? $have[ $first ] : ( isset( $have[ $second ] ) ? $have[ $second ] : '' );
		};
		$map = array(
			'.ic-hero'             => $pick( 'hero', 'hero' ),
			'.ic-tile--strength'   => $pick( 'strength', 'strength' ),
			'.ic-tile--cardio'     => $pick( 'cardio', 'cardio' ),
			'.ic-tile--mind'       => $pick( 'mind', 'mind' ),
			'.ic-tile--combat'     => $pick( 'combat', 'combat' ),
			'.ic-banner--classes'  => $pick( 'strength', 'hero' ),
			'.ic-banner--pricing'  => $pick( 'cta', 'hero' ),
			'.ic-banner--schedule' => $pick( 'cardio', 'hero' ),
			'.ic-banner--trainers' => $pick( 'hero', 'strength' ),
			'.ic-banner--about'    => $pick( 'hero', 'strength' ),
			'.ic-banner--contact'  => $pick( 'combat', 'cta' ),
			'.ic-about-img'        => $pick( 'hero', 'strength' ),
			'.ic-cta'              => $pick( 'cta', 'hero' ),
		);
		$css = "\n/* IRONCORE IMAGES */\n";
		foreach ( $map as $sel => $img ) {
			if ( '' !== $img ) {
				$css .= $sel . "{background-image:url('" . $img . "');}\n";
			}
		}
		$css    .= '/* END IRONCORE IMAGES */';
		$current .= $css;
		update_option( 'ic_img_sig', $sig );
	}
	if ( $current !== wp_get_custom_css() ) {
		wp_update_custom_css_post( $current );
	}

	// Astra options, once.
	if ( ! get_option( 'ic_opts_done' ) ) {
		$opts = get_option( 'astra-settings', array() );
		if ( is_array( $opts ) ) {
			$opts['footer-copyright-editor'] = 'Copyright [copyright] [current_year] [site_title]. All rights reserved. | <a href="/privacy/">Privacy Policy</a>';
			$opts['scroll-to-top-enable']    = 1;
			update_option( 'astra-settings', $opts );
		}
		update_option( 'ic_opts_done', 1 );
	}
}
