<?php 
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version()) 
?>

    <div class="functions-container">
	    <span>Funktionen:</span>
		<span class="right">
			<?php echo $cakeVersion; ?>
		</span>
		<div class="left functions"><?php echo $this->Html->link("System Status", array('controller' => 'system', 'action' => 'status'),array('class'=> 'button'));?></div>
		<div class="left functions"><?php echo $this->Html->link("System Einstellungen", array('action' => 'settings'),array('class'=> 'button'));?></div>
		<div class="left functions"><?php echo $this->Html->link("Aktualisieren", array('action' => 'index'),array('class' => 'button')) ?></div>
		<div class="left functions"><?php echo $this->Html->link("sshd Neustart", array('action' => 'sshrestart'),array('class' => 'button'),'Den ssh-Daemon neustarten?') ?></div>
		<div class="left functions"><?php echo $this->Html->link("System Neustart", array('action' => 'reboot'),array('class' => 'button reboot'),'System Neustart durchführen?') ?></div>
		<div class="clear"></div>
    </div>
<h1>System</h1>
<!--
<p>
<?php //echo $this->Html->link("System neustarten", array('action' => 'reboot'),array('class' => 'button')) ?>
</p>
-->
<div>

	<dl class="left hardware">
		<h2>Hardware:</h2>	
			<dt class="temperture">Temperatur:</dt>
				<dd><pre><?php echo $data['temperature']; ?></pre></dd>
			<dt class="sdcard">Speicher:</dt>
				<dd><pre><?php echo $data['disk']; ?></pre></dd>
			<dt class="volt">Spannung:</dt>
				<dd><pre><?php echo $data['volt']; ?></pre></dd>
			<dt class="sinusclock">Takt:</dt>
				<dd><pre><?php echo $data['clock']; ?></pre></dd>
	</dl>

	<dl class="left software">
		<h2>Software:</h2>
			<dt class="uptime">Laufzeit:</dt>
				<dd><pre><?php echo $data['uptime']; ?></pre></dd>
			<dt class="ram">RAM:</dt>
				<dd><pre><?php echo $data['memory']; ?></pre></dd>
			<dt class="service">Dienste:
				<a class="button close" href="#">Anzeigen</a>
			</dt>
			<dd class="not_shown"><pre><?php echo $data['service']; ?></pre></dd>
			<dt class="syslog">Syslog: 
				<a class="button close" href="#">Anzeigen</a>
			</dt>
			<dd class="not_shown"><pre><?php echo $data['syslog']; ?></pre></dd>
			</dt>			
	</dl>
	
	<dl class="left apps">
		<h2>Anwendungen:</h2>	
			<dt class="top">Laufende Anwendungen:
				<a class="button close" href="#">Anzeigen</a>
				<!-- <a class="button" name="refresh_top" href="#">Aktualisieren</a> -->
			</dt>
			<dd class="not_shown"><pre><?php echo $data['top']; ?></pre></dd>
			
			<dt class="installed">Installierte Anwendungen:
				<a class="button close" href="#">Anzeigen</a>
			</dt>
			<dd class="not_shown"><pre><?php echo $data['installed']; ?></pre></dd>
			
	</dl>
	

	<dl class="left data-list">
		<h2>Kamera Daten:</h2>	
			<dt>Native Auflösung</dt>
				<dd><pre>5 Megapixel</pre></dd>
			<dt>Max. Bildauflösung</dt>
				<dd><pre>2592 x 1944</pre></dd>
			<dt>Boardgröße</dt>
				<dd><pre>25 x 20 x 9 mm</pre></dd>
			<dt>Gewicht</dt>
				<dd><pre>ca. 3 g</pre></dd>				
		</ul>
	</dl>

<?php if(isset($data['showir']) && $data['showir'] == true): ?>
	<dl class="left data-list">
		<h2>Infrarot Scheinwerfer</h2>	
			<dt>LED Anzahl</dt>
				<dd><pre>15</pre></dd>
			<dt>Wellenlänge</dt>
				<dd><pre>940nm</pre></dd>
			<dt>Abstrahlwinkel</dt>
				<dd><pre>40°</pre></dd>
			<dt>Versorgung</dt>
				<dd><pre>6V</pre></dd>
			<dt>Leistungsaufnahme</dt>
				<dd><pre>60mA</pre></dd>					
		</ul>
	</dl>
<?php endif; ?>

	
	<div class="clear"></div>
</div>
 