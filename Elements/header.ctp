<header class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="nav-collapse collapse">
				<?php echo $this->Custom->menu('main', array('dropdown' => true)); ?>
			</div>
			<?php echo $this->Html->link(Configure::read('Site.title'), '/', array('class' => 'brand')) ?>
		</div>
	</div>
</header>