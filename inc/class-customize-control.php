<?php
class Crimson_Rose_Notice_Control extends WP_Customize_Control {
	public function render_content() {
		?>
		<div class="notice-control-wrapper">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( isset( $this->description ) && ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</div>
		<?php
	}
}
