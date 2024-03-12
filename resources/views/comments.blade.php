<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .comment-box {
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #007BFF;
            background-color: #e9ecef;
        }
        .comment-box:last-child {
            margin-bottom: 0;
        }
        .comment-content {
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .comment-author {
            font-weight: bold;
            color: #007BFF;
        }
        .comment-meta {
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Comentarios</h1>
        @foreach ($comments as $comment)
            <div class="comment-box">
                <div class="comment-content">{{ $comment['comment'] }}</div>
                <div class="comment-author">{{ $comment['data']['CUSER_NAME'] ?? 'Anónimo' }}</div>
                <div class="comment-meta">Publicado el {{ date('d/m/Y H:i', strtotime($comment['created_at'])) }}</div>
            </div>
        @endforeach
    </div>
</body>
</html>
