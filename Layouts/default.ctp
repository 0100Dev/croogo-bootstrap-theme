<?php
// Adjusting content width
if ($this->Regions->blocks('left') and $this->Regions->blocks('right')) {
	$span = "col-md-6";
}
elseif ($this->Regions->blocks('left') xor $this->Regions->blocks('right')) {
	$span = "col-md-9";
}
else {
	$span = "col-md-12";
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		echo $this->Html->charset();
		?>
		<title><?php echo $title_for_layout; ?> &raquo; <?php echo Configure::read('Site.title'); ?></title>

		<!-- Other -->
		<?php
		echo $this->Meta->meta();
		echo $this->Layout->feed();
		echo $this->Html->meta(array(
			'name'    => 'viewport',
			'content' => 'width=device-width, initial-scale=1'
		));
	    ?>

		<!-- styles -->
		<?php
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('theme');

		echo $this->fetch('css');
		?>

		<!-- scripts -->
		<?php
		// Croogo JavaScript
		echo $this->Layout->js();

		// Scripts for our layout
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
		?>

		<!-- Plugins -->
		<?php
		echo $this->fetch('css');
		echo $this->Blocks->get('script');
		?>
	</head>
	<body>
		<?php echo $this->element('header'); ?>

		<div class="container">
			<div class="row">
				<?php if ($this->Regions->blocks('left')): ?>
					<div class="col-md-3">
						<?php echo $this->Regions->blocks('left'); ?>
					</div>
				<?php endif; ?>

				<div class="<?php echo $span; ?>">
				<?php
					echo $this->Layout->sessionFlash();
					echo $content_for_layout;
				?>
				</div>

				<?php if ($this->Regions->blocks('right')): ?>
					<div class="col-md-3">
						<?php echo $this->Regions->blocks('right'); ?>
						<?php echo $this->element('accordion'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<footer>
			<div class="pull-left">
				Powered by <a href="http://www.croogo.org">Croogo</a>.
			</div>
			<div class="pull-right">
				<a href="http://www.cakephp.org"><?php echo $this->Html->image('/img/cake.power.gif'); ?></a>
			</div>
		</footer>

	    <?php
			echo $this->Blocks->get('scriptBottom');
			echo $this->Js->writeBuffer();
		?>
	</body>
</html>