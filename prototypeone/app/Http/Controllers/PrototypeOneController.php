<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\SubmitCaseRequest;
use App\Http\Requests\SubmitMessageRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\ResearchNote;
use App\Professional;
use App\Supplier;
use App\ResearchCase;
use App\Message;
use App\ExpertUser;
use App\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;
//for file uploads
use Input;
use Validator;
use Redirect;


class PrototypeOneController extends Controller {

	private $users; // Eloquent model of user table
	private $research_notes; // Eloquent model of research note table
	private $professionals; // Eloquent model of professionals table
	private $suppliers; // Eloquent model of suppliers table
	private $research_cases;// Eloquent model of research cases table
	private $messages; // Eloquent model of case messages
	private $expert_users; // Eloquent model of expert users
	private $research_photos;
	public function __construct (User $users, ResearchNote $research_notes, 
								Professional $professionals, 
								Supplier $suppliers, Message $messages,
								ResearchCase $cases, 
								ExpertUser $expert_users, Photo $photos) {
		$this->users = $users;
		$this->research_notes = $research_notes;
		$this->professionals = $professionals;
		$this->suppliers = $suppliers;
		$this->research_cases = $cases;
		$this->messages = $messages;
		$this->expert_users = $expert_users;
		$this->research_photos = $photos;
	}

	/*
	* Index function for home public root page
	*/
	public function index () {
		return view("prototypeone.index");
	}
	
	/**
	* Function dealing with the about page
	*/
	public function about () {
		return view("prototypeone.about");
	}
	
	/**
	* Function handling login
	*/
	public function login (LoginRequest $request) {
		$userinfo = array(
			'username' => $request->get('username'),
			'password' => $request->get('password')
		); // User Input
		if (Auth::attempt($userinfo)) {
			// Get user info
			$user = Auth::user();
			// Authentication Succeeded
			return redirect()->intended('home/'.$user->user_id); 

		} else {
			// Authentication Failed
			// Create a message bag containing all the errors
			$autherrors = new MessageBag(['loginFailed' 
				=> ['Username and/or password invalid']]);
			return redirect()->back()
							 ->withErrors($autherrors);
		}
	}
	
	/**
	* Function handling logout
	*/
	public function logout () {
		Auth::logout(); // Log user out
		return view('prototypeone.logout');
	}
	
	/**
	* Function handling plain home page
	*/
	public function homeNoUser () {
		return view('prototypeone.needlogin');
	}
	
	/**
	* Function handling home page of a user
	*/
	public function homeUser ($user_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			if (!strcmp($user->usertype, 'Seeker')) { 
				// Simple user info
				$research_notes = 
					$this->research_notes
					     ->where('user_id', '=', $user->user_id)
						 ->get(); // Get research notes
				return view('prototypeone.home', 
					compact('user', 'research_notes'));
			} else if (!strcmp($user->usertype, 'Professional')) { 
				// Professional info
				$extrainfo = 
					$this->professionals
						 ->find($user->professional_id);
				return view('prototypeone.home', 
					compact('user', 'extrainfo'));
			} else if (!strcmp($user->usertype, 'Supplier')) { 
				// Supplier info
				$extrainfo = 
					$this->suppliers
						 ->find($user->supplier_id);
				return view('prototypeone.home', 
					compact('user', 'extrainfo'));
			} else if (!strcmp($user->usertype, "Expert User")) {
				// Expert User info
				$extrainfo =
					$this->expert_users
						 ->find($user->expert_user_id);
				return view ('prototypeone.home', 
					compact('user', 'extrainfo'));
			}
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling viewing a research note
	*/
	public function viewNote ($user_id, $research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', 
						 	$research_note_id)
						 ->get()
						 ->first(); // Get note
			$isCase = $this->research_cases
						   ->where('research_note_id', '=', 
						   		$research_note_id)
						   ->get()
						   ->first();
			$images = $this->getPhotos($research_note_id);
			return view("prototypeone.viewnote", 
				compact('note', 'user', 'isCase','images'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling creating a new note
	*/
	public function createNote ($user_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			return view("prototypeone.createnote", compact('user'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function validating and authenticating a new note
	*/
	public function createNoteCheck (CreateNoteRequest $request, 
			$user_id) {
		if (Auth::check()) { // User is logged in.
			if (Auth::user()->user_id != $user_id) { // Wrong user id
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			
			// Correct user. Continue
			/* Insert Database Record */
			$note = new ResearchNote; // Create New Database Instance
			$user = Auth::user(); // Current User
			$note->user_id = $user->user_id; // Set User Id
			$note->title = $request->get('title');
			$note->research_text = $request->get('research_text');
			/* Set Slug - May not be used */
			$slugcontainer = str_slug($request->get('title'), "-");
			$note->slug = $slugcontainer;
			$note->save(); // Finish creating Note
			
			$images =$this->uploadImages($user_id, $note);

			return view("prototypeone.newnoteapproved", 
				compact('user', 'note', 'images'));
		} else { // No user logged in
			return redirect()->route("home_no_user_path");
		}
	}
	
	/**
	* Function handling editing a research note
	*/
	public function editNote ($user_id, $research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', 
						 	$research_note_id)
						 ->get()
						 ->first(); // Get note
			$images = $this->getPhotos($research_note_id);
			return view("prototypeone.editnote", compact('user', 'note', 'images'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function checking the edit of a research note
	*/

	public function editNoteCheck (CreateNoteRequest $request, $user_id, 
			$research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			$note = $this->research_notes
						 ->whereResearch_note_id($research_note_id)
						 ->first();
			// Change the title, text and slug
			$note->title = $request->get('title');
			$note->research_text = $request->get('research_text');
			/* Set Slug */
			$slugcontainer = str_slug($request->get('title'), "-");
			$note->slug = $slugcontainer;
			$note->save(); // Finish creating Note
			
			$images; // Array of images
			//for each photo //modify request
			for ($i = 0; $i < sizeof($request->photos); $i++) {
				$photo = new Photo;
				$photo->research_note_id = $note->research_note_id;
				$photo->path = $request->photos[$i]->path;
				$photo->save();
				array_push($images, $photo);
			}
			
			return view("prototypeone.editnoteapproved", 
				compact('user', 'note', 'images'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling deleting a research note
	*/
	public function deleteNote ($user_id, $research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', 
						 	$research_note_id)
						 ->get()
						 ->first(); // Get note
			
			return view("prototypeone.deletenoteconfirm", 
				compact('user', 'note'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling actually deleting the research note
	*/
	public function deleteNoteConfirm ($user_id, $research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', 
						 	$research_note_id)
						 ->get()
						 ->first(); // Get note
			// Delete the note
			$note->delete();
			$images = $this->getPhotos($research_note_id);
			//delete each photo
			for ($i = 0; $i < sizeof($images); $i++) {
				deletePhoto($research_note_id, $images->path);
			}
			return redirect()->intended('home/'.$user->user_id);
		} else {
			return redirect()->route('home_no_user_path');
		}
	}

	/*	PANEL AND CASE FUNCTIONS */
	/* Functions for Research Cases */	
	public function submitCase ($user_id, $research_note_id) {
		if (Auth::check()) { // User should be logged in
			if (Auth::user()->user_id != $user_id) { // Wrong user
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			/* Create research case */
			$case = new ResearchCase;
			$case->research_note_id = $research_note_id;
			$case->status = false;
			$case->save();
			// Get research note info
			$research_note_info = 
				$this->research_notes
					 ->find($case->research_note_id);
			return view("prototypeone.cases.submitcaseconfirm", 
				compact('user_id', 'research_note_info'));
		} else { // User not logged on
			return redirect()->route('home_no_user_path');
		}
	}
	
	public function changeCaseStatus ($user_id, $case_id, $status){
		if (Auth::check()) { // User should be logged in 
			if (Auth::user()->user_id != $user_id) { // Wrong user
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
		} else {
			return redirect()->route('home_no_user_path');
		}
	}

	
	/* Functions for case messages */
	public function submitMessage ($user_id, $case_id,
			SubmitMessageRequest $request) {
		if (Auth::check()) { // User should be logged in
			// Need to check that user is authorised to submit messages 
			// (so panel member)
			if (Auth::user()->user_id != $user_id) { // Wrong user
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}

			$message = new Message;
			$message->case_id = $case_id;
			$message->user_id = $user_id;
			$message->message = $request->get('message_text');
			$message->save(); // Insert message
			return redirect()
				->intended('home/'.$user_id.'/cases/'.$case_id);
		} else { // User not logged on
			return redirect()->intended('home_no_user_path');
		}
	}

	public function editMessage ($case_id, $user_id, $new_message){
		if (Auth::check()) { // User should be logged in
			if (Auth::user()->user_id != $user_id) { // Wrong user
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			// Code 
			//should run update on DB after first returning existing message (so edit and not rewrite)
		} else { // User not logged on 
			return redirect()->route('home_no_user_path');
		}
	}
	public function deleteMessage($user_id, $case_id) {
		// Check user is either the submitting seeker or a panel member
		if (Auth::check()) { // User should be logged in 
			if (Auth::user()->user_id != $user_id) {
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			// Code 
			//modify view to check that they want to delete
		} else { // User not logged on 
			return redirect()->route('home_no_user_path');
		}
	}
	public function deleteMessageConfirm($user_id, $message_id) {
		// Check user is either the submitting seeker or a panel member
		if (Auth::check()) { // User should be logged in 
			if (Auth::user()->user_id != $user_id) {
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
			// Code 
			// delete operation on DB
		} else { // User not logged on 
			return redirect()->route('home_no_user_path');
		}
	}
	
	/* Functions for viewing cases, 
		both a list of all cases and individual cases */
	public function getCases($user_id) {
	
		if (Auth::check()) { // User should be logged in

			// Check if they are a professional and whatnot
			// Find all notes that are also cases
			if (Auth::user()->professional_id == 1) {
				return redirect()->intended(
					'home/'.Auth::user()->user_id);
			}
		
			$cases = $this->research_notes
						  ->whereExists(function ($query) {
							$query->select('*')
							->from('research_case')
							->whereRaw('research_case.research_note_id 
								= research_notes.research_note_id');
							})
						  ->get(); // Get cases
			$caseInfo = $this->research_cases->all(); // Case info
			$numberOfCases = $this->research_cases->count();
			return view("prototypeone.cases.displaycases", 
				compact('cases', 'numberOfCases', 'caseInfo', 'user_id'));
			
		} else { // user not logged on
			return redirect()->route('home_no_user_path');
		}
	}
	/* Gets individual case and the case's 
		messages and returns a view that displays them */
	public function getCasePage ($user_id, $case_id) {
		// Check user is either the submitting seeker or a panel member
		if (Auth::check()) { // User should be logged in 
			/* Check that the user id is the user who owns 
			this case id and the professionals */
			$panel = $this->professionals->get();
			$owner = $this->research_notes
						  ->find(
						  		$this->research_cases
						  			 ->find($case_id)
						  			 ->research_note_id)
						  ->user_id; 
			if (Auth::user()->user_id != $owner) {
				// We aren't the owner. Check if user is 
				// a profesional
				$valid = false;
				for ($i = 0; $i < $this->professionals->count(); ++$i) {
					$userInfo = $this->users
									 ->where(
									 	"professional_id", "=", 
									 	$panel[$i]->professional_id
									 )
									 ->get()
									 ->first();
					if ($userInfo->user_id == Auth::user()->user_id) {
						$valid = true;
						break;
					}
				}
				if (!$valid) {
					return redirect()->intended(
					'home/'.Auth::user()->user_id);
				}
			}

			// Actual code 
			$research_note = 
				$this->research_notes
					 ->find(
					 	$this->research_cases
					 		 ->find($case_id)
					 		 ->research_note_id
					 );
			$user = 
				$this->users
					 ->find(
					 	$research_note->user_id
					 );
			$messages =
				$this->messages
					 ->where("case_id", "=", $case_id)
					 ->get();
			$images = $this->getPhotos($research_note->research_note_id);		 
			return view("prototypeone.cases.viewcase", 
				compact('research_note', 'user', 'messages', 'case_id', 
					'user_id', 'images'));
		} else { // User not logged on 
			return redirect()->route('home_no_user_path');
		}
	}
	/** Functions for uploading, deleting and viewing photos*/
	/**
	* Uploads a given file to the server
	*/
	private function uploadImages ($user_id, $note) {
		/*photo stuff*/
		//get files
		$image_file_count = count(Input::file('research_images'));
		$images = array(); // Array of images
		
		//validate that they are images
		//rename and move
		//check dir exists and create it if it does not
		if (chdir ("./note_images/")) {
			$directory = $user_id ."/". $note->research_note_id ."/";
			if (!file_exists($directory)) {
				mkdir($directory, 0777, true);//permissions need changing
			}
			
			//to be integrated with other for loop below
			for ($i = 0; $i < $image_file_count; $i++) {
				$filename = Input::file('research_images')[$i]->getClientOriginalName();
				//may have to use Input::file('research_images')->...
				//and change $image_files to a count of the number of elements
				Input::file('research_images')[$i]->move($directory, $filename);
				//DB stuff
				$photo = new Photo;
				$photo->research_note_id = $note->research_note_id;
				// system could change so that this stores only filename and exact path is determined later from note
				$photo->path = $directory."/".$filename;
				$photo->save();
				array_push($images, $photo);
				
			}
		}
		return $images;
	}
	/**
	* Creates an entry in the images table to reference a photo saved on disk.
	* requires that upon saving a note the function to save notes calls this.
	* @require images to be stored on disk in the following system: 
	* 			/public/note_images/{user_id}/{research_note_id}/{filename}
	* @require $path is unique.
	*/
	private function savePhoto ($research_note_id, $path) {
			$photo = new Photo;
			$message->path = $path;
			$message->research_note_id = $research_note_id;
			$message->save(); // Insert message
	}
	/**
	* Removes an entry from the images table (actual deletion 
	* from disk will be done elsewhere)
	*/
	public function deletePhoto ($research_note_id, $path) {
		if (Auth::check()) { // User should be logged in
			
			$photo = $this->$research_photos
					     ->where('path', '=', $path)
						 ->get()
						 -first();
			$photo->delete();
			
		} else { // User not logged on
			return redirect()->intended('home_no_user_path');
		}
	}
	
	/**
	* Returns all photos related to a given research note.
	* The functions that view notes and cases can call this function.
	* and pass the values to the views from there
	*/
	private function getPhotos ($research_note_id) {
		$photos = $this->research_photos
					   ->where('research_note_id', '=', $research_note_id)
					   ->get();
		return $photos;
	}
	
	
	
	
	
	/**
	* Function handling the root register page, 
	* where users are given the option to register as 
	* one of three users
	*/
	public function registerHome () {
		return view("prototypeone.registerHome");
	}
	
	/**
	* Function handling registration of a user
	*/
	public function newAccount (RegisterRequest $request) {
		/* Create Database Instance */
		$user = new User;
		$user->username = $request->get('username');
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = \Hash::make($request->get('password'));
		$user->usertype = $request->get('usertype');
		// Handle different user types
		if (!strcmp("Seeker", $request->get('usertype'))) { // AT Seeker 
			$user->professional_id = 1;
			$user->supplier_id = 1;
			$user->expert_user_id = 1;
		} else if (!strcmp("Professional", $request->get('usertype'))) { 
			// AT Professional
			// Create and save new professional object
			$professional = new Professional;
			$professional->title = $request->get('title');
			$professional->about = $request->get('about');
			$professional->qualifications = $request
									->get('qualifications');
			$professional->save();
			// Set professional id and supplier id of user model
			$user->professional_id = $professional->professional_id;
			$user->supplier_id = 1;
			$user->expert_user_id = 1;
		} else if (!strcmp("Supplier", $request->get('usertype'))) {
			// Create and save new supplier object
			$supplier = new Supplier;
			$supplier->street_number = $request->get('street_number');
			$supplier->street_name = $request->get('street_name');
			$supplier->suburb = $request->get('suburb');
			$supplier->state = $request->get('state');
			$supplier->post_code = $request->get('post_code');
			$supplier->work_phone_number = $request
											->get('work_phone_number');
			$supplier->mobile_phone_number = $request
											->get('mobile_phone_number');
			$supplier->description = $request->get('description');
			$supplier->save();
			// Set supplier id and seeker id of user model
			$user->professional_id = 1;
			$user->supplier_id = $supplier->supplier_id;
			$user->expert_user_id = 1;
		} else if (!strcmp("Expert User", $request->get('usertype'))) {
			// Create and save a new Expert User object
			$expert_user = new ExpertUser;
			$expert_user->qualifications = $request->get('qualifications');
			$expert_user->save();
			$user->professional_id = 1;
			$user->supplier_id = 1;
			$user->expert_user_id = $expert_user->expert_user_id;
		}
		$user->save(); // Finish creating User
		$extrainfo;
		if (!strcmp($user->usertype, 'Seeker')) { // Simple user info
			$extrainfo = null;
		} else if (!strcmp($user->usertype, 'Professional')) { 
			// Professional info
			$extrainfo = $this->professionals
							  ->find($user->professional_id);
		} else if (!strcmp($user->usertype, 'Supplier')) { 
			// Supplier info
			$extrainfo = $this->suppliers->find($user->supplier_id);
		} else if (!strcmp($user->usertype, 'Expert User')) {
			// Expert User info
			$extrainfo = $this->expert_users->find($user->expert_user_id);
		}
		return view("prototypeone.accountapproved", 
			compact('user', 'extrainfo'));
	}

	/**
	* Functions handling three different register forms
	*/
	
	/* AT Seeker register form */
	public function seekerRegister () {
		return view("prototypeone.seekerRegister");
	}
	
	/* AT Professional register form */
	public function professionalRegister () {
		return view("prototypeone.professionalRegister");
	}
	
	/* AT Supplier register form */
	public function supplierRegister () {
		return view("prototypeone.supplierRegister");
	}

	/* AT Expert User register form */
	public function expertUserRegister () {
		return view("prototypeone.expertUserRegister");
	}
	
	/* test function */
	public function pizza () {
		return view("prototypeone.pizza");
	}
	
}
