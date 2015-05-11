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
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;

class PrototypeOneController extends Controller {

	private $users; // Eloquent model of user table
	private $research_notes; // Eloquent model of research note table
	private $professionals; // Eloquent model of professionals table
	private $suppliers; // Eloquent model of suppliers table
	private $research_cases;// Eloquent model of research cases table
	private $messages; // Eloquent model of case messages
	private $expert_users; // Eloquent model of expert users
	
	public function __construct (User $users, ResearchNote $research_notes, 
								Professional $professionals, 
								Supplier $suppliers, Message $messages,
								ResearchCase $cases, 
								ExpertUser $expert_users) {
		$this->users = $users;
		$this->research_notes = $research_notes;
		$this->professionals = $professionals;
		$this->suppliers = $suppliers;
		$this->research_cases = $cases;
		$this->messages = $messages;
		$this->expert_users = $expert_users;
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
			$user = Auth::user(); // Get user info
			// Authentication succeeded
			return redirect()->intended('home/'.$user->user_id);
		} else {
			// Authentication Failed
			// Create a message bag containing all the errors
			$autherrors = new MessageBag([
				'loginFailed' => ['Username and/or password invalid']]);
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
						 ->where('research_note_id', 
						 	'=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			return view("prototypeone.viewnote", 
				compact('note'), compact('user'));
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
	public function createNoteCheck (CreateNoteRequest $request, $user_id) {
		/* Create Database Instance */
		$note = new ResearchNote; /* Create New Database Instance */
		$user = Auth::user(); // Current User
		$note->user_id = $user->user_id; // Set User Id
		$note->title = $request->get('title');
		$note->research_text = $request->get('research_text');
		/* Set Slug */
		$slugcontainer = str_slug($request->get('title'), "-");
		$note->slug = $slugcontainer;
		$note->save(); // Finish creating Note
		return view("prototypeone.newnoteapproved", 
			compact('user'), compact('note'));
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
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', 
						 	'=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			return view("prototypeone.editnote", 
				compact('user'), compact('note'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function checking the edit of a research note
	*/
	public function editNoteCheck (CreateNoteRequest $request, 
		$user_id, $research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
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
			return view("prototypeone.editnoteapproved", 
				compact('user'), compact('note'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling deleting a research note
	*/
	public function deleteNote ($user_id, 
		$research_note_id) {
		if (Auth::check()) { // User should be logged in
			$user = Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', 
						 	'=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			return view("prototypeone.deletenoteconfirm", 
				compact('user'), compact('note'));
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
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', 
						 	'=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			// Delete the note
			$note->delete();
			return redirect()->intended('home/'.$user->user_id);
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	//PANEL AND CASE FUNCTIONS
	/*Functions for Research Cases*/	
	public function submitCase ($user_id, $research_id) {
		return "Case submitted";
	}
	public function submitCaseConfirm ($user_id) {
		//dont need to check wether they said yes 
		//or not as yes calls this and no just goes back to the page	
	}
	public function changeCaseStatus ($user_id, $case_id, $status){}
	
	/*Functions for case messages*/
	public function submitMessage ($case_id, $user_id, $message) {}
	public function editMessage ($case_id, $user_id, $new_message){}
	public function deleteMessage($user_id, $case_id) {
		//check user is either the submitting seeker or a panel member
	}
	public function deleteMessageConfirm($user_id, $case_id) {}
	// display all messages attaced to given case
	public function getMessages ( $case_id, $user_id) {}
	
	/*functions for viewing cases, both a list of all cases and individual cases*/
	public function getCases($user_id) {}
	//gets individual case and the case's messages and returns a view that displays them
	public function getCasePage ($user_id, $case_id) {}
	
	
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
			$professional->qualifications = 
				$request->get('qualifications');
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
			$supplier->work_phone_number = 
				$request->get('work_phone_number');
			$supplier->mobile_phone_number = 
				$request->get('mobile_phone_number');
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
			$extrainfo = 
				$this->professionals
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
