<?php

namespace App\Http\Controllers;

use App\FeedBack;
use App\User;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
    //
    public function postLogin(Request $request)
    {
        $studyNo = $request->get('studyNo');
        $password = $request->get('password');
        $user = DB::table('users')->where('study_no','=',$studyNo)->where('password','=',$password)->first();
        if (empty($user)) {
            $data['msg'] =  "用户名或密码不存在";
            return $data;
        } else {
            $data['entity'] = $user;
//            return $data;
            return $this->loginSuccess($user);
        }
    }

    public function editInfo(Request $request)
    {
        $password = $request->get('password');
        $userName = $request->get('userName');
        $phone = $request->get('phone');
        $sex = $request->get('sex');
        $age = $request->get('age');
        $department = $request->get('department');
        if (empty($password)) {
            $sql = "update users set user_name = '$userName' , phone = $phone , sex = $sex , age = $age , detartment = '$department'";
        } else {
            $sql = "update users set password = $password";
        }

        $userId = $request->getSession()->get('userId');
        DB::update("$sql where user_id = ?", array($userId));
        return $this->writeSuccess();

    }

    public function getInfo(Request $request)
    {
        $userId = $request->getSession()->get('userId');
        $user =DB::table('users')->where('user_id',$userId)->first();
        return $this->writeSuccess($user);

    }

    public function getLogOut(Request $request)
    {

        $request->getSession()->clear();

    }


    public function getTeacherList()
    {
        $results = DB::select('select * from teacher');
        return $this->writeSuccess($results);
    }

    public function getTeacherDetail(Request $request)
    {
        $userId = $request->get('userId');
        $teacherId = $request->get('teacherId');
        $teacher = DB::table('teacher')->where('teacher_id',$teacherId)->first();
        $teacherComment = DB::table('teachercomment')->where('teacher_id',$teacherId)->where('user_id',$userId)->first();
        $teacher->comment = $teacherComment;
        return $this->writeSuccess($teacher);
    }

    public function evaluateTeacher(Request $request)
    {
        $userId = $request->get('userId');
        $content = $request->get('content');
        $teacherId = $request->get('teacherId');
        $teacherComment = DB::table('teachercomment')->where('teacher_id',$teacherId)->where('user_id',$userId)->first();

        if (empty($teacherComment)) {
            DB::insert('insert into teachercomment (user_id, teacher_id ,content) values (?, ?,?)', array($userId, $teacherId, $content));
            return $this->writeSuccess();
        }else {
            $commentid = $teacherComment->comment_id;
            DB::update("update teachercomment set content = '$content' where comment_id = ?", array($commentid));
            return $this->writeSuccess();
        }
    }

    public function feedBack(Request $request)
    {
        $userId = $request->get('userId');
        $content = $request->get('content');
        DB::insert('insert into feedback (user_id, content) values (?, ?)', array($userId, $content));
        return $this->writeSuccess();
    }

    public function writeSuccess($entity = null)
    {
        $data['data'] = $entity;
        $data['msg'] = 'success';
        $data['code'] = '200';
        return $data;
    }

    public function writeFail($entity)
    {
        $data['data'] = $entity;
        $data['msg'] = 'fail';
        $data['code'] = '300';
        return $data;
    }

    public function loginSuccess($entity)
    {
        $data['entity'] = $entity;
        $data['msg'] = 'success';
        $data['code'] = '200';
        return $data;
    }

}
