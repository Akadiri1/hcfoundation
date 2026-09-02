<script type="text/javascript">

  function createExcerptFunc(param) {
  var text = param.text ?? "";
  const excerptLength = param.length ?? 30;
  const splitter = param.splitter ?? " ";
  const delimiter = param.delimiter ?? "...";
  const decode = Boolean (param.decode ?? false);
  const linkColor = param.linkColor ?? "#000";
  const textColor = param.textColor ?? "#000";

  if (decode == true){
      var text = (atob(text))
  }

  const excerpt = text.split(splitter).length > excerptLength ? text.split(splitter, excerptLength).join(splitter) + delimiter : text;

  const excerptElement = document.createElement('div');
  const textElement = document.createElement('div');
  textElement.innerHTML = excerpt;
  textElement.style.color = textColor;

  const readMoreButton = document.createElement('a');
  const readLessButton = document.createElement('a');


  if (text.split(splitter).length > excerptLength) {
    readMoreButton.style.display = 'block';
  }else{
    readMoreButton.style.display = 'none';
  }

  if (text.split(splitter).length > excerptLength) {
    readLessButton.style.display = 'block';
  }else{
    readLessButton.style.display = 'none';
  }


  readMoreButton.href = '#';
  readMoreButton.style.color = linkColor;
  readMoreButton.innerHTML = 'Read more';
  readMoreButton.addEventListener('click', (evt) => {
    evt.preventDefault();
    textElement.innerHTML = text;
    readMoreButton.style.display = 'none';
    readLessButton.style.display = 'block';
  });

  readLessButton.href = '#';
  readLessButton.style.color = linkColor;
  readLessButton.innerHTML = 'Read less';
  readLessButton.style.display = 'none';
  readLessButton.addEventListener('click', (evt) => {
    evt.preventDefault();
    textElement.innerHTML = excerpt;
    readMoreButton.style.display = 'block';
    readLessButton.style.display = 'none';
  });


  excerptElement.appendChild(textElement);
  excerptElement.appendChild(readMoreButton);
  excerptElement.appendChild(readLessButton);

  return excerptElement;
}



  function createExcerpt(param) {
  var text = param.text ?? "";
  const excerptLength = param.length
  const splitter = param.splitter ?? " ";
  const delimiter = param.delimiter ?? "...";
  const decode = Boolean (param.decode ?? false);
  const linkColor = param.linkColor ?? "#000";
  const textColor = param.textColor ?? "#000";

  if (decode == true){
      var text = (atob(text))
  }

  const excerpt = text.split(splitter).length > excerptLength ? text.split(splitter, excerptLength).join(splitter) + delimiter : text;

  // console.log(excerpt);
  
  const excerptElement = document.createElement('div');
  const textElement = document.createElement('div');
  textElement.innerHTML = excerpt;
  textElement.style.color = textColor;

  const readMoreButton = document.createElement('a');
  const readLessButton = document.createElement('a');


  if (text.split(splitter).length > excerptLength) {
    readMoreButton.style.display = 'block';
  }else{
    readMoreButton.style.display = 'none';
  }

  if (text.split(splitter).length > excerptLength) {
    readLessButton.style.display = 'block';
  }else{
    readLessButton.style.display = 'none';
  }


  readMoreButton.href = '#';
  readMoreButton.style.color = linkColor;
  readMoreButton.innerHTML = 'Read more';
  readMoreButton.addEventListener('click', (evt) => {
    evt.preventDefault();
    textElement.innerHTML = text;
    readMoreButton.style.display = 'none';
    readLessButton.style.display = 'block';
  });

  readLessButton.href = '#';
  readLessButton.style.color = linkColor;
  readLessButton.innerHTML = 'Read less';
  readLessButton.style.display = 'none';
  readLessButton.addEventListener('click', (evt) => {
    evt.preventDefault();
    textElement.innerHTML = excerpt;
    readMoreButton.style.display = 'block';
    readLessButton.style.display = 'none';
  });


  excerptElement.appendChild(textElement);
  excerptElement.appendChild(readMoreButton);
  excerptElement.appendChild(readLessButton);

  return excerptElement;
}




  Date.prototype.isLeapYear = function() {
    var year = this.getFullYear();
    if((year & 3) != 0) return false;
    return ((year % 100) != 0 || (year % 400) == 0);
  };

  Date.prototype.daysInMonth = function () {
    return new Date(this.getFullYear(), this.getMonth()+1, 0).getDate();
  }

  Date.prototype.getDayOfYear = function() {
    var dayCount = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
    var mn = this.getMonth();
    var dn = this.getDate();
    var dayOfYear = dayCount[mn] + dn;
    if(mn > 1 && this.isLeapYear()) dayOfYear++;
    return dayOfYear;
  };

  function cleanDecodeDate(date = null, type = null) {
  if (date == null) {
    date = new Date().toISOString().substring(0, 10);
  }

  if (type != null) {
    type = type.toUpperCase();
  }

  let dateToInteger;
  if (Number.isInteger(date)) {
    dateToInteger = date;
  } else {
    dateToInteger = new Date(date).getTime();
  }

  const returnDate = {};

  returnDate.hour = new Date(dateToInteger).getHours().toString().padStart(2, '0');
  returnDate.minutes = new Date(dateToInteger).getMinutes().toString().padStart(2, '0');
  returnDate.seconds = new Date(dateToInteger).getSeconds().toString().padStart(2, '0');
  returnDate.meridiem = new Date(dateToInteger).getHours() >= 12 ? 'PM' : 'AM';

  returnDate.dayAbbr = new Intl.DateTimeFormat('en-US', { weekday: 'short' }).format(dateToInteger);
  returnDate.day = new Intl.DateTimeFormat('en-US', { weekday: 'long' }).format(dateToInteger);
  returnDate.dayInt = new Date(dateToInteger).getDate().toString().padStart(2, '0');
  returnDate.dayIntSuffix = new Date(dateToInteger).getDate() + getOrdinalSuffix(new Date(dateToInteger).getDate());
  returnDate.dayInYear = new Date(dateToInteger).getDayOfYear();

  returnDate.dayInWeek = new Date(dateToInteger).getDay() + 1;

  returnDate.monthAbbr = new Intl.DateTimeFormat('en-US', { month: 'short' }).format(dateToInteger);
  returnDate.monthInt = (new Date(dateToInteger).getMonth() + 1).toString().padStart(2, '0');
  returnDate.month = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(dateToInteger);
  returnDate.monthCount = new Date(dateToInteger).daysInMonth();

  returnDate.year = new Date(dateToInteger).getFullYear().toString();
  returnDate.yearShort = new Date(dateToInteger).getFullYear().toString().slice(-2);

  if (type == "FULL") {
    return returnDate;
  } else if (type == "FULL_TIME") {
    return `${returnDate.hour}:${returnDate.minutes}:${returnDate.seconds} ${returnDate.meridiem}`;
  } else if (type == "TIME") {
    return `${returnDate.hour}:${returnDate.minutes} ${returnDate.meridiem}`;
  } else {
    return `${returnDate.dayAbbr}, ${returnDate.dayInt} ${returnDate.monthAbbr} ${returnDate.year}`;
  }
}

function getOrdinalSuffix(n) {
  const j = n % 10,
        k = n % 100;
  if (j == 1 && k != 11) {
      return 'st';
  }
  if (j == 2 && k != 12) {
      return 'nd';
  }
  if (j == 3 && k != 13) {
      return 'rd';
  }
  return 'th';
}

	
  function loadMore(evt_target = null, parentElem, dataElem, endpoint, limit, where = null, your_func = null){
    var error = [];

    var callBackObject = {};

    var parentElem = document.querySelector(parentElem) || null;
    var dataElem = document.querySelectorAll(dataElem) || null;
    var endpoint = endpoint || null;
    dataElem = [...dataElem];

    console.log(dataElem);

    if (dataElem != null && parentElem != null) {
      var offset = dataElem.length;
      if (where == null) {
        if (typeof your_func == "function") {
          callBackObject = {parent:parentElem,offset, limit, endpoint, where}
          your_func(callBackObject);
          return

        }else{
          error.push("You didn't pass a callback function when you left argument `where` empty");
        }
      }else{
        ajaxPost(endpoint, {offset:dataElem.length, where, limit}, (err, res)=>{
          console.log(res);
          var returnData = {data:res, parent:parentElem, offset}
          // var response = JSON.parse(res);
          your_func(returnData);

        })
      }
    }else{
      error.push("parent element or data element is null");
    }

    console.log(error);
  }

  function urlString(urlToString) {
    const urlString = urlToString.replace(/ /g, '-').replace(/\+/g, '-').toLowerCase().replace(/%[0-9A-F]{2}/gi, function(match) {
      return match.toLowerCase();
    });
    return urlString;
  }


  function previewBodyWithElipsces(string, count = 50 , strip = true, urlParam = { link: '', color: 'blue' }) {
  const originalString = string;
  let words = string.split(' ');
  let urlColor = '';
  let urlText = '';
  let url = '';
  if ('color' in urlParam) {
    urlColor = `style='color:${urlParam['color']} !important;'`;
  }
  if ('text' in urlParam) {
    urlText = urlParam['text'];
  } else {
    urlText = 'read more';
  }
  if ('link' in urlParam) {
    if (urlParam['link'] !== '') {
      url = ` <a href='${urlParam['link']}'${urlColor}>${urlText}</a>`;
    }
  }
  if (words.length > count) {
    words = words.slice(0, count);
    string = words.join(' ') + '...';
  }
  if (strip === true) {
    string = string.replace(/<[^>]*>/g, '');
  }
  return string + url;
}


</script>