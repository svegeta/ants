<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */
/**
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
 */
?>
    <div class="functions-container">
		<div class="left functions"><?php echo $this->Html->link($systembuttontext, array('controller' => 'system', 'action' => 'switchsystemstate'),array('class'=> $systembutton));?></div>
		<?php if($showopticalstate): ?>
			<div class="left functions"><?php echo $this->Html->link($opticalbuttontext, array('controller' => 'system', 'action' => 'switchopticalstate'),array('class'=> $opticalbutton));?></div>
		<?php endif; ?>
		<div class="left functions"><?php echo $this->Html->link("Bild erstellen", array('controller' => 'images', 'action' => 'makeimage'),array('id'=>'imagebutton','class'=> 'button'));?></div>
		<div id="create-video" class="left functions">
			<?php echo $this->Form->create('Video',array(
														'url' => array('controller' => 'videos', 'action' => 'add'),
														'type' => 'post',
														'class'=> 'button-start-qv'
													));?>
									
							

			<?php echo $this->Form->end('Sofort Video',array('class'=> 'button-start-qv'));?>
			
		</div>

		<div id="infotext" class="left">
			<h2>Info:</h2>
			<p>
				System bleibt jetzt die ganze Zeit aktiv, bis es manuell abgeschalten wird. 
				Lediglich die optische Alarmierung wird im eingestellten Zeitintervall&sup1;
				an- bzw. abgeschalten. Das System zeichnet demnach weiterhin nach Bewegungserkennung 
				auf. Zudem kann jetzt unter 
				<?php echo $this->Html->link('System->Einstellungen', array('controller' => 'system','action' => 'settings')); ?>
				die aktuelle DynDNS Adresse hinterlegt werden, falls diese sich ändern sollte.
				Bitte bei Fehlverhalten Bescheid geben.
<pre>&sup1;Mo-Fr  7 Uhr Deaktivierung
       22 Uhr Aktivierung</pre> 
			</p>
		</div>
		<div class="clear"></div>
    </div>
</p>


