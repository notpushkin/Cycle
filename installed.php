<?php
if (!class_exists("Router")) {
  header("Location: ./");
}
?>
<!doctype html>
<!-- The Time Machine GitHub pages theme was designed and developed by Jon Rohan, on Feb 7, 2012. -->
<!-- Follow him for fun. http://twitter.com/jonrohan. Tail his code on http://github.com/jonrohan -->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <link rel="stylesheet" href="assets/stylesheets/stylesheet.css" media="screen"/>
  <link rel="stylesheet" href="assets/stylesheets/pygment_trac.css"/>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="assets/javascripts/script.js"></script>

  <title>Cycle</title>
  <meta name="description" content="Cycle is a simple but powerful, one-class RESTful routing engine for PHP.">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>

  <div class="wrapper">
    <header>
      <h1 class="title">Welcome!</h1>
    </header>
    <div id="container">
      <p class="tagline">Cycle was successfully installed!</p>
      <div id="main" role="main">
        <article class="markdown-body">
          <h2>Getting started</h2>

<ol>
<li><s>Download Cycle from its Github repo.</s></li>
<li>Delete <code>installed.php</code> file and <code>assets/</code>directory.</li>
<li>Add some routes to <code>index.php</code> file.</li>
<li>You're done!</li>
</ol><h2>Example</h2>

<p>This is an example of how routes can be set up. </p>
<div class="highlight">
<pre><span class="cp">&lt;?php</span>
<span class="k">require</span> <span class="s1">'include/Router.php'</span><span class="p">;</span>

<span class="nv">$r</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Router</span><span class="p">;</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s2">"/"</span><span class="p">,</span> <span class="k">function</span><span class="p">(</span><span class="nv">$p</span><span class="p">)</span> <span class="p">{</span>
  <span class="k">echo</span> <span class="s2">"Welcome to our RESTful API!"</span><span class="p">;</span>
<span class="p">});</span>

<span class="c1">// Classic HTTP requests</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">get</span><span class="p">(</span><span class="s2">"/books/:id.:format"</span><span class="p">,</span> <span class="k">function</span><span class="p">(</span><span class="nv">$p</span><span class="p">)</span> <span class="k">use</span><span class="p">(</span><span class="nv">$tpl</span><span class="p">){</span>
  <span class="k">echo</span> <span class="nx">encode_array</span><span class="p">(</span><span class="nx">get_book</span><span class="p">(</span><span class="nv">$p</span><span class="p">[</span><span class="s1">'id'</span><span class="p">]),</span> <span class="nv">$p</span><span class="p">[</span><span class="s1">'format'</span><span class="p">]);</span>
<span class="p">});</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">post</span><span class="p">(</span><span class="s2">"/books"</span><span class="p">,</span> <span class="k">function</span><span class="p">(</span><span class="nv">$p</span><span class="p">)</span> <span class="k">use</span><span class="p">(</span><span class="nv">$tpl</span><span class="p">){</span>
  <span class="k">echo</span> <span class="s2">"Created a new book"</span><span class="p">;</span>
<span class="p">});</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">put</span><span class="p">(</span><span class="s2">"/books/:id"</span><span class="p">,</span> <span class="k">function</span><span class="p">(</span><span class="nv">$p</span><span class="p">)</span> <span class="k">use</span><span class="p">(</span><span class="nv">$tpl</span><span class="p">){</span>
  <span class="k">echo</span> <span class="s2">"Book was successfully replaced"</span><span class="p">;</span>
<span class="p">});</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">delete</span><span class="p">(</span><span class="s2">"/books/:id"</span><span class="p">,</span> <span class="k">function</span><span class="p">(</span><span class="nv">$p</span><span class="p">)</span> <span class="k">use</span><span class="p">(</span><span class="nv">$tpl</span><span class="p">){</span>
  <span class="k">echo</span> <span class="s2">"There is no more book with id 1"</span><span class="p">;</span>
<span class="p">});</span>

<span class="c1">// Custom methods (maybe use it in WebDAV etc.)</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">addRoute</span><span class="p">(</span><span class="s2">"/books"</span><span class="p">,</span> <span class="k">function</span><span class="p">(</span><span class="nv">$p</span><span class="p">)</span> <span class="p">{</span>
  <span class="k">echo</span> <span class="s2">"Some FOO request performed"</span><span class="p">;</span>
<span class="p">},</span> <span class="s2">"FOO"</span><span class="p">);</span>

<span class="nv">$r</span><span class="o">-&gt;</span><span class="na">run</span><span class="p">();</span>
</pre>
</div>

        </article>
      </div>
    </div>
    <footer>
      <div class="owner">
      <p><a href="https://github.com/pooh110andco" class="avatar"><img src="https://secure.gravatar.com/avatar/e1dd6b968d35671a4843cb3ff2d89bae?s=48&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-140.png" width="48" height="48"/></a> <a href="https://github.com/pooh110andco">Ale110</a> maintains <a href="https://github.com/pooh110andco/Cycle">Cycle</a></p>


      </div>
      <div class="creds">
        <small>This page generated using <a href="https://pages.github.com/">GitHub Pages</a><br/>theme by <a href="http://twitter.com/jonrohan/">Jon Rohan</a></small>
      </div>
    </footer>
  </div>
  <div class="current-section">
    <a href="#top">Scroll to top</a>
    <p class="name"></p>
  </div>

  
</body>
</html>
