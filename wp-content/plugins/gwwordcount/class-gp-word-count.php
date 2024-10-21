<?php

if ( ! class_exists( 'GP_Plugin' ) ) {
	return;
}

class GP_Word_Count extends GP_Plugin {

	private static $_instance = null;

	protected $_version     = GP_WORD_COUNT_VERSION;
	protected $_path        = 'gwwordcount/gwwordcount.php';
	protected $_full_path   = __FILE__;
	protected $_slug        = 'gwwordcount';
	protected $_title       = 'Gravity Forms Word Count';
	protected $_short_title = 'Word Count';

	public static function get_instance() {
		if( self::$_instance == null ) {
			self::$_instance = isset ( self::$perk ) ? new self ( new self::$perk ) : new self();
		}
		return self::$_instance;
	}

	public function minimum_requirements() {
		return array(
			'plugins'      => array(
				'gravityperks/gravityperks.php' => array(
					'name'    => 'Gravity Perks',
					'version' => '2.2.4',
				),
			),
		);
	}

	private static $supported_field_types = array( 'text', 'textarea', 'post_excerpt', 'post_content', 'post_title' );

	function init() {

		parent::init();

		load_plugin_textdomain( 'gp-word-count', false, basename( dirname( __file__ ) ) . '/languages/' );

		$this->perk->enqueue_field_settings();

		add_action( 'gform_register_init_scripts', array( &$this, 'register_init_scripts' ) );
		add_filter( 'gform_validation', array( &$this, 'validate' ) );
		add_action( 'gperk_field_settings', array( $this, 'field_settings_ui' ) );
		add_action( 'gform_editor_js', array( $this, 'field_settings_js' ) );

	}

	function field_settings_ui() {
		?>

		<li class="<?php echo $this->_slug; ?>_setting gwp_field_setting field_setting" style="display:none;">
			<label class="section_label">
				<?php _e( 'Word Counts', 'gravityperks' ); ?>
				<?php gform_tooltip( "{$this->_slug}_word_counts" ); ?>
			</label>

			<div class="gp-row">
				<div class="gp-group">
					<label for="<?php echo $this->_slug; ?>_min_word_count">
						<?php _e( 'Minimum', 'gp-word-count' ); ?>
					</label>
					<input type="text" id="<?php echo $this->_slug; ?>_min_word_count"
						   placeholder="e.g. 2"
						   onblur="SetFieldProperty('<?php echo $this->_slug; ?>_min_word_count', this.value);"/>
				</div>

				<div class="gp-group">
					<label for="<?php echo $this->_slug; ?>_max_word_count">
						<?php _e( 'Maximum', 'gp-word-count' ); ?>
					</label>
					<input type="text" id="<?php echo $this->_slug; ?>_max_word_count"
						   placeholder="e.g. 5"
						   onblur="SetFieldProperty('<?php echo $this->_slug; ?>_max_word_count', this.value);"/>
				</div>
			</div>
		</li>

		<?php
	}

	function field_settings_js() {
		?>

		<script type="text/javascript">

		jQuery(function($){

			<?php foreach ( self::$supported_field_types as $field_type ) : ?>
				fieldSettings['<?php echo $field_type; ?>'] += ", .<?php echo $this->_slug; ?>_setting";
			<?php endforeach; ?>

			$(document).bind('gform_load_field_settings', function(event, field) {

				jQuery('#<?php echo $this->_slug; ?>_min_word_count').val(field['<?php echo $this->_slug; ?>_min_word_count']);
				jQuery('#<?php echo $this->_slug; ?>_max_word_count').val(field['<?php echo $this->_slug; ?>_max_word_count']);

			});

		});

		</script>

		<?php
	}

	/**
	 * Return the scripts which should be enqueued.
	 *
	 * @return array
	 */
	public function scripts() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';

		$scripts = array(
			// Frontend
			array(
				'handle'    => 'textareaCounter',
				'src'       => $this->get_base_url() . '/scripts/jquery.textareaCounter.js',
				'version'   => $this->_version,
				'deps'      => array(
					'jquery',
					'gform_gravityforms',
				),
				'enqueue' => array(
					array( $this, 'has_word_count_field' ),
				),
			),
		);

		return array_merge( parent::scripts(), $scripts );
	}	

	public function has_word_count_field( $form ) {
		if ( ! $form ) {
			return false;
		}

		foreach ( $form['fields'] as $field ) {
			if ( $field->{$this->perk->key( 'min_word_count' )} || $field->{$this->perk->key( 'max_word_count' )} ) {
				return true;
			}
		}

		return false;
	}

	/**
	* Register counter on applicable fields when the form is displayed.
	*
	* Only need to apply the script when a max word count is specified. Min word count is only handled via PHP.
	*
	* @param mixed $form
	*/
	public function register_init_scripts( $form ) {

		$script       = '';
		$default_args = array(
			'limit'                   => 0,
			'min'                     => 0,
			'truncate'                => true,
			'defaultLabel'            => sprintf( __( 'Max: %s words', 'gp-word-count' ), '{limit}' ),
			'defaultLabelSingular'    => sprintf( __( 'Max: %s word', 'gp-word-count' ), '{limit}' ),
			'counterLabel'            => sprintf( __( '%s words left', 'gp-word-count' ), '{remaining}' ),
			'counterLabelSingular'    => sprintf( __( '%s word left', 'gp-word-count' ), '{remaining}' ),
			'limitReachedLabel'       => '<span class="gwwc-max-reached" style="font-weight:bold;">' . sprintf( __( '%s words left', 'gp-word-count' ), '{remaining}' ) . '</span>',
			'limitExceededLabel'      => '<span class="gwwc-max-exceeded" style="font-weight:bold;color:#c0392b;">' . sprintf( __( 'Limit exceeded!', 'gp-word-count' ), '{remaining}' ) . '</span>',
			'minCounterLabel'         => sprintf( __( '%s more words required', 'gp-word-count' ), '{remaining}' ),
			'minCounterLabelSingular' => sprintf( __( '%s more word required', 'gp-word-count' ), '{remaining}' ),
			'minReachedLabel'         => '<span class="gwwc-min-reached" style="font-weight:bold;color:#27ae60">' . __( 'Minimum word count met.', 'gp-word-count' ) . '</span>',
			'minDefaultLabel'         => sprintf( __( 'Min: %s words', 'gp-word-count' ), '{min}' ),
			'minDefaultLabelSingular' => sprintf( __( 'Min: %s word', 'gp-word-count' ), '{min}' ),
		);

		foreach ( $form['fields'] as $field ) {

			$has_min_word_count = $field->{$this->perk->key( 'min_word_count' )};
			$has_max_word_count = $field->{$this->perk->key( 'max_word_count' )};

			if ( $has_min_word_count || $has_max_word_count ) {

				$default_args['formId']            = $form['id'];
				$default_args['limit']             = $has_max_word_count;
				$default_args['min']               = $has_min_word_count;
				$default_args['useRichTextEditor'] = (bool) $field->useRichTextEditor;

				$args         = apply_filters( 'gpwc_script_args', $default_args, $field, $form );
				$field_script = sprintf( 'jQuery( \'#input_%d_%d\' ).textareaCounter( %s );', $form['id'], $field['id'], json_encode( $args ) );

                // Reinitialize the counter if refreshed with GPPA.
                $field_script .= <<<JS
                jQuery(document).on('gppa_updated_batch_fields', (event, formId, updatedFieldIDs) => {
                    if ({$form['id']} != formId) {
                        return;
                    }

                    if ( ! updatedFieldIDs.includes({$field['id']}) ) {
                        return;
                    }

                    {$field_script}
                });
                JS;

                $script .= $field_script;	
			}
		}

		if ( ! $script ) {
			return;
		}

		GFFormDisplay::add_init_script( $form['id'], $this->_slug, GFFormDisplay::ON_PAGE_RENDER, $script );

	}

	public function validate( $validation_result ) {

		$form     = $validation_result['form'];
		$is_valid = true;

		foreach ( $form['fields'] as &$field ) {

			if ( ! $this->should_field_be_validated( $form, $field ) ) {
				continue;
			}

			if ( $field->useRichTextEditor ) {
				$words      = rgpost( sprintf( 'gpwc_plain_text_%d', $field->id ) );
				$word_count = count( array_filter( preg_split( '/[ \n\r]+/', trim( $words ) ) ) );
			} else {
				$words      = RGFormsModel::get_field_value( $field );
				$word_count = preg_match_all( '/\S+/', $words );
			}

			$word_count = gf_apply_filters( array(
				'gpwc_word_count',
				$field->formId,
				$field->id,
			), $word_count, $words );

			$min_word_count = intval( $field->{$this->perk->key( 'min_word_count' )} );
			if ( $min_word_count && $word_count < $min_word_count ) {
				$field['failed_validation']  = true;
				$field['validation_message'] = apply_filters( $this->perk->key( '_min_word_count_validation_message' ), sprintf( _n( 'You must enter at least %s word.', 'You must enter at least %s words.', $min_word_count, 'gp-word-count' ), $min_word_count ) );
			}

			$max_word_count = intval( $field->{$this->perk->key( 'max_word_count' )} );
			if ( $max_word_count !== 0 && $word_count > $max_word_count ) {
				$field['failed_validation']  = true;
				$field['validation_message'] = apply_filters( $this->perk->key( '_max_word_count_validation_message' ), sprintf( _n( 'You may only enter %s word.', 'You may only enter %s words.', $max_word_count, 'gp-word-count' ), $max_word_count ) );
			}

			if ( $field['failed_validation'] ) {
				$is_valid = false;
			}
		}

		$validation_result['form']     = $form;
		$validation_result['is_valid'] = ! $validation_result['is_valid'] ? false : $is_valid;

		return $validation_result;
	}

	public function should_field_be_validated( $form, $field ) {

		if ( ! GFFormDisplay::is_field_validation_supported( $field ) ) {
			return false;
		}

		if ( $field['pageNumber'] != GFFormDisplay::get_source_page( $form['id'] ) ) {
			return false;
		}

		if ( ! in_array( GFFormsModel::get_input_type( $field ), self::$supported_field_types ) ) {
			return false;
		}

		if ( GFFormsModel::is_field_hidden( $form, $field, array() ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Adds tooltips for the settings.
	 *
	 * @param array $tooltips An array with the existing tooltips.
	 */
	public function tooltips( $tooltips ) {
		$tooltips["{$this->_slug}_word_counts"] = '<h6>' . __( 'Word Counts', 'gp-word-count' ) . '</h6>' . __( 'Specify the minimum and maximum number of words that can be entered in this field. Leave either setting empty to ignore that limit.', 'gp-word-count' );
		return $tooltips;
	}

	public static function has_conditional_logic( $form ) {
		if ( empty( $form ) ) {
			return false;
		}

		if ( isset( $form['button']['conditionalLogic'] ) ) {
			return true;
		}

		foreach ( rgar( $form, 'fields' ) as $field ) {
			if ( ! empty( $field['conditionalLogic'] ) ) {
				return true;
			} elseif ( isset( $field['nextButton'] ) && ! empty( $field['nextButton']['conditionalLogic'] ) ) {
				return true;
			}
		}
		return false;
	}


}

class GWWordCount extends GP_Word_Count { }

GFAddOn::register( 'GP_Word_Count' );
