<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationApproveMail;
use App\Mail\ApplicationDeclineMail;


class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => ['exists:jobs,id'],
            // 'user_id' => ['required','exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
        ]);

        $data = [
            'job_id' => $request->job_id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];

        Application::create($data);

        return redirect()->back()->with('success', 'Your application has been submitted!');
    }

    public function index()
    {
        $user = Auth::user();
        $applications = Application::whereHas('job', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['job', 'user'])->get();

        return view('user.myjobs', compact('user', 'applications'));
    }

    public function approve($application_id)
    {
        $application = Application::findOrFail($application_id);

        Mail::to($application->email)->send(new ApplicationApproveMail($application));

        return response()->redirectTo('/users/myjobs')->with('success', 'the application has been approved');
    }

    public function decline($application_id)
    {
        $application = Application::findOrFail($application_id);

        Mail::to($application->email)->send(new ApplicationDeclineMail($application));
        
        return response()->redirectTo('/users/myjobs')->with('success' ,'the application has been declined');
    }
}
