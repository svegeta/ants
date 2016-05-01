<!-- File: /app/View/Posts/settings.ctp -->
   
	<div class="functions-container">
		<span>Funktionen:</span>
		<span>
			<div class="left functions"><?php echo $this->Html->link("Zurück zum System", array('controller' => 'system', 'action' => 'index'),array('class'=> 'button'));?></div>

			<div class="clear"></div>
		</span>
		
    </div>
	<h1>System Einstellungen</h1>
<div>

		<?php foreach ($settings as $setting): ?>
			<div class="setting"><h4><?php echo $setting[0]; ?></h4>
			<?php foreach ($setting[1] as $g): ?>
				<dl class="setting" style="text-transform: none;">
					<span><?php echo $g['System']['description'] ?></span>
					<?php 	
						switch ($g['System']['key']) {
							case "emailalert":
								echo "<p>" . ($g['System']['pair'] == "1" ? "Aktiviert" : "Deaktiviert") . "</p>";
								break;
							case "emailalertb4video":
								echo "<p>" . ($g['System']['pair'] == "1" ? "Aktiviert" : "Deaktiviert") . "</p>";
								break;
							default:
								echo "<p>" . $g['System']['pair'] . "</p>";
						}	
					?>
					<?php echo $this->Html->link("Bearbeiten", array('action' => 'editsetting',$g['System']['id']),array('class'=> 'button'));?>
				</dl>	
			<?php endforeach; ?>	
			</div>
	<?php endforeach; ?>	
</div>

