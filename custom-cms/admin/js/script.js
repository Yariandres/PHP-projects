window.onload = () => {
  // get tag location
  let displayDate = document.querySelector("#date");
  console.log(displayDate);

  // create a date object 
  let date  = new Date();
  // get the day from object 
  let day = date.getDay();

  // assign day 
  let weekday = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
  let year = date.getFullYear();

  // write to the year 
  displayDate.innerHTML = `${weekday[day]} - ${year}`;
}