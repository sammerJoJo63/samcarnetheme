<?php
/**
 * Template Name: Home Page
 * 
 * @package BeOnePage
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section id="slider" class="slider<?php echo Kirki::get_option( 'front_page_text_slider_parallax' ) == '1' ? ' slider-parallax' : ''; ?> nopadding clearfix">
				<div class="full-screen">
					<div class="container slider-caption text-center clearfix">
						<?php
							if ( Kirki::get_option( 'front_page_text_slider_title' ) != '' ) {
								echo '<h1>' . strip_tags( html_entity_decode( Kirki::get_option( 'front_page_text_slider_title' ) ), '<span>' ) . '</h1>';
							}
						?>

						<?php
							if ( Kirki::get_option( 'front_page_text_slider_content' ) != '' ) {
								echo '<p>' . strip_tags( html_entity_decode( Kirki::get_option( 'front_page_text_slider_content' ) ), '<span>' ) . '</p>';
							}
						?>

						<?php if ( Kirki::get_option( 'front_page_text_slider_btn_text' ) != '' ) : ?>
							<div class="slider-btn">
								<a href="<?php echo Kirki::get_option( 'front_page_text_slider_btn_url' ); ?>" class="btn btn-light"><?php echo Kirki::get_option( 'front_page_text_slider_btn_text' ); ?></a>
							</div><!-- .slider-btn -->
						<?php endif; ?>
					</div><!-- .container -->
				</div><!-- .full-screen -->

				<?php if ( Kirki::get_option( 'front_page_text_slider_scroll_down' ) == '1' ) : ?>
					<div class="scroll-down"></div>
				<?php endif; ?>
			</section><!-- #slider -->
			<div id="skillSpotlight"></div>
			<section id="<?php echo Kirki::get_option( 'front_page_icon_service_module_id' ); ?>" class="module icon-service-module clearfix">
				<div class="<?php echo Kirki::get_option( 'front_page_icon_service_module_layout' ) == 'fixed' ? 'container' : 'container-fluid'; ?>">
                    <div class="row">
						<?php if ( Kirki::get_option( 'front_page_icon_service_module_title' ) != '' ) : ?>
							<div class="module-caption col-md-12 text-center">
								<h2><?php echo strip_tags( html_entity_decode( Kirki::get_option( 'front_page_icon_service_module_title' ) ), '<span>' ); ?></h2>

								<?php if ( Kirki::get_option( 'front_page_icon_service_module_subtitle' ) != '' ) : ?>
									<p><?php echo Kirki::get_option( 'front_page_icon_service_module_subtitle' ); ?></p>
								<?php endif; ?>

								<div class="separator">
									<span><i class="fa fa-circle"></i></span>
								</div><!-- .separator -->

								<div class="spacer"></div>
							</div><!-- .module-caption -->
						<?php endif; ?>

						<?php $icon_service_boxes = get_post_meta( get_option( 'page_on_front' ), '_beonepage_option_icon_service_box', true ); ?>

						<?php if ( ! empty( $icon_service_boxes ) ) : ?>
							<?php foreach ( $icon_service_boxes as $icon_service_box ) : ?>
								<?php
									if ( Kirki::get_option( 'front_page_icon_service_module_layout' ) == 'fixed' ) {
										$width = 'col-md-4';
									} else {
										$width = 'col-md-3';
									}
								?>

								<div class="icon-service-box <?php echo $width; ?> text-center">
									<?php if ( isset( $icon_service_box['url'] ) && $icon_service_box['url'] != '' ) : ?>
										<a href="<?php echo $icon_service_box['url']; ?>">
									<?php endif; ?>

									<div class="service-icon">
										<i class="fa fa-<?php echo $icon_service_box['icon']; ?>"></i>
									</div><!-- .service-icon -->

									<?php if ( isset( $icon_service_box['title'] ) && $icon_service_box['title'] != '' ) : ?>
										<h3 class="service-title"><?php echo $icon_service_box['title']; ?></h3>
									<?php endif; ?>

									<?php if ( isset( $icon_service_box['description'] ) && $icon_service_box['description'] != '' ) : ?>
										<p class="service-content"><?php echo $icon_service_box['description']; ?></p>
									<?php endif; ?>

									<?php if ( isset( $icon_service_box['url'] ) && $icon_service_box['url'] != '' ) : ?>
										</a>
									<?php endif; ?>

									<div class="spacer"></div>
								</div><!-- .icon-service-box -->
							<?php endforeach; ?> 
						<?php endif; ?>
					</div><!-- .row -->
					
					<div class="row skillBox">
						<div class="module-caption text-center">
						<div class="separator">
									<span><i class="fa fa-circle"></i></span>
								</div><!-- .separator -->
						</div>
						<?php
							
							$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$sql = "SELECT DISTINCT category FROM Skills";
							$result = mysqli_query($conn, $sql);
							
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
									$cat[] = $row["category"];
								}
							} else {
								echo "0 results";
							}
							
							$i = 0;
							foreach($cat as $key=>$value) {
								
								echo "<div class='skillssub sub" . $i . "'>";
								echo "<h3>" . $value . "</h3>";
								$sql = "SELECT category, skill, years FROM Skills WHERE category='$value'"; 
								$result = mysqli_query($conn, $sql);
								if (mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_array($result)) {
										echo "<div class='block'><h5>" . $row["skill"] . "</h5><span>Years of Experience:</span> " . $row["years"] . "</div>";
									}	
								} else {
									echo "0 results";
								}
								echo "</div>";
								$i++;
							}
							mysqli_close($conn);
							
						?>
					</div>
				</div><!-- .container -->
			</section><!-- #service -->
			<div id="portfolio"></div>
			<section id="<?php echo Kirki::get_option( 'front_page_portfolio_module_id' ); ?>" class="module portfolio-module clearfix">
				<div class="container-fluid">
                    <div class="row row-nopadding">
						<?php if ( Kirki::get_option( 'front_page_portfolio_module_title' ) != '' ) : ?>
							<div class="module-caption col-md-12 text-center">
								<h2><?php echo strip_tags( html_entity_decode( Kirki::get_option( 'front_page_portfolio_module_title' ) ), '<span>' ); ?></h2>

								<?php if ( Kirki::get_option( 'front_page_portfolio_module_subtitle' ) != '' ) : ?>
									<p><?php echo Kirki::get_option( 'front_page_portfolio_module_subtitle' ); ?></p>
								<?php endif; ?>

								<div class="separator">
									<span><i class="fa fa-circle"></i></span>
								</div><!-- .separator -->

								<div class="spacer"></div>
							</div><!-- .module-caption -->
						<?php endif; ?>

						<?php
							$tags = get_terms( 'portfolio_tag' );
							$count = count( $tags );
						?>

						<?php if ( ! is_wp_error( $tags ) && $count > 0 && Kirki::get_option( 'front_page_portfolio_module_filter' ) == '1'  ) : ?>
							<div id="portfolio-filter" class="col-md-12 text-center">
								<a href="#" class="active" data-filter="*"><?php echo Kirki::get_option( 'front_page_portfolio_module_all' ); ?></a>

								<?php
									foreach ( $tags as $tag ) {
										$tag_name = str_replace( ' ', '-', strtolower( $tag->name ) );

										printf( '<a href="#" data-filter=".portfolio-tag-%1s">%2s</a>', $tag_name, $tag->name );
									}
								?>
							</div><!-- #portfolio-filter -->
						<?php endif; ?>

						<div id="portfolio-container" class="col-md-10 col-md-offset-1"></div>

						<div id="portfolio-loader">
							<i class="fa fa-spinner fa-pulse"></i>
						</div><!-- .portfolio-loader -->

						<div class="portfolio-wrap col-md-12 clearfix">
							<?php
								$args = array(
									'post_type' => 'portfolio',
									'posts_per_page' => -1
								);
								$query = new WP_Query( $args );

								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) : $query->the_post();

										get_template_part( 'template-parts/content', 'portfolio' );

									endwhile;
								} else {
									global $switch_portfolio_post;

									$switch_portfolio_post = 'portfolio';

									get_template_part( 'template-parts/content', 'none' );
								}

								wp_reset_postdata();
							?>
						</div><!-- #portfolio-wrap -->
					</div><!-- .row -->
				</div><!-- .container-fluid -->
			</section><!-- #portfolio -->
			<div id="resume"></div>
			<section id="<?php echo Kirki::get_option( 'front_page_ver_promo_module_id' ); ?>" class="module promo-box-ver-module clearfix">
				<div class="container">
                    <div class="row">
						<div class="promo-box-ver col-md-10 col-md-offset-1 text-center">
							<?php
								if ( Kirki::get_option( 'front_page_ver_promo_title' ) != '' ) {
									echo '<h2>' . strip_tags( html_entity_decode( Kirki::get_option( 'front_page_ver_promo_title' ) ), '<span>' ) . '</h2>';
								}
							?>
							
							<div class="separator">
									<span><i class="fa fa-circle"></i></span>
								</div><!-- .separator -->

							<?php
								if ( Kirki::get_option( 'front_page_ver_promo_content' ) != '' ) {
									echo '<p>' . strip_tags( html_entity_decode( Kirki::get_option( 'front_page_ver_promo_content' ) ), '<span>' ) . '</p>';
								}
							?>

							<?php if ( Kirki::get_option( 'front_page_ver_promo_btn_text' ) != '' ) : ?>
								<div class="promo-btn">
									<a href="<?php echo Kirki::get_option( 'front_page_ver_promo_btn_url' ); ?>" class="btn btn-light"><?php echo Kirki::get_option( 'front_page_ver_promo_btn_text' ); ?></a>
								</div><!-- .promo-btn -->
							<?php endif; ?>
						</div><!-- .promo-box-ver -->
					</div><!-- .row -->
				</div><!-- .container -->
			</section><!-- #promo-box-ver -->
			<div id="funFacts"></div>
			<section id="<?php echo Kirki::get_option( 'front_page_blog_module_id' ); ?>" class="module blog-module clearfix">
				<div class="container-fluid">
                    <div class="row row-nopadding">
						<?php if ( Kirki::get_option( 'front_page_blog_module_title' ) != '' ) : ?>
							<div class="module-caption col-md-12 text-center">
								<h2><?php echo strip_tags( html_entity_decode( Kirki::get_option( 'front_page_blog_module_title' ) ), '<span>' ); ?></h2>

								<?php if ( Kirki::get_option( 'front_page_blog_module_subtitle' ) != '' ) : ?>
									<p><?php echo Kirki::get_option( 'front_page_blog_module_subtitle' ); ?></p>
								<?php endif; ?>

								<div class="separator">
									<span><i class="fa fa-circle"></i></span>
								</div><!-- .separator -->

								<div class="spacer"></div>
							</div><!-- .module-caption -->
						<?php endif; ?>

						<div class="blog-wrap col-md-12 clearfix">
							
							<div class="promo-box-ver col-md-10 col-md-offset-1 text-center">
							
							<p>I was 15 when I started to learn HTML.</p>
							<p>Member and Supporter of the LGBTQIA community (Asexual)</p>
							<p>Love to play the 00s station on Apple Music</p>
							<p>I went to a class in high school called "Programming, Databases, & Website Development" at a local career center. The instructor helped me to obtain my first paid development job at 18</p>
							<p>I watch a lot of BuzzFeed videos on YouTube, especially the Try Guys and Ladylike</p>
							<p>I started writing lyrics and poems when I was 16</p>
							<p>I play fiddle music on the violin. I'm currently looking into doing pop covers as well</p>
							<p>Mostly on Apple devices. I don't hate Windows; I hate Windows 8</p>
							<p>I'm always looking for the next coding trends, including frameworks, tools, and libraries</p>
							<p>My favorite IDE is Coda on a Mac</p>
							<p>I love listening to the TWiT network, especially "The Tech Guy", "The New Screensavers", and "iOS Today"</p>
							
						</div>
							
						</div><!-- #blog-wrap -->
					</div><!-- .row -->
				</div><!-- .container-fluid -->
			</section><!-- #blog -->
			<div id="contact"></div>
			<section id="<?php echo Kirki::get_option( 'front_page_contact_module_id' ); ?>" class="module contact-module clearfix">
				<div class="container">
                    <div class="row">
						<?php if ( Kirki::get_option( 'front_page_contact_module_title' ) != '' ) : ?>
							<div class="module-caption col-md-12 text-center">
								<h2><?php echo strip_tags( html_entity_decode( Kirki::get_option( 'front_page_contact_module_title' ) ), '<span>' ); ?></h2>

								<?php if ( Kirki::get_option( 'front_page_contact_module_subtitle' ) != '' ) : ?>
									<p><?php echo Kirki::get_option( 'front_page_contact_module_subtitle' ); ?></p>
								<?php endif; ?>

								<div class="separator">
									<span><i class="fa fa-circle"></i></span>
								</div><!-- .separator -->

								<div class="spacer"></div>
							</div><!-- .module-caption -->
						<?php endif; ?>

						<?php $contact_boxes = get_post_meta( get_option( 'page_on_front' ), '_beonepage_option_contact_box', true ); ?>

						<?php if ( ! empty( $contact_boxes ) ) : ?>
							<div class="contact-info col-md-4 clearfix">
								<?php foreach ( $contact_boxes as $contact_box ) : ?>
									<div class="contact-item">
										<?php if ( isset( $contact_box['icon'] ) && $contact_box['icon'] != '' ) : ?>
											<div class="ci-icon"><i class="fa fa-<?php echo $contact_box['icon']; ?>"></i></div>
										<?php endif; ?>

										<?php if ( isset( $contact_box['label'] ) && $contact_box['label'] != '' ) : ?>
											<div class="ci-title"><?php echo $contact_box['label']; ?></div>
										<?php endif; ?>

										<?php if ( isset( $contact_box['description'] ) && $contact_box['description'] != '' ) : ?>
											<?php if ( isset( $contact_box['url'] ) && $contact_box['url'] != '' ) : ?>
												<div class="ci-content"><a href="<?php echo $contact_box['url']; ?>"><?php echo $contact_box['description']; ?></a></div>
											<?php else : ?>
												<div class="ci-content"><?php echo $contact_box['description']; ?></div>
											<?php endif; ?>
										<?php endif; ?>
									</div><!-- .contact-info -->
								<?php endforeach; ?> 
							</div><!-- .contact-item  -->
						<?php endif; ?>

						<div class="contact-form col-md-7 col-md-offset-1 clearfix">
							<?php
								$a = rand( 0, 9 );
								$b = rand( 0, 9 );
								$required = esc_attr__( 'This field is required.', 'beonepage' );
								$equalto = esc_attr__( 'Please check your math.', 'beonepage' );
								$email = esc_attr__( 'Invalid email address.', 'beonepage' );
							?>

							<form id="contact-form" class="contact-form clearfix">
								<div class="contact-form-process">
									<i class="fa fa-spinner fa-pulse"></i>
								</div><!-- .contact-form-process -->

								<div id="contact-form-result"><span></span></div>

								<fieldset class="col-sm-4">
									<input type="text" id="contact-form-name" name="name" placeholder="<?php echo esc_html__( 'Name', 'beonepage' ); ?>" value="<?php if( isset( $_POST['name'] ) ) { echo esc_attr( $_POST['name'] ); } ?>" class="cf-form-control required" data-msg-required="<?php echo $required; ?>" />
								</fieldset>

								<fieldset class="col-sm-4">
									<input type="email" id="contact-form-email" name="email" placeholder="<?php esc_html_e( 'Email', 'beonepage' ); ?>" value="<?php if( isset( $_POST['email'] ) ) { echo esc_attr( $_POST['email'] ); } ?>" class="required email cf-form-control" data-msg-required="<?php echo $required; ?>" data-msg-email="<?php echo $email; ?>" />
								</fieldset>

								<fieldset class="col-sm-4">
									<input type="text" id="contact-form-phone" name="phone" placeholder="<?php esc_html_e( 'Phone', 'beonepage' ); ?>" value="<?php if( isset( $_POST['phone'] ) ) { echo esc_attr( $_POST['phone'] ); } ?>" class="cf-form-control" />
								</fieldset>

								<fieldset class="col-sm-12">
									<input type="text" id="contact-form-subject" name="subject" placeholder="<?php esc_html_e( 'Subject', 'beonepage' ); ?>" value="<?php if( isset( $_POST['subject'] ) ) { echo esc_attr( $_POST['subject'] ); } ?>" class="required cf-form-control" data-msg-required="<?php echo $required; ?>" />
								</fieldset>

								<fieldset class="col-sm-12">
									<textarea rows="3" id="contact-form-message" name="message" placeholder="<?php esc_html_e( 'Message', 'beonepage' ); ?>" class="required cf-form-control" data-msg-required="<?php echo $required; ?>"><?php if( isset( $_POST['message'] ) ) { echo esc_attr( $_POST['message'] ); } ?></textarea>
								</fieldset>

								<fieldset class="captcha col-sm-6">
									<input type="text" id="contact-form-captcha" name="captcha" placeholder="<?php echo $a . ' + ' . $b . ' = ?'; ?>" class="required cf-form-control" data-msg-required="<?php echo $required; ?>" data-rule-equalto="#captcha-value" data-msg-equalto="<?php echo $equalto; ?>" />
									<input type="hidden" id="captcha-value" value="<?php echo $a + $b; ?>">
								</fieldset><!-- .captcha -->

								<fieldset class="submit col-sm-6">
									<input type="hidden" name="action" value="contact_form">

									<?php wp_nonce_field( 'ajax_contact_form', 'ajax_contact_form_nonce' ); ?>

									<button class="btn btn-light" type="submit" id="contact-form-submit" name="submit" value="submit"><?php echo Kirki::get_option( 'front_page_contact_module_send' ); ?></button>
								</fieldset><!-- .submit -->
							</form>
                        </div><!-- .contact-form -->
					</div><!-- .row -->
				</div><!-- .container -->
			</section><!-- #contact -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
