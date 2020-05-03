Clearkey DRM 
Steps
1. Build the container
sudo docker build -t my-drm .
2. Run the container
sudo docker run -dit --name my-running-drm -p 8080:80 my-drm
3. Upload .mp4 video (less then 256MB).
http://localhost:8080/index.php
4. Encrypt package and generate stream.mpd
http://localhost:8080/package.php
Content id : 1
Key : hyN9IKGfWKdAwFaE5pm0qg
Key ID : oW5AK5BW43HzbTSKpiu3SQ
5. Obtain the necessary data from a completed packaging task
http://localhost:8080/packaged_content/55
6. Play video
http://localhost:8080/play.php
