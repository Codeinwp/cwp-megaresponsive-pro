<?php
/*
 * Template Name: Contact
*/

$commentError = '';
$nameError = '';
$emailError = '';

if(isset($_POST['submitted'])) {
        if(trim($_POST['contactName']) === '') {
               $nameError = __('Please enter your name.','cwp-megaresponsive-pro');
               $hasError = true;
        } else {
               $name = trim($_POST['contactName']);
        }
 
        if(trim($_POST['email']) === '')  {
               $emailError = __('Please enter your email address.','cwp-megaresponsive-pro');
               $hasError = true;
        } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
               $emailError = __('You entered an invalid email address.','cwp-megaresponsive-pro');
               $hasError = true;
        } else {
               $email = trim($_POST['email']);
        }
 
        if(trim($_POST['comments']) === '') {
               $commentError = __('Please enter a message.','cwp-megaresponsive-pro');
               $hasError = true;
        } else {
               $comments = stripslashes(trim($_POST['comments']));
        }
 
        if(!isset($hasError)) {
               $emailTo = get_theme_mod('cwp_megaresponsive_pro_email_address');
               if (!isset($emailTo) || ($emailTo == '') ){
                       $emailTo = get_option('admin_email');
               }
               $subject = '[PHP Snippets] From '.$name;
               $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
               $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
 
               wp_mail($emailTo, $subject, $body, $headers);
               $emailSent = true;
        }
 
}

get_header(); 

$sidebar_position = get_theme_mod( 'sidebar_position' );

if( empty($sidebar_position) ):
	$sidebar_position = 'two-sidebar';
endif;

?>

<div id="primary" class="content-area <?php echo $sidebar_position; ?>"> 
    <div id="content" class="site-content" role="main" style="<?php 
                if( ($sidebar_position === 'one-sidebar-left') || ($sidebar_position === 'full-width') ): 
                    echo 'margin-right: 0';
                endif;
                ?>">
        
        <div class="w1">
            <div class="w2" style="<?php 
                if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'full-width') ): 
                    echo 'margin-left: 0';
                elseif( $sidebar_position === 'two-sidebar-right' ):
                    echo 'margin-left: 200px; margin-right: 0';
                endif;
                ?>">

            <div class="main-content">
                <div class="frontpage-wrap" style="<?php 
                    if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'full-width') ): 
                        echo 'margin-left: 0';
                    elseif( $sidebar_position === 'two-sidebar-right' ):
                        echo 'margin-left: 0; margin-right: 30px';
                    endif;
                ?>">

                       <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                       <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                               <h1><?php the_title(); ?></h1>
                                      <div>
                                              <?php if(isset($emailSent) && $emailSent == true) { ?>
                                                      <div>
                                                             <p class="messsage_sent"><?php _e('Thanks, your email was sent successfully.', 'cwp-megaresponsive-pro'); ?></p>
                                                      </div>
                                              <?php } else { ?>
                                              		  <div class="content-contact">
                                                      	<?php the_content(); ?>
                                                      </div><!-- .content-contact -->
                                                      <?php if(isset($hasError) || isset($captchaError)) { ?>
                                                             <p class="messsage_error"><?php _e('Sorry, an error occured.', 'cwp-megaresponsive-pro'); ?><p>
                                                      <?php } ?>
 										
                                            <div class="cotnact-form-wrap">
                                            
                                              <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                                                      <ul>
                                                      <li>
                                                             <label for="contactName"><?php _e('Name', 'cwp-megaresponsive-pro'); ?></label>
                                                             <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" />
                                                             <?php if($nameError != '') { ?>
                                                                     <span><?php $nameError;?></span>
                                                             <?php } ?>
                                                      </li>
 
                                                      <li>
                                                             <label for="email"><?php _e('Email:', 'cwp-megaresponsive-pro'); ?></label>
                                                             <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />
                                                             <?php if($emailError != '') { ?>
                                                                     <span><?php $emailError;?></span>
                                                             <?php } ?>
                                                      </li>
 
                                                      <li><label for="commentsText"><?php _e('Message:', 'cwp-megaresponsive-pro'); ?></label>
                                                             <textarea name="comments" id="commentsText" rows="7" cols="10"><?php if(isset($_POST['comments'])) { echo stripslashes($_POST['comments']); } ?></textarea>
                                                             <?php if($commentError != '') { ?>
                                                                     <span><?php $commentError;?></span>
                                                             <?php } ?>
                                                      </li>
 
                                                      <li>
                                                             <input type="submit" value="Send email"></input>
                                                      </li>
                                              </ul>
                                              <input type="hidden" name="submitted" id="submitted" value="true" />
                                      </form>
                                      </div><!-- .cotnact-form-wrap -->
                                      
                               <?php } ?>
                               </div><!-- .entry-content -->
                       </div><!-- .post -->
 
                               <?php endwhile; endif; ?>
                </div>
            </div>

            <?php if( ($sidebar_position === 'one-sidebar-left') || ($sidebar_position === 'two-sidebar-right') || ($sidebar_position === 'two-sidebar') ): ?>
                <div class="sidebar-left-wrap" style="<?php 
                        if( $sidebar_position === 'two-sidebar-right' ):
                            echo 'float: right; margin-right: 0;';
                        endif;
                    ?>">
                    <?php get_sidebar('left');  ?>
                </div><!-- .side-content -->
            <?php endif; ?>
            
      </div><!-- .w2 -->
    </div><!-- .w1 -->

    </div><!-- #content --> 
</div><!-- #primary --> 

<?php
  if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'two-sidebar-right') || ($sidebar_position === 'two-sidebar') ): 
    get_sidebar();
  endif;

get_footer(); ?>