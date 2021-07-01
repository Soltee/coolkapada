<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    /**
     * Displays the newsletters emails list
     */
    public function  index()
    {
        $emails = Newsletter::latest()->paginate(10);
        // dd(Newsletter::pluck('id')->toArray());
        return view('admin.newsletter.index', compact('emails'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return back()
            ->with('toast_success', 'Email deleted.');
    }
}
