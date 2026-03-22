<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Setting;
use App\Mail\ReplyMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'reply_message' => 'required|string',
        ]);

        $host = Setting::get('smtp_host');
        if (empty($host)) {
            return back()->with('error', 'Konfigurasi SMTP belum diatur. Silakan atur di menu Pengaturan terlebih dahulu.');
        }

        config([
            'mail.mailers.smtp.host' => $host,
            'mail.mailers.smtp.port' => Setting::get('smtp_port'),
            'mail.mailers.smtp.encryption' => Setting::get('smtp_encryption') ?: null,
            'mail.mailers.smtp.username' => Setting::get('smtp_username'),
            'mail.mailers.smtp.password' => Setting::get('smtp_password'),
            'mail.from.address' => Setting::get('smtp_from_address'),
            'mail.from.name' => Setting::get('smtp_from_name'),
        ]);

        try {
            Mail::to($message->email)->send(new ReplyMessageMail($message, $request->subject, $request->reply_message));
            $message->update(['replied_at' => now()]);
            return back()->with('success', 'Balasan berhasil dikirim ke ' . $message->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
