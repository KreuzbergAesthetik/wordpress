<?php
/**
 * Verwaltungsseite "Inhalte": alle Texte der Startseite bearbeiten.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_menu', function () {
	add_menu_page( 'Inhalte der Startseite', 'Inhalte', 'edit_pages', 'ka-inhalte', 'ka_render_admin', 'dashicons-edit-page', 3 );
} );

add_action( 'admin_init', function () {
	register_setting( 'ka_group', 'ka_content', array(
		'type'              => 'array',
		'sanitize_callback' => 'ka_sanitize_content',
		'default'           => array(),
	) );
} );

function ka_sanitize_content( $in ) {
	$out    = array();
	$fields = ka_fields();
	if ( ! is_array( $in ) ) { return $out; }
	foreach ( $fields as $key => $f ) {
		if ( ! isset( $in[ $key ] ) ) { continue; }
		$v = wp_unslash( $in[ $key ] );
		switch ( $f['type'] ) {
			case 'html':
				$v = wp_kses_post( $v );
				break;
			case 'inline':
				$v = wp_kses( $v, array( 'strong' => array(), 'em' => array(), 'br' => array() ) );
				break;
			case 'text':
				$v = sanitize_text_field( $v );
				break;
			default: // area, lines
				$v = sanitize_textarea_field( $v );
		}
		// Unverändert zur Vorgabe? Dann nichts speichern, damit spätere Theme-Updates greifen.
		if ( trim( $v ) === trim( (string) $f['default'] ) ) { continue; }
		$out[ $key ] = $v;
	}
	return $out;
}

function ka_render_admin() {
	if ( ! current_user_can( 'edit_pages' ) ) { return; }
	$sections = array();
	foreach ( ka_fields() as $key => $f ) { $sections[ $f['section'] ][ $key ] = $f; }
	?>
	<div class="wrap">
		<h1>Inhalte der Startseite</h1>
		<p>Hier änderst Du alle Texte, Preise und Fragen. Leere Felder zeigen wieder den ursprünglichen Text. Nach dem Speichern ist die Änderung sofort auf der Seite sichtbar.</p>
		<p>Text in [eckigen Klammern] wird im Entwurfsmodus als offene Stelle markiert. Den Entwurfsmodus schaltest Du in der Datei <code>functions.php</code> mit <code>KA_DRAFT</code> aus.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'ka_group' ); ?>
			<?php foreach ( $sections as $title => $items ) : ?>
				<h2 style="margin-top:2.2em;padding-top:1em;border-top:1px solid #c3c4c7"><?php echo esc_html( $title ); ?></h2>
				<table class="form-table" role="presentation"><tbody>
				<?php foreach ( $items as $key => $f ) :
					$name = 'ka_content[' . $key . ']';
					$val  = ka_raw( $key );
					?>
					<tr>
						<th scope="row"><label for="ka-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $f['label'] ); ?></label></th>
						<td>
						<?php if ( 'html' === $f['type'] ) :
							wp_editor( $val, 'ka_' . $key, array( 'textarea_name' => $name, 'textarea_rows' => 10, 'media_buttons' => false, 'teeny' => true ) );
						elseif ( in_array( $f['type'], array( 'area', 'lines' ), true ) ) :
							$rows = max( 3, min( 28, substr_count( $val, "\n" ) + 2 ) ); ?>
							<textarea id="ka-<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $name ); ?>" rows="<?php echo (int) $rows; ?>" class="large-text"><?php echo esc_textarea( $val ); ?></textarea>
						<?php else : ?>
							<input id="ka-<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $name ); ?>" type="text" class="large-text" value="<?php echo esc_attr( $val ); ?>">
						<?php endif; ?>
						<?php if ( $f['help'] ) : ?><p class="description"><?php echo esc_html( $f['help'] ); ?></p><?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody></table>
			<?php endforeach; ?>
			<?php submit_button( 'Änderungen speichern' ); ?>
		</form>
	</div>
	<?php
}
