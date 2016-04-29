<div class="comment-form">
	<h3><?php echo __('Add new comment'); ?></h3>
	<?php
		$type = $types_for_layout[$node['Node']['type']];

		if ($this->params['controller'] == 'comments') {
			$nodeLink = $this->Html->link(__('Go back to original post') . ': ' . $node['Node']['title'], $node['Node']['url']);
			echo $this->Html->tag('p', $nodeLink, array('class' => 'back'));
		}

		$formUrl = array(
			'plugin' => 'comments',
			'controller' => 'comments',
			'action' => 'add',
			$node['Node']['id'],
		);
		if (isset($parentId) && $parentId != null) {
			$formUrl[] = $parentId;
		}
	?>
	<div class="row">
	<?php
	echo $this->Form->create('Comment', array(
		'url'           => $formUrl,
		'inputDefaults' => array(
			'div'       => 'form-group',
			'label'     => array(
				'class' => 'col col-md-3 control-label'
			),
			'wrapInput' => 'col col-md-9',
			'class'     => 'form-control'
		),
		'class'         => 'form-horizontal'
	));
			if ($this->Session->check('Auth.User.id')) {
				echo $this->Form->input('Comment.name', array(
					'placeholder' => __('Name'),
					'value' => $this->Session->read('Auth.User.name'),
					'readonly' => 'readonly',
				));
				echo $this->Form->input('Comment.email', array(
					'placeholder' => __('Email'),
					'value' => $this->Session->read('Auth.User.email'),
					'readonly' => 'readonly',
				));
				echo $this->Form->input('Comment.website', array(
					'placeholder' => __('Website'),
					'value' => $this->Session->read('Auth.User.website'),
					'readonly' => 'readonly',
				));
				echo $this->Form->input('Comment.body', array('label' => false));
			} else {
				echo $this->Form->input('Comment.name', array('placeholder' => __('Name')));
				echo $this->Form->input('Comment.email', array('placeholder' => __('Email')));
				echo $this->Form->input('Comment.website', array('placeholder' => __('Website')));
				echo $this->Form->input('Comment.body', array('label' => false));
			}

			if ($type['Type']['comment_captcha']) {
				echo $this->Recaptcha->display_form();
			}
		echo $this->Form->end(array(
			'div'   => 'col col-md-9 col-md-offset-3',
			'class' => 'btn btn-default'
		));
	?>
	</div>
</div>