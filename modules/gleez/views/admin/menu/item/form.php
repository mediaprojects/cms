<?php defined("SYSPATH") or die("No direct script access.") ?>

<?php
        $parms = isset($post->id) ? array('id' => $post->id, 'action' => 'edit') : array('action' => 'add', 'id' => $menu->id);
	$items = isset($post->id) ? $post->select_list('id', 'title', '--') : $menu->select_list('id', 'title', '--');

	echo Form::open(Route::get('admin/menu/item')->uri($parms), array('id'=>'menu-form', 'class'=>'form')) ?>

	<?php if ( ! empty($errors)): ?>
		<div id="formerrors" class="errorbox">
			<h3>Ooops!</h3>
			<ol>
				<?php foreach($errors as $field => $message): ?>
					<li>	
						<?php echo $message ?>
					</li>
				<?php endforeach ?>
			</ol>
		</div>
	<?php endif ?>

<div class="control-group <?php echo isset($errors['title']) ? 'error': ''; ?>">
	<?php echo Form::label('title', __('Title:'), array('class' => 'control-label')) ?>
   	<?php echo Form::input('title', $post->title, array('class' => 'input-large')); ?>
</div>

<div class="control-group <?php echo isset($errors['name']) ? 'error': ''; ?>">
	<?php echo Form::label('name', __('Slug:'), array('class' => 'control-label')) ?>
   	<?php echo Form::input('name', $post->name, array('class' => 'input-large')); ?>
</div>

<div class="control-group <?php echo isset($errors['url']) ? 'error': ''; ?>">
	<?php echo Form::label('url', __('Link:'), array('class' => 'control-label')) ?>
   	<?php echo Form::input('url', $post->url, array('class' => 'input-large')); ?>
</div>

<?php if( ! isset($post->id) ):?>
	<div class="control-group <?php echo isset($errors['parent']) ? 'error': ''; ?>">
		<?php echo Form::label('parent', __('Parent:'), array('class' => 'control-label')) ?>
		<?php echo Form::select('parent', $items, $post->pid, array('class' => 'input-large')); ?> 
	</div>
<?php endif; ?>
  
<div class="control-group <?php echo isset($errors['descp']) ? 'error': ''; ?>">
 	<?php echo Form::label('description', __('Description:'), array('class' => 'control-label')) ?>
 	<?php echo Form::textarea('descp', $post->descp, array('class' => 'input-large', 'rows' => 5)) ?>
</div>

<?php echo Form::submit('menu-item', __('Submit'), array('class' => 'btn btn-primary btn-large')) ?>
<?php echo Form::close() ?>
