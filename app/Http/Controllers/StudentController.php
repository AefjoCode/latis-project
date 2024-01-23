<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Institution;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        return $this->middleware('auth');
    }


     public function export()
     {
        $students = Student::select('id','nis', 'nama_siswa', 'email', 'foto', 'institution_id')->with('institution')->get();

        $export = (new FastExcel($students))->download('student.xlsx', function ($student) {
            return [
                'Id' => $student->id,
                'Nis' => $student->nis,
                'Nama Siswa' => $student->nama_siswa,
                'Email' => $student->email,
                'Foto' => $student->foto,
                'Insitution' => optional($student->institution)->nama_lembaga,
            ];
        });
        
    
        return $export;
     }
     

     public function search(Request $request)
     {
         $search = $request->input('search');
         $lembaga = $request->input('nama_lembaga');
     
         $institutions = Institution::get();
     
         $students = Student::query();
     
         if ($search) {
             $students->where(function ($query) use ($search) {
                 $query->where('nama_siswa', 'like', "%" . $search . "%")
                     ->orWhere('nis', 'like', "%" . $search . "%");
             });
         }
     
         if ($lembaga) {
             $students->where('institution_id', $lembaga);
         }
     
         $students = $students->paginate();
     
         return view('student.index', [
             'students' => $students,
             'institutions' => $institutions
         ]);
     }
     
     
    public function index()
    {

        $students = Student::paginate(4);
        $institutions = Institution::all();
        return view('student.index', [
            'students' => $students,
            'institutions' => $institutions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions = Institution::all();
        
        return view('student.create', [
            'institutions' => $institutions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required',
            'nis' => 'required|numeric|unique:students',
            'nama_siswa' => 'required',
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:100'
        ]);

        $foto = $request->file('foto');
        
        $path_foto = time()."_".$foto->getClientOriginalName();

        $path = 'foto';
        $foto->move($path, $path_foto);
        
        Student::create([
            'institution_id' => $request->institution_id,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'email' => $request->email,
            'foto' => $path.'/'.$path_foto,
        ]);

        return redirect()->route('student.create')->with('message', 'data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);

        return view('student.show', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $institutions = Institution::all();

        return view('student.edit', [
            'student' => $student,
            'institutions' => $institutions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'institution_id' => 'required',
            'nis' => 'required|numeric|unique:students',
            'nama_siswa' => 'required',
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:100'
        ]);

        $foto = $request->file('foto');
        
        $path_foto = time()."_".$foto->getClientOriginalName();

        $path = 'foto';
        $foto->move($path, $path_foto);
        
        $student = Student::find($id);

        $student->update([
            'institution_id' => $request->institution_id,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'email' => $request->email,
            'foto' => $path.'/'.$path_foto,
        ]);

        return redirect()->route('student.edit', $student)->with('message', 'data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        $student->delete();

        return back();
    }
}
