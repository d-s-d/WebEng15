<?php 
    global $stylesheet_dir, $stylesheet_url;

    get_header();

    if (isset($_POST["submit"])) {
        $to = get_bloginfo('admin_email');
	$from = $_POST["firstname"] ." ". $_POST["lastname"];
	$subject = "sent from contact form";
	$message = $_POST["message"];
	echo $subject ." ". $message ." ". $from . "<br>";
        if (mail($to, $subject, $message, $from)) {
            echo "sent: " . $to;
        }
	else {
	    
            echo "failed: " . $to;
        }
    }
?>

				<div class="container" style="background-image: url('<?php echoPicture($stylesheet_dir,'images/bg4.png');?>');background-size: 100%;background-repeat: no-repeat;background-color: #040205; min-height: 500px;" role="main">
				
					<div style="width:100%">
						<br><br>
						<p style="font-size: 340%; color:#fff;">
							<strong>Contact Me</strong>
						</p>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br>

					<div style="float:left;overflow: hidden;vertical-align: bottom;">
						<form action="" method="post">
							<p style="float:left;">
								First name:
							</p>

							<input type="text" name="firstname" style="float:right;">
							<br>
							<p style="float:left;">
								Last name:
							</p>

							<input type="text" name="lastname" style="float:right;">

							<br>
							<textarea type="text" name="message" rows="7" cols="65" >	</textarea>
							<br>
							<button name="submit" type="submit" style="background-color:#fafafa; color:#000;padding-left:5px;padding-right:5px;">
								Submit
							</button>
						</form>
					</div>
					<br>

					<div class="ctransbox">
						<div class="full">
							<strong style="float:left;">Email</strong><strong style="float:right;">
								<?php echo get_option('contact_email'); ?></strong>
							<br>
							<strong style="float:left;">Fax</strong><strong style="float:right;">
								<?php echo get_option('contact_fax'); ?>
							</strong>
							<br>
							<strong style="float:left;">Address: </strong><strong style="float:right;">
								<?php echo get_option('contact_address'); ?>
							</strong>
						</div>
					</div>

				</div>
<?php get_footer();?>
