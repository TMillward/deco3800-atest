<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\ResearchNote;
use App\Professional;
use App\Supplier;
use Illuminate\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;

class PrototypeOneController extends Controller {

	private $users; // Eloquent model of user table
	private $research_notes; // Eloquent model of research note table
	private $professionals; // Eloquent model of professionals table
	private $suppliers; // Eloquent model of suppliers table
	
	public function __construct (User $users, ResearchNote $research_notes, 
								Professional $professionals, 
								Supplier $suppliers) {
		$this->users = $users;
		$this->research_notes = $research_notes;
		$this->professionals = $professionals;
		$this->suppliers = $suppliers;
	}

	/*
	* Index function for home public root page
	*/
	public function index () {
		return view("prototypeone.index");
		//return "Welcome to Sprint Zero Prototype";
	}
	
	/**
	* Function dealing with the about page
	*/
	public function about () {
		return view("prototypeone.about");
		//return "This is the prototype for the Sprint Zero presentation";
	}
	
	/**
	* Function handling login
	*/
	public function login (LoginRequest $request) {
		$userinfo = array(
			'username' => $request->get('username'),
			'password' => $request->get('password')
		); // User Input
		if (\Auth::attempt($userinfo)) {
			// Get user info
			$user = \Auth::user();
			return redirect()->intended('home/'.$user->user_id); // Authentication Succeeded
		} else {
			// Authentication Failed
			// Create a message bag containing all the errors
			$autherrors = new MessageBag(['loginFailed' => ['Username and/or password invalid']]);
			return redirect()->back()
							 ->withErrors($autherrors);
		}
	}
	
	/**
	* Function handling logout
	*/
	public function logout () {
		\Auth::logout(); // Log user out
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
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$extrainfo; // Extra info for non-standard user
			if (!strcmp($user->usertype, 'Seeker')) { // Simple user info
				$extrainfo = null;
				$research_notes = $this->research_notes
								   ->where('user_id', '=', $user->user_id)
								   ->get(); // Get research notes
				return view('prototypeone.home', compact('user', 'research_notes'));
			} else if (!strcmp($user->usertype, 'Professional')) { // Professional info
				$extrainfo = $this->professionals->find($user->professional_id);
				return view('prototypeone.home', compact('user', 'extrainfo'));
			} else if (!strcmp($user->usertype, 'Supplier')) { // Supplier info
				$extrainfo = $this->suppliers->find($user->supplier_id);
				return view('prototypeone.home', compact('user', 'extrainfo'));
			}
			return view('prototypeone.home', compact('user', 'research_notes'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling viewing a research note
	*/
	public function viewNote ($user_id, $research_note_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			return view("prototypeone.viewnote", compact('note'), compact('user'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling creating a new note
	*/
	public function createNote ($user_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
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
	public function createNoteCheck (CreateNoteRequest $request) {
		/* Create Database Instance */
		$note = new ResearchNote; /* Create New Database Instance */
		$user = \Auth::user(); // Current User
		$note->user_id = $user->user_id; // Set User Id
		$note->title = $request->get('title');
		$note->research_text = $request->get('research_text');
		/* Set Slug */
		$slugcontainer = str_slug($request->get('title'), "-");
		$note->slug = $slugcontainer;
		$note->save(); // Finish creating Note
		return view("prototypeone.newnoteapproved", compact('user'), compact('note'));
	}
	
	/**
	* Function handling editing a research note
	*/
	public function editNote ($user_id, $research_note_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			return view("prototypeone.editnote", compact('user'), compact('note'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function checking the edit of a research note
	*/
	public function editNoteCheck (CreateNoteRequest $request, $user_id, $research_note_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
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
			return view("prototypeone.editnoteapproved", compact('user'), compact('note'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling deleting a research note
	*/
	public function deleteNote ($user_id, $research_note_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			return view("prototypeone.deletenoteconfirm", compact('user'), compact('note'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling actually deleting the research note
	*/
	public function deleteNoteConfirm ($user_id, $research_note_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			$note = $this->research_notes
						 ->where('research_note_id', '=', $research_note_id)
						 ->get()
						 ->first(); // Get note
			// Delete the note
			$note->delete();
			return redirect()->intended('home/'.$user->user_id);
		} else {
			return redirect()->route('home_no_user_path');
		}
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
		} else if (!strcmp("Professional", $request->get('usertype'))) { // AT Professional
			// Create and save new professional object
			$professional = new Professional;
			$professional->title = $request->get('title');
			$professional->about = $request->get('about');
			$professional->qualifications = $request->get('qualifications');
			$professional->save();
			// Set professional id and supplier id of user model
			$user->professional_id = $professional->professional_id;
			$user->supplier_id = 1;
		} else if (!strcmp("Supplier", $request->get('usertype'))) {
			// Create and save new supplier object
			$supplier = new Supplier;
			$supplier->street_number = $request->get('street_number');
			$supplier->street_name = $request->get('street_name');
			$supplier->suburb = $request->get('suburb');
			$supplier->state = $request->get('state');
			$supplier->post_code = $request->get('post_code');
			$supplier->work_phone_number = $request->get('work_phone_number');
			$supplier->mobile_phone_number = $request->get('mobile_phone_number');
			$supplier->description = $request->get('description');
			$supplier->save();
			// Set supplier id and seeker id of user model
			$user->professional_id = 1;
			$user->supplier_id = $supplier->supplier_id;
		}
		$user->save(); // Finish creating User
		$extrainfo;
		if (!strcmp($user->usertype, 'Seeker')) { // Simple user info
			$extrainfo = null;
		} else if (!strcmp($user->usertype, 'Professional')) { // Professional info
			$extrainfo = $this->professionals->find($user->professional_id);
		} else if (!strcmp($user->usertype, 'Supplier')) { // Supplier info
			$extrainfo = $this->suppliers->find($user->supplier_id);
		}
		return view("prototypeone.accountapproved", compact('user', 'extrainfo'));
	}

	/**
	* Functions handling three different login forms
	*/
	
	/* AT Seeker login form */
	public function seekerRegister () {
		return view("prototypeone.seekerRegister");
	}
	
	/* AT Professional login form */
	public function professionalRegister() {
		return view("prototypeone.professionalRegister");
	}
	
	/* AT Supplier login form */
	public function supplierRegister() {
		return view("prototypeone.supplierRegister");
	}
	
	public function pizza () {
		return view("prototypeone.pizza");
	}
	
}
