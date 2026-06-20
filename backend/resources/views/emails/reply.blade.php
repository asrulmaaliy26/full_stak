<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $replySubject }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #004d40; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>TPQ Al Hidayah</h2>
        </div>
        <div class="content">
            {!! nl2br(e($replyContent)) !!}
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} TPQ Al Hidayah. All rights reserved.</p>
            <p>Jl. KH. Hasyim Asy'ari 52 Gg 3, Desa Kauman, Kec. Kauman, Kab. Tulungagung.</p>
        </div>
    </div>
</body>
</html>
