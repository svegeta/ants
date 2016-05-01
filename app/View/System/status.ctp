<!-- File: /app/View/Posts/door.ctp -->

	<div class="functions-container">
		<span>Funktionen:</span>
		<span>
			<div class="left functions"><?php echo $this->Html->link("Zurück zum System", array('controller' => 'system', 'action' => 'index'),array('class'=> 'button'));?></div>
			<div class="left functions"><?php echo $this->Html->link("Aktualisieren", array('action' => 'status'),array('class' => 'button')) ?></div>
		</span>
		<div class="clear"></div>
    </div>
	<h1>System Status</h1>
	<div>
		<table>
			<tr>
				<th>Datum / Uhrzeit</th>
				<th>System Event</th>
				<th>Aktion</th>
			</tr>
		
			<?php foreach ($log as $entry): ?>
			<tr>
				<?php foreach ($entry as $data): ?>			
					<?php echo "<td>".$data."</td>" ?>
				<?php endforeach; ?>
			</tr>
				
			<?php endforeach; ?>
		</table>	
	</div>
<div class="clear"></div>