<?php
App::uses('AppController','Controller');
class TrashbinsController extends AppController{

	public function add(){
       // $this->layout = false;
		$this->autoRender = false;
        $response = array('status'=>'failed');
        if($this->request->is('post')){
            
            $data = file_get_contents('php://input');
            if(empty($data)){
                $data = json_encode($_POST);
            }
            
            if(!empty($data)){
                $data = json_decode($data);
                if($this->Trashbin->save($data)){
                    $response = array('status'=>'success','msg'=>'  successfully created');
                }
            }
        }
        
        echo json_encode($response);
    }


    public function view($id = null){
        //$this->layout = false;
        $this->autoRender = false;
        $response = array('status'=>'failed');
        if(isset($id)){
            $result = $this->Trashbin->findById($id);
            if(!empty($result)){
              $response = array('status'=>'success','data'=>$result);  
            } else {
                $response['msg'] = 'Data returned empty';
            }  
        }
        
        echo json_encode($response);
    }

    public function update(){
       // $this->layout = false;
    	$this->autoRender = false;
        $response = array('status'=>'failed');
        if($this->request->is(array('post','put'))){
            $data = file_get_contents('php://input');
            if(empty($data)){
                $data = json_encode($_POST);
            }
            if(!empty($data->id)){
                $this->Trashbin->id = $data->id;
                if($this->Trashbin->save($data)){
                    $response = array('status'=>'success','msg'=>'  updated');
                }
            } else {
                $response['msg'] = 'ID not provided';
            }
        }
        
        echo json_encode($response);
    }

    public function ajax_delete($id = null){
       // $this->layout = false;
    	$this->autoRender = false;
        $response = array('status'=>'failed');
        if(isset($id)){
            if($this->Trashbin->delete($id, true)){
                $response = array('status'=>'success','msg'=>'  deleted');
            }
        }
        
        echo json_encode($response);
    }


}
?>