<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

use function PHPUnit\Framework\isEmpty;

class StudiomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $firebase = (new Factory)
        ->withServiceAccount(__DIR__.'/laravel80-firebase-adminsdk-3pou9-850b1a0bcf.json')
        ->withDatabaseUri('https://laravel80-default-rtdb.firebaseio.com/');

    $database = $firebase->createDatabase();

    $blog = $database
    ->getReference('blog')->getValue();
$name = "Abdullah Zatma";
//remove
// $database->getReference('blog')-> remove();
return view('action.index',compact('blog','name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('action.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
'fname' => 'alpha_num|required',
'lname' => 'alpha_num|required',
'uname' => 'required|starts_with:@'

        ]);
        
        $firebase = (new Factory)
        ->withServiceAccount(__DIR__.'/laravel80-firebase-adminsdk-3pou9-850b1a0bcf.json')
        ->withDatabaseUri('https://laravel80-default-rtdb.firebaseio.com/');
        $database = $firebase->createDatabase();
        $blog = $database
        ->getReference('blog');
        $fname = $request['fname'];
        $lname = $request['lname'];
        $uname = $request['uname'];
        $r = route('admin.create');
        if(!empty($blog->getValue())){
            foreach($blog->getValue() as $item){
                if($item['uname'] == $uname){
                
                    return redirect("$r",302)->with('pass',false)->with('error','the username is use');
                }else{
                    $postData = ['fname'=> "$fname", 'lname'=> "$lname" , 'uname'=> "$uname"];
                    $postRef = $database->getReference('blog')->push($postData);
                    
                if( isEmpty($postRef)){
                
                return redirect("$r",302)->with('pass',true);
                }else{
                return redirect("$r",302)->with('pass',false);
                
                }
                    
                }
                        }
                     
                     
                
                  
                    }else{
                        $postData = ['fname'=> "$fname", 'lname'=> "$lname" , 'uname'=> "$uname"];
                        $postRef = $database->getReference('blog')->push($postData);
                        
                    if( isEmpty($postRef)){
                    
                    return redirect("$r",302)->with('pass',true);
                    }else{
                    return redirect("$r",302)->with('pass',false);
                    
                    }

                    }
        }
        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firebase = (new Factory)
        ->withServiceAccount(__DIR__.'/laravel80-firebase-adminsdk-3pou9-850b1a0bcf.json')
        ->withDatabaseUri('https://laravel80-default-rtdb.firebaseio.com/');
        $database = $firebase->createDatabase();
        $blog = $database
        ->getReference('blog');
        $fname = $lname = $uname = "def";
        foreach($blog->getValue() as $item){
      
            if($item['uname'] == $blog->getValue()[$id]['uname']){
                
                $fname = $item['fname']; 
                $lname = $item['lname']; 
                $uname = $item['uname']; 
               
                return view('action.edit',compact('fname','lname','uname','id'));

break;
            }

        }
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
        $validation = $request->validate([
            'fname' => 'alpha_num|required',
            'lname' => 'alpha_num|required',
        
            
                    ]);
                    
                    $firebase = (new Factory)
                    ->withServiceAccount(__DIR__.'/laravel80-firebase-adminsdk-3pou9-850b1a0bcf.json')
                    ->withDatabaseUri('https://laravel80-default-rtdb.firebaseio.com/');
                    $database = $firebase->createDatabase();
                    $blog = $database
                    ->getReference("blog");
                    $fname = $request['fname'];
                    $lname = $request['lname'];
                    $uname = $request['uname'];
                    $r = route('admin.index');
              $database->getReference()->removeChildren([
'blog/'.$id

              ]);
              $postData = ['fname'=> "$fname", 'lname'=> "$lname" , 'uname'=> "$uname"];
              $database->getReference('blog')->push($postData);
              return redirect("$r",302)->with('pass',"Edit done!");
         
                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firebase = (new Factory)
                    ->withServiceAccount(__DIR__.'/laravel80-firebase-adminsdk-3pou9-850b1a0bcf.json')
                    ->withDatabaseUri('https://laravel80-default-rtdb.firebaseio.com/');
                    $database = $firebase->createDatabase();
        $database->getReference()->removeChildren([
            'blog/'.$id
            
                          ]);
      $r= route('admin.index');
      return redirect("$r",302)->with('pass',"delete done!");

    }
}
