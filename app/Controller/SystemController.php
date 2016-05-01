 <?php

class SystemController extends AppController {
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Js' => array('System'));

	
	
    public function index(){
		//Collect Data
		$data['top']=$this->get_processes();
        $data['temperature']= $this->get_temp();
		$data['volt']= substr(shell_exec("/opt/vc/bin/vcgencmd measure_volts"),5);
		$data['clock']= trim(substr(shell_exec("/opt/vc/bin/vcgencmd measure_clock arm"),14)) / 1000000 .' MHz';
        $data['uptime']= shell_exec("uptime");       
        $data['disk']=shell_exec("df -h /");    
        $data['memory']=shell_exec("free -h"); 
        $data['service']=shell_exec("ps -Al");
		//$data['syslog']=$this->readLastLinesOfFile('/var/log/syslog', 1000);
		$data['syslog']=shell_exec("tac /var/log/syslog");
		$data['installed']=shell_exec("dpkg --get-selections");
		//Push Data to View dpkg --get-selections
        
		if($this->getSetting('extension') == "gpio"){
			$data['showir']=true;
		}
		$this->set('data', $data);
    }	
	
	public function start(){
		$system = $this->getstatus();
		$optical = $this->getopticalstatus();
		
		//System Switch Button
		$this->set('systemstate', $this->getsystemtext($system));
		$this->set('systembuttontext', $this->getsystemtext($system));
		$this->set('systemstatustext', $this->getsystemstatustext($system));
		$this->set('systembutton', "buttonsystemswitch-" .$this->getsystembuttonclass($system));
		
		//Optical Switch Button
		if($this->getSetting('extension') == "piface"){
			$this->set('showopticalstate', true);
			$this->set('opticalstate', $this->getsystemtext($optical));
			$this->set('opticalbuttontext', $this->getsystemtext($optical));
			$this->set('opticalstatustext', $this->getsystemstatustext($optical));
			$this->set('opticalbutton', "buttonopticalswitch-" . $this->getopticalbuttonclass($optical));
		}else{
			$this->set('showopticalstate', false);
		}
		
		//Weather INfo
		//WEIOIC LEIPZIG 90540430
		
		
		
		//Live View
		//$liveview='live.jpg';
		//$this->set('liveview', $liveview);
		
	}
	
	public function reboot(){
		if(file_exists("/var/www/securitycenter/system/reboot.lock")){
				$this->Session->setFlash(__('Systemneustart wird eingeleitet.'));
				$this->redirect(array('controller' => 'system', 'action' => 'start'));
			}
		$val = trim(@shell_exec("touch /var/www/securitycenter/system/reboot.lock"));
		$this->Session->setFlash(__('Systemneustart wird eingeleitet.'));
	}
	public function sshrestart(){
		if(file_exists("/var/www/securitycenter/system/ssh.lock")){
				$this->Session->setFlash(__('ssh Daemon wird neugestartet.'));
				$this->redirect(array('controller' => 'system', 'action' => 'start'));
			}
		$val = trim(@shell_exec("touch /var/www/securitycenter/system/reboot.lock"));
		$this->Session->setFlash(__('Systemneustart wird eingeleitet.'));
	}
	public function cancelreboot(){
			if(!file_exists("/var/www/securitycenter/system/reboot.lock")){
				die();
			}
			try{
				$val = trim(@shell_exec("rm /var/www/securitycenter/system/reboot.lock"));
			}
			catch(Exception $e){
				$this->Session->setFlash($e->message());
			}
			$this->Session->setFlash(__('Neustart abgebrochen.'));
			$this->redirect(array('controller' => 'system', 'action' => 'start'));
	}
	public function switchsystemstate(){
     
		if($this->getstatus()){
			try{
				$val = trim(@shell_exec("rm /var/www/securitycenter/system/alarm.lock"));
			}
			catch(Exception $e){
				$this->Session->setFlash($e->message());
			}
			$this->Session->setFlash(__('System manuell unscharf geschalten.'));
		}
		else{
			$val = trim(@shell_exec("touch /var/www/securitycenter/system/alarm.lock"));
			$this->Session->setFlash(__('System manuell scharf geschalten.'));
		}
		$this->redirect(array('controller' => 'system', 'action' => 'start'));
    }
		
	public function switchopticalstate(){
     
		if($this->getopticalstatus()){
			try{
				$val = trim(@shell_exec("rm /var/www/securitycenter/system/alarmoptical.lock"));
			}
			catch(Exception $e){
				$this->Session->setFlash($e->message());
			}
			$this->Session->setFlash(__('Optischer Alarm wurde deaktiviert.'));
		}
		else{
			$val = trim(@shell_exec("touch /var/www/securitycenter/system/alarmoptical.lock"));
			$this->Session->setFlash(__('Optischer Alarm wurde aktiviert.'));
		}
		$this->redirect(array('controller' => 'system', 'action' => 'start'));
    }
	
    private function getsystemtext($bool){
		if($bool){
			return "Unscharf schalten";
		}
		return "Scharf schalten";
    } 
    private function getsystemstatustext($bool){
		if($bool){
			return "Scharf";
		}
		return "Unscharf";
    } 
    private function getsystembuttonclass($bool){
		if($bool){
			return "on";
		}
		return "off";

    } 

	private function getopticaltext($bool){
		if($bool){
			return "Optischen Alarm deaktivieren";
		}
		return "Optischen Alarm aktivieren";
    } 
    private function getopticalstatustext($bool){
		if($bool){
			return "Aktiviert";
		}
		return "Deaktiviert";
    } 
    private function getopticalbuttonclass($bool){
		if($bool){
			return "on";
		}
		return "off";

    } 

	private function getstatus(){
       
       return file_exists("/var/www/securitycenter/system/alarm.lock") ;

    } 
	private function getopticalstatus(){
       
       return file_exists("/var/www/securitycenter/system/alarmoptical.lock") ;

    } 
	public function get_temp(){
		return substr(shell_exec("/opt/vc/bin/vcgencmd measure_temp"),5);
    }
	
	public function get_processes(){
		//return shell_exec("top -n 1 -b");
		//return shell_exec("ps -ax -o %cpu,%mem,cmd");

		return shell_exec("ps aux | sort -k 3n | tail -20");

    }
	

    public function heartbeat(){
        $temperature= shell_exec("/opt/vc/bin/vcgencmd measure_temp");
		$volt= shell_exec("/opt/vc/bin/vcgencmd measure_volts");
		$clock= shell_exec("/opt/vc/bin/vcgencmd measure_clock arm"); 
        $this->log("[Heartbeat]: $temperature, $volt, $clock");
		//CakeLog::write("$temperature, $volt, $clock");
        $this->redirect(array('controller' => 'system', 'action' => 'index'));
   
    }
	
   public function phpinfo(){
     //$this->set('info', phpinfo());
   }
   
   public function readLastLinesOfFile($filePath, $lines = 10) {
		//global $fsize;
		$handle = fopen($filePath, "r");
		if (!$handle) {
			return array();
		}
		$linecounter = $lines;
		$pos = -2;
		$beginning = false;
		$text = array();
		while ($linecounter > 0) {
			$t = " ";
			while ($t != "\n") {
				if(fseek($handle, $pos, SEEK_END) == -1) {
					$beginning = true;
					break;
				}
				$t = fgetc($handle);
				$pos--;
			}
			$linecounter--;
			if ($beginning) {
				rewind($handle);
			}
			$text[$lines-$linecounter-1] = str_replace(array("\r", "\n", "\t"), '', fgets($handle));
			if ($beginning) break;
		}
		fclose($handle);
		return array_reverse($text);
	   
	}
	
	public function status(){
		//$door = $this->getdoor();
		//$this->set('doortext', $this->getdoortext($door));
		$data=explode("\n",shell_exec("tac /var/www/securitycenter/system/log/log.txt"));
		
		
		$log=array();
		foreach ($data as $entry){
			$add = explode("@",$entry);
			if($add[0] != ""){
				$log[] = $add;
			}
		}
		
		$this->set('log', $log);
	}
		
	public function settings(){
		$groups=$this->System->find('all',array('group' => array('sgroup'), 'fields' => array('sgroup'), 'order' => array('sgroup desc')));
		$this->set('fields', $groups);
		$settings=array();
		foreach($groups as $g){
				$settings[] = array($g['System']['sgroup'],$this->System->find('all', array('conditions' => array('sgroup' => $g['System']['sgroup']), 'order' => array('sort'))));
		}
		//die(var_export($settings,true));
		$this->set('settings', $settings);
		
		
	}
	
	public function editsetting($id=null){
		if(!$id){
                throw new NotFoundException(__('Einstellung nicht gefunden'));
                
        }
        $this->set('setting', $this->System->findById($id));
	}
	public function savesetting($id=null){
		if (!$id) {
			throw new NotFoundException(__('Einstellung nicht gefunden'));
		}
		$setting = $this->System->findById($id);
		if (!$setting) {
			throw new NotFoundException(__('Einstellung nicht gefunden'));
		}
		if ($this->request->is('post')){
				
			$this->request->data['System']['id'] = $id;
			$this->request->data['System']['key'] =  $setting['System']['key'];
			$this->request->data['System']['description'] =  $setting['System']['description'];
			
			if ($this->System->save($this->request->data)) {
				$this->Session->setFlash(__('Einstellung gespeichert.'));
				return $this->redirect(array('controller' => 'system', 'action' => 'settings'));
			}
			$this->Session->setFlash(__('Einstellung konnte nicht gespeichert werden.'));
			$this->redirect(array('controller' => 'system', 'action' => 'settings'));
		}
		
	}
	
    private function getdoor(){
       $val = trim(@shell_exec("/usr/local/bin/gpio -1 read 18"));
       return $val;

    } 
	
	
}