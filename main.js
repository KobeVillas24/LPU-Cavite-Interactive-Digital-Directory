// import '../style.css'
// import javascriptLogo from '../javascript.svg'
// import { Render } from './three.js'

// function addToggleEvent() {
//     const btns = document.querySelectorAll(".toggle-info")
//     const rendererContainer =  document.querySelector("#renderer-container")

//     Array.from(btns).forEach(btn => {
//         btn.style.display = "block"
//         btn.addEventListener("click", () => {
//             const el = window.getComputedStyle(rendererContainer)
//             if (rendererContainer.style.display === "block") {
//                 rendererContainer.style.display = "none"
//             } else {
//                 rendererContainer.style.display = "block"
//             }
//         })
//     })
// }

// if ("virtualKeyboard" in navigator) {
//   navigator.virtualKeyboard.overlaysContent = true
//   const inputs = document.getElementsByTagName('input')

//   if (inputs) {
//     for (const input of inputs) {
//       input.addEventListener("click", () => {
//         navigator.virtualKeyboard.show()
//       })
//     }
//   }
// }

// getting all required elements
const searchWrapper = document.querySelector(".search-input")
const inputBox = searchWrapper.querySelector("input")
const suggBox = searchWrapper.querySelector(".autocom-box")


const getData = async () => {
    // fetch("../public/data.json")
    fetch("../getData.php")
        .then((res) => res.json())
        .then((data) => {
            console.log(data)
            setupSearch(data)
        })
        .catch((err) => console.error(err))
}
getData()





function setupSearch(data) {

  document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
      const searchInput = document.getElementById("inputBox");
      searchInput.blur();
    }, 0);
  });
    const suggestions = data
    const modelsContainer = document.getElementById("models-info-container")
    const modelsInfo = document.getElementById("models-info")
    const infoDiv = document.getElementById("main-content")
    const timeDiv = document.getElementById("modelsinfo")
    const infoImg = infoDiv.querySelector(".infoimg")
    const infoTitle = infoDiv.querySelector(".infoTitle")
    const infoLocation = infoDiv.querySelector(".infoLocation")
    const infoContact = infoDiv.querySelector(".infoContact")
    const infoTime = timeDiv.querySelector(".infoTime")
    const infoTo = infoDiv.querySelector(".infoTo")
    const infoDesc = infoDiv.querySelector(".infoDesc")
    const infoVideo = document.getElementById("infoVideo")
    const infoValo = document.getElementById("infoValo")
    const modelers = document.getElementById("modeler")
    const ikotpic = document.querySelector(".vid-360-container")
    const ikotlang = document.querySelector(".picikot")
    const modelsafety = document.getElementById("models-safety")
    const safetyImg = document.querySelector(".safepre")

    function select(element){
        const searchHistoryEl = document.getElementById("search-history")
        
        searchWrapper.classList.remove("active")
        
        const place = suggestions.find(p => p.title === element.textContent)
        
        infoImg.src = place.src
        infoTitle.textContent = place.title
        infoTime.textContent = place.time
        infoLocation.textContent = place.location
        infoContact.textContent = place.contact

        infoTo.textContent = place.to_loc
        infoDesc.textContent = place.description
        infoVideo.src = place.video
        infoValo.src = place.valovideo
        inputBox.value = place.title
        ikotpic.src = place.ikott
        safetyImg.src = place.safe

        
        picikot.setAttribute('src', place.ikot);
        safetyImg.setAttribute('src', place.safe);

        
            
        infoDiv.style.visibility = "visible"
        
        modelsContainer.style.visibility = "visible"
        modelers.style.visibility = "hidden"
        modelsafety.style.visibility = "hidden"

        const info = document.getElementsByClassName("info")[0]
        info.style.visibility = "hidden"
        
        modelscont.classList.toggle("growanimater")
        
        modelsinfo.classList.toggle("animaters")

        const ivideo = document.getElementById('infoVideo');
        
        ivideo.play();
        ivideo.playbackRate = 1.0;

        const video = document.getElementById("infoValo");
        video.play();
        video.currentTime = 0;
        video.playbackRate = 1.0;

        infoValo.addEventListener("ended", function() {
          infoValo.pause();
        });
            
        // video.currentTime = 0;
        // videoo.currentTime = 0;
        // video.play();
        // videoo.play()
        // video.currentTime = 0;
        // videoo.currentTime = 0; 
        $('.slide-images').hide();
        const keyboardContainer = document.querySelector('.keyboard-container');
        keyboardContainer.style.display = 'none';

        const selectedLocation = element.textContent;

        logSearchActivity(selectedLocation);

        
        const enterButton = document.querySelector(".enter");
        enterButton.onclick = () => executeSearch();

       

      }

      
      function logSearchActivity(title) {
        fetch("./login/login-system/logSearchActivity.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `title=${encodeURIComponent(title)}`,
        })
        .then((res) => res.text())
        .then((data) => {
            console.log(data);
        })
        .catch((err) => console.error(err));
    }
    
    
  
    
let selectedIndex = -1;
inputBox.focus();

inputBox.addEventListener("input", (event) => {
  const inputText = event.target.value.trim().toLowerCase();
  let filteredSuggestions = [];
  if (inputText) {
    filteredSuggestions = suggestions.filter((data) => {
      const title = data.title.toLowerCase().replace(/\s/g, "");
      const input = inputText.replace(/\s/g, "");
      return title.includes(input);
    });
    filteredSuggestions.sort((titleA, titleB) => {
      const a = titleA.title.toLowerCase();
      const b = titleB.title.toLowerCase();
      const modifiedA = a.replace(/\s/g, "");
      const modifiedB = b.replace(/\s/g, "");
      if (modifiedA.startsWith(inputText) && !modifiedB.startsWith(inputText))
        return -1;
      if (!modifiedA.startsWith(inputText) && modifiedB.startsWith(inputText))
        return 1;
      if (a < b) return -1;
      if (a > b) return 1;
      return 0;
    });
  } else {
    filteredSuggestions = suggestions;
  }
  const allSuggestions = filteredSuggestions.map((data) => {
    return `<li class="searchitem">${data.title}</li>`;
  });
  showSuggestions(allSuggestions);
  searchWrapper.classList.add("active");
  const searchItems = suggBox.querySelectorAll("li");
  searchItems.forEach((element) => {
    element.onclick = () => select(element);
  });
  emptyArray = []; // reset emptyArray to an empty array
});

inputBox.addEventListener("keydown", (event) => {
  const searchItems = suggBox.querySelectorAll("li");
  const totalItems = searchItems.length;

  if (event.key === "ArrowDown") {
    event.preventDefault(); // Prevent scrolling of the page
    selectedIndex = (selectedIndex + 1) % totalItems;
    highlightSuggestion(searchItems);
  } else if (event.key === "ArrowUp") {
    event.preventDefault(); // Prevent scrolling of the page
    selectedIndex = (selectedIndex - 1 + totalItems) % totalItems;
    highlightSuggestion(searchItems);
  } else if (event.key === "Enter") {
    event.preventDefault(); // Prevent form submission
    const selectedSuggestion = suggBox.querySelector(".selected");
    if (selectedSuggestion) {
      select(selectedSuggestion);
    }
  }
});

inputBox.onclick = () => {
  const inputText = inputBox.value.trim().toLowerCase();
  let filteredSuggestions = [];
  if (inputText) {
    filteredSuggestions = suggestions.filter((data) => {
      const title = data.title.toLowerCase().replace(/\s/g, "");
      const input = inputText.replace(/\s/g, "");
      return title.includes(input);
    });
    filteredSuggestions.sort((titleA, titleB) => {
      const a = titleA.title.toLowerCase();
      const b = titleB.title.toLowerCase();
      const modifiedA = a.replace(/\s/g, "");
      const modifiedB = b.replace(/\s/g, "");
      if (modifiedA.startsWith(inputText) && !modifiedB.startsWith(inputText))
        return -1;
      if (!modifiedA.startsWith(inputText) && modifiedB.startsWith(inputText))
        return 1;
      if (a < b) return -1;
      if (a > b) return 1;
      return 0;
    });
  } else {
    filteredSuggestions = suggestions;
  }
  const allSuggestions = filteredSuggestions.map((data) => {
    return `<li class="searchitem">${data.title}</li>`;
  });
  showSuggestions(allSuggestions);
  searchWrapper.classList.add("active");
  const searchItems = suggBox.querySelectorAll("li");
  searchItems.forEach((element) => {
    element.onclick = () => select(element);
  });
  emptyArray = []; // reset emptyArray to an empty array
};

document.addEventListener("click", (event) => {
  const isClickInside = searchWrapper.contains(event.target);
  if (!isClickInside) {
    searchWrapper.classList.remove("active");
    suggBox.innerHTML = "";
    emptyArray = [];
  }
});

function showSuggestions(list) {
  if (!list.length) searchWrapper.classList.remove("active");
  suggBox.innerHTML = list.join("");
}

function highlightSuggestion(searchItems) {
  searchItems.forEach((element, index) => {
    if (index === selectedIndex) {
      element.classList.add("selected");
      element.scrollIntoView({ behavior: "smooth", block: "nearest" });
    } else {
      element.classList.remove("selected");
    }
  });
}
    

const clearButton = document.getElementById("clear-button");
clearButton.addEventListener("click", clearSearch);

function clearSearch() {
  inputBox.value = ""; // Clear the input text
  searchWrapper.classList.remove("active"); // Hide the search suggestions
  suggBox.innerHTML = ""; // Clear the suggestion box
  emptyArray = []; // Reset emptyArray to an empty array
  selectedIndex = -1; // Reset selectedIndex to -1
}


}


const btns = document.querySelectorAll(".toggles")
// const btns = document.querySelectorAll(".toggles")
const btntoggles = document.querySelector(".toggles");

const btntoggless = document.querySelector(".toggless");

// const resetCameraBtn = document.querySelector(".reset-camera")

Array.from(btns).forEach(btn => {
    btn.addEventListener("click", () => {
        const modelsContainer = document.getElementById("models-info-container")
        
       
       
       
        if (modelsContainer.style.visibility === "visible") {
            modelsContainer.style.visibility = "hidden"
        } else {
            modelsContainer.style.visibility = "visible"
        }
        const info = document.getElementsByClassName("info")[0]
        if (info.style.visibility === "visible") {
   
        } else {
            info.style.visibility = "visible" 
        }
        // const modelsInfo = document.getElementById("models-info")
        // if (modelsInfo.style.visibility === "visible") {
        //     modelsInfo.style.visibility = "hidden"
        // } else {
        //     modelsInfo.style.visibility = "visible"
        // }
        

    })
})
const btnss = document.querySelectorAll(".toggless")


Array.from(btnss).forEach(btn => {
    btn.addEventListener("click", () => {
        const modelsContainer = document.getElementById("models-info-container")
     
        if (modelsContainer.style.visibility === "hidden") {
            modelsContainer.style.visibility = "visible"     
        } else {
            modelsContainer.style.visibility = "hidden" 
        }
        const info = document.getElementsByClassName("info")[0]
        if (info.style.visibility === "hidden") {
            info.style.visibility = "visible"   
        } else {
            info.style.visibility = "hidden" 
        }
        // const modelsInfo = document.getElementById("models-info")
        // if (modelsInfo.style.visibility === "visible") {
        //     modelsInfo.style.visibility = "hidden"
        // } else {
        //     modelsInfo.style.visibility = "visible"
        // }
    })
})

const btnr = document.querySelectorAll(".toggler")
Array.from(btnr).forEach(btn => {
    btn.addEventListener("click", () => {
        const modelsContainer = document.getElementById("models-info-container")
        const modelers = document.getElementById("modeler")
     
        if (modelsContainer.style.visibility === "hidden") {
            modelsContainer.style.visibility = "hidden"     
            modelers.style.visibility = "visible"
        } else {
            modelsContainer.style.visibility = "hidden" 
            modelers.style.visibility = "visible"
        }
        const info = document.getElementsByClassName("info")[0]
        if (info.style.visibility === "hidden") {
            info.style.visibility = "hidden"   
            
        } else {
            info.style.visibility = "hidden" 
            
        }

        // const modelsInfo = document.getElementById("models-info")
        // if (modelsInfo.style.visibility === "visible") {
        //     modelsInfo.style.visibility = "hidden"
        // } else {
        //     modelsInfo.style.visibility = "visible"
        // }
    })
})
const btnrr = document.querySelectorAll(".togglr")
Array.from(btnrr).forEach(btn => {
btn.addEventListener("click", () => {
    const modelsContainer = document.getElementById("models-info-container")
    const modelers = document.getElementById("modeler")
 
    if (modelsContainer.style.visibility === "hidden") {
        modelsContainer.style.visibility = "visible"  
        modelers.style.visibility = "hidden"   
    } else {
        modelsContainer.style.visibility = "hidden" 
        modelers.style.visibility = "hidden"
    }
    const info = document.getElementsByClassName("info")[0]
    if (info.style.visibility === "hidden") {
        info.style.visibility = "hidden"   
    } else {
        info.style.visibility = "hidden" 
    }
    // const modelsInfo = document.getElementById("models-info")
    // if (modelsInfo.style.visibility === "visible") {
    //     modelsInfo.style.visibility = "hidden"
    // } else {
    //     modelsInfo.style.visibility = "visible"
    // }
})
})

const btnsafe = document.querySelectorAll(".safetybtn")
Array.from(btnsafe).forEach(btn => {
    btn.addEventListener("click", () => {
        const modelsContainer = document.getElementById("models-info-container")
        const safemodel = document.getElementById("models-safety")
        
    
        if (modelsContainer.style.visibility === "hidden") {
            modelsContainer.style.visibility = "visible"  
            safemodel.style.visibility = "visible"   
        } else {
            modelsContainer.style.visibility = "hidden" 
            safemodel.style.visibility = "visible"
        }
        const info = document.getElementsByClassName("info")[0]
        if (info.style.visibility === "hidden") {
            info.style.visibility = "hidden"   
        } else {
            info.style.visibility = "hidden" 
        }
        // const modelsInfo = document.getElementById("models-info")
        // if (modelsInfo.style.visibility === "visible") {
        //     modelsInfo.style.visibility = "hidden"
        // } else {
        //     modelsInfo.style.visibility = "visible"
        // }
    })
})


const btnw = document.querySelectorAll(".backway")
Array.from(btnw).forEach(btn => {
btn.addEventListener("click", () => {
    const modelsContainer = document.getElementById("models-info-container")
    const safemodel = document.getElementById("models-safety")
 
    if (modelsContainer.style.visibility === "hidden") {
        modelsContainer.style.visibility = "visible"  
        safemodel.style.visibility = "hidden"    
    } else {
        modelsContainer.style.visibility = "hidden" 
        safemodel.style.visibility = "hidden"
    }
    const info = document.getElementsByClassName("info")[0]
    if (info.style.visibility === "hidden") {
        info.style.visibility = "hidden"   
    } else {
        info.style.visibility = "hidden" 
    }
    // const modelsInfo = document.getElementById("models-info")
    // if (modelsInfo.style.visibility === "visible") {
    //     modelsInfo.style.visibility = "hidden"
    // } else {
    //     modelsInfo.style.visibility = "visible"
    // }
})
})









const videoContainer = document.getElementById("video-container");
const video = document.getElementById("autoplay-video");
let videoTimeout;
const timeoutDuration = 120_000; // 1.5 minutes = 90,000 milliseconds

  function startVideoTimeout() {
    videoTimeout = setTimeout(function() {
      videoContainer.style.display = "block";
      video.currentTime = 0;
      video.play();
    }, timeoutDuration);
  }

  function resetVideoTimeout() {
    clearTimeout(videoTimeout);
    video.pause();
    videoContainer.style.display = "none";
    startVideoTimeout();
  }

  function startInteractionTimeout() {
    clearTimeout(videoTimeout);
    resetVideoTimeout();
  }

  video.addEventListener("ended", function() {
    video.currentTime = 0;
    video.play();
    startInteractionTimeout();
  });

  document.addEventListener("mousemove", startInteractionTimeout);
  document.addEventListener("keypress", startInteractionTimeout);

  startVideoTimeout();
 
  document.addEventListener('DOMContentLoaded', function() {
    var inputElement = document.getElementById('search');
    var keyboardContainer = document.querySelector('.keyboard-container');
    var keyboardKeys = keyboardContainer.querySelectorAll('.key');
    var proxyInput = document.createElement('input'); // Create a proxy input element
  
    // Set the proxy input element to be transparent and positioned absolutely
    proxyInput.style.position = 'absolute';
    proxyInput.style.opacity = '0';
    proxyInput.style.pointerEvents = 'none';
  
    // Append the proxy input element to the search wrapper
    inputElement.appendChild(proxyInput);
  
    // Hide the keyboard container on page load
    keyboardContainer.style.display = 'none';
  
    inputElement.addEventListener('click', function() {
      proxyInput.focus(); // Focus on the proxy input element
      keyboardContainer.style.display = 'block'; // Show the keyboard container
    });
  
    inputElement.addEventListener('input', function() {
      var searchValue = inputElement.value.toLowerCase();
      // Logic to update suggestions based on the search value
      updateSuggestions(searchValue);
    });
  
    inputElement.addEventListener('focusout', function(event) {
      // Check if the newly focused element is a key within the keyboard
      if (!keyboardContainer.contains(event.relatedTarget)) {
        keyboardContainer.style.display = 'none';
      }
    });
  
    keyboardKeys.forEach(function(key) {
      key.addEventListener('click', function() {
        var character = this.textContent;
        inputElement.value += character;
        // Trigger the input event after updating the input value
        var inputEvent = new Event('input', { bubbles: true });
        inputElement.dispatchEvent(inputEvent);
      });
    });
  
    proxyInput.addEventListener('input', function() {
      inputElement.value = proxyInput.value; // Update the search input value with the proxy input value
      var searchValue = inputElement.value.toLowerCase();
      // Logic to update suggestions based on the search value
      updateSuggestions(searchValue);
    });
    
    proxyInput.addEventListener('keydown', function(event) {
      if (event.key === 'Backspace') {
        var searchValue = inputElement.value.toLowerCase();
        var newValue = searchValue.slice(0, -1); // Remove the last character
        inputElement.value = newValue;
        proxyInput.value = newValue; // Update the proxy input value
        // Trigger the input event after updating the input value
        var inputEvent = new Event('input', { bubbles: true });
        inputElement.dispatchEvent(inputEvent);
        event.preventDefault(); // Prevent the default backspace behavior
      }
    });
    
  
    // function updateSuggestions(searchValue) {
    //   var suggestions = getMatchingSuggestions(searchValue);
    //   showSuggestions(suggestions);
    // }
  
    // function getMatchingSuggestions(searchValue) {
    //   if (!searchValue) {
    //     return suggestions; 
    //   }
   
    //   return suggestions.filter(function(suggestion) {
    //     return suggestion.title.toLowerCase().includes(searchValue);
    //   });
    // }

    
  });

 

  
