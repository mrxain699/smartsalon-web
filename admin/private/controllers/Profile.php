<?php

class Profile extends Controller
{

    private $message = '';
    private $errors =  array();
    private $user_id;
    private $user;

    function __construct()
    {
        if (isset($_SESSION['ID']) && $_SESSION['ID'] != '') {
            $this->user_id = $_SESSION['ID'];
        }
        $this->user = $this->load_model('User');
    }

    function index()
    {

        $user = $this->user->where('id', $this->user_id);
        $data = $user[0];
        $this->view(
            'profile',
            [
                "data" => $data,
            ]
        );
    }

    function upload_image()
    {
        if (is_array($_POST) && count($_POST) > 0) {
            $data = $_POST;
            $image = $_FILES['img'];
            $id = $data['id'];
            $uploaded_image = $this->user->validate_image($image);
            if (is_array($uploaded_image) && count($uploaded_image) > 0) {
                $_SESSION['message'] = $uploaded_image['image'];
                $_SESSION['message_type'] = "error";
                $this->redirect('profile');
            } else {
                $response = $this->user->update(["image" => $uploaded_image], $id);
                if ($response) {
                    $_SESSION['IMAGE'] = $uploaded_image;
                    $_SESSION['message'] = "Image upload successfully";
                    $_SESSION['message_type'] = "success";
                    $this->redirect('profile');
                } else {
                    $_SESSION['message'] = "Sorry, something went wrong";
                    $_SESSION['message_type'] = "error";
                    $this->redirect('profile');
                }
            }
        }
    }

    function update()
    {
        if (is_array($_POST) && count($_POST) > 0) {
            $data = $_POST;
            $id = $data['id'];
            $user = new $this->user($data);
            $err_arr = $user->validate();
            if (is_array($err_arr) && empty($err_arr)) {
                $res = $user->update($user->sanitize_data(), $id);
                if ($res) {
                    $_SESSION['message'] = "Profile update successfully";
                    $_SESSION['message_type'] = "success";
                    $this->redirect('profile');
                } else {
                    $_SESSION['message'] = "Sorry, something went wrong";
                    $_SESSION['message_type'] = "error";
                    $this->redirect('profile');
                }
            } else {
                $this->errors = $err_arr;
            }
        }


        if (is_array($this->errors) && count($this->errors) > 0) {
            $this->view(
                "profile",
                [
                    "data" => @$data,
                    "errors" => $this->errors,
                ]
            );
        }
    }

    function change_password()
    {
        $user = $this->user->where('id', $this->user_id);
        if (is_array($_POST) && count($_POST) > 0) {
            $data = $_POST;
            $id = $data['id'];
            $password = $data['password'];
            $confirm_password = $data['cpass'];
            if ($password != $confirm_password) {
                $this->message = alert("error", "Password didn't match!");
            } else {
                $err_arr = validate_password($password);
                if (empty($err_arr)) {
                    $res = $this->user->reset_password($id, $password);
                    if ($res) {
                        $_SESSION['message'] = "Password Changed Successfully";
                        $_SESSION['message_type'] = "success";
                        $this->redirect('profile');
                    } else {
                        $_SESSION['message'] = "Sorry, something went wrong";
                        $_SESSION['message_type'] = "error";
                        $this->redirect('profile');
                    }
                } else {
                    $this->errors = $err_arr;
                }
            }
        }
        if (is_array($this->errors) && count($this->errors) > 0) {
            $this->view(
                "profile",
                [
                    "data" => $user[0],
                    "message" => $this->message,
                    "errors" => $this->errors,
                ]
            );
        }
    }
}
