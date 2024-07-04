<?php

function child_styles() {
	wp_enqueue_style( 'my-child-theme-style', get_stylesheet_directory_uri() . '/style.css', array( 'vamtam-front-all' ), false, 'all' );
	wp_enqueue_style( 'owl-css', get_stylesheet_directory_uri() . '/css/owl.carousel.min.css', array( 'vamtam-front-all' ), false, 'all' );
	wp_enqueue_script( 'owl-js', get_stylesheet_directory_uri() . '/js/owl.carousel.js');
    wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'));
		
    wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url('admin-ajax.php')));
}
add_action( 'wp_enqueue_scripts', 'child_styles' );

add_action( 'after_setup_theme', 'wpsites_child_theme_posts_formats', 11 );

function wpsites_child_theme_posts_formats(){
 add_theme_support( 'post-formats', array(
    'audio',
    'gallery',
    'link',
    'quote',
    'video',
    ) );
}

function featured_scholars(){
	$arg= array(
        'posts_per_page'=> 1 ,
        'post_type'=> 'scholars',
        'order'=>'DESC',
        'meta_query' => array(
	        array(
	            'key' => 'featured',
	            'value' => 'Yes',
	            'compare' => '='
	        )
	    )
    );

    // The Query
    $the_query = new WP_Query( $arg );

    // The Loop
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $featured = get_field('featured');
            $function = get_field('function');
            $email = get_field('email');
            $social_link = get_field('social_link');
            $social_img = get_field('social_image');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail();

            echo	'<div class="d-flex p-0 m-0" style="background-color: #F1F5FB;">
        <div class="d-flex flik" style="margin: -40px 0 40px -30px;" >
            <div class="col-sm-4 p-0 m-0">
                <div>
                    '.$thumbnail.'
                    <div class="ank">
                        <i class="fa fa-linkedin lk" aria-hidden="true"></i>
                        <a href="'.$permalink.'" class="btn rounded-0 vieew-profile">View Profile<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
            <div class="col-sm-8 pr-5 fcs">
                <div class="featured-scholard">
                    <h1>FEATURED</h1>
                    <h1>SCHOLARS</h1>
                </div>
                <h5 class="mt-4 mb-0" style="text-decoration: underline; font-family: "gotham-bold";">'.$title.'</h5>
                <div class="d-flex fnt pt-4 mb-1">
                    <p class="m-0 pr-5"><b>Affiliation</b></p>
                    <p class="m-0">'.$function.'</p>
                </div>
                <div class="d-flex fnt">
                    <p class="m-0 pr-5"><b>Email</b></p>
                    <p class="m-0 pl-4"><b>'.$email.'</b></p>
                </div>
                <div class="f-s para pt-3">
                    '.$content.'
                </div>
            </div>
        </div>
    </div>';

            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
}
add_shortcode( 'feat_scholars', 'featured_scholars' );

function recently_featured_scholars(){
	$arg= array(
        'posts_per_page'=> 3 ,
        'post_type'=> 'scholars',
        'order'=>'ASC',
        'meta_query' => array(
	        array(
	            'key' => 'featured',
	            'value' => 'Yes',
	            'compare' => '='
	        )
	    )
    );

    // The Query
    $the_query = new WP_Query( $arg );
    echo '<div class="pl-5 mmbr"><h3 class="reacently-feadtured" style="font-family: "gotham-bold";">Recently Featured</h3>';
    // The Loop
    if ( $the_query->have_posts() ) {
    	$count = 0;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $featured = get_field('featured');
            $function = get_field('function');
            $email = get_field('email');
            $social_link = get_field('social_link');
            $social_img = get_field('social_image');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail();
			$link = get_field( "link_of_scholar_profile" );
            if($count == 2){
            	$no_bord = 'no-bord';
            } else {$no_bord = 'btm-bord';}

            echo	'<div class="row '.$no_bord.'">

                <a href="'.$link.'"><div class="col-sm-4 col-xs-3 pr-0 mn">
                '.$thumbnail.'
                </div></a>
                <div class="col-sm-8 col-xs-9 p-0 mo">
                    <div class="brand-featuredd">
                        <a href="'.$link.'"><h6 style="font-family: "gotham-bold";">'.$title.'</h6></a>
                    </div>
                    <div class="d-flex">
                    <div class="fntt">
						<div class="aff">
                        	
							<p class="m-0">'.$function.'</p>
						</div>
						<div class="focus">
                        	
							 <p class="m-0">Focus Group</p>
						</div>
						<div class="email_recent">
                        	
							<p class="m-0"><b><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to='.$email.'" target="_blank">'.$email.'</a></b></p>
						</div>
                    </div>
                 

                    </div>
                </div><div class="clearfix"></div>
        </div>';
					$count++;
            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
    echo '</div>';
}
add_shortcode( 'recent_feat_scholars', 'recently_featured_scholars' );

function expert_topics(){
	$arg= array(
        'posts_per_page'=> 3 ,
        'post_type'=> 'experts',
        'order'=>'DESC',
    );

    // The Query
    $the_query = new WP_Query( $arg );

    // The Loop
    if ( $the_query->have_posts() ) {
    	$count = 0;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $title = get_the_title();
            $function = get_field('function');
            $email = get_field('email');
            $social_link = get_field('social_link');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail();
            $publication_link = get_field('publication_link');
            if($count == 2){
            	$marg = 'mar-r-n';
            }
            echo	'<div class="expert '.$marg.'">
                        <a class="up-arrow" href="'.$permalink.'"><img src="'.get_stylesheet_directory_uri().'/images/2.svg"></a>
					    <div class="zinder">
					    <div class="ex-feat-img">'.$thumbnail.'</div>
					    <div class="ex-feat-txt">
					    	<a href="'.$permalink.'"><h2>'.$title.'</h2></a>
					        <span><label>Affiliation</label><p>'.$function.'</p></span>
					        <span><label style="padding-right: 27px;">Email</label><p class="b-l">'.$email.'</p></span>
					    </div>
					    </div>
					    <div class="ex-socail-img">
						    <a class="linked" href="'.$social_link.'"><img src="'.get_stylesheet_directory_uri().'/images/linkedin.png"></a>
						    <a href="'.$publication_link.'" class="view-publications" role="button">View Publications</a>
						    <a href="'.$permalink.'" class="view-profile" role="button">View Profile</a>
						</div>
					</div>';
					$count++;
            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
}
add_shortcode( 'expert_topic', 'expert_topics' );

function partnering_scholars(){
	$arg= array(
        'posts_per_page'=> 4 ,
        'post_type'=> 'scholars',
        'order'=>'DESC',
        'meta_query' => array(
	        array(
	            'key' => 'partnering',
	            'value' => 'Yes',
	            'compare' => '='
	        )
	    )
    );

    // The Query
    $the_query = new WP_Query( $arg );

    // The Loop
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $title = get_the_title();
            $function = get_field('function');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
			$link = get_field( "link_of_scholar_profile" );

            echo	'<div class="partner-feat d-flex">
					    <a href="'.$link.'"><div class="parner-img">'.$thumbnail.'</div></a>
					    <div class="zind-partner">
					        <a href="'.$link.'"><h2>'.$title.'</h2></a>
					        <span><p>'.$function.'</p></span>
					    </div>

					</div>';

            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
}
add_shortcode( 'partner_scholars', 'partnering_scholars' );

function contributing_scholars(){
	$arg= array(
        'posts_per_page'=> 4 ,
        'post_type'=> 'scholars',
        'order'=>'DESC',
        'meta_query' => array(
	        array(
	            'key' => 'contributing',
	            'value' => 'Yes',
	            'compare' => '='
	        )
	    )
    );

    // The Query
    $the_query = new WP_Query( $arg );

    // The Loop
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $title = get_the_title();
            $function = get_field('function');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
			$link = get_field( "link_of_scholar_profile" );

            echo	'<div class="partner-feat d-flex">
					    <a href="'.$link.'"><div class="parner-img">'.$thumbnail.'</div></a>
					    <div class="zind-partner">
					        <a href="'.$link.'"><h2>'.$title.'</h2></a>
					        <span><p>'.$function.'</p></span>
					    </div>

					</div>';

            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
}
add_shortcode( 'contribute_scholars', 'contributing_scholars' );

function collaborating_scholars(){
	$arg= array(
        'posts_per_page'=> 4 ,
        'post_type'=> 'scholars',
        'order'=>'DESC',
        'meta_query' => array(
	        array(
	            'key' => 'collaborating',
	            'value' => 'Yes',
	            'compare' => '='
	        )
	    )
    );

    // The Query
    $the_query = new WP_Query( $arg );

    // The Loop
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $title = get_the_title();
            $function = get_field('function');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
			$link = get_field( "link_of_scholar_profile" );

            echo	'<div class="partner-feat d-flex">
					    <a href="'.$link.'"><div class="parner-img">'.$thumbnail.'</div></a>
					    <div class="zind-partner">
					        <a href="'.$link.'"><h2>'.$title.'</h2></a>
					        <span><p>'.$function.'</p></span>
					    </div>

					</div>';

            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
}
add_shortcode( 'collaborate_scholars', 'collaborating_scholars' );

function all_directory(){
	$arg= array(
        'posts_per_page'=> -1 ,
        'post_type'=> array('scholars','experts'),
        'order'=>'DESC',
    );

    // The Query
    $the_query = new WP_Query( $arg );

    // The Loop
    if ( $the_query->have_posts() ) {
        $c = 0;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $title = get_the_title();
            $function = get_field('function');
            $email = get_field('email');
            $permalink = get_the_permalink();
            $thumbnail = get_the_post_thumbnail();
            $thumbnail1 = wp_get_attachment_url( get_post_thumbnail_id(get_the_id()), 'medium' );

            echo	'<div class="directory-feat">
					    <div class="d-flex" style="align-items: end;">
					    	<div class="parner-img dir-parner-img">'.$thumbnail.'</div>

						    <div class="zind-partner" style="margin-bottom: auto;">
						        <h2>'.$title.'</h2>
						        <span><label>Affiliation</label><p>'.$function.'</p></span>
						        <span><label padding-right: 27px;>Email</label><p class="b-l">'.$email.'</p></span>
						    </div>
						    <div class="socail-img-partner">
							    <a href="'.$permalink.'" class="elementor-button-link elementor-button elementor-size-sm hh-h" role="button">
									<span class="elementor-button-content-wrapper">
									<span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-long-arrow-alt-right"></i></span>
									<span class="elementor-button-text">View profile</span>
									</span>
								</a>
							</div>
					    </div>
					</div>';
                    $c++;
            } // end while
    wp_reset_postdata();
    } else {
    	echo '<h2>No Featured Scholars Found!</h2>';
    }
}
add_shortcode( 'all_loops', 'all_directory' );

function filter_form(){
    $ajax = get_admin_url().'admin-ajax.php';
    $html = '<input type="hidden" id="admin-ajax_" value="'.$ajax.'">
    <div class="d-flex c-filters">
        <div class="c-2">
            <i class="fas fa-search"></i>
            <input type="text" value="" class="s-filter" placeholder="Search">
        </div>
        <div class="c-2">
            <input type="text" value="" class="s-function" placeholder="Affiliation">
        </div>
    </div>';
    return $html;
}
add_shortcode( 'filters_html', 'filter_form' );

function search_filters(){
    $filter = $_REQUEST['s_filter'];
    $function = $_REQUEST['s_function'];

    if(isset($function)) {
    	$args = array(
	        's' => $filter,
	        'post_type' => 'scholars',
	        'meta_query' => array(
	            'relation' => 'AND',
				array(
				    'key'   => 'link_of_scholar_profile',
				    'value' => array(''),
				    'compare' => 'NOT IN'
				),
				array(
				    'key'   => 'function',
				    'value' => $function,
				    'compare' => 'LIKE'
				)
			)
	    );
    } else {
		$args = array(
		    's' => $filter,
		    'post_type' => 'scholars',
		    'meta_key' => 'link_of_scholar_profile',
		    'meta_value' => array(''),
		    'meta_compare' => 'NOT IN'
		);
    }

	$loop = new WP_Query( $args );

    $out = '';
    if ($loop -> have_posts()) {
        while ($loop -> have_posts()) : $loop -> the_post();
            $post_image = get_the_post_thumbnail_url();
            $post_title = get_the_title();
            $post_description = get_the_content();
            $post_category = get_the_category();
            $func_sc = get_field( "function" );
            $email_sc = get_field( "email" );
            $link = get_field( 'link_of_scholar_profile' );

            if(!empty($post_image)){
                $tt = '<img src="' . $post_image . '">';
            } else {
                $tt = '<div class="images_placeholder"><i class="fas fa-user"></i></div>';
            }
            $out .= '<div class="scholar_card_cat">
                        <div class="scholar_card_inner">
                            <div class="img_card_inner">
                                ' . $tt . '
                                <div class="scholar_intro">
                                    <h1>' . $post_title . '</h1>
                                    <h3 class="fun_sc">Affiliation <span class="fun_nam">' . $func_sc . '</span></h3>
                                    <h3 class="email_sc">Email<a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to='.$email_sc.'" target="_blank"><span class="ema_name">'.$email_sc.'</span></a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="view_btn"><a href="'.$link.'">View Profile <i class="fas fa-arrow-right"></i></a></div>
                    </div>';
		endwhile;
		wp_reset_postdata();
	} else {
		echo '<h3 style="text-align:center;">No scholars match your criteria</h4>';
	}
    die($out);
}
add_action( 'wp_ajax_search_filters', 'search_filters' );
add_action( 'wp_ajax_nopriv_search_filters', 'search_filters' );

function skills_repeater(){
    $id = get_the_ID();
    //var_dump($id);
    $arg= array(
                'post_type'=> 'scholars',
                'order'=>'DESC',
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {

                while ( $the_query->have_posts() ) {
                    $the_query->the_post();

                        if( have_rows('skills') ):
                            while( have_rows('skills') ) : the_row();
                                $skill = get_sub_field('skill');

                            echo '<li class="skill-li"><p>'.$skill.'</p></li>';
                            endwhile;
                        endif;
                }
                wp_reset_postdata();
            }
        }
add_shortcode( 'repeater_html', 'skills_repeater' );

function policy_repeater(){
    $arg= array(
                'post_type'=> 'scholars',
                'order'=>'DESC',
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {

                while ( $the_query->have_posts() ) {
                    $the_query->the_post();

    if( have_rows('policy_expertise') ):
        while( have_rows('policy_expertise') ) : the_row();
            $expertise = get_sub_field('expertise');

        echo '<li class="expertise-li"><p>'.$expertise.'</p></li>';
        endwhile;
    endif;
        }
        wp_reset_postdata();
    }
}
add_shortcode( 'expertise_html', 'policy_repeater' );

// function engagement_sect(){
//     echo '<div class="elementor-section bg-wg">
//     <div class="container">
//         <h2 class="m-t">ENGAGEMENT</h2>
//         <div class="d-flex">
//             <div class="data-sec">
//                 <h2>$234k</h2>
//                 <p>Robin Fretwell Wilson is the Director of the Institute of Government and Public Affairs and the Mildred Van Voorhis Jones Chair in Law at the University of Illinois College of Law, where she served as the Associate Dean for Public Engagement. At IGPA, Professor Wilson also leads IGPA"s Substance Use Disorder Working Group. Robin Fretwell Wilson is the Director of the Institute of Government and Public Affairs and the Mildred Van Voorhis Jones Chair in Law at the University of Illinois College of Law, where she served as the Associate Dean for Public Engagement. At IGPA, Professor Wilson also leads IGPA"s Substance Use Disorder Working Group.</p>
//                 <a href="#" class="elementor-button-link elementor-button elementor-size-xl hh-h-data" role="button">
//                     <span class="elementor-button-content-wrapper">
//                     <span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-arrow-right"></i></span>
//                     <span class="elementor-button-text">Read More</span></span>
//                 </a>
//             </div>
//             <div class="data-s-i">
//                 <img src="'.get_stylesheet_directory_uri().'/images/Group 72.png">
//             </div>
//         </div>
//     </div>
// </div>';
// }
// add_shortcode( 'engagement_html', 'engagement_sect' );

function recent_publications(){
    $arg= array(
                'posts_per_page'=> 5 ,
                'post_type'=> 'publications',
                'order'=>'ASC'
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {
                $count = 0;
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $title_public = get_the_title();
                    $permalink_public = get_the_permalink();
                    $public_thumbnail = get_the_post_thumbnail_url();

                    if ($count >= 1) {
                        $first_thumb = '';
                        $d_none = 'd-none';
                        $first_head = 'first-heading';
                    } else{
                        $first_thumb = $public_thumbnail;
                        $d_none = '';
                        $first_head = '';
                    }
                    ?>
                    <div class="publicT">
                                <div class="tt <?php echo $d_none; ?>" style="background: url('<?php echo $first_thumb; ?>');">
                                    <a class="up-arrow2" href="<?php echo $permalink_public;?>"><img src="<?php echo get_stylesheet_directory_uri()?>/images/2.svg"></a>
                                </div>
                                <div class="zindz">
                                    <h2 class="<?php echo $first_head; ?>"><?php echo $title_public; ?></h2>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                            </div>
                   <?php $count++; } // end while
            wp_reset_postdata();
            } else {
                echo '<h2>No Publications Found!</h2>';
            }
}
add_shortcode( 'publications_html', 'recent_publications' );

function upNext_section(){
    $arg= array(
                'posts_per_page'=> 5 ,
                'post_type'=> 'publications',
                'order'=>'DESC'
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {
                $count = 0;
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $title_public = get_the_title();
                    $permalink_public = get_the_permalink();
                    $public_thumbnail = get_the_post_thumbnail_url();

                    if ($count >= 1) {
                        $first_thumb = '';
                        $d_none = 'd-none';
                        $first_head = 'first-heading';
                    } else{
                        $first_thumb = $public_thumbnail;
                        $d_none = '';
                        $first_head = '';
                    }
                    ?>

                    <div class="publicT">
                                <div class="tt <?php echo $d_none; ?>" style="background: url('<?php echo $first_thumb; ?>');">
                                    <a class="up-arrow2" href="<?php echo $permalink_public;?>"><img src="<?php echo get_stylesheet_directory_uri()?>/images/2.svg"></a>
                                </div>
                                <div class="zindz">
                                    <h2 class="<?php echo $first_head; ?>"><?php echo $title_public; ?></h2>
                                    <p><?php echo get_the_date(); ?></p>
                                </div>
                            </div>
                   <?php $count++; } // end while
            wp_reset_postdata();
            } else {
                echo '<h2>No Featured Scholars Found!</h2>';
            }
}
add_shortcode( 'upNext_html', 'upNext_section' );

function policy_section(){
    echo '<div id="custom-tabs">
        <ul>
           <li><a class="first-tab tab-active" href="javascript:void(0)">Policy Work</a></li>
        </ul>
        <div id="tabs-1" class="">';
            $arg= array(
                'posts_per_page'=> -1 ,
                'post_type'=> 'policy',
                'order'=>'DESC'
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $title_feat = get_the_title();
                    $permalink_feat = get_the_permalink();
                    $feat_thumbnail = get_the_post_thumbnail_url();
                    $feat_content = get_the_content();
                    ?>

                    <div class="d-flex">
                        <div>
                            <img src="<?php echo $feat_thumbnail; ?>">
                        </div>
                        <div class="feat-txt2">
                            <h2><?php echo $title_feat; ?></h2>
                            <?php echo $feat_content; ?>
                        </div>
                        <div class="up-up">
                            <a class="up-arrow2" href="<?php echo $permalink_feat;?>"><img src="<?php echo get_stylesheet_directory_uri()?>/images/2.svg"></a>
                        </div>
                    </div>

                   <?php } // end while
            wp_reset_postdata();
            } else {
                echo '<h2>No Featured Scholars Found!</h2>';
            }
      echo  '</div>
    </div>';
}
add_shortcode( 'policy_html', 'policy_section' );

function scholars_id(){
            $arg= array(
                'posts_per_page'=> -1 ,
                'post_type'=> 'scholars',
                'order'=>'DESC'
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $scholar_ID = get_the_id();

                    echo $scholar_ID;

                    } // end while
            wp_reset_postdata();
            } else {
                echo '<h2>No Featured Scholars Found!</h2>';
            }
}

function featured_work(){

    $id_S = get_the_ID();
    //var_dump($id_S);
    echo '<div class="owl-carousel owl-theme caro-w-dot">';
            $arg= array(
                'posts_per_page'=> 5 ,
                'post_type'=> 'featured_work',
                'order'=>'ASC'
            );

            // The Query
            $the_query = new WP_Query( $arg );
            // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $title = get_the_title();
                    $content = get_the_content();
                    $permalink = get_the_permalink();
                    $thumbnail = get_the_post_thumbnail();
                    $feat = get_field_object('feat');
                    $feat_ID = $feat[value]->ID;

                    // var_dump($id_S.'scholar');
                    // var_dump($feat_ID.'postScholar');
                    // var_dump(get_the_ID());
                    if ($id_S === $feat_ID) { ?>
                        <div class="feat2 item">
                                <div class="feat-img2"><?php echo $thumbnail; ?><a class="up-arrow2" href="<?php echo $permalink_public;?>"><img src="<?php echo get_stylesheet_directory_uri()?>/images/2.svg"></a><p><?php echo get_the_date(); ?></p></div>
                                <div class="zind2">
                                    <h2><?php echo $title; ?></h2>
                                    <span class="descc"><?php echo $content; ?></span>
                                    <div class="single">
                                        <a href="<?php echo $permalink; ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">Read More<span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas">&#xf054;</i></span></a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
            wp_reset_postdata();
            } else {
                echo '<h2>No Featured Work!</h2>';
            }
        echo '</div>';
}
add_shortcode( 'featured_work_html', 'featured_work' );


function press_section(){
    echo '<div class="in-press">
        <div class="inform-box">
            <p>Stay informed on our current initiatives and check out our latest press moments</p>
            <a href="#">View All News & Events</a>
        </div>
        <div class="owl-carousel my-caro-press owl-theme">';
            $arg= array(
                'posts_per_page'=> 5 ,
                'post_type'=> 'press',
                'order'=>'ASC'
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $title_press = get_the_title();
                    $permalink_press = get_the_permalink();
                    $press_thumbnail = get_the_post_thumbnail_url();
                    $press_content = get_the_content();
                    ?>

                    <div class="item" style="background: url('<?php echo $press_thumbnail; ?>');">
                        <div>
                            <h2><?php echo $title_press; ?></h2>
                            <?php echo $press_content; ?>
                        </div>
                        <a class="up-arrow2" href="<?php echo $permalink_press;?>"><img src="<?php echo get_stylesheet_directory_uri()?>/images/2.svg"></a>
                    </div>

                   <?php } // end while
            wp_reset_postdata();
            } else {
                echo '<h2>No Press Found!</h2>';
            }
        echo '</div>
    </div>';
}
add_shortcode( 'press_section_html', 'press_section' );

function quick_links(){
    echo '<div class="quick-links">
            <ul>
                <li><a href="#">Featured Work</a></li>
                <li><a href="#">Background</a></li>
                <li><a href="#">Policy Research</a></li>
                <li><a href="#">Impact</a></li>
            </ul>
        </div>';
}
add_shortcode( 'quick_links_html', 'quick_links' );

function milestones_section(){
    echo '<div class="owl-carousel my-caro owl-theme">';
            $arg= array(
                'posts_per_page'=> 5 ,
                'post_type'=> 'milestones',
                'order'=>'ASC'
            );

            // The Query
            $the_query = new WP_Query( $arg );

            // The Loop
            if ( $the_query->have_posts() ) {
                $count = 0;
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $sub_title = get_the_title();
                    $sub_content = get_the_content();
                    $sub_year = get_field('year');
                    if ($count == 0) {
                        $f_mar = 'mar-ri';
                    }
                    if ($count == 1) {
                        $s_mar = 'mar-rs';
                    }
                    if ($count == 2) {
                        $t_mar = 'mar-rt';
                    } ?>

                    <div class="item">
                        <h2><?php echo $sub_title; ?></h2>
                        <p><?php echo $sub_content; ?></p>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('.my-caro .owl-dots button.owl-dot:eq(<?php echo $count; ?>)').append('<p></p>');
                            jQuery('.my-caro .owl-dots button.owl-dot:eq(<?php echo $count; ?>)').find('p:eq(0)').text('<?php echo $sub_year; ?>');

                            jQuery('.my-caro .owl-dots button.owl-dot:eq(0)').addClass('mar-ri');
                            jQuery('.my-caro .owl-dots button.owl-dot:eq(1)').addClass('mar-rs');
                            jQuery('.my-caro .owl-dots button.owl-dot:eq(2)').addClass('mar-rt');
                        });
                    </script>
                   <?php $count++;
                   } // end while ?>
                   <style type="text/css">
                        .elementor-widget-container .my-caro .owl-dots button.mar-ri{
                            margin-right: 20%;
                        }
                        .elementor-widget-container .my-caro .owl-dots button.mar-rs{
                            margin-right: 15%;
                        }
                        .elementor-widget-container .my-caro .owl-dots button.mar-rt{
                            margin-right: 10%;
                        }
                    </style>
            <?php wp_reset_postdata();
            } else {
                echo '<h2>No Milestones Found!</h2>';
            }
        echo '</div>';
}
add_shortcode( 'milestones_section_html', 'milestones_section');

//Racial Attitude Shortcode

function racial(){
            $arg= array(
                'posts_per_page'=> 8 ,
                'post_type'=> 'racial-attitude',
				'orderby' => 'title',
                'order'=>'ASC',
            );
            // The Query
            $the_query = new WP_Query( $arg );
            // The Loop
            if ( $the_query->have_posts() ) {?>
               <div class="container">
                    <?php
                     while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        $title = get_the_title();
                        $content = get_the_content();
                        $permalink = get_the_permalink();
                        $thumbnail = get_the_post_thumbnail_url( $the_query->ID, $default);
                        ?>
                            <div class="racial_post">
								<a href="<?php echo $permalink; ?>"><h1 class="_racial_post_title"><?php echo $title; ?></h1></a>
                                <h6 class="_racial_post_date"><?php echo get_the_date(); ?></h6>
                                 <div class="_racial_post_para"><?php echo $content; ?></div>
                                 <?php
                                 if( have_rows('downloads') ):?>
                                    <h5 class="racial_download">Download Results:</h5>
                                    <?php
                                    while( have_rows('downloads') ) : the_row();
                                         $download_text = get_sub_field('download_text_');
                                         $download_link = get_sub_field('download_link');?>
											<div class="racial_download_link">
												<a href="<?php echo $download_link; ?>" id="download_text_links"><?php echo $download_text; ?></a><i class="fas fa-chevron-right"></i>
											</div>
                                            <?php
                                        endwhile;
                                    else :
                                        echo '';
                                    endif;
                                    ?>
                            </div>
                            <?php
                    } // end while
                    ?>
                    </div>
                <?php
            wp_reset_postdata();
            } else {
                echo '<h2>No Post Found!</h2>';
            }
}
add_shortcode( 'racial_attitude', 'racial' );

	/*
    * FAQ CPT
    */

function register_events_cpt() {
	register_post_type( 'events',
	array(
		'labels' => array(
			'name' => 'Events',
			'singular_name' => 'Event',
			'add_new' => 'Add Event',
			'add_new_item' => 'Add Event',
			'edit' => 'Edit Event',
			'edit_item' => 'Edit Event',
			'new_item' => 'New Event',
			'view' => 'View Events',
			'view_item' => 'View Events',
			'search_items' => 'Search Events',
			'not_found' => 'No Event Found',
			'not_found_in_trash' => 'No Event found in Trash',
		),
		'supports' => array( 'title','thumbnail','editor'),
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-calendar-alt',
	));
	flush_rewrite_rules();
}
add_action( 'after_setup_theme', 'register_events_cpt' );

// Event Page shortcodes

function events_slider_shortcode(){
    ob_start();
	?>
	<section class="our-events">
        <div class="section-title">
            <h1>Events</h1>
        </div>
		<?php
			$args = array(
				'post_type' => 'events',
				'posts_per_page' => -1,
				'order' => 'DESC',
				'status'=>'publish'
			);
			$loop = new WP_Query( $args );
			if( $loop->have_posts() ):
		?>
        <div class="owl-carousel owl-theme">
			<?php
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
            <div class="item">
                <div class="event-wrapper" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                    <div class="event-title">
                        <h2><?php the_title(); ?></h2>
                        <a href="<?php the_permalink(); ?>">View Event <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="event-detail">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="event-description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="divide-line"></div>
                        </div>
                        <div class="col-lg-3">
                            <div class="event-info">
                                <h2><?php the_field('event_date'); ?></h2>
                                <p><i class="fas fa-clock"></i> <?php the_field('event_start_time'); ?> - <?php the_field('event_end_time'); ?></p>
                                <p><i class="fas fa-map-marker-alt"></i> <?php the_field('event_location'); ?></p>
                                <a href="<?php the_permalink(); ?>">More Details <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
				endwhile;
			?>
        </div>
		<?php
        	wp_reset_postdata();
			else:
    	?>
    		<h2>No Events Found</h2>
    	<?php
    		endif;
    	?>
    </section>

	<script>
		jQuery(document).ready(function($){
			$('.our-events .owl-carousel').owlCarousel({
				animateOut: 'fadeOut',
				loop:true,
				margin:0,
				nav:true,
				navText: ["<i class='fas fa-arrow-left'></i> Previous Event","Next Event <i class='fas fa-arrow-right'></i>"],
				dots:false,
				responsive:{
					0:{
						items:1
					}
				}
			});
		});
	</script>
	<?php
    return ob_get_clean();
}
add_shortcode( 'events_slider', 'events_slider_shortcode' );


function all_events_shortcode(){
    ob_start();
	?>
	<section class="all-events">
		<?php
			$today = date( 'Y-m-d' );
			
			$args = array(
				'post_type' => 'events',
				'posts_per_page' => -1,
				//'orderby' => 'post_date',
				'orderby' => 'meta_value_num',
				'meta_key' => 'event_date',
				'order' => 'ASC',
				'status'=>'publish',
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'value' => $today,
            'compare' => '<=',
            'type' => 'DATE'
        )
    ),
			);
			$loop = new WP_Query( $args );
			if( $loop->have_posts() ):
			while ( $loop->have_posts() ) : $loop->the_post();
		?>
        <div class="event-card">
            <div class="event-img">
                <div class="event-image">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                </div>
                <div class="event-card-info">
                    <h2><?php the_field('event_date'); ?></h2>
                    <p><i class="fas fa-clock"></i> <?php the_field('event_start_time'); ?> - <?php the_field('event_end_time'); ?></p>
                </div>
            </div>
            <div class="event-card-content">
                <h2><?php the_title(); ?></h2>
                <p><i class="fas fa-map-marker-alt"></i> <?php the_field('event_location'); ?></p>
            </div>
            <div class="view-event">
                <a href="<?php the_permalink(); ?>">View Event <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
		<?php
			endwhile;
		?>
		<?php
        	wp_reset_postdata();
			else:
    	?>
    		<h2>No Events Found</h2>
    	<?php
    		endif;
    	?>
    </section>
	<?php
    return ob_get_clean();
}
add_shortcode( 'all_events', 'all_events_shortcode' );



function featured_news_slider($atts){
    // ob_start();
	if(isset($atts['catname'])) {
		$cat_ID = $atts['catname'];
	}
	?>
	<section class="featured-news">
		<div class="featured-news-inner">
	        <div class="section-title"><h2>Featured</h2></div>
			<?php
				$args = array(
					'post_type'        => 'post',
                    'status'           => 'publish',
					'posts_per_page'   => 3,
					'orderby'          => 'title',
					'order'            => 'ASC',
					'meta_key'		   => 'featured',
					'meta_value'       => 'Yes',
                    'category__in'     => $cat_ID,
				);
				$loop = new WP_Query( $args );
				if( $loop->have_posts() ){
			?>
	        <div class="owl-carousel owl-theme">
				<?php
					while ( $loop->have_posts() ) { $loop->the_post();
				?>
	            <div class="featured-item">
	            	<div class="featured-post-wrap">
		            	<div class="featured-post-content">
		            		<h1><?php the_title(); ?></h1>
		            		<div class="featured-news-meta">
		            			<span class="news-meta-date"><?php echo get_the_date( 'M j, Y' ); ?></span> / <span class="news-meta-tag">LGBTQ Refrom</span>
		            		</div>
		                    <?php the_content(); ?>
		                    <a href="<?php the_permalink(); ?>">Read more <i class="fas fa-arrow-right"></i></a>
		            	</div>
		            	<div class="featured-post-img-box">
		            		<div class="featured-post-img" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></div>
		            	</div>
		            	<div class="clear clearfix"></div>
	            	</div>
	            </div>
				<?php } ?>
	        </div>
			<?php
	        	wp_reset_postdata();
				} else {
	    	?>
	    		<h2>No News Found</h2>
	    	<?php
	    		}
	    	?>
    	</div>
    </section>

	<script>
		jQuery(document).ready(function($){
			$('.featured-news .owl-carousel').owlCarousel({
				animateOut: 'fadeOut',
				loop: false,
				margin: 0,
				nav: true,
				navText: ["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],
				dots:false,
				responsive:{
					0:{
						items:1
					}
				}
			});
		});
	</script>
	<?php
    // return ob_get_clean();
}
add_shortcode( 'feature_news_slider', 'featured_news_slider' );




function author_details(){
    ob_start();
	?>
	<?php

// Check rows exists.
if( have_rows('author_details') ):?>
	<div class="main-author-sidebar">
		<h3 class="author-heading">Author</h3>
		<?php
    // Loop through rows.
    while( have_rows('author_details') ) : the_row();

        // Load sub field value.
        $aut_name = get_sub_field('author_name');
	    $aut_des = get_sub_field('author_designation');
	?>
     	 <div class="author">
        	<h1 class="aut_name"><?php echo $aut_name ; ?></h1>
        	<h5 class="aut_des"><?php echo $aut_des ; ?></h5>
         </div>
<?php
    // End loop.
    endwhile;
		?>
   </div>
<?php
// No value.
else :
    // Do something...
endif;
    return ob_get_clean();
}
add_shortcode( 'author', 'author_details' );




//Scholar Profile Shortcode



function scholar_pro($atts){
   // attributes for shortcode
   if (isset($atts['cat']) && isset($atts['tag'])) {$cats = $atts['cat'];$tags = $atts['tag'];} else {return;}
   if (isset($atts['posts_per_page'])) {$posts_per_page = $atts['posts_per_page'];} else {$posts_per_page = -1;}
//    $post_ID = get_the_ID();
    $args = array(
        'posts_per_page' => $posts_per_page,
        'post_type' => 'scholars',
		'orderby' => 'title',
        'order'  => 'ASC',
//         'post__not_in' => array($post_ID),
        'tax_query' => array(
            'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $cats,
        ),
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $tags,
        ),
        )
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        $card_number = 1;
        while ( $loop->have_posts() ) : $loop->the_post();
        $post_image = get_the_post_thumbnail_url();
        $post_title = get_the_title();
        $post_description = get_the_content();
        $post_category = get_the_category();
		$func_sc = get_field( "function" );
		$email_sc = get_field( "email" );

            ?>
                <div class="scholar_card_cat">
                    <div class="scholar_card_inner">
                        <div class="img_card_inner">
							<?php
								if(!empty($post_image)){
									?>
									<img src="<?php echo $post_image; ?>">
							<?php
								}
							else{
								?>
								<div class="images_placeholder">
										<i class="fas fa-user"></i>
								</div>
							<?php
							}
							?>
                            <div class="scholar_intro">
                                <h1><?php echo $post_title; ?></h1>
								<h3 class="fun_sc"><span class="funcc">Affiliation </span><span class="fun_nam"><?php echo $func_sc; ?></span></h3>
								<h3 class="email_sc">
									<span class="email_title">Email</span>
									<span>
									<a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $email_sc; ?>" target="_blank">
										<span class="ema_name">
										<?php echo $email_sc; ?>
										</span>
									</a>
									</span>
								</h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php


        endwhile;
        wp_reset_postdata();
    }
    else{
        echo 'No post Found';
    }
}
add_shortcode( 'scholar_profile', 'scholar_pro' );



// In the News Shortcode

function in_the_news_sc(){
    ob_start();
	?>
	<?php

// Check rows exists.
if( have_rows('in_the_news_detail') ):
	?>
	<h2 class="in_the_news_head">In the News</h2>

	<?php
    // Loop through rows.
    while( have_rows('in_the_news_detail') ) : the_row();

        // Load sub field value.
        $news_title = get_sub_field('in_the_news_title');
	    $news_link = get_sub_field('in_the_news_link');
	?>
		<div class="main_news">
			<div class="news_main">
        		<p class="news_title"><?php echo $news_title ; ?></p>
        	</div>
         	<div class="link_news">
         		<a href="<?php echo $news_link; ?>"><i class="fas fa-chevron-right"></i></a>
         	</div>
		</div>

<?php
    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
    return ob_get_clean();
}
add_shortcode( 'in_news', 'in_the_news_sc' );



// Related Works Shortcode

function related_works(){
    ob_start();
	?>
	<?php

// Check rows exists.
if( have_rows('related_works') ):
	?>
	<h2 class="in_the_news_head">Related Works</h2>

	<?php
    // Loop through rows.
    while( have_rows('related_works') ) : the_row();

        // Load sub field value.
        $news_title = get_sub_field('related_works_title');
	    $news_link = get_sub_field('related_works_link');
	?>
		<div class="main_news">
			<div class="news_main">
        		<p class="news_title"><?php echo $news_title ; ?></p>
        	</div>
         	<div class="link_news">
         		<a href="<?php echo $news_link; ?>"><i class="fas fa-chevron-right"></i></a>
         	</div>
		</div>

<?php
    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
    return ob_get_clean();
}
add_shortcode( 'related_work', 'related_works' );



// roaster archive shortcode
function roaster(){
    $terms = get_terms([
        'taxonomy' => 'edgar_fellow_roaster',
		'order' => 'DESC',
        'hide_empty' => false,
    ]);

    foreach ( $terms as $term) { $term_slug = $term->slug; ?>
		<div class="fellow-main">
			<div class="roaster-img">
				<img src="<?php the_field('roaster_image',$term->taxonomy . '_' . $term->term_id); ?>">
			</div>
			<div class="roaster-detail">
                <p id="title"><?php echo $term->name; ?></p>
                <a href="<?php echo $url = home_url( '/edgar-fellows-alumni/?fellows=' ) .  $term_slug; ?>" id="view-btn">View All <i aria-hidden="true" class="fas fa-arrow-right"></i></a>
			</div>
		</div>
   <?php }
}
add_shortcode( 'fellow', 'roaster' );


function edgar_fellows(){

	global $wpdb;
	$fellows = $_REQUEST['fellow-option'];
	$fellows_q = $_REQUEST['fellow-query'];

	if (isset( $fellows_q ) && !empty( $fellows_q )) {
		$temp_args = array(
	        'post_type' => 'scholars',
	        'posts_per_page' => -1,
	        'order'  => 'ASC',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'edgar_fellow_roaster',
	                'field'    => 'slug',
	                'terms'    => $fellows,
	            )
	        )
	    );
		$temp_loop = new WP_Query( $temp_args );

		$mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '%".$fellows_q."%' ");
	    $args = array(
	        'post__in'=> $mypostids,
	        'post_type' => 'scholars',
	        'posts_per_page' => -1,
	        'order'  => 'ASC',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'edgar_fellow_roaster',
	                'field'    => 'slug',
	                'terms'    => $fellows,
	            )
	        )
	    );
	} else {
		$args = array(
	        'post_type' => 'scholars',
	        'posts_per_page' => -1,
	        'order'  => 'ASC',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'edgar_fellow_roaster',
	                'field'    => 'slug',
	                'terms'    => $fellows,
	            )
	        )
	    );
	}

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        $card_number = 1;
        while ( $loop->have_posts() ) : $loop->the_post();
        $post_image = get_the_post_thumbnail_url();
        $post_title = get_the_title();
        $post_description = get_the_content();
        $post_category = get_the_category();
        $func_sc = get_field( "function" );
        $email_sc = get_field( "email" );
        $link = get_field( 'link_of_scholar_profile' ); ?>

            <div class="scholar_card_cat">
                <div class="scholar_card_inner">
                    <div class="img_card_inner">
							<?php if(!empty($post_image)){ ?>
								<img src="<?php echo $post_image; ?>">
							<?php } else { ?>
								<div class="images_placeholder">
									<i class="fas fa-user"></i>
								</div>
							<?php } ?>
                        <div class="scholar_intro">
                            <h1><?php echo $post_title; ?></h1>
                            <h3 class="fun_sc">Affiliation <span class="fun_nam"><?php echo $func_sc; ?></span></h3>
                            <h3 class="email_sc">
									<span class="email_title">Email</span>
									<span>
									<a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $email_sc; ?>" target="_blank">
										<span class="ema_name">
										<?php echo $email_sc; ?>
										</span>
									</a>
									</span>
								</h3>
                        </div>
                    </div>
                </div>
                <?php if($link){ ?>
                    <div class="view_btn"><a href="<?php echo get_permalink(); ?>">View Profile <i class="fas fa-arrow-right"></i></a></div>
                <?php } ?>
            </div>
        <?php


        endwhile;
        wp_reset_postdata();
    }
    else{
        echo 'No post Found..!';
    }

	die();
}
add_action('wp_ajax_edgar_fellows', 'edgar_fellows');
add_action('wp_ajax_nopriv_edgar_fellows', 'edgar_fellows');

function leadership(){

    global $wpdb;
    $fellows = $_REQUEST['leader-option'];
    $fellows_q = $_REQUEST['leader-query'];

    if (isset( $fellows_q ) && !empty( $fellows_q )) {
        $temp_args = array(
            'post_type' => 'scholars',
            'posts_per_page' => -1,
            // 'meta_key' => 'link_of_scholar_profile',
            // 'meta_value' => array(''),
            // 'meta_compare' => 'NOT IN',
            'order'  => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'leadership_class',
                    'field'    => 'slug',
                    'terms'    => $fellows,
                )
            )
        );
        $temp_loop = new WP_Query( $temp_args );

        $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '%".$fellows_q."%' ");
        $args = array(
            'post__in'=> $mypostids,
            'post_type' => 'scholars',
            'posts_per_page' => -1,
            // 'meta_key' => 'link_of_scholar_profile',
            // 'meta_value' => array(''),
            // 'meta_compare' => 'NOT IN',
            'order'  => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'leadership_class',
                    'field'    => 'slug',
                    'terms'    => $fellows,
                )
            )
        );
    } else {
		$args = array(
	        'post_type' => 'scholars',
	        'posts_per_page' => -1,
            // 'meta_key' => 'link_of_scholar_profile',
            // 'meta_value' => array(''),
            // 'meta_compare' => 'NOT IN',
            'orderby' => 'title',
	        'order'  => 'ASC',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'leadership_class',
	                'field'    => 'slug',
	                'terms'    => $fellows,
	            )
	        )
	    );
	}

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        $card_number = 1;
        while ( $loop->have_posts() ) : $loop->the_post();
        $post_image = get_the_post_thumbnail_url();
        $post_title = get_the_title();
        $post_description = get_the_content();
        $post_category = get_the_category();
        $func_sc = get_field( "function" );
        $email_sc = get_field( "email" );
      	$link = get_field( 'link_of_scholar_profile' );
    ?>
            <div class="scholar_card_cat">
                <div class="scholar_card_inner">
                    <div class="img_card_inner">
                            <?php if(!empty($post_image)){ ?>
                                <img src="<?php echo $post_image; ?>">
                            <?php } else { ?>
                                <div class="images_placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            <?php } ?>
                        <div class="scholar_intro">
                            <h1><?php echo $post_title; ?></h1>
                            <h3 class="fun_sc">Affiliation <span class="fun_nam"><?php echo $func_sc; ?></span></h3>
                        </div>
                    </div>
                </div>
                <?php if($link){ ?>
                	<div class="view_btn"><a href="<?php echo $link; ?>">View Profile <i class="fas fa-arrow-right"></i></a></div>
                <?php } ?>
            </div>
        <?php


        endwhile;
        wp_reset_postdata();
    }
    else{
        echo 'No post Found..!!!';
    }
    die();
}
add_action('wp_ajax_leadership', 'leadership');
add_action('wp_ajax_nopriv_leadership', 'leadership');


function dropdown_filter_shortcode(){
    ob_start();
        include('template-parts/fellows-filter.php');
    return ob_get_clean();
}
add_shortcode('dropdown_filter', 'dropdown_filter_shortcode');

function leadership_filter_shortcode(){
    ob_start();
        include('template-parts/leadership-filter.php');
    return ob_get_clean();
}
add_shortcode('leader_filter', 'leadership_filter_shortcode');



function Press_article(){
    ob_start();
	?>
	<?php
	$press_article_text = get_field( "sidebar_article_text" );
	$press_article_author_title = get_field( "sidebar_article_title_name" );
	$press_article_author_name = get_field( "sidebar_article_publisher_name" );
	$press_article_text_link = get_field( "sidebar_article_link" );
// Check rows exists.
if( !empty($press_article_text)):?>
	<div class="side-bar-press-article">
            <div class="article-qoutes">
                <i aria-hidden="true" class="fas fa-quote-left" id="qoute_btn"></i>
                <p class="article-text"><?php echo $press_article_text; ?></p>
				<p class="article-author-name"><?php  echo $press_article_author_title; ?>/<?php echo $press_article_author_name; ?></p>
				<div class="btn-press">
					<a href="<?php echo $press_article_text_link; ?>">
					<button class="press-article-links">Full Press Release <i aria-hidden="true" class="fas fa-arrow-right"></i></button>
					</a>
				</div>
            </div>
     </div>
<?php
// No value.
else :
    // Do something...
endif;
    return ob_get_clean();
}
add_shortcode( 'sidebar_press_article', 'Press_article' );



// Scholar Profile Shortcode

add_shortcode( 'all_scholars', 'more_post_ajax' );

function more_post_ajax(){

//echo $_POST["ppp"]; exit;
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 10;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'scholars',
		'orderby' => 'title',
        'order' => 'ASC',
        'meta_key' => 'link_of_scholar_profile',
		'meta_value' => array(''),
		'meta_compare' => 'NOT IN',
        'posts_per_page' => $ppp,
        'paged'    => $page,
    );
    $loop = new WP_Query($args);



    $out = '';
    if ($loop -> have_posts()) {
    	while ($loop -> have_posts()) : $loop -> the_post();
        $exclude[] = $post->ID; 
			$post_image = get_the_post_thumbnail_url();
	        $post_title = get_the_title();
	        $post_description = get_the_content();
	        $post_category = get_the_category();
			$func_sc = get_field( "function" );
			$email_sc = get_field( "email" );
			$link = get_field( 'link_of_scholar_profile' );

	        if(!empty($post_image)){
	            $tt = '<img src="' . $post_image . '">';
	        } else {
	            $tt = '<div class="images_placeholder"><i class="fas fa-user"></i></div>';
	        }

			$out .= '<div class="scholar_card_cat">
						<div class="scholar_card_inner">
                        	<div class="img_card_inner">
                        		' . $tt . '
                                <div class="scholar_intro">
                                <h1>' . $post_title . '</h1>
                                <h3 class="fun_sc">Affiliation  <ul><li class="fun_nam">' . $func_sc . '</li> </ul></h3>
                                <h3 class="email_sc">
                                    <span class="email_title">Email</span>
                                    <span>
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to='.$email_sc.'" target="_blank">
                                        <span class="ema_name">'.$email_sc.'</span>
                                    </a>
                                    </span>
                                </h3>
                            </div>
                        	</div>
                    	</div>
                    	<div class="view_btn"><a href="'.$link.'">View Profile <i class="fas fa-arrow-right"></i></a></div>
                	</div>';
        
    	endwhile;
        wp_reset_postdata();

        
    } else{
        $out = 'No post Found';
    }
    $out .= '<div id="ajax-posts"></div>';
    $out .=  '<div id="more_posts"><a href="javascript:void(0)">Load More</a></div>';
    add_action('wp_footer','double_btn_fix');
    echo $out;
}
function double_btn_fix(){
        echo "<style> #ajax-posts #more_posts{display:none !important;}</style>";
}
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


function flash_index_detail_graph(){
    ob_start();
    $graph_data = get_field('index_data');
    $data_rows = array_reverse($graph_data);
    $highestYear = array();
    foreach( $data_rows as $row ) {
        $highestYear[] = $row['data_year'];
    }
    $highYear = max($highestYear);
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="index_data_chart_filter">
        <select name="year" id="year">
            <option value="">Select Year</option>
            <?php foreach( $data_rows as $row ) { ?>

                <?php  ?>

                <option value="<?php echo $row['data_year']; ?>" <?php if($row['data_year']==$highYear){echo 'selected';} ?>><?php echo $row['data_year']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div id="index_data_chart"></div>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback();

        function load_monthwise_data(year, title) {
            var temp_title = title + ' '+year+'';
            jQuery.ajax({
                url: ajax_object.ajax_url,
                method: "POST",
                data: {year:year, action: 'custom_graph_data'},
                dataType: "JSON",
                success:function(res){
                    drawMonthwiseChart(res, temp_title);
                },
                error:function(err){
                    // console.log(err);
                }
            });
        }

        function drawMonthwiseChart(chart_data, chart_main_title){
            var jsonData = chart_data;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Index');

            jQuery.each(jsonData, function(i, jsonData){
                var month = jsonData.month;
                var profit = parseFloat(jQuery.trim(jsonData.profit));
                data.addRows([[month, profit]]);
            });

            var options = {
                width: 1100,
                height: 500,
                isStacked: true,
                // colors: ['blue'],
                hAxis: {
                    format: 'MMM yy',
                    // gridlines: {count: 15},
                },
                vAxis: {
                    gridlines: {color: '#eee'},
                    viewWindowMode:'explicit',
                    viewWindow:{
                        min: 80,
                    }
                    // ticks: [80, 85, 90, 95, 100, 105, 110, 115, 120],
                },
            	chartArea: {left: 35, right: 35},
            };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('index_data_chart'));
        chart.draw(data, options);

        }

    </script>

    <script>
    jQuery(document).ready(function(){
        var closestYear = jQuery('#year').find(":selected").text();
        load_monthwise_data(closestYear, 'Month Wise Profit Data For');

        jQuery('#year').change(function(){
            var year = jQuery(this).val();
            if(year != ''){
                load_monthwise_data(year, 'Month Wise Profit Data For');
            }
        });
    });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode( 'index_data_graph', 'flash_index_detail_graph' );

function flash_index_detail_table(){
	ob_start();

	if( have_rows('index_data') ){
		$index_data = get_field('index_data');
		$data_rows = array_reverse($index_data); ?>

		<div class="index-archive-table">
			<table>
				<thead>
					<tr>
						<th colspan="1"></th>
						<th class="index-head">Jan</th>
						<th class="index-head">Feb</th>
						<th class="index-head">Mar</th>
						<th class="index-head">Apr</th>
						<th class="index-head">May</th>
						<th class="index-head">Jun</th>
						<th class="index-head">Jul</th>
						<th class="index-head">Aug</th>
						<th class="index-head">Sep</th>
						<th class="index-head">Oct</th>
						<th class="index-head">Nov</th>
						<th class="index-head">Dec</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach( $data_rows as $row ) { ?>
					<tr>
						<td><?php echo $row['data_year']; ?></td>
						<td><?php echo $row['january_data']; ?></td>
						<td><?php echo $row['february_data']; ?></td>
						<td><?php echo $row['march_data']; ?></td>
						<td><?php echo $row['april_data']; ?></td>
						<td><?php echo $row['may_data']; ?></td>
						<td><?php echo $row['june_data']; ?></td>
						<td><?php echo $row['july_data']; ?></td>
						<td><?php echo $row['august_data']; ?></td>
						<td><?php echo $row['september_data']; ?></td>
						<td><?php echo $row['october_data']; ?></td>
						<td><?php echo $row['november_data']; ?></td>
						<td><?php echo $row['december_data']; ?></td>
					</tr>
				<?php } ?>
				</tbody>

			</table>
		</div>

	<?php } else {
		echo "Nothing Found!";
	}
	return ob_get_clean();
}
add_shortcode( 'index_data', 'flash_index_detail_table' );

function sevenYearSelect($field) {
    $currentYear = date('Y');
    $field['choices'] = array();

    foreach(range($currentYear-55, $currentYear) as $year) {
		$field['choices'][$year] = $year;
    }
    return $field;
}
add_filter('acf/load_field/key=field_620edce437f52', 'sevenYearSelect');


function custom_graph_data(){

    if(isset($_POST["year"])) {

        $graph_data = get_field('index_data', 26790);
        $data_rows = array_reverse($graph_data);

        foreach( $data_rows as $row ) {

            if($_POST["year"] == $row['data_year']) {

                if(!empty($row['january_data'])){
                    $output[] = array(
                        'month'   => 'Jan',
                        'profit'  => floatval($row['january_data'])
                    );
                }
                if(!empty($row['february_data'])){
                    $output[] = array(
                        'month'   => 'Feb',
                        'profit'  => floatval($row['february_data'])
                    );
                }
                if(!empty($row['march_data'])){
                    $output[] = array(
                        'month'   => 'Mar',
                        'profit'  => floatval($row['march_data'])
                    );
                }
                if(!empty($row['april_data'])){
                    $output[] = array(
                        'month'   => 'Apr',
                        'profit'  => floatval($row['april_data'])
                    );
                }
                if(!empty($row['may_data'])){
                    $output[] = array(
                        'month'   => 'May',
                        'profit'  => floatval($row['may_data'])
                    );
                }
                if(!empty($row['june_data'])){
                    $output[] = array(
                        'month'   => 'Jun',
                        'profit'  => floatval($row['june_data'])
                    );
                }
                if(!empty($row['july_data'])){
                    $output[] = array(
                        'month'   => 'Jul',
                        'profit'  => floatval($row['july_data'])
                    );
                }
                if(!empty($row['august_data'])){
                    $output[] = array(
                        'month'   => 'Aug',
                        'profit'  => floatval($row['august_data'])
                    );
                }
                if(!empty($row['september_data'])){
                    $output[] = array(
                        'month'   => 'Sep',
                        'profit'  => floatval($row['september_data'])
                    );
                }
                if(!empty($row['october_data'])){
                    $output[] = array(
                        'month'   => 'Oct',
                        'profit'  => floatval($row['october_data'])
                    );
                }
                if(!empty($row['november_data'])){
                    $output[] = array(
                        'month'   => 'Nov',
                        'profit'  => floatval($row['november_data'])
                    );
                }
                if(!empty($row['december_data'])){
                    $output[] = array(
                        'month'   => 'Dec',
                        'profit'  => floatval($row['december_data'])
                    );
                }
            }
        }
        echo json_encode($output);
    }
    exit();
}
add_action('wp_ajax_nopriv_custom_graph_data', 'custom_graph_data');
add_action('wp_ajax_custom_graph_data', 'custom_graph_data');


function flash_index_main_page_graph(){
    ob_start(); ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['',  'Index'],
          ['Jan',      <?php the_field('january_index'); ?>],
          ['Feb',      <?php the_field('february_index'); ?>],
          ['Mar',      <?php the_field('march_index'); ?>],
          ['Apr',      <?php the_field('april_index'); ?>],
          ['May',      <?php the_field('may_index'); ?>],
          ['Jun',      <?php the_field('june_index'); ?>],
          ['Jul',      <?php the_field('july_index'); ?>],
          ['Aug',      <?php the_field('august_index'); ?>],
          ['Sep',      <?php the_field('september_index'); ?>],
          ['Oct',      <?php the_field('october_index'); ?>],
          ['Nov',      <?php the_field('november_index'); ?>],
          ['Dec',      <?php the_field('december_index'); ?>],
        ]);

        var options = {
			height: 515,
			isStacked: true,
			hAxis: {
				format: 'MMM yy',
			},
            vAxis: {
                gridlines: {color: '#eee'},
                viewWindowMode:'explicit',
                viewWindow:{
                    min: 80,
                }
            },
            chartArea: {left: 35, right: 15},
            legend: { position: 'top', alignment: 'end' },
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('index_data_chart'));

        chart.draw(data, options);
      }
    </script>

    <div id="index_data_chart"></div>


    <?php
    return ob_get_clean();
}
add_shortcode( 'index_data_main_page', 'flash_index_main_page_graph' );