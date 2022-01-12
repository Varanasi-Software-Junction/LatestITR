<?php
use App\EmpInfo;
use App\Book;
use App\User;
use App\PersonalInfo;
use App\AddressInfo;
use App\OtherSourceInc;
use App\SendFile;
use App\BankDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Validation\ValidationException;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//**********************************************
/*
1. Personal Info : 
                    API:
                    Data post and Update : - Done (http://itrplus.com/itr/api/addpersonlinfo)    
                    
                    Get Personal Info: Done (http://itrplus.com/itr/api/getpersonalinfobyid/41)
                    
2. Address Info : API
                        Data post and Update : - Done(http://itrplus.com/itr/api/addaddressinfo)
                        
                        Get Address : Done (http://itrplus.com/itr/api/addressfind/41)
                        
                        
                        
3. Bank Details: API
    
                    Data post : - Done (http://itrplus.com/itr/api/bankdetails)
                    
                    Update : - Pending

                    Get Bank Details:- Done (http://itrplus.com/itr/api/bankdetailsbyitrid/41)

4. Other Source:

                Data post and Update: - Done(https://itrplus.com/itr/api/othersourceinc)
                
                Get Other source:- Pending


                    


*/
//***********************************Other Source Inc**************************




Route::post('/addupdateothersource', function(Request $request){
	try{
		$itrid=isset($request["itrid"])?$request["itrid"]:0;
		$data=OtherSourceInc::where("itrid",$itrid)->get();
		if(count($data)>0)
		{
		    $pi=$data[0];
		    $id=$pi["id"];
		    $pi->fill($request->all());
		    $pi["id"]=$id;
		    $pi->save();
		}
		else
		{
		$pi = OtherSourceInc::create($request->all());
		//$userid=$request["userid"];
		
		$pi->save();
		}
		$pi["status"]="ok";
		
		
		return response()->json($pi, 200);
	}
	catch(\Exception $f){
		$error=array("status"=>"failed","error"=>$f->getMessage());
		return response()->json($error, 200);
	}
});





Route::get('/getothersourcebyitrid/{itrid}', function($itrid,Request $request){
	try
	{
		//$id=$request["id"];
		$emp = OtherSourceInc::where("itrid",$itrid)->get();
		if(count($emp)<=0)
		{
			throw new Exception('Itrid Not Found');
		}
        $data=[];
        $data["data"]=$emp;
		$data["status"]="ok";

		return response()->json($data, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});



//***********************************Other Source Inc**************************





//***********************************Bank Details**************************



Route::post('/addupdatebankdetailsbyid', function(Request $request){
    //Pass itrid and no id to create a new record
    //Pass itrid and an id to update
	try{
	    
	    $id=isset($request["id"])?$request["id"]:0;
		$data=  BankDetails::where("id",$id)->get();
		if(count($data)>0)
		{
		    $pi=$data[0];
		    $pi->fill($request->all());
		$pi["id"]=$id;
		$pi->save();
		}
		else
		{
		$pi = BankDetails::create($request->all());
		$pi->save();
		
		}
		$pi["status"]="ok";
		
		
		return response()->json($pi, 200);
	}
	catch(\Exception $f){
		$error=array("status"=>"failed","error"=>$f->getMessage());
		return response()->json($error, 200);
	}
});





Route::get('/getbankdetailsbyitrid/{itrid}', function ($itrid,Request $request){
    //Working
	try
	{
	
		$emp = BankDetails::where("itrid",$itrid)->get();
		if(count($emp)==0)
		{
			throw new Exception('Itrid Not Found');
		}
		$data=[];
        $data["data"]=$emp;
		$data["status"]="ok";

		return response()->json($data, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});




//*******************************************************************


//**********************************************


Route::get('/getbankdetailsbyid/{id}', function ($id,Request $request){
    //Working
	try
	{
		//$id=$request["id"];
		$emp = BankDetails::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});



//***********************************Bank Details**************************
//***********************************Address Info**************************



Route::post('/addupdateaddressinfobyitrid', function (Request $request) {
	try
	{
		$itrid=$request["itrid"];
		$itrpersonal=PersonalInfo::find($itrid);
		if ($itrpersonal==null)
		{
			throw new Exception('ITR Id does not exist');
		}
		
		$data=AddressInfo::where("itrid",$itrid)->get();
		if(count($data)>0)
		{
		    $pi=$data[0];
		    $id=$pi["id"];
		    $pi->fill($request->all());
		    $pi["id"]=$id;
		    $pi->save();
		}
		else 
		{
		
		
	 $pi = AddressInfo::create($request->all());
		
		
		
		$pi->save();
		}
		$pi["status"]="ok";
		

		
        return response()->json($pi, 200);
	}
	 catch (\Exception $e) {
$error=array("status"=>"failed","error"=>$e->getMessage());
    return response()->json($error, 200);
}
	
	
	
});












Route::get('/getaddressbyitrid/{itrid}', function ($itrid,Request $request){ 
	try
	{
		
		$emp = AddressInfo::where("itrid",$itrid)->get();
		if(count($emp)<=0)
		{
			throw new Exception('Itrid Not Found');
		}
        $emp=$emp[0];
		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});



//***********************************Address Info**************************
//***********************************Personal Info**************************



Route::post('/addpersonlinfo', function (Request $request) {
	//Working
	try
	{
		$userid=$request["userid"];
		$user=User::find($userid);
		if ($user==null)
		{
			throw new Exception('User Id does not exist');
		}
		$request["sourceofincome"]=serialize( $request["sourceofincome"]);
		$id=isset($request["id"])?$request["id"]:0;
		$data=PersonalInfo::where("id",$id)->get();
		if(count($data)>0)
		{
		     $pi = $data[0];
		     
		     $pi->fill($request->all());
		     $pi->save();
		}
		
		else
		{
	 $pi = PersonalInfo::create($request->all());
		$pi->save();
		}
		$pi["status"]="ok";
		$pi["sourceofincome"]=unserialize($pi["sourceofincome"]);
        return response()->json($pi, 200);
	}
	 catch (\Exception $e) {
$error=array("status"=>"failed","error"=>$e->getMessage());
    return response()->json($error, 200);
}
	
	
	
});








Route::get('/getpersonalinfobyid/{id}', function($id,Request $request){ //Working
	
	try
	{
		//$id=$request["id"];
		$emp = PersonalInfo::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});


Route::get('/getallpersonalinfobyuserid/{userid}', function ($userid,Request $request){
	try
	{
	    //$userid=$request["userid"];
	    
	 $data= PersonalInfo::where("userid",$userid)->get();
	 $result=[];
	 $result["status"]="ok";
	 $result["data"]=$data;
		return response()->json($result, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});




//***********************************Personal Info**************************

//*************************************************************
Route::post('/sendfile', function(Request $request){
    //File upload working. And need to add one field for pwd and associate with
    // IRT id
	try{
		$filename ="dummy";
		$request["filename"]=$filename;
		
		 if ($request->hasFile('filecontents')) {
			 $pi = SendFile::create($request->all());
			 $file = $request->file('filecontents');
			 $filename =rand(10,100) . time().'_'.$file->getClientOriginalName();
			 $file->move("public/product",$filename);
			 $pi["filename"]=$filename;
			 $pi["url"]="http://itrplus.com/itr/public/product/$filename";
			 
			 
		 }
		 else
		 {
			 	throw new Exception('No file selected');
		 }
		$pi->save();
		$pi["status"]="ok";
		
		
		return response()->json($pi, 200);
	}
	catch(\Exception $f){
		$error=array("status"=>"failed","error"=>$f->getMessage());
		return response()->json($error, 200);
	}
});



//**********************************************


//**********************************************
//**********************************************

Route::get('/sendfilefind/{id}', function ($id,Request $request){
	try
	{
	    
		//Working properly
		$emp = SendFile::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}
		//$emp["url"]=str_replace("\\","",$emp["url"]);
		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});


//**********************************************




//*******************************************************************


//*******************************************************************


//*******************************************************************

//*******************************************************************
Route::get('/registeruserfind/{id}', function($id,Request $request){ //Working
	
	try
	{
		//$id=$request["id"];
		$emp = User::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});

//*******************************************************************
Route::get('/addjsonuserfind/{id}', function($id,Request $request){ // Working but we can delete we have api to get user info (registeruserfind)
	
	try
	{
		$id=$request["id"];
		$emp = User::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});

//*******************************************************************
Route::get('/adduserfind', function(Request $request){ //Working 
	
	try
	{
		$id=$request["id"];
		$emp = User::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});

//*******************************************************************
Route::get('/sanctumfind', function(Request $request){ 
    //Working fine we can delete
	
	try
	{
		$id=$request["id"];
		$emp = User::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});

//*******************************************************************
Route::get('/find', function(Request $request){
    //Working fine we can delete
	
	try
	{
		$id=$request["id"];
		$emp = User::find($id);
		if($emp==null)
		{
			throw new Exception('Id Not Found');
		}

		$emp["status"]="ok";

		return response()->json($emp, 200);
	}
	catch(\Exception $k) {
		$error=array("status"=>"failed","error"=>$k->getMessage());
		return response()->json($error, 200);
	}
});



//*******************************************************************




Route::post('/hello' , function(Request $request) {
	$request= json_decode($request->getContent(), true);
	return "Hello" . $request["id"];
});




//*************************************************************



//*************************************************************



//*************************************************************



//**********************************************
Route::get('/registeruser',function (Request $request)
{
$validatedData = $request->validate([
'name' => 'required|string|max:255',
                   'email' => 'required|string|email|max:255|unique:users',
                   'password' => 'required|string|min:8',
]);

      $user = User::create([
              'name' => $validatedData['name'],
                   'email' => $validatedData['email'],
                   'password' => Hash::make($validatedData['password']),
       ]);
	   return $user;

//$token = $user->createToken('auth_token')->plainTextToken;

//return response()->json([              'access_token' => $token,                   'token_type' => 'Bearer',]);
});
Route::post('/addjsonuser', function (Request $request) {
    //Working
	try
	{
	$request = json_decode($request->getContent(),true);
	$request["password"]=Hash::make($request['password']);
        $user = User::create($request);
     $user->save();
$user["status"] = "ok";

        return response()->json($user, 200);
}
    catch (\Exception $e) {
$error=array("status"=>"failed","error"=>$e->getMessage());
    return response()->json($error, 200);
}
    
});


//********************************************


Route::get('/adduser', function (Request $request) {
   
	$request["password"]=Hash::make($request['password']);
        $user = User::create($request->all());
		$user->save();

        return response()->json($user, 200);
    
    
});


Route::post('sanctum/json/token', function (Request $request) {
   
 $request= json_decode($request->getContent(), true);

$email=$request["email"];
    $user = User::where('email', $email)->first();

    if (! $user || ! Hash::check($request["password"], $user->password)) {
		$error=array("status"=>"failed",);
        return response()->json($error, 200);;
    }
	$user["status"] = "ok";
	$user["token"] = $user->createToken("android")->plainTextToken;
    return response()->json($user, 200);// $user->createToken("android")->plainTextToken;
	
	//return "Hello";
});




Route::get('sanctum/token', function (Request $request) {
   
  

$email=$request["email"];
    $user = User::where('email', $email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
	

    return $user->createToken("android")->plainTextToken;
	
	//return "Hello";
});


Route::post('sanctum/token', function (Request $request) {
   
  /* $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
*/
$email=$request["email"];
    $user = User::where('email', $email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
	

    return $user->createToken("android")->plainTextToken;
	
	//return "Hello";
});






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'Auth\LoginController@login');


Route::post('register', 'Auth\RegisterController@register');
