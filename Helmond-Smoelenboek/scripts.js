function setLanguage(language) {
    // Get the Dutch and English content divs
    var bioNL = document.getElementById('bio-nl');
    var bioEN = document.getElementById('bio-en');

    // Toggle visibility based on language
    if (language === 'nl') {
      bioNL.style.display = 'block';
      bioEN.style.display = 'none';
    } else if (language === 'en') {
      bioNL.style.display = 'none';
      bioEN.style.display = 'block';
    }
  }