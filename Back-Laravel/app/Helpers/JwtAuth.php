<?php 
 
 namespace App\Helpers; 

 use Firebase\JWT\JWT; 
 use Illiminate\Support\Fecades\DB; 
 use App\User; 


 Class JwtAuth{
 	public $key; 

 	public function __construct(){
 		$this->key ='clave_super_secreta_ssv_web1232_producc-32311238843';
 	}


 	public function signup($email,$password,$getToken=null){
 		//Buscar si existe el usuario con sus credenciales. 
 		$user=User::Where([
 			'email'=>$email, 
 			'password'=>$password
 		])->first(); 
  			 
 		 
 		//Comprobar si son correctos. (objeto)
 		$signup=false; 
 		if(is_object($user)){
 			$signup=true; 
 		

 		}

 		//General el token de datos del usuario autenticado. 
 		if($signup){

 			$token = array(
 				'sub'=> $user->id, 
 				'name' => $user->name, 
 				'email' => $user->email, 
 				'surname' =>$user->surname, 
 				'description' =>$user->description, 
 				'image' => $user->image, 
 				'iat' =>  time(), 
 				'exp' => time() + (7*24*60*60)
 			); 

 			$jwt=JWT::encode($token,$this->key,'HS256'); 
 			$decoded = JWT::decode($jwt,$this->key, ['HS256']); 
			 
 			//Devolver los datos decodificados o el token, en funcion de un parametro
 			if(is_null($getToken)){
 				$data =$jwt; 
 			}else {
 				$data=$decoded; 
 			}

 		}else{
 			$data = array(
 				'status'=>'error', 
 				'code' =>404, 
 				'message' => 'Login incorrecto.'

 			); 
 		}

 		return $data; 

 	}

 	public function checkToken($jwt,$getIndentity=false){
 		$auth= false;

 		try{
 			$jwt = str_replace('"', '',$jwt); 

 			$decoded=  JWT::decode($jwt,$this->key, ['HS256']); 

 		}catch(\UnexpectedValueException $e){	
 			$auth = false; 

 		}catch(\DomainException $e){
 			$auth=false; 
 		}

 		if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
 			 $auth=true; 
 		}else {
 			$auth=false; 
 		}

 		if($getIndentity){
 			return $decoded; 
 		}


 		return $auth; 

 	}


 }