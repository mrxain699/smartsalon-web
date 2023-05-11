<?php
class User extends Controller {

    private $message = '';
    private $errors = array();
    private $user;

    function __construct(){
        $this->user = $this->load_model('User');
    }

    function index(){
        $users = $this->_all($this->user);
        $total_users = $this->user->count();
        $total_admins = $this->user->count('rank', 'admin');
        $total_employees = $this->user->count('rank', 'employee');
        $total_block_users = $this->user->count('status', 'block');

        $this->view('users',
        [
            "users"=>$users,
            "total_users"=>$total_users,
            "total_admins"=>$total_admins,
            "total_employees"=>$total_employees,
            "total_block_users"=>$total_block_users,

        ]);
    }

    function add(){          
        if(is_array($_POST) && count($_POST) > 0){
            $data = $_POST;
            $response = $this->_add($this->user, $data);
            if(is_array($response) && count($response) > 0){
                $this->errors = $response;
            } 
            else{
                $_SESSION['message'] = "User added successfully";
                $_SESSION['message_type'] = "success";
                unset($data);
            }
        }
        $this->view('add_user',
        [

            "errors"=>$this->errors,
            "data"=>@$data,

        ]);
    }


    function update($id = null){
        if($id != null){
            $user = $this->user->where('id', $id);
            $data = $user[0];
        }
        else if(is_array($_POST) && count($_POST) > 0){
            $data = $_POST;
            $response = $this->_update($this->user, $_POST);
            if(is_array($response) && count($response) > 0){
                $this->errors = $response;  
            }
            else{
                $_SESSION['message'] = "User update successfully";
                $_SESSION['message_type'] = "success";
                $this->redirect('user');
            }
        }

        $this->view("update_user",
        [
            "data"=>@$data,
            "errors"=>$this->errors,
        ]);
    }

    function delete($id = null){
        if($id != null){
            $user = $this->user->where('id', $id);
            if(!empty($user[0]['image'])){
                $path = "uploads/".$user[0]['image'];
                if($this->user->delete($id)){
                    unlink($path);
                    $_SESSION['message'] = "User deleted successfully";
                    $_SESSION['message_type'] = "success";
                    $this->redirect('user'); 

                }
                else{
                    $_SESSION['message'] = "Sorry, something went wrong!";
                    $_SESSION['message_type'] = "error";
                    $this->redirect('user');  
                }
            }
            else{
                if($this->user->delete($id)){
                    $_SESSION['message'] = "User deleted successfully";
                    $_SESSION['message_type'] = "success";
                    $this->redirect('user'); 
                }
                else{
                    $_SESSION['message'] = "Sorry, something went wrong!";
                    $_SESSION['message_type'] = "error";
                    $this->redirect('user');  
                }
            }
           
        }
    }

    function block($id = null){
        if($id != null){
            $res = $this->_block($this->user, $id);
            if($res){
                $_SESSION['message'] = "User blocked successfully";
                $_SESSION['message_type'] = "success";
                $this->redirect('user'); 
            }
            else{
                $_SESSION['message'] = "Sorry, something went wrong!";
                $_SESSION['message_type'] = "error";
                $this->redirect('user');   
            } 
        }

    }

    function unblock($id = null){
        if($id != null){
            $res = $this->_unblock($this->user, $id);
            if($res){
                $_SESSION['message'] = "User unblocked successfully";
                $_SESSION['message_type'] = "success";
                $this->redirect('user'); 
            }
            else{
                $_SESSION['message'] = "Sorry, something went wrong!";
                $_SESSION['message_type'] = "error";
                $this->redirect('user');   
            } 
        }

    }

    function filter(){
        if(is_array($_POST) && count($_POST) > 0){
            $data = $this->_filter($this->user, $_POST);
            if(is_array($data) && count($data) > 0){
                echo json_encode($data);
            }
            else{
                echo 0;
            }
        }
           
    }

    function search(){
        if(is_array($_POST) && count($_POST) > 0){
            $data = $this->_search($this->user, "firstname", $_POST);
            if(is_array($data) && count($data) > 0){
                echo json_encode($data);
            }
            else{
                echo 0;
            } 
        } 
    }

    function get_rank($u_id){
        if($u_id > 0){
            $user = $this->user->where('id', $u_id);
            if(is_array($user) && count($user) > 0){
                echo json_encode(["rank"=>$user[0]['rank']]);
            }
            else{
                echo 0;
            }
            
        }
    }
    

   

    

    
}
?>