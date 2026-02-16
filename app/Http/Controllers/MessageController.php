<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get messages where user is either sender or recipient
        $messages = Message::where('sender_id', $user->id)
                         ->orWhere('recipient_id', $user->id)
                         ->with(['sender', 'recipient'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(15);

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recipients = User::where('id', '!=', Auth::id())->get();
        return view('messages.create', compact('recipients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:general,billing,technical,compliance,other',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $request->recipient_id,
            'subject' => $request->subject,
            'content' => $request->content,
            'category' => $request->category,
            'status' => 'sent',
        ]);

        return redirect()->route('messages.show', $message->id)->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        // Check if user is sender or recipient
        if ($message->sender_id !== Auth::id() && $message->recipient_id !== Auth::id()) {
            abort(403, 'Unauthorized to view this message');
        }

        // Mark as read if user is recipient
        if ($message->recipient_id === Auth::id() && !$message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }

        $message->load(['sender', 'recipient', 'replies']);
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        if ($message->sender_id !== Auth::id()) {
            abort(403, 'Unauthorized to edit this message');
        }

        $recipients = User::where('id', '!=', Auth::id())->get();
        return view('messages.edit', compact('message', 'recipients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        if ($message->sender_id !== Auth::id()) {
            abort(403, 'Unauthorized to update this message');
        }

        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:general,billing,technical,compliance,other',
        ]);

        $message->update([
            'recipient_id' => $request->recipient_id,
            'subject' => $request->subject,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('messages.show', $message->id)->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        // Allow deletion by either sender or recipient
        if ($message->sender_id !== Auth::id() && $message->recipient_id !== Auth::id()) {
            abort(403, 'Unauthorized to delete this message');
        }

        // For soft delete, we'll mark as deleted by sender/recipient instead of hard deleting
        if ($message->sender_id === Auth::id()) {
            $message->update(['deleted_by_sender' => true]);
        } elseif ($message->recipient_id === Auth::id()) {
            $message->update(['deleted_by_recipient' => true]);
        }

        // If both parties have marked as deleted, then hard delete
        if ($message->deleted_by_sender && $message->deleted_by_recipient) {
            $message->delete();
        }

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }

    /**
     * Reply to a message.
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new message as a reply
        $reply = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $message->sender_id === Auth::id() ? $message->recipient_id : $message->sender_id,
            'parent_id' => $message->id,
            'subject' => 'Re: ' . $message->subject,
            'content' => $request->content,
            'category' => $message->category,
            'status' => 'sent',
        ]);

        return redirect()->route('messages.show', $reply->id)->with('success', 'Reply sent successfully.');
    }

    /**
     * Mark a message as read.
     */
    public function markAsRead(Message $message)
    {
        if ($message->recipient_id === Auth::id()) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }

        return redirect()->back();
    }

    /**
     * Get unread messages count.
     */
    public function unreadCount()
    {
        $count = Message::where('recipient_id', Auth::id())
                       ->where('is_read', false)
                       ->where('deleted_by_recipient', false)
                       ->count();

        return response()->json(['unread_count' => $count]);
    }
}
