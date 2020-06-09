
<div class="sidebar">
	<ul>
		<?php dynamic_sidebar(); ?>
	</ul>
</div>
<?php if (REGISTRATION_LOGGED_IN) : ?>
	<script type="text/javascript" charset="utf-8">
	(function($){
		var widget = $('<li id="my_events" class="widget" style="display:none"><h2>My Upcoming Schedule</h2><div id="schedule-cnt"></div></li>');
		$(widget).prependTo($('.sidebar > ul'));
		var url = "<?php echo REGISTRATION_URL; ?>/_wp-upcoming-schedule.php?sidebar=true&challenge=<?php echo $_SESSION['challenge']; ?> .upcoming-schedule";
		$(widget).find('#schedule-cnt').load(url, {}, function() {
			$(this).find('table, td').css({
				'text-align': 'left',
				'vertical-align': 'top'
			});
			$(this).find('*[nowrap]').removeAttr('nowrap');
			var myshedule=$(this);
			
			var flag=0;
			if ($(widget).find('#schedule-cnt tr').length==2) {
				$(widget).find('#schedule-cnt tr:eq(1)').find('td').each(function() {
					if ($(this).find('p').text()!="-") {
						flag=1;
						return;
					}
				});
				
				if (flag) {
					$(widget).next().remove();
				} else {
					$('#my_events').remove();
				}
			}
			$('#my_events').show();
		});


		
	})(jQuery)
	</script>
<?php endif; ?>