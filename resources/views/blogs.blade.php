<!DOCTYPE html>
<html>
<head>
    <title>Blogs</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
<table style="width:100%">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Author</th>
        <th>Date</th>
        <th>Content</th>
    </tr>
    @foreach($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td>{{$post->extra('description')}}</td>
            <td>{{$post->extra('author')}}</td>
            <td>{{$post->extra('date')}}</td>
            <td>{!! $post->body !!}</td>
        </tr>
    @endforeach
</table>
</body>

</html>
