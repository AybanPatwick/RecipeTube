const spoonacularApiKey = 'db1a277431f9432e8cc216cfa20118ff';
  const edamamApiKey = 'a30c31f5d8b607ae5d19d72363b587a6';
  const spoonacularEndpoint = 'https://api.spoonacular.com/recipes/random';
  const edamamEndpoint = 'https://api.edamam.com/search';
  const edamamAppId = '78358b73';
  const appId = '914c916b';
  const appKey = 'c61f08e829636e79374c26259871d01c';

  // Function to fetch nutrition analysis from Edamam API
  async function getNutritionAnalysis(ingredientsList) {
    try {
      const edamamNutritionEndpoint = `https://api.edamam.com/api/nutrition-details?app_id=${appId}&app_key=${appKey}`;

      const requestBody = {
        ingr: ingredientsList
      };

      const response = await fetch(edamamNutritionEndpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestBody)
      });

      const data = await response.json();
      displayNutritionalFacts(data);
    } catch (error) {
      console.error('Error fetching nutrition analysis:', error);
    }
  }

  // Function to display nutritional facts in a table
  function displayNutritionalFacts(nutritionData) {
    const nutritionalFactsTable = document.getElementById('nutritionalFacts');

    // Clear the existing table rows
    nutritionalFactsTable.innerHTML = '';

    if (nutritionData && nutritionData.totalNutrients) {
      // Create table header
      const tableHeader = document.createElement('thead');
      tableHeader.innerHTML = `
        <tr>
          <th>Nutrient</th>
          <th>Amount</th>
          <th>Unit</th>
        </tr>
      `;
      nutritionalFactsTable.appendChild(tableHeader);

      // Create table body initially limited to 3 nutrients
      const tableBody = document.createElement('tbody');
      const nutrientKeys = Object.keys(nutritionData.totalNutrients).slice(0, 3); // Initially limit to 3 nutrients
      nutrientKeys.forEach(key => {
        const nutrient = nutritionData.totalNutrients[key];
        const nutrientRow = document.createElement('tr');
        nutrientRow.innerHTML = `
          <td>${nutrient.label}</td>
          <td>${nutrient.quantity.toFixed(2)}</td>
          <td>${nutrient.unit}</td>
        `;
        tableBody.appendChild(nutrientRow);
      });
      nutritionalFactsTable.appendChild(tableBody);

      if (Object.keys(nutritionData.totalNutrients).length > 3) {
        // Create "Show More" button
        const showMoreButton = document.createElement('button');
        showMoreButton.textContent = 'Show More';
        showMoreButton.addEventListener('click', () => {
          // Show all nutrients when "Show More" button is clicked
          displayAllNutrients(nutritionData);
          showMoreButton.style.display = 'none'; // Hide the button after revealing all nutrients
        });
        nutritionalFactsTable.appendChild(showMoreButton);
      }
    } else {
      // Display a message if no nutritional information is available
      nutritionalFactsTable.innerHTML = `
        <tr>
          <td colspan="3">Nutritional information not available.</td>
        </tr>
      `;
    }
  }

  // Function to display all nutrients
  function displayAllNutrients(nutritionData) {
    const nutritionalFactsTable = document.getElementById('nutritionalFacts');

    const tableBody = document.createElement('tbody');
    Object.keys(nutritionData.totalNutrients).forEach(key => {
      const nutrient = nutritionData.totalNutrients[key];
      const nutrientRow = document.createElement('tr');
      nutrientRow.innerHTML = `
        <td>${nutrient.label}</td>
        <td>${nutrient.quantity.toFixed(2)}</td>
        <td>${nutrient.unit}</td>
      `;
      tableBody.appendChild(nutrientRow);
    });
    nutritionalFactsTable.appendChild(tableBody);
  }

  // Function to fetch recipe data from Spoonacular API
  async function getRecipe(recipe) {
    try {
      const spoonacularResponse = await fetch(`${spoonacularEndpoint}?apiKey=${spoonacularApiKey}&number=1&tags=${recipe}`);
      const spoonacularData = await spoonacularResponse.json();

      if (spoonacularData && spoonacularData.recipes && spoonacularData.recipes.length > 0) {
        const recipeInfo = spoonacularData.recipes[0];
        displayRecipe(recipeInfo);
        getFoodPhotoFromPexels(recipeInfo.title);
        searchVideo(recipeInfo.title);

        // Extract ingredients for nutritional analysis
        const ingredientsList = recipeInfo.extendedIngredients.map(ingredient => ingredient.original);
        await getNutritionAnalysis(ingredientsList); // Fetch nutrition analysis data
      } else {
        console.log('No recipe found in Spoonacular. Trying Edamam...');
        await getRecipeFromEdamam(recipe);
      }
    } catch (error) {
      console.error('Error fetching recipe:', error);
    }
  }

  // Function to fetch recipe data from Edamam API
  async function getRecipeFromEdamam(recipe) {
    try {
      const edamamResponse = await fetch(`${edamamEndpoint}?q=${recipe}&app_id=${edamamAppId}&app_key=${edamamApiKey}&to=1`);
      const edamamData = await edamamResponse.json();

      if (edamamData && edamamData.hits && edamamData.hits.length > 0) {
        const recipeInfo = edamamData.hits[0].recipe;
        displayRecipeFromEdamam(recipeInfo);
        // Handle other functionalities for Edamam data (if required)
      } else {
        console.log('No recipe found in Edamam.');
        // Handle the scenario where no recipe is found in both APIs
      }
    } catch (error) {
      console.error('Error fetching recipe from Edamam:', error);
    }
  }

  // Function to display recipe details
  function displayRecipe(recipe) {
    const recipeDiv = document.getElementById('recipe');
    recipeDiv.innerHTML = `
      <h2>${recipe.title}</h2>
      <div class="recipe-content">
        <div class="recipe-text">
          <p>${recipe.instructions}</p>
          <p>Ingredients:</p>
          <ul>
            ${recipe.extendedIngredients.map(ingredient => `<li>${ingredient.original}</li>`).join('')}
          </ul>
          <p>Preparation time: ${recipe.readyInMinutes} minutes</p>
          <p>Servings: ${recipe.servings}</p>
          <p>Source: ${recipe.sourceName}</p>
        </div>
        <div class="recipe-photo">
          <img src="" alt="Food Photo" style="max-width: 100%; height: auto;">
        </div>
      </div>
    `;
  }

  // Function to fetch a photo of the food from Pexels
  async function getFoodPhotoFromPexels(foodName) {
    const pexelsApiKey = 'fgOZkJ5uEHoqEAAMV6ULyFdpIeK8MegO6AMoKP34jqZR5jOPhm358PGD';
    const pexelsEndpoint = `https://api.pexels.com/v1/search?query=${foodName}&per_page=1`;

    try {
      const response = await fetch(pexelsEndpoint, {
        headers: {
          Authorization: pexelsApiKey
        }
      });
      const data = await response.json();

      if (data.photos && data.photos.length > 0) {
        const photoUrl = data.photos[0].src.medium;
        displayFoodPhoto(photoUrl);
      } else {
        console.log('No photo found.');
      }
    } catch (error) {
      console.error('Error fetching photo:', error);
    }
  }

  // Function to display the fetched food photo
  function displayFoodPhoto(photoUrl) {
    const photoDiv = document.querySelector('.recipe-photo img');
    if (photoDiv) {
      photoDiv.src = photoUrl;
    } else {
      console.error('Photo element not found.');
    }
  }

  // Function to search for a video related to the recipe on YouTube
  async function searchVideo(recipeTitle) {
    const youtubeApiKey = 'AIzaSyBqfZSfjtWxLd-6SSjsQb8WVUsPMjP8MqY';
    const youtubeEndpoint = `https://www.googleapis.com/youtube/v3/search?part=snippet&q=${recipeTitle}&key=${youtubeApiKey}&type=video`;

    try {
      const response = await fetch(youtubeEndpoint);
      const data = await response.json();

      if (data.items && data.items.length > 0) {
        displayVideos(data.items);
      } else {
        console.log('No video found.');
      }
    } catch (error) {
      console.error('Error fetching video:', error);
    }
  }

  // Function to display the fetched YouTube videos in a carousel
  function displayVideos(videos) {
    const videosDiv = document.getElementById('videos');
    videosDiv.innerHTML = '';

    const carouselContainer = document.createElement('div');
    carouselContainer.className = 'video-carousel';

    let currentIndex = 0;

    function showVideos(startIndex) {
      carouselContainer.innerHTML = '';
      const endIndex = Math.min(startIndex + 3, videos.length);

      for (let i = startIndex; i < endIndex; i++) {
        const video = videos[i];
        const videoId = video.id.videoId;
        const videoTitle = video.snippet.title;

        const videoElement = document.createElement('iframe');
        videoElement.width = '300';
        videoElement.height = '169';
        videoElement.src = `https://www.youtube.com/embed/${videoId}`;
        videoElement.title = videoTitle;
        videoElement.allowFullscreen = true;

        const videoItem = document.createElement('div');
        videoItem.className = 'video-item';
        videoItem.appendChild(videoElement);

        carouselContainer.appendChild(videoItem);
      }
    }

    showVideos(currentIndex);

    const prevButton = document.createElement('button');
    prevButton.textContent = 'Prev';
    prevButton.addEventListener('click', () => {
      currentIndex = Math.max(currentIndex - 3, 0);
      showVideos(currentIndex);
    });

    const nextButton = document.createElement('button');
    nextButton.textContent = 'Next';
    nextButton.addEventListener('click', () => {
      currentIndex = Math.min(currentIndex + 3, videos.length - 3);
      showVideos(currentIndex);
    });

    const navButtons = document.createElement('div');
    navButtons.className = 'nav-buttons';
    navButtons.appendChild(prevButton);
    navButtons.appendChild(nextButton);

    videosDiv.appendChild(navButtons);
    videosDiv.appendChild(carouselContainer);
  }

  // Function to display recipe details from Edamam
  function displayRecipeFromEdamam(recipe) {
    const recipeDiv = document.getElementById('recipe');
    recipeDiv.innerHTML = `
      <h2>${recipe.label}</h2>
      <p>${recipe.url}</p>
      <p>Ingredients:</p>
      <ul>
        ${recipe.ingredients.map(ingredient => `<li>${ingredient.text}</li>`).join('')}
      </ul>
      <p>Preparation time: ${recipe.totalTime} minutes</p>
      <p>Servings: ${recipe.yield}</p>
      <p>Source: ${recipe.source}</p>
    `;
  }

  // Function to trigger search for a recipe
  function searchRecipe() {
    const recipeInput = document.getElementById('recipeInput').value;
    getRecipe(recipeInput);
  
    // Create a link element for the CSS file
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = 'mainstyle.css'; // Replace with your CSS file path
  
    // Append the link element to the document head
    document.head.appendChild(link);
    
  }