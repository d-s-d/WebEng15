<?php 
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		if($_SERVER['REQUEST_METHOD'] === 'POST' )
		{
			$attachement = media_handle_upload( 'image_file',  $_POST['post_id']);
			
			if( is_wp_error( $attachement ) ) {
				echo $attachement->get_error_message();
			}
			set_post_thumbnail($_POST['post_id'], $attachement );
		}
    global $stylesheet_dir, $stylesheet_url;
    get_header();
?>
				<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'./images/bg2.png');?> ');background-size: 100%;background-repeat: no-repeat;background-color: #040205; " role="main">
				<ul class="list">
<?php
if(have_posts()):
		the_post();
		global $post;
		$post_id = $post->ID
?>
            <li class="blog_list__item">
							<figure class="blog_list__item__inner">
								<figcaption>
									<?php if(has_post_thumbnail() ) {the_post_thumbnail(); } ?>
									<strong><?php the_title(); ?></strong>.
									<div id="post_content"><?php the_content(); ?></div>
									<br><br>
<?php
	// Find connected pages
	$connected = new WP_Query( array(
	  'connected_type' => 'posts_to_portfolio',
	  'connected_items' => get_queried_object(),
	  'nopaging' => true,
	) );

	// Display connected pages
	if ( $connected->have_posts() ) :
?>
<h3>Related portfolio posts:</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li><a style="color:#000000" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a></li>
<?php endwhile; ?>
</ul>

<?php 
// Prevent weirdness
wp_reset_postdata();

	endif; // connect->have_posts()
	if( current_user_can('edit_post', $post_id) ): ?>

		<script type="text/javascript">
		var post_id = <?php echo $post_id; ?>;
		</script>
<br />
<br />
	<button class="btn" id="btn_edit">edit</button>&nbsp;
	<button class="btn" id="btn_bold"><strong>B</strong></button>	&nbsp;
	<button class="btn" id="btn_italic"><i>i</i></button>	&nbsp;
	<button class="btn" id="btn_underline"><u>u</u></button>	&nbsp;
	<button class="btn" id="btn_save">save</button>	&nbsp;
<?php
	endif;
?>
				</figcaption>
			</figure>

			</li>
<?php
	endif;
?>
					</ul>
				</div>
	<script type="text/javascript">
	var editing = false;
	function for_each_edit_btn( f ) {
				var commands = ['underline', 'bold', 'italic'];
		for( var c in commands ) 
		{
			var _cmd = commands[c];
			var btn = $("#btn_"+_cmd);
			f(btn, _cmd);
		}
	}

	function editPost() {
		editing = true;
		for_each_edit_btn( function(btn) { btn.show(); })
		$("#post_content").attr('contentEditable', 'true');
		$("#btn_save").show();
	}

	function savePost() {
		editing = false;
		for_each_edit_btn( function(btn) { btn.hide(); } );
		$("#btn_save").hide();
		$("#post_content").attr('contentEditable', 'false');
		// send post to server
		$.ajax({
			type: 'POST',
				url: '/larajade/wp-admin/admin-ajax.php',
				cache: false,
				data: {
					action: 'set_post_content',
					post_id: post_id,
					content: $("#post_content").html()
				},
				success: function(data) {
					console.log(data);
				}
		});
	}

	$().ready( function() {
		$("figcaption > img").click( function() {
			savePost();
			$("#new-image-dialog").dialog('open');
		} );

		$("#new-image-dialog").dialog({
			autoOpen: false,
			modal: true,
			draggable: true,
			resizable: false,
			position: ['center', 'top'],
			show: 'blind',
			hide: 'blind',
			width: 400,
			dialogClass: 'ui-dialog-osx',
			buttons: {
					"Cancel": function() {
							$(this).dialog("close");
					}
			}
		});
		$("#btn_edit").hide();
		$("#btn_save").hide();
		for_each_edit_btn( function(btn) { btn.hide(); } );
		for_each_edit_btn( function(btn, _cmd) {	
			btn.click( (function(cmd) { 
				return function() { console.log(cmd); document.execCommand(cmd, false, null);}; 
			})(_cmd) ); 
		});
		if( post_id ) {
			$("#btn_edit").show();
			$("#btn_edit").click( editPost );
			$("#btn_save").click( savePost );
		}
	});
	</script>
<div id="new-image-dialog" title="Choose New Image">
    <span class="ui-state-default"><span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 0 0;"></span></span>
		<div style="margin-left: 23px;">
		<form action="?p=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="image_file" required />
			<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
			<input type="submit" value="Upload" />
		</form>
		<p>
    </p></div>
</div>

<?php 
wp_reset_postdata();
get_footer();
?>
