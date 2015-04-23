<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\ResearchNote;
use Illuminate\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;

class PrototypeOneController extends Controller {

	private $users; // Eloquent model of user table
	private $research_notes; // Eloquent model of research note table
	
	public function __construct (User $users, ResearchNote $research_notes) {
		$this->users = $users;
		$this->research_notes = $research_notes;
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
			// Create a message bag conaining all the errors
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
	public function homenouser () {
		return view('prototypeone.needlogin');
	}
	
	/**
	* Function handling home page of a user
	*/
	public function homeuser ($user_id) {
		if (\Auth::check()) { // User should be logged in
			$user = \Auth::user(); // Get user
			$research_notes = $this->research_notes
								   ->where('user_id', '=', $user->user_id)
								   ->get(); // Get research notes
			if ($user->user_id != $user_id) { // Wrong user id.
				// Either user is not allowed to access, redirected
				// to their page or they can look at the page but
				// not do anything
				return redirect()->intended('home/'.$user->user_id);
			}
			return view('prototypeone.home', compact('user'), compact('research_notes'));
		} else {
			return redirect()->route('home_no_user_path');
		}
	}
	
	/**
	* Function handling register page
	*/
	public function register () {
		return view("prototypeone.register");
	}
	
	/**
	* Function handling registration of a user
	*/
	public function newaccount (RegisterRequest $request) {
		/* Create Database Instance */
		$user = new User;
		$user->username = $request->get('username');
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = \Hash::make($request->get('password'));
		$user->save(); // Finish creating User
		return view("prototypeone.accountapproved", compact('user'));
	}
	
	/**
	* Function handling viewing a research note
	*/
	public function viewnote ($user_id, $research_note_id) {
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
	public function createnote ($user_id) {
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
	public function createnotecheck (CreateNoteRequest $request) {
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
	public function editnote ($user_id, $research_note_id) {
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
	public function editnotecheck (CreateNoteRequest $request, $user_id, $research_note_id) {
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
	public function deletenote ($user_id, $research_note_id) {
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
	public function deletenoteconfirm ($user_id, $research_note_id) {
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

	public function pizza () {
		return view("prototypeone.pizza");
	}
	
}
