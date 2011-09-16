/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: Mike Hudson :: http://www.afrozeus.com */

function setupFadeLinks() {
  arrFadeLinks[0] = "http://shwecommunity.net";
  arrFadeTitles[0] = "News! Updates on Shwecommunity.net";
  arrFadeLinks[1] = "http://shwecommunity.net";
  arrFadeTitles[1] = "Valentine song album";
  arrFadeLinks[2] = "http://shwecommunity.net";
  arrFadeTitles[2] = "Lastest myanmar mp3";
  arrFadeLinks[3] = "http://shwecommunity.net";
  arrFadeTitles[3] = "Design for Valentine day is coming soon!";
  arrFadeLinks[4] = "http://shwecommunity.net";
  arrFadeTitles[4] = "Latest popular posted on Blog";
}

// You can also play with these variables to control fade speed, fade color, and how fast the colors jump.

var m_FadeOut = 255;
var m_FadeIn=0;
var m_Fade = 0;
var m_FadeStep = 3;
var m_FadeWait = 1600;
var m_bFadeOut = true;

var m_iFadeInterval;

window.onload = Fadewl;

var arrFadeLinks;
var arrFadeTitles;
var arrFadeCursor = 0;
var arrFadeMax;

function Fadewl() {
  m_iFadeInterval = setInterval(fade_ontimer, 10);
  arrFadeLinks = new Array();
  arrFadeTitles = new Array();
  setupFadeLinks();
  arrFadeMax = arrFadeLinks.length-1;
  setFadeLink();
}

function setFadeLink() {
  var ilink = document.getElementById("fade_link");
  ilink.innerHTML = arrFadeTitles[arrFadeCursor];
  ilink.href = arrFadeLinks[arrFadeCursor];
}

function fade_ontimer() {
  if (m_bFadeOut) {
    m_Fade+=m_FadeStep;
    if (m_Fade>m_FadeOut) {
      arrFadeCursor++;
      if (arrFadeCursor>arrFadeMax)
        arrFadeCursor=0;
      setFadeLink();
      m_bFadeOut = false;
    }
  } else {
    m_Fade-=m_FadeStep;
    if (m_Fade<m_FadeIn) {
      clearInterval(m_iFadeInterval);
      setTimeout(Faderesume, m_FadeWait);
      m_bFadeOut=true;
    }
  }
  var ilink = document.getElementById("fade_link");
  if ((m_Fade<m_FadeOut)&&(m_Fade>m_FadeIn)){
	//alert(m_Fade+"-"+ToHex(m_Fade));
    var color;
    if(m_Fade < 45) {
	color="yellow";
    }else{
	color = "#" + ToHex(m_Fade);
    }
    ilink.style.color = color;
    }
}

function Faderesume() {
  m_iFadeInterval = setInterval(fade_ontimer, 10);
}

function ToHex(strValue) {
  try {
    var result= (parseInt(strValue).toString(16));

    while (result.length !=2)
            result= ("0" +result);
    result = result + result + result;
    return result.toUpperCase();
  }
  catch(e)
  {
  }
}

