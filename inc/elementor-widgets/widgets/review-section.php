<?php
namespace Recipeselementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Recipes Review Contents section widget.
 *
 * @since 1.0
 */
class Recipes_Review_Contents extends Widget_Base {

	public function get_name() {
		return 'recipes-review-contents';
	}

	public function get_title() {
		return __( 'Review Contents', 'recipes-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'recipes-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Review contents  ------------------------------
		$this->start_controls_section(
			'reviews_content',
			[
				'label' => __( 'Review Contents', 'recipes-companion' ),
			]
        );

        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'recipes-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Feedback From Customers', 'recipes-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'recipes-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially <br> in the workplace. That’s why it’s crucial that, as women.',
            ]
        );

		$this->add_control(
            'reviews', [
                'label' => __( 'Create New', 'recipes-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ reviewer_name }}}',
                'fields' => [
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'recipes-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                    ],
                    [
                        'name' => 'reviewer_name',
                        'label' => __( 'Client Name', 'recipes-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Adame Nesane', 'recipes-companion' ),
                    ],
                    [
                        'name' => 'reviewer_designation',
                        'label' => __( 'Client Designation', 'recipes-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Chief Customer', 'recipes-companion' ),
                    ],
                    [
                        'name' => 'review_txt',
                        'label' => __( 'Review Text', 'recipes-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( "You're had. Subdue grass Meat us winged years you'll doesn't. fruit two also won one yielding creepeth third give may never lie alternet food.", "recipes-companion" ),
                    ],
                ],
                'default'   => [
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Adame Nesane', 'recipes-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'recipes-companion' ),
                        'review_txt'            => __( "You're had. Subdue grass Meat us winged years you'll doesn't. fruit two also won one yielding creepeth third give may never lie alternet food.", "recipes-companion" ),
                    ],
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Hasan', 'recipes-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'recipes-companion' ),
                        'review_txt'            => __( "You're had. Subdue grass Meat us winged years you'll doesn't. fruit two also won one yielding creepeth third give may never lie alternet food.", "recipes-companion" ),
                    ],
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Fardous', 'recipes-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'recipes-companion' ),
                        'review_txt'            => __( "You're had. Subdue grass Meat us winged years you'll doesn't. fruit two also won one yielding creepeth third give may never lie alternet food.", "recipes-companion" ),
                    ],
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Rubel', 'recipes-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'recipes-companion' ),
                        'review_txt'            => __( "You're had. Subdue grass Meat us winged years you'll doesn't. fruit two also won one yielding creepeth third give may never lie alternet food.", "recipes-companion" ),
                    ],
                    [
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Hasan Fardous', 'recipes-companion' ),
                        'reviewer_designation'  => __( 'Chief Customer', 'recipes-companion' ),
                        'review_txt'            => __( "You're had. Subdue grass Meat us winged years you'll doesn't. fruit two also won one yielding creepeth third give may never lie alternet food.", "recipes-companion" ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Review Section', 'recipes-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_overlay_col', [
                'label' => __( 'Section Overlay Color', 'recipes-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-testmonial.overlay2::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_text_col', [
                'label' => __( 'Review Text Color', 'recipes-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_name_col', [
                'label' => __( 'Reviewer Name Color', 'recipes-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    // call load widget script
    $this->load_widget_script(); 
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $reviews   = !empty( $settings['reviews'] ) ? $settings['reviews'] : '';
    ?>

    <!-- customer_feedback_area  -->
    <div class="customer_feedback_area">
        <div class="container">
            <div class="row justify-content-center mb-50">
                <div class="col-xl-9">
                    <div class="section_title text-center">
                        <?php
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                            if ( $sub_title ) { 
                                echo '<p>'.wp_kses_post( nl2br( $sub_title ) ).'</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="customer_active owl-carousel">
                        <?php
                        if( is_array( $reviews ) && count( $reviews ) > 0 ){
                            foreach ( $reviews as $review ) {
                                $review_txt    = !empty( $review['review_txt'] ) ? $review['review_txt'] : '';
                                $reviewer_name = !empty( $review['reviewer_name'] ) ? $review['reviewer_name'] : '';
                                $reviewer_designation = !empty( $review['reviewer_designation'] ) ? $review['reviewer_designation'] : '';
                                $client_img = !empty( $review['client_img']['id'] ) ? wp_get_attachment_image( $review['client_img']['id'], 'recipes_testimonial_thumb_100x100', '', array( 'alt' => $reviewer_name. ' image' ) ) : '';
                                ?>
                                <div class="single_customer d-flex">
                                    <?php 
                                        if ( $client_img ) { 
                                            echo '
                                            <div class="thumb">
                                                '.$client_img.'
                                            </div>
                                            ';
                                        }
                                    ?>
                                    <div class="customer_meta">
                                        <?php 
                                            if ( $reviewer_name ) { 
                                                echo '<h3>'.esc_html( $reviewer_name ).'</h3>';
                                            }
                                            if ( $reviewer_designation ) { 
                                                echo '<span>'.esc_html( $reviewer_designation ).'</span>';
                                            }
                                            if ( $review_txt ) { 
                                                echo '<p>'.wp_kses_post( nl2br( $review_txt ) ).'</p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.customer_active').owlCarousel({
            loop:true,
            margin:60,
            items:1,
            autoplay:false,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            nav:false,
            dots:true,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            // dotsData: true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                767:{
                    items:1,
                    nav:false
                },
                992:{
                    items:2
                },
                1200:{
                    items:2
                },
                1500:{
                    items:2
                }
            }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}
