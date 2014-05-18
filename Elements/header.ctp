<header class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link(Configure::read('Site.title'), '/', array('class' => 'navbar-brand')) ?>
		</div>
		<div class="navbar-collapse collapse">
			<?php echo $this->Custom->menu('main', array('dropdown' => true)); ?>
		</div>
	</div>
</header>
