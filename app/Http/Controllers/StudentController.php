<?php
/**
 * Created by PhpStorm.
 * User: 18710
 * Date: 2017/7/16
 * Time: 17:27
 */

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller {

    public function index() {

        // orm方式读取数据，paginate是每次读取3条数据并分页显示
        $students = Student::paginate(20);

        return view('student.index', [
            'students' => $students
        ]);
    }

    // 新增数据
    public function create(Request $request) {

        if ($request->isMethod('post')){
            $data = $request->input('Student');
            if (Student::create($data)){
                // 重定向回主页并且将创建成功的信息通过一个flash传到session会话中
                return redirect('student/index')->with('success', '新增数据成功');
            } else {
                return redirect()->back()->with('fail','新增数据失败');
            }

        }


        return view('student.create');
    }

    // 保存数据
    public function save(Request $request) {
        $data = $request->input('Student');
//        var_dump($data);
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ($student->save()){
            return redirect('student/index');
        } else {
            return redirect()->back();
        }



    }

}