<?php get_header(); ?>


<main id="content" class="<?php 
  if ( is_single() || is_page() ) {
    global $post;
    $post_slug = $post->post_name;
    echo $post_slug;
  }
?>">
  
  <div class="blog section">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-9">
          <nav aria-label="Breadcrumbs" class="breadcrumbs">
            <p>
              <a href="/blog/" class="back-link">
                <span aria-hidden="true">❮ </span>
                Back to blog
              </a>
            </p>
          </nav>
          <?php

            if ( have_posts() ) {
              while ( have_posts() ) {
                the_post(); 
                
                $src = get_avatar_url( get_the_author_meta( 'ID' ), 32 ); 
                $href = get_permalink();
                $title = get_the_title();
                $author = get_the_author();
                $authorURL = esc_url( get_the_author_meta( 'url' ) );

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

              /* Post title */
                
              $markup = '';

              $markup .= '<h1 class="blog-post-title" aria-hidden="true">' . $title . '</h1>';
          
              /* Post author */
                $markup .= '<div class="bio-block">';

                  $markup .= '<img class="blog-post-author-image" width="32" height="32" src="' . $src . '" alt="' . $author . '">';

                  $markup .= '<div class="bio-block-info">';
                    $markup .= '<p class="blog-post-author">' . $author . '</p>';
                    $markup .= '<p class="blog-post-date">' . get_the_date( 'M j, Y' ) . '</p>';
                  $markup .= '</div>';

                $markup .= '</div>';

              echo $markup;

              ?>

                <?php the_content(); ?>

                <?php
              }
            }

          ?>
          
          <?php
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }
          
          ?>
        </div><!--/.col-md-9-->
      </div><!--/.row-->
    </div><!--/.container-->
  </div><!--/.section-->
</main>

<?php get_footer(); ?>