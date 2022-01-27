getCurrentValue()

function getCurrentValue () {
  let xhttp = new XMLHttpRequest()
  let waterbar = document.getElementById('water-bar')
  let readcount = 0
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      waterbar.innerHTML = this.responseText + '%'
      waterbar.setAttribute('aria-valuenow', this.responseText)
      waterbar.setAttribute('style', 'height: ' + this.responseText + '%')
      setTimeout(function () {
        getCurrentValue()
      }, 250)
      console.log(this.responseText)
      readcount++
    }
  }
  xhttp.open('GET', 'get-water-level.php', true)
  xhttp.send()
}
