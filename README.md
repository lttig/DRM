<h1>Clearkey DRM<br /></h1>
Steps<br />
1. Build the container<br />
> sudo docker build -t my-drm .<br /><br />
2. Run the container<br />
> sudo docker run -dit --name my-running-drm -p 8080:80 my-drm<br /><br />
3. Upload .mp4 video (less then 256MB).<br />
> http://localhost:8080/index.php<br /><br />
4. Encrypt package and generate stream.mpd<br />
> http://localhost:8080/package.php<br />
> Content id : 1<br />
> Key : hyN9IKGfWKdAwFaE5pm0qg<br />
> Key ID : oW5AK5BW43HzbTSKpiu3SQ<br /><br />
5. Obtain the necessary data from a completed packaging task<br />
> http://localhost:8080/packaged_content/55<br /><br />
6. Play video<br />
> http://localhost:8080/play.php<br /><br />
