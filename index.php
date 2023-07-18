

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="refresh" content="600">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="icon" type="image/svg+xml" href="/vite.svg" /> -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LPU Cavite Interactive Digital Directory</title>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
    <script src="https://aframe.io/releases/1.4.1/aframe.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
   
   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="./style.css"/>
    

   
  </head>
  
  <body>
    
  <div id="video-container">
    
  <video id="autoplay-video" loop>
    <source src="./videos/tist.webm" type="video/webm">
  </video>

  </div>
    <nav>
      <img class="nav-logo" src="lpulogosana.jpg"onclick="window.location.reload();" />

      <a class="supertitle" onclick="window.location.reload();">LPU CAVITE INTERACTIVE DIGITAL DIRECTORY</a>
      
      <div class="searchicon">
        <!-- <img src="tryse.jpg" width="40px" height="40px" /> -->
      </div>
      <!-- <input type="text" id="search" placeholder="Search...">
	    <button id="voice-search"><i class="fa fa-microphone"></i></button> -->
      
      <div class="nav-btns">
       
         <div class="tooltip">
         <img src="inf.png" style="width: 40px; height: 40px; margin-top: 10px; right: 0; cursor: pointer;" onclick="playVVideo()">
            <span class="tooltiptext">Tutorial Video</span>
          </div>
          
          
       
      </div>
    </nav>
      
    
    
    <div class="wrapper ">
  
  <div class="search-input">
    <a href="" target="_blank" hidden></a>
    <div class="input-container">
      <input type="text" id="search" placeholder="Enter Destination Here..."/>
      <div class="keyboard-container" >
          <div class="keyboard-row">
            <button class="key" onclick="insertCharacter('1')">1</button>
            <button class="key" onclick="insertCharacter('2')">2</button>
            <button class="key" onclick="insertCharacter('3')">3</button>
            <button class="key" onclick="insertCharacter('4')">4</button>
            <button class="key" onclick="insertCharacter('5')">5</button>
            <button class="key" onclick="insertCharacter('6')">6</button>
            <button class="key" onclick="insertCharacter('7')">7</button>
            <button class="key" onclick="insertCharacter('8')">8</button>
            <button class="key" onclick="insertCharacter('9')">9</button>
            <button class="key" onclick="insertCharacter('0')">0</button>
          </div>
          <div class="keyboard-row">
            <button class="key" onclick="insertCharacter('Q')">Q</button>
            <button class="key" onclick="insertCharacter('W')">W</button>
            <button class="key" onclick="insertCharacter('E')">E</button>
            <button class="key" onclick="insertCharacter('R')">R</button>
            <button class="key" onclick="insertCharacter('T')">T</button>
            <button class="key" onclick="insertCharacter('Y')">Y</button>
            <button class="key" onclick="insertCharacter('U')">U</button>
            <button class="key" onclick="insertCharacter('I')">I</button>
            <button class="key" onclick="insertCharacter('O')">O</button>
            <button class="key" onclick="insertCharacter('P')">P</button>
          </div>
          <div class="keyboard-row">
            <button class="key" onclick="insertCharacter('A')">A</button>
            <button class="key" onclick="insertCharacter('S')">S</button>
            <button class="key" onclick="insertCharacter('D')">D</button>
            <button class="key" onclick="insertCharacter('F')">F</button>
            <button class="key" onclick="insertCharacter('G')">G</button>
            <button class="key" onclick="insertCharacter('H')">H</button>
            <button class="key" onclick="insertCharacter('J')">J</button>
            <button class="key" onclick="insertCharacter('K')">K</button>
            <button class="key" onclick="insertCharacter('L')">L</button>
          </div>
          <div class="keyboard-row">
            <button class="key" onclick="insertCharacter('Z')">Z</button>
            <button class="key" onclick="insertCharacter('X')">X</button>
            <button class="key" onclick="insertCharacter('C')">C</button>
            <button class="key" onclick="insertCharacter('V')">V</button>
            <button class="key" onclick="insertCharacter('B')">B</button>
            <button class="key" onclick="insertCharacter('N')">N</button>
            <button class="key" onclick="insertCharacter('M')">M</button>
          </div>
  <div class="keyboard-row">
  <button class="space" onclick="insertSpace()">Space</button>
    <button class="backspace" onclick="deleteCharacter()">Backspace</button>
    <!-- <button class="enter" onclick="executeSearch()">Enter</button> -->
    <!-- <button class="enter" onclick="submitForm()">Enter</button> -->
    
  </div>
  
  <script >

  
function insertCharacter(character) {
  var searchInput = document.getElementById('search');
  var currentValue = searchInput.value;
  var selectionStart = searchInput.selectionStart;
  var selectionEnd = searchInput.selectionEnd;

  // Remove the oninput event listener temporarily
  searchInput.removeEventListener('input', handleInput);

  // Insert the character at the cursor position
  searchInput.value =
    currentValue.slice(0, selectionStart) +
    character +
    currentValue.slice(selectionEnd);

  // Set the new cursor position after the inserted character
  var newCursorPosition = selectionStart + 1;
  searchInput.setSelectionRange(newCursorPosition, newCursorPosition);

  // Trigger the input event after updating the input value
  var inputEvent = new Event('input', { bubbles: true });
  searchInput.dispatchEvent(inputEvent);

  // Reattach the oninput event listener
  searchInput.addEventListener('input', handleInput);

  // Reset the focus on the search input
  searchInput.focus();
}

function insertSpace() {
  var searchInput = document.getElementById("search");
  
  // Append a space character to the input value
  searchInput.value += ' ';
}

function deleteCharacter() {
  var searchInput = document.getElementById("search");
  var currentValue = searchInput.value;
  if (currentValue.length > 0) {
    searchInput.value = currentValue.slice(0, -1);
  }
}

</script>
</div>


     
      <button id="clear-button" onclick="clearSearch()">
        <i class="fas fa-times" style="font-size: 24px;"></i>
      </button>
    </div>
    <div class="autocom-box">
      <div class="icon">
        <i class="fas fa-search"></i>
      </div>
    </div>
  </div>
</div>




   





<div class="vcc">
  <video id="vvids" src="./videos/123.webm"></video>
  <button id="exitButton" onclick="exitVideo()">EXIT</button>
</div>
<script>
        function playVVideo() {
  var vcc = document.querySelector('.vcc');
  vcc.style.visibility = 'visible'; // Show the video container

  var vvid = document.getElementById('vvids');
  vvid.style.display = 'block'; // Show the video element
  vvid.play(); // Play the video
}

function exitVideo() {
  var vcc = document.querySelector('.vcc');
  vcc.style.visibility = 'hidden'; // Hide the video container

  var vvid = document.getElementById('vvids');
  vvid.style.display = 'none'; // Hide the video element
  vvid.pause(); // Pause the video
}
</script>
<div class="slide-images">
<?php
    $files = scandir("slide");
    $ext = '.jpg';
    foreach ($files as $img) {
        if ( substr_compare($img, $ext, -strlen($ext), strlen($ext)) === 0 ) {
           echo "<div class='img-container'><img src='./slide/$img'></div> ";
        }
      }
?>
</div>
            
            
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     
    $(document).ready(function() {
        const imgContainers = $('.img-container');
        const numImages = imgContainers.length;
        let currentImageIndex = 0;

        function fadeImages() {
            const currentImageContainer = imgContainers.eq(currentImageIndex);

            // Hide all other image containers
            imgContainers.not(currentImageContainer).hide();

            currentImageContainer.fadeIn(1000, function() {
                setTimeout(function() {
                    currentImageContainer.fadeOut(3000, function() {
                        currentImageIndex = (currentImageIndex + 1) % numImages;
                        fadeImages();
                    });
                }, 2000); // Adjust this timeout value as needed
            });
        }

        fadeImages();

        // Click event listener to hide the slider image container
        $(document).click(function() {
            $('.slide-images').hide();
        });

        // Show/hide the img-container based on the visibility of the dashboard
        $('#btn-search-history, #btn-charts').click(function() {
            if ($('#dashboard').is(':visible')) {
                $('.slide-images').hide();
            } else {
                $('.slide-images').show();
            }
        });

        // Hide the img-container initially if the dashboard is visible
        if ($('#dashboard').is(':visible')) {
            $('.slide-images').hide();
        }
    });
</script>

    <div class="mains-content">
      <div class="product-info" id="product-info"></div>
    </div>
    
    <div id="dashboard" class="<?php if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] != "admin") { echo 'hide-el'; } ?>">
      <h2>Search History</h2>
      <h3>Number of Searches of the Day</h3>
      <h4>Top 5 Most Searched Locations</h4>
      

      <ul id="search-history"></ul>

      <div id="search-history-chart-wrapper">
        <div class="chart-line-container"><canvas id="chart-line"></canvas></div>
        <div class="chart-pie-container"><canvas id="chart-pie"></canvas></div>
      </div>

      <div class="dashboard-btns">
        <button id="clear-storage" class="btn-primary">Clear Storage</button>
        <button id="btn-search-history" class="btn-primary">Search History</button>
        <button id="btn-charts" class="btn-primary">Charts</button >
        <a class="btn-primary" href="login/login-system/register_form.php" style="margin-left: 0px; display: none;">Register now</a>
        <!-- <button id="homes" onclick="location.reload()">Home</button> -->
      </div>
    </div>
    
   
    <main id="main-content">
      <div class="info">
        <!-- <div class="redbox"></div> -->
        <img class="infoimg"/>
        
        <div style="display: flex; flex-direction: column; width: 100%;">
            <div style="height: 100%; padding-bottom: auto;">
              <h3 class="infoTitle">title</h3>
              <h5 class="infoLocation">title</h5>
              <h6 class="infoContact">title</h6>
              <p class="infoDesc">description</p>
              
            </div>
            <div class="toggless" style="margin-left: auto;">  
              <img src="way.png" style="width: 12px; height: 15px;">
              SHOW WAYFINDING
            </div>

        </div>
      </div>
      <!-- <iframe src = "https://3dwarehouse.sketchup.com/embed/968ac0b6-c148-4ba5-a6ba-dd1f709bc3eb?token=kAL24ZtZBGQ=&binaryName=s21">
      </iframe> 
      
      <iframe class="schoolmap" src="https://3dwarehouse.sketchup.com/embed/a674d174-3a3f-4ade-a983-4da63e28c6b9?token=ahV023P4fLg=&binaryName=s21" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="580" height="326" allowfullscreen>
      </iframe>
      
      <video class="blender" width="80%" height="80%" loop muted autoplay="autoplay" src="/wayfindvids/j1try.webm" type="video/webm">
      </video> -->

      <div id="models-info-container">
        <div id="models-container">
          <!-- <div id="renderer-container"></div> --> 
          <!-- <a-scene embedded class="vid-360-container" vr-mode-ui="enabled: false"  >
            <a-assets> -->
          <video id="infoVideo"  autoplay='false'></video>
          <div class="replayBtn"  style="position: absolute; left: 10px; bottom: 20px;" >  
            <img src="rep.png" style="width: 15px; height: 15px;">
            REPLAY
          </div>
        
              
            <!-- </a-assets>
            <a-videosphere src="#infoVideo" rotation="0 260 0"></a-videosphere>
          </a-scene> -->
        <!-- <script>
          var video = document.getElementById('infoVideo');

            video.addEventListener('ended', function() {
            video.currentTime = 0;
            video.play();
            }, false);
        </script>
            -->
          

          <!-- <div class="reset-camera" style="position: absolute; right: 10px; bottom: 80px;">  
            RESET CAMERA
          </div> -->
          <div class="toggles"  style="position: absolute; right: 10px; bottom: 20px;">  
            <img src="inf.png" style="width: 15px; height: 15px;">
            SHOW INFO
          </div>
          <div class="toggler" style="position: absolute; right: 10px; bottom: 20px;">
            <img src="360.png" style="width: 20px; height: 12px;">  
            360 VIEW 
          </div>
          <div class="safetybtn"  style="position: absolute; right: -80px; bottom: 20px;">  
            <img src="saft.png" style="width: 15px; height: 15px;">
            SAFETY
          </div>
          <div button id="x1btn"  style="position: absolute; left: 24%; bottom: 20px;">  
            <img src="1p.png" style="width: 15px; height: 15px;">
            x1 SPEED
          </div>
          <div button id="x2btn"  style="position: absolute; left: 36%; bottom: 20px;">  
            <img src="2p.png" style="width: 15px; height: 15px;">
            x2 SPEED
          </div>
          <div button id="x4btn"  style="position: absolute; left: 48%; bottom: 20px;">  
            <img src="2p.png" style="width: 15px; height: 15px;">
            x4 SPEED
          </div>
          <div button id="playPauseBtn"  style="position: absolute; left: 12%; bottom: 20px;">  
            <!-- <img src="2p.png" style="width: 15px; height: 15px;"> -->
            
          </div>
          
        </div>

        <div id="modelsinfo">
          <div class="navbar"><a href="#">NAVIGATION</a></div>
          
          <div class="time">
            <div class="from"><img src="bcirc.jpg" width="40px" height="40px" /></div>
            <h6 class="infoFrom" >From: LPU Cavite Main Entrance</h6>
            
            <div class="to"><img src="3dot.jpg" width="40px" height="40px" /></div>
            <p class="infoTo">title</p>
            <div class="taym"><img src="loc.jpg" width="30px" height="40px" /></div>
            <div class="estime"><img src="time.jpg" width="40px" height="40px" /></div>
            <p class="infoTime">title</p>
            
          </div>
          
              

              <div id="infoValoContainer">
              <div class="border">
                <d href="#">EAGLE EYE VIEW</d>
              </div>
                <video id="infoValo" autoplay muted></video>
              </div>
              
          
        </div>
      </div>
          

      <div id="models-safety">
          <div id="modelssafe">
            
            <img class="safepre"/>
                <div class="backway"  style="position: absolute; right: 10px; bottom: 20px;">  
                  <img src="way.png" style="width: 12px; height: 15px;">
                  SHOW WAYFINDING
                </div>
          </div>     
          
          
        

          <div id="safeinfo">
            <div class="safebar"><a href="#">LEGEND</a></div>
            
            
            <div class="fi"><img src="yellowish.png" width="40px" height="40px" /></div>
              <p class="redarrow" >RED ARROW - Fire Exit</p>
              
              <div class="fe"><img src="fe.png" width="40px" height="40px" /></div>
              <p class="yellowcircle">YELLOW CIRCLE - Fire Extinguisher</p>
              
              
      </div>
      

      <div id="modeler">
        <div class="navbar360"><a href="#">360 VIEW</a></div>

        <a-scene embedded class="vid-360-container" vr-mode-ui="enabled: false" >
          <a-sky id="picikot" rotation="0 260 0"></a-sky>
          <!-- <script>
              const sky = document.querySelector("#picikot")

              // Save the initial rotation of the panorama
              const initialRotation = "0 260 0"
              sky.setAttribute("rotation", initialRotation)
              console.log("Test 360")
          </script> -->
        </a-scene >

        <div class="togglr" style="position: absolute; right: 10px; bottom: 20px;" >  
          <img src="way.png" style="width: 12px; height: 15px;">
          SHOW WAYFINDING
        </div>
      </div>
    </div>
  </main>
  
  <script type="module" src="js/main.js"></script>
  <!-- <script type="module" src="js/three.js"></script> -->
  <script>
    const infoVideo = document.getElementById("infoVideo");
    const valer = document.getElementById("infoValo");
    const replayBtn = document.querySelector(".replayBtn");
    

    infoVideo.addEventListener("ended", function() {
      replayBtn.style.display = "block";
    });

    replayBtn.addEventListener("click", function() {
      replayBtn.style.display = "visible";
      infoVideo.currentTime = 0;
      valer.currentTime = 0;
      infoVideo.playbackRate = 1.0;
      valer.playbackRate = 1.0;
      infoVideo.play();
      valer.play();
    });

    const btnX2 = document.getElementById('x2btn');
    const btnX1 = document.getElementById('x1btn');
    const btnX4 = document.getElementById('x4btn');

    btnX2.addEventListener('click', () => {
      infoVideo.playbackRate = 2.0;
      valer.playbackRate = 2.0;
    });

    btnX1.addEventListener('click', () => {
      infoVideo.playbackRate = 1.0;
      valer.playbackRate = 1.0;
    });
    btnX4.addEventListener('click', () => {
      infoVideo.playbackRate = 4.0;
      valer.playbackRate = 4.0;
    });
    const playPauseBtn = document.getElementById("playPauseBtn");
      const playIcon = document.createElement("img");
      const pauseIcon = document.createElement("img");
      const textSpan = document.createElement("span");

      playIcon.src = "./img/plays.png";
      playIcon.width = 20;
      playIcon.height = 20;
      playIcon.style.display = "block";

      pauseIcon.src = "./img/paus.png";
      pauseIcon.width = 20;
      pauseIcon.height = 20;
      pauseIcon.style.display = "none";

      textSpan.style.marginLeft = "5px";
      textSpan.textContent = "PAUSE";

      playPauseBtn.appendChild(pauseIcon);
      playPauseBtn.appendChild(playIcon);
      playPauseBtn.appendChild(textSpan);

      infoVideo.isPlaying = false;
      valer.isPlaying = false;

      playPauseBtn.addEventListener("click", function() {
        if (infoVideo.paused) {
          infoVideo.play();
          valer.play();
          infoVideo.isPlaying = true;
          valer.isPlaying = true;
          pauseIcon.style.display = "none";
          playIcon.style.display = "block";
          textSpan.textContent = "PAUSE";
        } else {
          infoVideo.pause();
          valer.pause();
          infoVideo.isPlaying = false;
          valer.isPlaying = false;
          playIcon.style.display = "none";
          pauseIcon.style.display = "block";
          if (infoVideo.isPlaying || valer.isPlaying) {
            textSpan.textContent = "PAUSE";
          } else {
            textSpan.textContent = "PLAY";
          }
        }
      });

      const infofo = document.querySelector(".info");
    const infot = document.querySelector(".infoTitle");
    const infoi = document.querySelector(".infoimg");
    const infod = document.querySelector(".infoDesc");
    const inloc = document.getElementById('.infoLocation');
    const modelsinfo = document.querySelector("#modelsinfo");
    const modelscont = document.querySelector("#models-container");
    const modelers = document.querySelector("#modeler");
    const modelsafe = document.querySelector("#modelssafe");
    const safeinfos = document.querySelector("#safeinfo");
    const dashboards = document.getElementById("dashboard")
    // const btns = document.querySelectorAll(".toggles")
    const btntoggles = document.querySelector(".toggles");
    const btntoggless = document.querySelector(".toggless");
    const btntoggler = document.querySelector(".toggler");
    const btntogglr = document.querySelector(".togglr");
    const btnback = document.querySelector(".backway");
    const btnsafe = document.querySelector(".safetybtn");
    const video = document.getElementById('infoVideo');
    const valoVideo = document.getElementById('infoValo');
    
    const infrom = document.getElementById('.infoFrom');
    const red = document.querySelector('.redbox');
    const logs = document.querySelectorAll(".login-button")
    
    btntoggles.addEventListener("click", () => {
      infofo.classList.toggle("growanimater")
      infoi.classList.toggle("growanimater")
      infot.classList.toggle("fadeinn")
      infod.classList.toggle("fadeinn")
      
      modelsinfo.classList.toggle("animaters")
      modelscont.classList.toggle("growanimater")
      // red.classList.toggle("stret")
      
      
      

      video.pause();
      valoVideo.pause();
      
      
    });
    
    btntoggler.addEventListener("click", () => {
      modelers.classList.toggle("growanimater")
      video.pause();
      valoVideo.pause();
    });
    btnsafe.addEventListener("click", () => {
      modelsafe.classList.toggle("growanimater")
      safeinfos.classList.toggle("animaters")
      video.pause();
      valoVideo.pause();
    });
    btntogglr.addEventListener("click", () => {
      modelscont.classList.toggle("growanimater")
      modelsinfo.classList.toggle("animaters")
      
      
      video.playbackRate = 1.0;
      valoVideo.playbackRate = 1.0;
      video.play();
      valoVideo.play();
    });
    btnback.addEventListener("click", () => {
      modelscont.classList.toggle("growanimater")
      modelsinfo.classList.toggle("animaters")
      
      
      video.playbackRate = 1.0;
      valoVideo.playbackRate = 1.0;
      video.play();
      valoVideo.play();
    });


    btntoggless.addEventListener("click", () => {
      
      
      video.playbackRate = 1.0;
      valoVideo.playbackRate = 1.0;

      video.play();
      valoVideo.play();
      infot.classList.toggle("fadeinn")
      infod.classList.toggle("fadeinn")
      
      infofo.classList.toggle("growanimater")
      modelsinfo.classList.toggle("animaters")
      modelscont.classList.toggle("growanimater")

      // red.classList.toggle("stret")
      
      video.currentTime = 0;
      valoVideo.currentTime = 0;

      video.play();
      valoVideo.play();
      
    });
  </script>
  
   
  </body>
</html>
