<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .quote { border-left: 4px solid #ddd; padding-left: 10px; color: #666; font-style: italic; background-color: #f9f9f9; padding: 10px; border-radius: 4px; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #888; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <p>Halo <strong>{{ $originalMessage->name }}</strong>,</p>
        
        <p>{!! nl2br(e($replyMessage)) !!}</p>
        
        <br>
        <p>Salam,</p>
        <p><strong>Tim {{ \App\Models\Setting::get('site_name', 'WebCMS') }}</strong></p>
        
        <div class="footer">
            <p>--- Pesan Asli Sebelumnya ---</p>
            <div class="quote">
                <strong>Dari:</strong> {{ $originalMessage->name }} ({{ $originalMessage->email }})<br>
                <strong>Tanggal:</strong> {{ $originalMessage->created_at->format('d M Y H:i') }}<br><br>
                {!! nl2br(e($originalMessage->message)) !!}
            </div>
        </div>
    </div>
</body>
</html>
