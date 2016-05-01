<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

//App::uses('Debugger', 'Utility');
?>

<h2><?php echo __d('cake_dev', 'Security Center on cake'); ?></h2>
<h1>System</h1>
    <div class="functions-container">
		<div class="left functions"><?php echo $this->Html->link("SystemStatus on", array('controller' => 'pages', 'action' => 'switchsystemstate'),array('class'=> $systembutton));?></div>
		<!--<div class="left functions"><?php //echo $this->Html->link("SystemStatus" . $systemtext, array('controller' => 'pages', 'action' => 'switchsystemstate'),array('class'=> $systembutton));?></div>-->
		<div class="clear"></div>
    </div>

<p>
Aufruf von einem 
<?php 
if($this->request->is('mobile')){
 echo "Mobilem Gerät";
}
else{
 echo "Standard PC";
}
?>
.
</p>


