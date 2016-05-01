<!-- File: /app/View/Posts/editsetting.ctp -->
	<div class="functions-container">
		<span>Funktionen:</span>
		<div class="left functions"><?php echo $this->Html->link("Zurück zu Einstellungen", array('controller' => 'system', 'action' => 'settings'),array('class'=> 'button'));?></div>
		<div class="clear"></div>
    </div>
<h1>Einstellung ändern</h1>	
<div>
<dl class="setting">
	
		<h2><?php echo $setting['System']['description'] ?></h2>
		<?php echo $this->Form->create('System',array(
														'url' => array('controller' => 'system', 'action' => 'savesetting', $setting['System']['id'] ),
														'type' => 'post',
														'class'=> 'button'
													));?>
		<?php
		switch ($setting['System']['key']) {
			case "camrotation":
				echo $this->Form->input('pair', 
										array(
											'class'=> 'button',							
											'options'=> array(
													"0"=>"0 Grad", 
													"90"=>"90 Grad",
													"180"=>"180 Grad", 
													"270"=>"270 Grad"),
											'type'=> 'select',
											'label'=> 'Ändern',
											'default'=> $setting['System']['pair']
										)										
									);
				
				break;
			case "emailalert":
				echo $this->Form->input('pair', 
										array(
											'class'=> 'button',	
											'type'=> 'checkbox',
											'label'=> 'Aktivieren',
											'default'=> $setting['System']['pair']
										)										
									);
				
				break;
			case "emailalertb4video":
				echo $this->Form->input('pair', 
										array(
											'class'=> 'button',	
											'type'=> 'checkbox',
											'label'=> 'Aktivieren',
											'default'=> $setting['System']['pair']
										)										
									);
				
				break;
			default:
				$type='text';
				$value=$setting['System']['pair'];
				echo $this->Form->input('pair', 
										array(
											'class'=> 'button',
											'type'=> $type,
											'label'=> 'Ändern',
											'value'=> $value,
										)										
									);
		}
		
		?>
		
		
		<?php echo $this->Form->hidden('id');?>
		<?php echo $this->Form->hidden('System.key'); ?>
		<?php echo $this->Form->hidden('System.description'); ?>			
		<?php echo $this->Form->end('Einstellung speichern',array('class'=> 'button'));?>
		</dl>

				
</div>
<div class="clear"></div>