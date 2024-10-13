<?php
namespace App\Controllers;

use App\Libraries\Controller;
use Exception;
class Pages extends Controller
{
    public function __construct()
    {
        $this->usermodel=$this->model('user');
        $this->blogmodel=$this->model('blogtable');

    }
    public function index()
    {
        $this->view('sample');
    }
    public function signup()
    {
        $data="";
        if(isset($_POST['signup']))
        {
         try{
            $user=$this->model('user');
            $user->firstname=$_POST['fname']??"";
            $user->lastname=$_POST['lname']??"";
            $user->email=$_POST['emailfield']??"";
            $user->userpassword=$_POST['pass']??"";
            $user->status="Pending";
            $user->role="customer";
            $user->save();
            $data="Data Inserted Waiting for Response";
        }
        catch(Exception $e)
    {
        $data="Email is already Registered!!";
    }
    }
        $this->view('signup',$data);
    }
    public function check()
    {
       
        // $user=['email'=>$_REQUEST['emailfield'],'userpassword'=>$_REQUEST['pass']];
        // $result=$this->usermodel::find($user);

        // $this->view('signup',$result);
        

    }
    public function loginview()
    {
        $result='';
        $this->view('login',$result);
    }
    public function login()
    {
       $result='';
     
        if (isset($_POST['login'])) {
            $result = 'Wrong Credentials!!';
           
            $result=$this->usermodel::find('all');
       
            foreach($result as $user)
            {
                
                if (($user->email == $_POST['emailfield']) && ($user->userpassword == $_POST['pass']) && ($user->status == 'Approved') && ($user->role == 'customer')) {
                    
            
                    header('Location:profile');
                    
                }
                else if (($user->email == $_POST['emailfield']) && ($user->userpassword == $_POST['pass']) && ($user->status == 'Approved') && ($user->role == 'admin')) {
                    
                
                    header('Location:dashboard');
                    
                }
                else if (($user->email == $_POST['emailfield']) && ($user->userpassword == $_POST['pass']) && ($user->status == 'Pending') && ($user->role == 'customer')) {
                    
                    $result='User is not Approved!!';
          
                    
                }
               
                $this->view('login',$result);
            }
        }
      
    }
    public function dashboard()
    {
        if (isset($_POST['delete'])) {

            $v=$_POST['delval']??"";
            $this->blogmodel::table()->delete(array('id'=>$v));
            
        }
        $result=$this->blogmodel::find('all');
       
        $this->view('dashboard',$result);
    }

   public function adminmoreabout()
    {
       
        $v=$_POST['item']??"";
        $result=$this->blogmodel::find('all',array('id'=>$v));
        $this->view('adminmoreabout',$result);
    }
    public function editform()
    {
        if (isset($_POST['edit'])) {
            $v = $_POST['editval'];
            $result=$this->blogmodel::find('all',array('id'=>$v));
            $this->view('editform', $result);
        }

        if (isset($_POST['update'])) {
            $bid = $_POST['bid'];
            $bname = $_POST['bname'];
            $bdesc = $_POST['bdesc'];
            $bimage = $_POST['bimage'];
            $temp=$this->blogmodel::find(array('id'=>$bid));
            $temp->blogname =$bname;
            $temp->blogdesc =$bdesc;
            $temp->blogimage =$bimage;
            $temp->save();
            header('Location:dashboard');
          
        }
    }
    public function profile()
    {

        $this->view('profile');
    }
    public function allusers()
    {
        if (isset($_POST['delete'])) {
            $v = $_POST['id'];
            $this->usermodel::table()->delete(array('id'=>$v));
        }
        if (isset($_POST['changestatus'])) {
            $v = $_POST['change'];
            $temp=$this->usermodel::find(array('id'=>$v));
            $s=$temp->status;
            if($s=="Approved")
            {
                $temp->status='Pending';
            }
            else{
                $temp->status='Approved' ;
            }
            $temp->save();
           
            
        }
        $result=$this->usermodel::find('all',array('role'=>"customer"));
        $this->view('allusers',$result);
    }
    public function addblog()
    {
        if (isset($_POST['addnewblog'])) {
        $bname = $_POST['bname'];
        $bdesc = $_POST['bdesc'];
        $bimage = $_POST['bimage'];
        $temp=$this->model('blogtable');
        $temp->blogname =$bname;
        $temp->blogdesc =$bdesc;
        $temp->blogimage =$bimage;
        $temp->save();
        header('Location:dashboard');
        }
        $this->view('addblog');
    }
}