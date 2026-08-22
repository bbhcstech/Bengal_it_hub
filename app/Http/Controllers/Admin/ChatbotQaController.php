<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotConversation;
use App\Models\ChatbotQa;
use Illuminate\Http\Request;

class ChatbotQaController extends Controller
{
    public function index()
    {
        return view('admin.chatbot.index', [
            'items' => ChatbotQa::orderBy('order')->get(),
            'recentConversations' => ChatbotConversation::latest()->limit(20)->get(),
            'provider' => config('services.chatbot.provider', 'local'),
        ]);
    }

    public function create()
    {
        return view('admin.chatbot.form', ['item' => new ChatbotQa()]);
    }

    public function store(Request $request)
    {
        ChatbotQa::create($this->validated($request));

        return redirect()->route('admin.chatbot.index')->with('status', 'Chatbot Q&A entry created successfully.');
    }

    public function edit(ChatbotQa $chatbot)
    {
        return view('admin.chatbot.form', ['item' => $chatbot]);
    }

    public function update(Request $request, ChatbotQa $chatbot)
    {
        $chatbot->update($this->validated($request));

        return redirect()->route('admin.chatbot.index')->with('status', 'Chatbot Q&A entry updated successfully.');
    }

    public function destroy(ChatbotQa $chatbot)
    {
        $chatbot->delete();

        return back()->with('status', 'Chatbot Q&A entry deleted successfully.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'keywords' => ['required', 'string', 'max:500'],
            'order' => ['nullable', 'integer'],
        ]) + ['is_active' => $request->boolean('is_active')];
    }
}
