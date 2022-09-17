<?php
/**
 * Widget Listed Post
 *
 * @package Bakery_shop
 */
 
// register Bakery_Shop_Listed_Post widget
function bakery_shop_register_listed_post_widget() {
    register_widget( 'Bakery_Shop_Listed_Post' );
}
add_action( 'widgets_init', 'bakery_shop_register_listed_post_widget' );
 
 /**
 * Adds Bakery_Shop_Listed_Post widget.
 */
class Bakery_Shop_Listed_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bakery_shop_listed_post', // Base ID
			esc_html__( 'PROSYS: Listed Post', 'bakery-shop' ), // Name
			array( 'description' => esc_html__( 'A Listed Post Widget', 'bakery-shop' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	   
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $num_post       = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumb     = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_date      = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $listed_type    = ! empty( $instance['listed_type'] ) ? $instance['listed_type'] : 'recent';
        
        $post_args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $num_post,
            'ignore_sticky_posts' => true,
        );   
        if(  $listed_type  == 'popular' ){
            $post_args['orderby'] = 'comment_count';
        }
        $qry = new WP_Query( $post_args );
        
        if( $qry->have_posts() ){
            echo $args['before_widget'];
            if( isset($title) && $title != "" ) { echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title']; }
            ?>
            <ul>
                <?php 
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
                    <li>
                        <?php if( has_post_thumbnail() && $show_thumb ){ ?>
                            <a href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php the_post_thumbnail( 'thumbnail' );?>
                            </a>
                        <?php }?>
                        <div class="entry-header">
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                            <?php if( $show_date  ){?>
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <a href="<?php the_permalink(); ?>">
                                            <time><?php  echo esc_html( get_the_date( get_option( 'date_format' ) ) ); ?></time>
                                        </a>                                    
                                    </span>
                                </div>
                            <?php }?>
                        </div>                        
                    </li>        
                <?php    
                }
            ?>
            </ul>
            <?php
            echo $args['after_widget'];   
        }
        wp_reset_postdata();  
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $num_post       = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_postdate  = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $listed_type    = ! empty( $instance['listed_type'] ) ? $instance['listed_type'] : 'recent';
        
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'bakery-shop' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) );  ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'bakery-shop' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_post' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $num_post ); ?>" />
		</p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'bakery-shop' ); ?></label>
		</p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_postdate' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_postdate ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>"><?php esc_html_e( 'Show Post Date', 'bakery-shop' ); ?></label>
		</p>

        <p> 
            <label for="<?php echo esc_attr( $this->get_field_id( 'listed_type' ) ); ?>"><?php esc_html_e( 'Listed As', 'bakery-shop' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_name( 'listed_type' ) ); ?>" type="radio" name="<?php echo esc_attr( $this->get_field_name( 'listed_type' ) ); ?>" value="<?php echo esc_attr( 'recent' ); ?>" <?php checked( 'recent', $listed_type ); ?> ><?php _e( 'Recent', 'bakery-shop' ); ?>
            <input id="<?php echo esc_attr( $this->get_field_name( 'listed_type' ) ); ?>" type="radio" name="<?php echo esc_attr( $this->get_field_name( 'listed_type' ) ); ?>" value="<?php echo esc_attr( 'popular' ); ?>" <?php checked( 'popular', $listed_type ); ?> ><?php _e( 'Popular', 'bakery-shop' ); ?>
        </p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']          = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['num_post']       = ! empty( $new_instance['num_post'] ) ? absint( $new_instance['num_post'] ) : 3 ;        
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? absint( $new_instance['show_thumbnail'] ) : '';
        $instance['show_postdate']  = ! empty( $new_instance['show_postdate'] ) ? absint( $new_instance['show_postdate'] ) : '';
        $instance['listed_type']    = ! empty( $new_instance['listed_type'] ) ? sanitize_text_field( $new_instance['listed_type'] ) : '';
		
        return $instance;
                
	}

} // class Bakery_Shop_Listed_Post 