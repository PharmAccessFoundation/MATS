<?php if ($comments): ?>
	
	<?php foreach ($comments as $item): ?>
		
		<div class="comment">
			
			<div class="details">
				<div class="name">
					<?php echo '<strong>'.$item->user_name.'</strong>' ?>
				</div>
				<div class="date">
					<p><?php echo format_date($item->created_on) ?></p>
				</div>
				<div class="content">
					<?php if (Settings::get('comment_markdown') and $item->parsed): ?>
						<?php echo $item->parsed ?>
					<?php else: ?>
						<p><?php echo nl2br($item->comment) ?></p>
					<?php endif ?>
				</div>
			</div>
		</div><!-- close .comment -->
	<?php endforeach ?>
	
<?php else: ?>
	<p><?php echo lang('comments:no_comments') ?></p>
<?php endif ?>