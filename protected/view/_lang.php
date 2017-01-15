<?php if($GLOBALS['config']['lang']==='ru'):?>
	<a title="Switch to english language" href="/<?php echo $_SERVER['QUERY_STRING'];?>?lang=eng" class="lang lang-eng">english</a>
	<?php elseif($GLOBALS['config']['lang']==='eng'):?>
	<a title="Переключиться на русский язык" href="/<?php echo $_SERVER['QUERY_STRING'];?>?lang=ru" class="lang lang-ru">русский</a>
<?php endif;?>
