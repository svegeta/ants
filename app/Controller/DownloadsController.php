<?php
class DownloadsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('downloads', $this->Download->find('all'));
    }
    
    public function download($id=null) {
         if (!$id) {
            throw new NotFoundException(__('Invalid download'));
        }
        $download = $this->Download->findById($id);
        $fileName = $download['Download']['download_file'];
        $filePath = "webroot/files".DS.$fileName;
        $this->response->file($filePath, array(
            'download' => true,
            'name' => $fileName
        ));
        return $this->response;
    }
    

}