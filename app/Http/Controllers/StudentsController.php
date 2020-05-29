<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\Mapel;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')) {
            $students = Student::where('nama', 'LIKE', '%'. $request->search .'%')->get();
        } else {
            $students = Student::all();
        }
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //form validation
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:students',
            'nis' => 'required|size:5|unique:students|min:5',
            'kelas' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        //inset tabel user
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(40);
        $user->save();

        //Insert tabel students
        $request->request->add(['user_id' => $user->id]);
        $student = \App\Student::create($request->all());    
        return redirect('/students')->with('status', 'Data siswa berhasil ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $student = \App\Student::find($id);
        if($student->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('students/' . $id)->with('failed', 'Data mata pelajaran sudah ada');
        }
        $student->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('students/' . $id)->with('status', 'Data nilai berhasil dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $matapelajaran = \App\Mapel::all();
        return view('students.show', ['student' => $student, 'matapelajaran' => $matapelajaran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:students',
            'nis' => 'required|size:5|unique:students',
            'kelas' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'picture' => 'max:1000|mimes:png,jpg,jpeg'
        ]);
        Student::where('id', $student->id)
                ->update([
                    'nama' => $request->nama,
                    'nis' => $request->nis,
                    'kelas' => $request->kelas,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'alamat' => $request->alamat,
                    'picture' => $request->picture
                ]);
            if($request->hasFile('picture')){
                $request->file('picture')->move('images/', $request->file('picture')->getClientOriginalName());
                $student->picture = $request->file('picture')->getClientOriginalName();
                $student->save();
            }
        return redirect('/students')->with('status','Data siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect('/students')->with('status','Data siswa berhasil dihapus');
    }
}
