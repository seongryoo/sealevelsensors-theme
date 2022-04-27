<?php get_header(); ?>

<main id="content" class="<?php 
  if ( is_single() || is_page() ) {
    global $post;
    $post_slug = $post->post_name;
    echo $post_slug;
  }
?>">
  
  <div class="section">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-9">
          <h1><?php the_title(); ?></h1>
          <?php

            $args = array(
              'post_type' => 'post',
              'category_name' => 'blog',
            );
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {
              while ( $the_query->have_posts() ) {
                $the_query->the_post();
                
                $src = get_avatar_url( get_the_author_meta( 'ID' ), 32 ); 
                $href = get_permalink();
                $title = get_the_title();
                $author = get_the_author();

                $guest_author = get_post_meta( get_the_ID(), 'dev_guest_author_name', true);
                $guest_author_img = get_post_meta( get_the_ID(), 'dev_guest_author_img', true);

                if ( $guest_author != '' ) {
                  $author = $guest_author;
                  $src = $guest_author_img;
                  if ( $guest_author_img == '' ) {
                    // Returns default author url from wordpress
                    $src = get_avatar_url( '', 32 );
                  }
                }
                
                $markup = '<div class="blog-post-block card">';
                
                /* Post author */
                  $markup .= '<div class="bio-block blog">';
                
                    $markup .= '<img class="blog-post-author-image" src="' . $src . '" alt="' . $author . '">';
                  
                    $markup .= '<div class="bio-block-info">';
                      $markup .= '<p class="blog-post-author">' . $author . '</p>';
                      $markup .= '<p class="blog-post-date">' . get_the_date( 'M j, Y' ) . '</p>';
                    $markup .= '</div>';
                
                  $markup .= '</div>';
                
                /* Post title */
                  $markup .= '<a href="' . $href . 
                              '" aria-label="' . $title . 'posted by ' . $author . 'on ' . get_the_date( 'F jS, Y' ) . '">';
                
                    $markup .= '<h3 class="blog-post-title" aria-hidden="true">' . get_the_title() . '</h3>';
                    
                    /* Post excerpt */
                    $markup .= '<p class="blog-post-excerpt"><span class="visually-hidden">Excerpt: </span>' . get_the_excerpt() . '</p>';
                
                  $markup .= '</a>';
                
                
                  
                
                
                
                /* Number of comments */
                  $markup .= '<a href="' . $href . '/#comments" aria-label="Read comments on ' . $title . '">';
                
                  if ( get_comments_number() == 1 ) {
                    $markup .= '<p class="blog-post-comments">' . get_comments_number() . ' comment</p>';
                  } else {
                    $markup .= '<p class="blog-post-comments">' . get_comments_number() . ' comments</p>';
                  }
                
                  $markup .= '</a>';
                /* End of wrapper div */
                $markup .= '</div>';
                
                echo $markup;
              }
            }
          ?>
        </div>
      </div>
    </div><!--/.container-->
  </div><!--/.section-->
</main>

<?php get_footer(); ?>