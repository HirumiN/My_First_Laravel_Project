<h2>
    {{ $post->title }}
</h2>

<p>
    Congrats! Your article uploaded in our website.
</p>

<p>
    <a href="{{ url('/posts/' . $post->slug) }}">View Your Post</a>
</p>
