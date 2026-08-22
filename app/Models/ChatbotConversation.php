<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotConversation extends Model
{
    protected $fillable = ['session_id', 'user_message', 'bot_reply', 'ip_address'];
}
