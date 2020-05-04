<h3>Clearkey DRM</h3>
<h4>Steps</h4>
1. Build the container<br />
<pre><code>sudo docker build -t my-drm .</code></pre>
2. Run the container<br />
<pre><code>sudo docker run -dit --name my-running-drm -p 8080:80 my-drm</code></pre>
3. Upload .mp4 video (less then 256MB).<br />
<pre><code>http://localhost:8080/index.php</code></pre>
4. Encrypt package and generate stream.mpd<br />
<pre><code>http://localhost:8080/package.php<br />
Content id : 1<br />
Key : hyN9IKGfWKdAwFaE5pm0qg<br />
Key ID : oW5AK5BW43HzbTSKpiu3SQ</code></pre>
5. Obtain the necessary data from a completed packaging task<br />
<pre><code>http://localhost:8080/packaged_content/55</code></pre>
6. Play video<br /> (tested with Firefox 75.0 (64-bit))
<pre><code>http://localhost:8080/play.php</code></pre>
<h4>Bibliography</h4><br />
https://github.com/Dash-Industry-Forum/dash.js/wiki/Generate-MPEG-DASH-content-encrypted-with-MPEG-CENC-ClearKey
