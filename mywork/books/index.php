<!DOCTYPE html>
<!-- saved from url=(0046)#/en-US/web-apps -->
<html lang="en" manifest=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- 
    20 Things I Learned About Browsers and the Web
    Built by Fi (www.f-i.com) for the Google Chrome Team.
    
    @author Hakim El Hattab
    @author Erik Kallevig
    @author Jon Gray
    -->
    
  
  <meta name="keywords" content="browsers, web, google, cookies, cloud computing, html5 book, web apps, javascript, phishing, malware, internet, online security, online safety, web apps, web applications, html, html5, plugins, browser extensions, online privacy, open source, christoph niemann, what is the web, what is the internet">
  <meta name="author" content="Google, inc.">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width = 1000">
  <meta name="description" content="Web Apps (or, &#39;Life, Liberty and the Pursuit of Appiness&#39;)">
  
      
      
  <link rel="image_src" href="./20 Things I Learned About Browsers and the Web_files/front-cover.jpg">
  
  <title>20 Things I Learned About Browsers and the Web</title>
  
  <link type="text/css" href="./20 Things I Learned About Browsers and the Web_files/twentythings.min.css" rel="stylesheet" media="screen"><link type="text/css" href="./20 Things I Learned About Browsers and the Web_files/print.css" rel="stylesheet" media="print">  
    
    <script src="./20 Things I Learned About Browsers and the Web_files/cb=gapi.loaded_0" async=""></script><script type="text/javascript" async="" src="./20 Things I Learned About Browsers and the Web_files/ga.js"></script><script type="text/javascript"> 
      document.write('<link rel="stylesheet" type="text/css" media="all" href="/css/hideOnLoad.css" />');
      
      if( window.location.hash.match('\/') ) {
        window.location = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port + window.location.hash.slice(1);
      }

      var SERVER_VARIABLES = {
        PAGE: "Page",
        PAGES:  "Pages",
        THING:  "THING",
        FOREWORD:  "FOREWORD",
        LANG: "en-US",
        SITE_VERSION: 49,
        FACEBOOK_MESSAGE: "A fun guidebook from Google on things you've always wanted to know about browsers & the web (but were afraid to ask",
        FACEBOOK_MESSAGE_SINGLE: "A fun fact I learned today from Google's guidebook to browsers and the web.",
        TWITTER_MESSAGE: "A fun guidebook from Google on things you've always wanted to know about browsers & the web:",
        TWITTER_MESSAGE_SINGLE: "A fun fact I learned today from Google's guidebook to browsers and the web: ",
        BUZZ_MESSAGE: "A fun guidebook from Google on things you've always wanted to know about browsers & the web (but were afraid to ask):",
        BUZZ_MESSAGE_SINGLE: "A fun fact I learned today from Google's guidebook to browsers and the web: ",
        SOLID_BOOK_COLOR: "#5873a0"      };
      
      // Set language for use by Google +1 button.
      window.___gcfg = {lang: SERVER_VARIABLES.LANG};
    </script><link rel="stylesheet" type="text/css" media="all" href="./20 Things I Learned About Browsers and the Web_files/hideOnLoad.css">

  

</head>
<body class="en-US  book" style="overflow-x: hidden; overflow-y: auto;">

  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19264787-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>  
    
  
  
  <header style="width: 1349px;">
    <h1><a class="logo" href="#/">20 Things I Learned About Browsers and the Web</a></h1>
    <nav>
      <ul>
        <li class="table-of-things"><a href="#">TABLE OF THINGS</a></li>
        <li class="divider1"></li>
        <li class="about"><a href="#">FOREWORD</a></li>
        <li class="divider2"></li>
        <li class="credits"><a href="#">CREDITS</a></li>
        <li class="divider2"></li>
      </ul>
    </nav>
    
    <div id="language-selector">
      <div id="language-selector-title"><a>
      English (US)      </a></div>
      <div id="language-selector-list">
        <ul>
          <li data-locale="cs-CZ"><a href="#">čeština</a></li><li data-locale="de-DE"><a href="#">Deutsch</a></li><li data-locale="en-GB"><a href="#">English (UK)</a></li><li data-locale="en-US"><a href="#">English (US)</a></li><li data-locale="es-419"><a href="#">español (Latinoamérica y el Caribe)</a></li><li data-locale="es-ES"><a href="#">español (ES)</a></li><li data-locale="fil-PH"><a href="#">Filipino</a></li><li data-locale="fr-FR"><a href="#">français</a></li><li data-locale="in-ID"><a href="#">Bahasa Indonesia</a></li><li data-locale="it-IT"><a href="#">italiano</a></li><li data-locale="ja-JP"><a href="#">日本語</a></li><li data-locale="nl-NL"><a href="#">Nederlands</a></li><li data-locale="pl-PL"><a href="#">polski</a></li><li data-locale="pt-BR"><a href="#">português</a></li><li data-locale="ru-RU"><a href="#">русский</a></li><li data-locale="zh-CN"><a href="#">中文（简体中文）</a></li><li data-locale="zh-TW"><a href="#">中文 (繁體中文)</a></li>        </ul>
      </div>
    </div>
    
    <!-- Input type="search" is currently too inconsistent across browsers and platforms -->
    <input id="search-field" type="text" value="Search Book">
  </header>
  
  <!-- Holds search results -->
  <div id="search-dropdown" style="left: 1115px; top: 43px;">
    <div class="fader">
      <div class="background-top"></div>
      <div class="background-bottom"></div>
      <div class="results">
        <div class="things">
          <h4><span>Search Book</span></h4>
          <hr>
        </div>
        <div class="keywords">
          <h4><span>KEYWORDS</span></h4>
          <hr>
        </div>
        <div class="empty">No results found.</div>
      </div>
    </div>
  </div>
  
  <!-- Left side grey overlay that masks out the book -->
  <div id="grey-mask" style="left: 0px;"></div>
  
  <div id="book" style="left: -565.5px; top: 80px; margin: 0px; opacity: 1; display: block;">
    <div id="shadow">
      <div class="shadow-left"></div>
      <div class="shadow-right"></div>
    </div>
    <div id="spine">
      <div class="spine-top"></div>
      <div class="spine-bottom"></div>
    </div>
    <div id="front-cover-bookmark" style="display: none;">
      <div class="content">
        <p>What’s a cookie? How do I protect myself on the web? And most importantly: What happens if a truck runs over my laptop?</p>
										<p>For things you’ve always wanted to know about the web but were afraid to ask, read on.</p>        <a href="#" class="open-book">OPEN BOOK</a>
        <canvas id="flip-intro" width="89" height="69"></canvas>
      </div>
    </div>
    <div id="sharer" style="display: block;">
      <div class="background-top"></div>
      <div class="background-bottom"></div>
      <div class="content">
        <ul>
          <li class="facebook"><a href="#" title="Facebook"></a></li>
          <li class="twitter"><a href="#" title="Twitter"></a></li>
          <li class="gplus"><div id="___plusone_2" style="text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 24px; height: 15px; background-position: initial initial; background-repeat: initial initial;"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 24px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 15px;" tabindex="0" vspace="0" width="100%" id="I0_1376054404391" name="I0_1376054404391" src="./20 Things I Learned About Browsers and the Web_files/fastbutton(1).htm" allowtransparency="true" data-gapiattached="true" title="+1"></iframe></div></li>
          <li class="print"><a href="#" target="_blank" title="Print Thing">Print Thing</a></li>
        </ul>
        <p class="index">THING<span style="">3</span></p>
        <p class="instruction">SHARE THING</p>
      </div>
    </div>
    <div id="front-cover" style="display: none;">
      <img src="./20 Things I Learned About Browsers and the Web_files/front-cover.jpg" width="830" height="520">
    </div>
    <div id="back-cover" style="display: none;">
      <img src="./20 Things I Learned About Browsers and the Web_files/back-cover.jpg" data-src-flipped="/css/images/back-cover-flipped.jpg" width="830" height="520">
    </div>
    <div id="page-shadow-overlay"></div>
    <div id="pages">
			
			<section class="template-start-7 title-foreword page-1 globalPage-1" style="z-index: 499; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Foreword to 20 Things</h2></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/cloud01.png" data-src="media/cloud01.png"></div>
<div class="left">
	<p class="drop-cap">Many of us these days depend on the World Wide Web to bring the world’s information to our fingertips, and put us in touch with people and events across the globe instantaneously.</p>
</div>
<div class="right">
	<p class="continuation">These powerful online experiences are possible thanks to an open web that can be accessed by anyone through a web browser, on any Internet-connected device in the world.</p>
</div><span class="pageNumber">1</span></div></section><section class="template-inner-6 title-foreword page-2 globalPage-2" style="z-index: 498; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">But how do our browsers and the web actually work? How has the World Wide Web evolved into what we know and love today? And what do we need to know to navigate the web safely and efficiently?</p>
	<p>“20 Things I Learned About Browsers and the Web” is a short guide for anyone who’s curious about the basics of browsers and the web.  Here’s what you’ll find here:</p>
	<p>First we’ll look at the Internet, the very backbone that allows the web to exist. We’ll also take a look at how the web is used today, through cloud computing and web apps.</p>
</div>
<div class="right">
	<p>Then, we’ll introduce the building blocks of web pages like HTML and JavaScript, and review how their invention and evolution have changed the websites you visit every day.  We’ll also take a look at the modern browser and how it helps users browse the web more safely and securely.</p>
	<p>Finally, we’ll look ahead to the exciting innovations in browsers and web technologies that we believe will give us all even faster and more immersive online experiences in the future.</p>
</div><span class="pageNumber">2</span></div></section><section class="template-inner-7 title-foreword page-3 globalPage-3" style="z-index: 497; display: none; width: 0px;"><div class="page">﻿<p>Life as citizens of the web can be liberating and empowering, but also deserves some self-education. Just as we’d want to know various basic facts as citizens of our physical neighborhoods -- water safety, key services, local businesses -- it’s increasingly important to understand a similar set of information about our online lives.  That’s the spirit in which we wrote this guide. Many of the examples used to illustrate the features and functionality of the browser often refer back to Chrome, the open-source browser that we know well. We hope you find this guide as enjoyable to read as we did to create.</p>
<p class="continuation">Happy browsing!</p>
<div class="spacer"></div>
<p class="continuation"><em>The Google Chrome Team, with many thanks to Christoph Niemann for his illustrations</em></p>
<p class="continuation"><em>November 2010</em></p><span class="pageNumber">3</span></div></section><section class="template-start-7 title-what-is-the-internet page-1 globalPage-4" style="z-index: 496; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>What is the Internet?</h2><h3>or, "You Say Tomato, I Say TCP/IP"</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/internet01.png" data-src="/media/internet01.png"></div>
<div class="left">
	<p class="drop-cap">What is the Internet, exactly? To some of us, the Internet is where we stay in touch with friends, get the news, shop, and play games. To some others, the Internet can mean their local broadband providers, or the underground wires and fiber-optic cables that</p>
</div>
<div class="right">
	<p class="continuation">carry data back and forth across cities and oceans. Who is right?</p>
	<p>A helpful place to start is near the Very Beginning: 1974.  That was the year that a few smart computer researchers invented something called the Internet Protocol Suite, or TCP/IP for</p>
</div><span class="pageNumber">4</span></div></section><section class="template-inner-5 title-what-is-the-internet page-2 globalPage-5" style="z-index: 495; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">short. TCP/IP created a set of rules that allowed computers to “talk” to each other and send information back and forth.</p>
	<p>TCP/IP is somewhat like human communication: when we speak to each other, the rules of grammar provide structure to language and ensure that we can understand each other and exchange ideas. Similarly, TCP/IP provides the rules of communication that ensure interconnected devices understand each other so that they can send information back and forth. As that group of interconnected devices grew from one room to many rooms — and then to many buildings, and then to many cities and countries — the Internet was born.</p>
</div>
<div class="right">
	<p>The early creators of the Internet discovered that data and information could be sent more efficiently when broken into smaller chunks, sent separately, and reassembled. Those chunks are called <strong>packets</strong>.  So when you send an email across the Internet, your full email message is broken down into packets, sent to your recipient, and reassembled. The same thing happens when you watch a video on a website like YouTube: the video files are segmented into data packets that can be sent from multiple YouTube servers around the world and reassembled to form the video that you watch through your browser.</p>
</div><span class="pageNumber">5</span></div></section><section class="template-inner-2 title-what-is-the-internet page-3 globalPage-6" style="z-index: 494; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>What about speed? If traffic on the Internet were akin to a stream of water, the Internet’s <strong>bandwidth</strong> is equivalent to the amount of water that flows through the stream per second. So when you hear engineers talking about bandwidth, what they’re really referring to is the amount of data that can be sent over your Internet connection per second. This is an indication of how fast your connection is. Faster connections are now possible with better physical infrastructure (such as fiber optic cables that can send information close to the speed of light), as well as better ways to encode the information onto the physical medium itself, even on older medium like copper wires.</p>
	<p>The Internet is a fascinating and highly technical system, and yet for most of us today, it’s a user-friendly world where we don’t even</p>
</div>
<div class="right">
	<p class="continuation"> think about the wires and equations involved. The Internet is also the backbone that allows the World Wide Web that we know and love to exist: with an Internet connection, we can access an open, ever-growing universe of interlinked web pages and applications. In fact, there are probably as many pages on the web today as there are neurons in your brain, as there are stars in the Milky Way!</p>
	<p>In the next two chapters, we’ll take a look at how the web is used today through cloud computing and web apps.</p>
</div><span class="pageNumber">6</span></div></section><section class="template-start-5 title-cloud-computing page-1 globalPage-7" style="z-index: 493; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Cloud Computing</h2><h3>or, why it's ok for a truck to crush your laptop</h3></div><div class="left">
	<p class="drop-cap">Modern computing in the age of the Internet is quite a strange, remarkable thing. As you sit hunched over your laptop at home watching a YouTube video or using a search engine, you’re actually plugging into the collective power of thousands of computers that serve all this information to you from far-away rooms distributed around the world. It’s almost like having a massive supercomputer at your beck and call, thanks to the Internet.</p>
	<p>This phenomenon is what we typically refer to as cloud computing. We now read the</p>
</div>
<div class="right">
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/cloud03.png" data-src="media/cloud03.png"></div>
	<p class="continuation">news, listen to music, shop, watch TV shows and store our files on the web. Some of us live in cities in which nearly every museum, bank, and government office has a website. The end result? We spend less time in lines or on the phone, as these websites allow us to do things like pay bills and make reservations. The movement of many of our daily tasks online enables us to live more fully in the real world.</p>
</div><span class="pageNumber">7</span></div></section><section class="template-inner-5 title-cloud-computing page-2 globalPage-8" style="z-index: 492; display: none; width: 0px;"><div class="page">﻿<div class="left">
<p>Cloud computing offers other benefits as well. Not too long ago, many of us worried about losing our documents, photos and files if something bad happened to our computers, like a virus or a hardware malfunction. Today, our data is migrating beyond the boundaries of our personal computers. Instead, we’re moving our data online into “the cloud”. If you upload your photos, store critical files online and use a web-based email service like Gmail or Yahoo! Mail, an 18-wheel truck could run over your laptop and all your data would still safely reside on the web, accessible from any Internet-connected computer, anywhere in the world.</p>
</div>
<div class="right">
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/cloud02.png" data-src="media/cloud02.png"></div>
</div><span class="pageNumber">8</span></div></section><section class="template-start-5 title-web-apps page-1 globalPage-9 current" style="z-index: 491;"><div class="page"><div class="page-title"><h2>Web Apps</h2><h3>or, "Life, Liberty and the Pursuit of Appiness"</h3></div><div class="left">
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/webapps01.png" data-src="media/webapps01.png" style=""><canvas width="300" height="260" style="position: absolute; left: 65px; top: 242px;"></canvas></div>
</div>
<div class="right">
	<div class="image2"><img src="./20 Things I Learned About Browsers and the Web_files/webapps02.png" data-src="media/webapps02.png"></div>
	<p class="drop-cap">If you play online games, use an online photo editor, or rely on web-based services like Google Maps, Twitter, Amazon, YouTube or Facebook, then you’re an active resident in the wonderful world of web apps.</p>
	<p>What exactly <i>is</i> a web app, anyway? And why should we care?</p>
</div><span class="pageNumber">9</span></div></section><section class="template-inner-2 title-web-apps page-2 globalPage-10" style="z-index: 490; width: 0px; display: none;"><div class="page">﻿<div class="left">
	<p><i>App</i> is shorthand for an application. Applications are also called programs or software. Traditionally, they’ve been designed to do broad, intensive tasks like accounting or word processing.  In the online world of web browsers and smart phones, apps are usually nimbler programs focused on a single task. Web apps, in particular, run these tasks inside the web browser and often provide a rich, interactive experience.</p>
	<p>Google Maps is a good example of a web app. It’s focused on one task: providing helpful map features within a web browser. You can pan and zoom around a map, search for a college or cafe, and get driving directions, among other tasks. All the information you need is pulled into the web app dynamically every time you ask for it.</p>
</div>
<div class="right">
	<p class="continuation">This brings us to four virtues of Web Appiness:</p>
	<h4>1. I can access my data from anywhere.</h4>
	<p class="continuation">In the traditional world of desktop applications, data is usually stored on my computer’s hard drive. If I’m on vacation and leave my computer at home, I can’t access my email, photos, or any of my data when I need it. In the new world of web apps, my email and all my data are stored online on the web. I can get to it on a web browser from any computer that’s connected to the Internet.</p>
	<h4>2. I’ll always get the latest version of any app.</h4>
	<p class="continuation">Which version of YouTube am I using today? What about tomorrow? The answer: Always the latest. Web apps update themselves automatically, so there’s always just one version: the latest version, with all the newest features and improvements. No need to</p>
</div><span class="pageNumber">10</span></div></section><section class="template-inner-2 title-web-apps page-3 globalPage-11" style="z-index: 489; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">manually upgrade to a new version every time. And I don’t have to go through a lengthy install process to use my web apps.</p>
	<h4>3. It works on every device with a web browser.</h4>
	<p class="continuation">In traditional computing, some programs work only on particular systems or devices. For instance, many programs written for a PC won’t work on a Mac. Keeping up with all the right software can be time-consuming and costly. In contrast, the web is an open platform. Anyone can reach it from a browser on any web-connected device, regardless of whether it’s a desktop computer, laptop, or mobile phone. That means I can use my favorite web apps even if I’m using my friend’s laptop or a computer at an Internet cafe.</p>
	<h4>4. It’s safer.</h4>
	<p class="continuation">Web apps run in the browser and I never</p>
</div>
<div class="right">
	<p class="continuation">have to download them onto my computer. Because of this separation between the app code and my computer’s code, web apps can’t interfere with other tasks on my computer or the overall performance of my machine. This means that I’m better protected from threats like viruses, malware and spyware.</p>
</div><span class="pageNumber">11</span></div></section><section class="template-start-2 title-html page-1 globalPage-12" style="z-index: 488; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>HTML, JavaScript, CSS and more</h2><h3>or, this is not your mom's AJAX</h3></div><p class="drop-cap">Web pages are written in HTML, the web programming language that tells web browsers how to structure and present content on a web page. In other words, HTML provides the basic building blocks for the web. And for a long time, those building blocks were pretty simple and static: lines of text, links and images.</p>
<p>Today, we expect to be able to do things like play online chess or seamlessly scroll around a map of our neighborhood, without waiting for the entire page to reload for every chess move or every map scroll.</p>
<p>The idea of such dynamic web pages began</p>
<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/html01.png" data-src="media/html01.png"></div><span class="pageNumber">12</span></div></section><section class="template-inner-4 title-html page-2 globalPage-13" style="z-index: 487; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="p1 continuation">with the invention of the scripting language JavaScript. JavaScript support in major web browsers meant that web pages could incorporate more meaningful real-time interactions. For example, if you’ve filled out an online form and hit the “submit” button, the web page can use JavaScript to check your entries in real-time and alert you almost instantly if you had filled out the form incorrectly.</p>
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/html02.png" data-src="media/html02.png"></div>
</div>
<div class="right">
	<div class="image2"><img src="./20 Things I Learned About Browsers and the Web_files/html03.png" data-src="media/html03.png"></div>
	<p>But the dynamic web as we know it today truly came to life when XHR (XMLHttpRequest) was introduced into JavaScript, and first used in web applications like Microsoft Outlook for the Web, Gmail and Google Maps. XHR enabled individual parts of a web page — a game, a map, a video, a little survey — to be altered without needing to reload the entire page. As a result, web apps are faster and more responsive.</p>
</div><span class="pageNumber">13</span></div></section><section class="template-inner-4 title-html page-3 globalPage-14" style="z-index: 486; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/html04.png" data-src="media/html04.png"></div>
	<p>Web pages have also become more expressive with the introduction of CSS (Cascading Style Sheets). CSS gives programmers an easy, efficient way to define a web page’s layout and beautify the page with design elements like colors, rounded corners, gradients, and animation.</p>
</div>
<div class="right">
	<p>Web programmers often refer to this potent combination of JavaScript, XHR, CSS and several other web technologies as AJAX (Asynchronous JavaScript and XML). HTML has also continued to evolve as more features and improvements are incorporated into new versions of the HTML standard.</p>
	<p>Today’s web has evolved from the ongoing efforts of all the technologists, thinkers, coders and organizations who create these web technologies and ensure that they’re supported in web browsers like Internet Explorer, Firefox, Safari and Google Chrome. This interaction between web technologies and browsers has made the web an open and friendly construction platform for web developers, who then bring to life many useful and fun web applications that we use daily.</p>
</div><span class="pageNumber">14</span></div></section><section class="template-start-2 title-html5 page-1 globalPage-15" style="z-index: 485; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>HTML5</h2><h3>or, in the beginning there was no &lt;video&gt;</h3></div><p class="drop-cap">More than two decades after HTML was introduced, we’re still asking questions about what the web is, and what it might become. What kinds of features and applications would we, as users, find fun, useful or even indispensable? What tools do developers need in order to create these great sites and apps? And finally, how can all this goodness be delivered inside a web browser?</p>
<p>These questions led to the evolution of the latest version of HTML known as HTML5, a set of capabilities that gives web designers and developers the ability to create the next generation of great online applications.  Take the HTML5 &lt;video&gt; tag, for example. Video wasn’t a major (or, really, any) part of the early web;</p>
<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/html501.png" data-src="media/html501.png"></div><span class="pageNumber">15</span></div></section><section class="template-inner-2 title-html5 page-2 globalPage-16" style="z-index: 484; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">instead, internet users installed additional software called plug-ins, in order to watch videos inside their web browsers. Soon it became apparent that easy access to video was a much-wanted feature on the web. The introduction of the &lt;video&gt; tag in HTML5 allows videos to be easily embedded and played in web pages without additional software.</p>
	<p>Other cool HTML5 features include offline capabilities that let users interact with web apps even when they don’t have an internet connection, as well as drag-and-drop capabilities. In Gmail, for instance, easy drag-and-drop allows users to instantly attach a file to an email message by simply dragging the file from the user’s desktop computer into the browser window.</p>
	<p>HTML5, like the web itself, is in perpetual</p>
</div>
<div class="right">
	<p class="continuation">evolution, based on users’ needs and developers’ imaginations.  As an open standard, HTML5 embodies some of the best aspects of the web: it works everywhere, and on any device with a modern browser.  But just as you can only watch HDTV broadcasts on an HD-compatible television, you need to use an up-to-date, HTML5-compatible browser in order to enjoy sites and apps that take advantage of HTML5’s features. Thankfully, as an Internet user, you have lots of choice when it comes to web browsers — and unlike TVs, web browsers can be downloaded for free.</p>
</div><span class="pageNumber">16</span></div></section><section class="template-start-7 title-threed page-1 globalPage-17" style="z-index: 483; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>3D in the Browser</h2><h3>or, browsing with more depth</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/3d01.png" data-src="/media/illustrations/3d01.png"></div>
<div class="left">
	<p class="drop-cap">3D graphics and animation can be truly captivating with all the right details in place: details like lighting and shadows, reflections, and realistic textures. But until now, it has been hard to deliver a compelling 3D experience, particularly over the Internet.</p>
</div>
<div class="right">
	<p>Why?  Mostly because creating a 3D experience in games and other applications requires data — lots and lots of data — to display intricate textures and shapes. In the past, these large amounts of data demanded more Internet bandwidth and more computing</p>
</div><span class="pageNumber">17</span></div></section><section class="template-inner-6 title-threed page-2 globalPage-18" style="z-index: 482; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">power than most common systems could handle. All that has changed very recently, and all for the better: browser-based 3D has arrived.</p>
	<p>Modern broadband helped solve bandwidth needs. Many homes and offices now have broadband speeds that dwarf the connections of even ten years ago. As a result, it’s possible to send large amounts of data over the Internet — data that is needed to display realistic 3D experiences in the browser. In addition, the computers we use today are so much more powerful than what we had in the past: processors and memory have improved such that even a standard laptop or desktop today can handle the complexity of 3D graphics.</p>
</div>
<div class="right">
	<p>Neither broadband nor raw computing power would matter without substantial advancements in the web browser’s capabilities. Many modern browsers have adopted open web technologies like WebGL and 3D CSS. With these technologies, web developers can create cool 3D effects for their web applications, and we can experience them without needing additional plug-ins. On top of that, many modern browsers now take advantage of a technique known as hardware-acceleration. This means that the browser can use the Graphics Processing Unit, or GPU, to speed up the computations needed to display both 3D and everyday 2D web content.</p>
</div><span class="pageNumber">18</span></div></section><section class="template-inner-7 title-threed page-3 globalPage-19" style="z-index: 481; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>So why is 3D in the browser a big deal? Because now it joins HTML5, JavaScript and other nifty new technologies in the toolkit that web developers can use to create a powerful new generation of web applications. For users, this means great new ways to visualize the information we find useful, and more fun online with engaging 3D environments and games.</p>
	<p>Most importantly, 3D in the browser comes with all the goodness of web apps: you can share, collaborate, and personalize the latest apps with friends all over the world.  Definitely more data and fun that <i>everyone</i> can use.</p>
</div><span class="pageNumber">19</span></div></section><section class="template-start-4 title-old-vs-new-browsers page-1 globalPage-20" style="z-index: 480; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>A Browser Madrigal</h2><h3>or, old vs. modern browsers</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/oldvsnewbrowsers01.png" data-src="/media/illustrations/oldvsnewbrowsers01.png"></div>
<p><span>Crabbed old and modern browsers</span><span>Cannot live together:</span><span>The modern browser is faster, featureful, and more secure</span><span>The old browser is slow, and at worst, a dreadful danger</span><span>Malicious attacks it cannot endure.</span><span class="reference">(with apologies to Shakespeare)</span></p><span class="pageNumber">20</span></div></section><section class="template-inner-6 title-old-vs-new-browsers page-2 globalPage-21" style="z-index: 479; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Most of us don’t realize how much an old and out-of-date web browser can negatively impact our online lives, particularly our online safety. You wouldn’t drive an old car with bald tires, bad brakes, and an unreliable engine for years on end. It’s a bad idea to take the same chances with the web browser that you use daily to navigate to every page and application on the web.</p>
	<p>Upgrading to a modern browser — like the latest version of Mozilla Firefox, Apple Safari, Microsoft Internet Explorer, Opera, or Google Chrome — is important for three reasons:</p>
</div>
<div class="right">
	<p>First, old browsers are vulnerable to attacks, because they typically aren’t updated with the latest security fixes and features. Browser vulnerabilities can lead to stolen passwords, malicious software snuck secretly onto your computer, or worse. An up-to-date browser helps guard against security threats like phishing and malware.</p>
	<p>Second, the web evolves quickly.  Many of the latest features on today’s websites and web applications won't work with old browsers. Only up-to-date browsers have the speed improvements that let you run web pages and applications quickly, along with support for modern web technologies such as HTML5, CSS3, and fast JavaScript.</p>
</div><span class="pageNumber">21</span></div></section><section class="template-inner-3 title-old-vs-new-browsers page-3 globalPage-22" style="z-index: 478; display: none; width: 0px;"><div class="page">﻿<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/oldvsnewbrowsers02.png" data-src="/media/illustrations/oldvsnewbrowsers02.png"></div>
<p>Third and last, old browsers slow down innovation on the web.  If lots of Internet users cling to old browsers, web developers are forced to design websites that work with both old and new technologies. Facing limited time and resources, they end up developing for the lowest common denominator — and not building the next generation of useful, groundbreaking web applications. (Imagine if today’s highway engineers were required to design high-speed freeways that would still be perfectly safe for a Model T.) That’s why outdated browsers are bad for users overall and bad for innovation on the web.</p><span class="pageNumber">22</span></div></section><section class="template-inner-2 title-old-vs-new-browsers page-4 globalPage-23" style="z-index: 477; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Not that anyone blames you personally for staying loyal to your aging browser. In some cases, you may be unable to upgrade your browser. If you find that you’re blocked from upgrading your browser on your corporate computer, have a chat with your IT administrator. If you can’t upgrade an old version of Internet Explorer, the Google Chrome Frame plug-in can give you the benefits of some modern web app functionality by bringing in Google Chrome’s capabilities into Internet Explorer.</p>
	<p>Old, outdated browsers are bad for us as users, and they hold back innovation all over the web. So take a moment to make sure that you’ve upgraded to the latest version of your favorite modern browser.</p>
</div>
<div class="right">
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/oldvsnewbrowsers03.png" data-src="/media/illustrations/oldvsnewbrowsers03.png"></div>
	<p class="note continuation">Editor’s note: To check which browser you’re using, visit <a href="http://www.whatbrowser.org/">www.whatbrowser.org</a>.</p>
</div><span class="pageNumber">23</span></div></section><section class="template-start-7 title-plugins page-1 globalPage-24" style="z-index: 476; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Plug-ins</h2><h3>or, pepperoni for your cheese pizza</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/plugins.png" data-src="/media/illustrations/plugins.png"></div>
<div class="left">
	<p class="drop-cap">In the early days of the World Wide Web, the first versions of HTML couldn’t deliver fancy content like videos. Text, images, and links were pretty much the limit.</p>
	<p>Plug-ins were invented to work around the limitations of early HTML and deliver more</p>
</div>
<div class="right">
	<p class="continuation">interactive content. A plug-in is an additional piece of software that specializes in processing particular types of content. For example, users may download and install a plug-in like Adobe Flash Player to view a web page which contains a video or an interactive game.</p>
</div><span class="pageNumber">24</span></div></section><section class="template-inner-2 title-plugins page-2 globalPage-25" style="z-index: 475; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>How much does a plug-in interface with a browser? Curiously, hardly at all. The plug-in model is a lot like picture-in-a-picture on TV: the browser defines a distinct space on the web page for the plug-in, then steps aside.  The plug-in is free to operate inside that space, independent of the browser.</p>
	<p>This independence means that a particular plug-in can work across many different browsers. However, that ubiquity also makes plug-ins prime targets for browser security attacks. Your computer is even more vulnerable to security attacks if you’re running plug-ins that aren't up to date, because out-of-date plug-ins don’t contain the latest security fixes.</p>
	<p>The plug-in model we use today is largely the one inherited from the web’s early days. But the web community is now looking at new</p>
</div>
<div class="right">
	<p class="continuation">ways to modernize plug-ins — like clever ways to integrate plug-ins more seamlessly so that their content is searchable, linkable, and can interact with the rest of the web page. More importantly, some browser vendors and plug-in providers now collaborate to protect users from security risks. For example, the Google Chrome and Adobe Flash Player teams have worked together to integrate Flash Player into the browser. Chrome’s auto-update mechanism helps ensure that the Flash Player plug-in is never out-of-date and always receives the latest security fixes and patches.</p>
</div><span class="pageNumber">25</span></div></section><section class="template-start-5 title-browser-extensions page-1 globalPage-26" style="z-index: 474; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Browser Extensions </h2><h3>or, superpowers for your browser</h3></div><div class="left">
	
	<p class="drop-cap">Browser extensions let you add new features to your 
	browser — literally <i>extending</i> your browser.</p>
	
	<p>This means that you can customize your browser with the features that 
	are most important to you. Think of extensions as ways of adding new 
	superpowers to what the browser can already do.</p>
	
	<p>These superpowers can be mighty or modest, depending on your needs. For 
	example, you might install a currency converter extension that shows up as 
	a new</p>
</div>
<div class="right">
	<p class="continuation">button next to your browser’s address bar. Click 
	the button and it converts all the prices on your current web page into 
	any currency you specify. That’s helpful if you’re an avid backpacker who 
	does most of your travel planning and booking online. Extensions like these 
	let you apply the same kind of functionality to every web page you visit.</p>
	
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/browserextensions.png" data-src="/media/illustrations/browserextensions.png"></div>
</div><span class="pageNumber">26</span></div></section><section class="template-inner-5 title-browser-extensions page-2 globalPage-27" style="z-index: 473; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Browser extensions can also act on their own, outside of web pages. 
	An email notifier extension can live on your browser toolbar, quietly 
	check for new messages in your email account and let you know when one 
	arrives. In this case, the extension is always working in the 
	background no matter what web page you’re looking at — and you don’t 
	have to log in to your email in a separate window to see if you have 
	new messages.</p>
</div>
<div class="right">
	<p>When browser extensions were first introduced, developers often had 
	to build them in unusual programming languages or in heavy-duty 
	mainstream languages like C++. This took a lot of work, time and 
	expertise. Adding more code to the browser also added to security 
	concerns, as it gave attackers more chances to exploit the browser. 
	Because the code was sometimes arcane, extensions were notorious for 
	causing browser crashes, too.</p>
	
	<p>Today, most browsers let developers write extensions in the basic, 
	friendly programming languages of the web: HTML, JavaScript and CSS. 
	Those are the same languages used to build most modern web apps and web 
	pages, so today’s extensions are much closer cousins to the web apps and 
	pages they work with. They’re faster and easier to build, safer, and get 
	better and better right along with the web standards they’re built upon.</p>
</div><span class="pageNumber">27</span></div></section><section class="template-inner-2 title-browser-extensions page-3 globalPage-28" style="z-index: 472; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>To discover new extensions, check out your browser’s extensions 
	gallery. You’ll see thousands of extensions that can help make browsing 
	more efficient or just plain fun — from extensions that let you highlight 
	and scribble notes on web pages while you’re doing research, to those that 
	show nail-biting, play-by-play sports updates from your browser’s interface.</p>
</div>
<div class="right">
</div><span class="pageNumber">28</span></div></section><section class="template-start-7 title-sync page-1 globalPage-29" style="z-index: 471; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Synchronizing the Browser</h2><h3>or, why it's ok for a truck to crush your laptop, part II</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/sync01.png" data-src="/media/illustrations/sync01.png"></div>
<div class="left">
	<p class="drop-cap">So you’re living in “the cloud”: congratulations! You use web apps for email, music, and almost everything. You save critical documents, photos, and files online where you can reach them from any Internet-connected computer, anywhere in the world.</p>
</div>
<div class="right">
	<p>If an 18-wheel truck comes roaring down the road and crushes your laptop to bits, all is not lost. You just find another Internet-connected device and get back to working with all that vital information you so smartly saved online.</p>
</div><span class="pageNumber">29</span></div></section><section class="template-inner-2 title-sync page-2 globalPage-30" style="z-index: 470; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>But wait: What about all the bookmarks, browser extensions, and browser preferences that you use daily? Did they get crunched into oblivion along with your laptop?</p>
	<p>The answer used to be “yes.”  You’d have to forage for your favorite extensions all over again and gather all the websites you had painstakingly bookmarked. But no more! Many of today’s browsers, such as Firefox and Chrome, have begun building in a feature known as <strong>synchronization</strong> (“sync” for short). Sync lets you save your browser settings online, in the cloud, so they aren’t lost even if your computer melts down.</p>
	<p>Sync functionality also makes life simpler if you use multiple computers, say, a laptop at work and a family desktop at home. You don’t have to manually recreate bookmarks of your favorite websites or reconfigure the browser</p>
</div>
<div class="right">
	<p class="continuation">settings on every computer you own. Any changes you make to your sync-enabled browser on one computer will automatically appear in all other synced computers within seconds.</p>
	<p>In Chrome, for example, sync saves all bookmarks, extensions, preferences and themes to your Google Account. Use any other Internet-connected computer, and all you need to do is fire up Chrome and log in to your Google Account through the browser’s sync feature. <i>Voila!</i> All your favorite browser settings are ready to use on the new machine.</p>
	<p>Regardless of how many computers you need to juggle, as long as you have an Internet connection and a modern browser that’s synced to the cloud, you’re all set to go. Even if every one of them gets hit by the proverbial truck.</p>
</div><span class="pageNumber">30</span></div></section><section class="template-start-5 title-browser-cookies page-1 globalPage-31" style="z-index: 469; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Browser Cookies</h2><h3>or, thanks for the memories</h3></div><div class="left">
	
	<p class="drop-cap"><i>Cookie</i> seems like an unlikely name for a piece of 
	technology, but cookies play a key role in providing functionality that Internet 
	users may want from websites: a memory of visits, in the past or in progress.</p>
	
	<p>A cookie is a small piece of text sent to your browser by a website you visit. 
	It contains information about your visit that you may want the site to remember, 
	like your preferred language and other settings. The browser stores this data and 
	pulls it out the next time you visit the site to make the next trip easier and more 
	personalized. If you visit</p>
</div>
<div class="right">
	<p class="continuation">a movie website and indicate that you’re most interested in 
	comedies, for instance, the cookies sent by the website can remember this so you may 
	see comedies displayed at the start of your next visit.</p>
	
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/cookies01.png" data-src="/media/illustrations/cookies01.png"></div>
	
	<p>Online shopping carts also use cookies. As you browse for DVDs on that movie 
	shopping site, for instance, you may notice that you can add them to your shopping 
	cart without</p>
</div><span class="pageNumber">31</span></div></section><section class="template-inner-2 title-browser-cookies page-2 globalPage-32" style="z-index: 468; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">logging in. Your shopping cart doesn’t “forget” the 
	DVDs, even as you hop around from page to page on the shopping site, because 
	they’re preserved through browser cookies. Cookies can be used in online 
	advertising as well, to remember your interests and show you related ads 
	as you surf the web.</p>
	
	<p>Some people prefer not to allow cookies, which is why most modern browsers 
	give you the ability to manage cookies to suit your tastes. You can set up 
	rules to manage cookies on a site-by-site basis, giving you greater control 
	over your privacy. What this means is that you can choose which sites you 
	trust and allow cookies only for those sites, blocking cookies from everyone 
	else. Since there are many types of cookies — including “session-only cookies” 
	that last only for a particular browsing session, or permanent cookies that 
	last for multiple sessions — modern browsers</p>
</div>
<div class="right">
	<p class="continuation">typically give you fine-tuned controls so that you 
	can specify your preferences for different types of cookies, such as accepting 
	permanent cookies as session-only.</p>
	
	<p>In the Google Chrome browser, you’ll notice a little something extra in the 
	Options menus: a direct link to the Adobe Flash Player storage settings manager. 
	This link makes it easy to control local data stored by Adobe Flash Player 
	(otherwise commonly known as "Flash cookies"), which can contain information 
	on Flash-based websites and applications that you visit. Just as you can manage 
	your browser cookies, you should be able to easily control your Flash cookies 
	settings as well.</p>
</div><span class="pageNumber">32</span></div></section><section class="template-start-7 title-browser-privacy page-1 globalPage-33" style="z-index: 467; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Browsers and Privacy</h2><h3>or, giving you choices to protect your privacy in the browser</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/browserprivacy01.png" data-src="/media/illustrations/browserprivacy01.png"></div>
<div class="left">
	<p class="drop-cap">Security and privacy are closely related, but 
	not identical.</p>
	
	<p>Consider the security and privacy of your home: door locks and alarms 
	help protect you from burglars, but curtains and blinds keep</p>
</div>
<div class="right">
	<p class="continuation">your home life private from passersby.</p>
	
	<p> In the same way, browser security helps protect you from malware, 
	phishing, and other online attacks, while privacy features help keep 
	your browsing private on your computer.</p>
</div><span class="pageNumber">33</span></div></section><section class="template-inner-6 title-browser-privacy page-2 globalPage-34" style="z-index: 466; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Let’s look more closely at privacy. Here’s an analogy: Say you’re 
	an avid runner who jogs a few miles every day. If you carry a GPS 
	device to help you track your daily runs, you create a diary of 
	running data on your device — a historical record of where you run, 
	how far you run, your average speed, and the calories you burn.</p>
	
	<p>As you browse the web, you generate a similar diary of <i>browser</i> 
	data that is stored locally on your computer: a history of the sites you 
	visit, the cookies sent to your browser, and any files you download. If 
	you’ve asked your browser to remember your passwords or form data, that’s 
	stored on your computer too.</p>
</div>
<div class="right">
	<p>Some of us may not realize that we can clear all this browser data 
	from our computers at any time. It’s easy to do through a browser’s 
	Options or Preferences menu. (The menu differs from browser to browser.) 
	In fact, the latest versions of most modern browsers also offer a “private” 
	or “incognito” mode. For example, in Chrome’s incognito mode, any web page 
	that you view won’t appear in your browsing history. In addition, all new 
	cookies are deleted after you close all the incognito windows that you’ve 
	opened. This mode is especially handy if you share your computer with 
	other people, or if you work on a public computer in your local library 
	or cybercafe.</p>
</div>
<span class="pageNumber">34</span></div></section><section class="template-inner-4 title-browser-privacy page-3 globalPage-35" style="z-index: 465; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>All these privacy features in the browser give you control over 
	the browsing data locally on your computer or specific data that 
	are sent by your browser to websites. Your browser’s privacy settings 
	do not control other data that these websites may have about you, 
	such as information you previously submitted on the website.</p>
	
	<p>There are ways to limit some of the information that websites 
	receive when you visit them. Many browsers let you control your 
	privacy preferences on a site-by-site basis and make your own choices 
	about specific data such as cookies, JavaScript, and plugins. For 
	instance, you can set up rules to allow cookies only for a specified 
	list of sites that you trust, and instruct the browser to block 
	cookies for all other sites.</p>

<p>There’s always a bit of tension between privacy and efficiency.  
Collecting real-world aggregate data and feedback from users can 
</p>
</div>
<div class="right">

<p class="continuation">really help improve products and the user experience. The key is 
finding a good balance between the two while upholding strong 
privacy standards.</p>

<p>Here’s an example from the real world: browser cookies. On one 
hand, with cookies, a website you frequently visit is able to remember 
contents of your shopping cart, keep you logged in, and deliver a 
more useful, personalized experience based on your previous visits. 
On the other hand, allowing browser cookies means that the website is 
collecting and remembering information about these previous visits. 
If you wish, you can choose to block cookies at any time. So the next 
time you’re curious about fine-tuning your browser privacy settings, 
check out the privacy settings in your browser’s Options or 
Preferences menu.</p>

</div><span class="pageNumber">35</span></div></section><section class="template-inner-7 title-browser-privacy page-4 globalPage-36" style="z-index: 464; display: none; width: 0px;"><div class="page"><span class="pageNumber">36</span></div></section><section class="template-start-2 title-malware page-1 globalPage-37" style="z-index: 463; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Malware, Phishing, and Security Risks</h2><h3>or, if it quacks like a duck but isn't a duck</h3></div><p class="drop-cap">When you use an ATM downtown, you probably glance over your shoulder to make sure nobody is lurking around to steal your PIN number (or your cash). In fact, you probably first check to make sure that you’re not using a fake ATM machine. When you browse the web and perform transactions online, two security risks to be aware of are malware and phishing.  These attacks are perpetrated by individuals or organizations who hope to steal your personal information or hijack your computer.</p>
<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/malware01.png" data-src="media/malware01.png"></div><span class="pageNumber">37</span></div></section><section class="template-inner-5 title-malware page-2 globalPage-38" style="z-index: 462; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">What exactly are phishing and malware attacks?</p>
	<p>Phishing takes place when someone masquerades as someone else, often with a fake website, to trick you into sharing personal information.  (It’s called “phishing” because the bad guys throw out electronic bait and wait for someone to bite.)  In a typical phishing scam, the attacker sends an email that looks like it’s from a bank or familiar web service you use. The subject line might say, “Please update your information at your bank!” The email contains phishing links that look like they go to your bank’s website, but really take you to an impostor website. There you’re asked to log in, and inadvertently reveal your bank account number, credit card numbers, passwords, or other sensitive information to the bad guys.</p>
</div>
<div class="right">
	<p>Malware, on the other hand, is malicious software installed on your machine, usually without your knowledge.  You may be asked to download an anti-virus software that is actually a virus itself. Or you may visit a page that installs software on your computer without even asking. The software is really designed to steal credit card numbers or passwords from your computer, or in some cases, harm your computer. Once the malware is on your computer, it’s not only difficult to remove, but it’s also free to access all the data and files it finds, send that information elsewhere, and generally wreak havoc on your computer.</p>
</div><span class="pageNumber">38</span></div></section><section class="template-inner-2 title-malware page-3 globalPage-39" style="z-index: 461; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>An up-to-date, modern web browser is the first line of defense against phishing and malware attacks.  Most modern browsers, for instance, can help analyze web pages to look for signs of lurking malware, and alert you when they find it.</p>
	<p>At the same time, an attacker may not always use sophisticated technical wizardry to hijack your computer, but could instead find clever ways to trick you into making a bad decision. In the next few chapters, we’ll look at how you can make wiser decisions to protect yourself when you’re online -- and how browsers and other web technologies can help.</p>
</div><span class="pageNumber">39</span></div></section><section class="template-start-2 title-browser-protection page-1 globalPage-40" style="z-index: 460; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>How Modern Browsers Help Protect You From Malware and Phishing</h2><h3>or, beware the ne'er-do-wells!</h3></div>
<p class="drop-cap">An up-to-date browser guards you from phishing 
and malware attacks when you’re browsing the web. It does so by 
limiting three types of security risk when you’re online:</p>

<h4>Risk 1: How often you come into contact with an attacker</h4>

<p class="continuation">You can be exposed to attackers through a 
malicious fake website, or even through a familiar website that has 
been hacked. Most modern browsers pre-check each web page you visit 
and alert you if one is suspected of being malicious. This lets you 
make an informed judgment about whether you really want to visit 
that page.</p>

<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/browserprotection01.png" data-src="media/browserprotection01.png"></div><span class="pageNumber">40</span></div></section><section class="template-inner-2 title-browser-protection page-2 globalPage-41" style="z-index: 459; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>For example, Google Chrome uses Safe Browsing technology, which is also used in several other modern browsers. As you browse the web, each page is checked quickly against a list of suspected phishing and malware websites. This list is stored and maintained locally on your computer to help protect your browsing privacy. If a match against the local list is found, the browser then sends a request to Google for more information. (This request is completely obscured and the browser does not send it in plain text.) If Google verifies the match, Chrome shows a red warning page to alert you that the page you're trying to visit may be dangerous.</p>
	<h4>Risk 2: How vulnerable your browser is if it’s attacked</h4>
	<p class="continuation">Old browsers that haven’t been upgraded are likely to have security vulnerabilities that attackers can exploit. All outdated software,</p>
</div>
<div class="right">
	<p class="continuation">irrespective of whether it’s your operating system, browser, or plug-ins, has the same problem.  That’s why it’s important to use the very latest version of your browser and promptly install security patches on your operating system and all plug-ins, so that they’re always up-to-date with the latest security fixes.</p>
	<p>Some browsers check for updates automatically and install updates when initiated by the user. Chrome and some other browsers go one step further: they’re built with auto-update. The browser runs an update check periodically, and automatically updates to the latest version without disrupting your browsing flow. Furthermore, Chrome has integrated Adobe Flash Player and a PDF viewer into the browser, so that both these popular plug-ins are also auto-updated.</p>
</div><span class="pageNumber">41</span></div></section><section class="template-inner-2 title-browser-protection page-3 globalPage-42" style="z-index: 458; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<h4>Risk 3: How much damage is done if an attacker finds 
	vulnerabilities in your browser</h4>
	
	<p class="continuation">Some modern browsers like Chrome and 
	Internet Explorer are built with an added layer of protection 
	known as a “sandbox.” Just as a real-life sandbox has walls to 
	keep sand from spilling out, a browser sandbox builds a contained 
	environment to keep malware and other security threats from 
	infecting your computer. If you open a malicious web page, the 
	browser’s sandbox prevents that malicious code from leaving the 
	browser and installing itself to your hard drive. The malicious 
	code therefore cannot read, alter, or further damage the data on 
	your computer.</p>
	
	<p>In summary, a modern browser can protect you against online 
	security threats by first, checking websites you’re about to visit 
	for suspected malware and phishing; second, providing update 
	notifications or auto-updating</p>
</div>
<div class="right">
	<p class="continuation">when a newer, more secure version of the 
	browser is available, and third, using the browser sandbox to curb 
	malicious code from causing further damage to your computer.</p>
	
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/browserprotection02.png" data-src="media/browserprotection02.png"></div>
	
	<p>In the next few chapters, we’ll take a look at how a basic 
	understanding of web addresses can help you make informed decisions 
	about the websites you visit.</p>
</div><span class="pageNumber">42</span></div></section><section class="template-start-7 title-url page-1 globalPage-43" style="z-index: 457; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Using Web Addresses to Stay Safe</h2><h3>or, 'my name is URL'</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/url01.png" data-src="/media/illustrations/url01.png"></div>
<div class="left">
	<p class="drop-cap">A Uniform Resource Locator — better known as a URL — may sound like a complicated thing. But fret not: it’s simply the web address you type into your browser to get to a particular web page or web application.</p>
</div>
<div class="right">
	<p>When you enter a URL, the website is fetched from its hosting server somewhere in the world, transported over miles of cables to your local Internet connection, and finally displayed by the browser on your computer.</p>
</div><span class="pageNumber">43</span></div></section><section class="template-inner-2 title-url page-2 globalPage-44" style="z-index: 456; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">Here are a few examples of a URL:</p>
	<div class="url-image"><img src="./20 Things I Learned About Browsers and the Web_files/url_b1.png" data-src="media/url_b1.png"></div>
	<p class="continuation">...to get to the news website for the British Broadcasting Corporation (“.co.uk” indicates registration in the United Kingdom)</p>
	<div class="url-image"><img src="./20 Things I Learned About Browsers and the Web_files/url_b2.png" data-src="media/url_b2.png"></div>
	<p class="continuation">...to get to the search engine Google</p>
	<div class="url-image"><img src="./20 Things I Learned About Browsers and the Web_files/url_b3.png" data-src="media/url_b3.png"></div>
	<p class="continuation">...to get to the website for Museo Nacional Del Prado, the Madrid-based art museum. (“.es” indicates registration in Spain)</p>
	<div class="url-image"><img src="./20 Things I Learned About Browsers and the Web_files/url_b4.png" data-src="media/url_b4.png"></div>
	<p class="continuation">...to get to the online banking website for Bank of America (“https://” indicates an encrypted connection)</p>
</div>
<div class="right">
</div><span class="pageNumber">44</span></div></section><section class="template-inner-2 title-url page-3 globalPage-45" style="z-index: 455; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>It’s easy to take URLs for granted, since we type them into our browsers every day.  But understanding the parts of a URL can help guard against phishing scams or security attacks.</p>
	<p class="continuation">Let’s look at what’s in a URL in this example:</p>
	<div class="url-breakdown">
		<span class="url">http://www.google.com/maps</span>
		<span class="figure-1">scheme</span>
		<span class="figure-2">hostname</span>
		<span class="figure-3">path</span>
		<span class="figure-4">top level domain</span>
	</div>
	<p>The first part of a URL is called the <strong>scheme</strong>. In the example above, HTTP is the scheme and shorthand for HyperText Transfer Protocol.</p>
</div>
<div class="right">
	<p>Next, “www.google.com” is the name of the <strong>host</strong> where the website resides. When any person or company creates a new web site, they register this hostname for themselves. Only they may use it. This is important, as we’ll see in a moment.</p>
	<p>A URL may have an additional <strong>path</strong> after the hostname, which sends you to a specific page on that host — like jumping right to a chapter or page in a book. Back to our example, the path tells the host server that you want to see the maps web application at www.google.com. (In other words, Google Maps.)  Sometimes that path is moved to the front of the hostname as a subdomain, such as “maps.google.com”, or “news.google.com” for Google News.</p>
</div><span class="pageNumber">45</span></div></section><section class="template-inner-6 title-url page-4 globalPage-46" style="z-index: 454; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Now let’s talk safety.  One way to check if you’re surfing right into a phishing scam or an impostor website is by looking carefully at the URL in your browser’s address bar.  Pay particular attention to the hostname — remember, only the legitimate owner of that hostname can use it.</p>
	<p>For example, if you click on a link and expect to be directed to the Bank of America website:</p>
	<h4>LEGITIMATE:</h4>
	<ul>
		<li>www.<span class="highlight">bankofamerica</span>.com is a legitimate URL, since the hostname is correct.</li>
		<li>www.<span class="highlight">bankofamerica</span>.com/smallbusiness is also a legitimate URL since the hostname is correct. The path of the URL points to a sub-page on small business.</li>
	</ul>
</div>
<div class="right">
	<h4>SUSPICIOUS:</h4>
	<ul>
		<li><span class="highlight">bankofamerica</span>.xyz.com is not Bank of America’s website. Instead, “bankofamerica” is a subdomain of the website xyz.com.</li>
		<li>www.xyz.com/<span class="highlight">bankofamerica</span> is still not Bank of America's website. Instead, “bankofamerica” is a path within www.xyz.com.</li>
	</ul>
	<p>If you’re using a banking website or conducting an online transaction with sensitive information such as your password or account number, check the address bar first! Make sure that the scheme is “<strong>https://</strong>” and there’s a padlock icon in your browser’s address bar. “https://” indicates that the data is being transported between the server and browser using a secure connection.</p>
</div><span class="pageNumber">46</span></div></section><section class="template-inner-2 title-url page-5 globalPage-47" style="z-index: 453; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Through a secure connection, the full URL for Bank of America’s website should look like this: <strong>https://</strong>www.bankofamerica.com. A secure connection ensures that no one else is eavesdropping or interfering with the sensitive information that you’re sending. So “https://” is a good sign. But remember, it’s still important to make sure that you’re actually talking to a legitimate website by checking the hostname of a URL. (It would defeat the purpose to have a secure connection to a bogus website!)</p>
	<p>In the next chapter, we’ll look at how a typed URL into the browser’s address bar takes you to the right web page.</p>
</div>
<div class="right">
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/url02.png" data-src="media/url02.png"></div>
</div><span class="pageNumber">47</span></div></section><section class="template-start-7 title-dns page-1 globalPage-48" style="z-index: 452; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>IP Addresses and DNS</h2><h3>or, the phantom phone booth</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/dns01.png" data-src="/media/illustrations/dns01.png"></div>
<div class="left">
	<p class="drop-cap">Do you wonder how your browser finds the right web page when you type a URL into its address bar?</p>
	<p>Every URL (say, “www.google.com”) has its own numbered Internet Protocol or IP address.</p>
</div>
<div class="right">
	<p class="continuation">An IP address looks something like this:</p>
	<span class="ip-address"><strong>74.125.19.147</strong></span>
	<p>An IP address is a series of numbers that tells us where a particular device is on the Internet network, be it the google.com server or</p>
</div><span class="pageNumber">48</span></div></section><section class="template-inner-5 title-dns page-2 globalPage-49" style="z-index: 451; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">your computer. It’s a bit like mom’s phone number: just as the phone number tells an operator which house to route a call to so it reaches your mom, an IP address tells your computer which other device on the Internet to communicate with — to send data to and get data from.</p>
	<p>Your browser doesn’t automatically know every IP address for the 35 billion (or more) devices on the planet that are connected on the Internet. It has to look each one up, using something called the Domain Name System. The DNS is essentially the “phone book” of the Web:  while a phone book translates a name like “Acme Pizza” into the right phone number to call, the DNS translates a URL or web address (like “www.google.com”) into the right IP address to contact (like “74.125.19.147”) in order to get the information that you want (in this case, the Google homepage).</p>
</div>
<div class="right">
	<p>So when you type in “google.com” into your web browser, the browser looks up google.com’s IP address through a DNS and contacts it, waits for a response to confirm the connection, and then sends your request for google.com’s web page to that IP address. Google’s server at that IP address will then send back the requested web page to your computer’s IP address for your browser to display.</p>
</div><span class="pageNumber">49</span></div></section><section class="template-inner-2 title-dns page-3 globalPage-50" style="z-index: 450; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>In many ways, fetching and loading a web page in the browser is not unlike making a phone call. When you make a phone call, you’d probably look up the number, dial, wait for someone to pick up, say “hello,” and wait for a response before you start the conversation. Sometimes you have to redial if there are problems connecting. On the web, a similar process happens in a split-second; all you see is that you’ve typed “www.google.com” into the browser and the Google home page appears.</p>
	<p>In the next chapter, we’ll look at how we can verify the identity of a website that we fetch and load in the browser through the <strong>extended validation certificate</strong>.</p>
</div>
<div class="right">
</div><span class="pageNumber">50</span></div></section><section class="template-start-5 title-identity page-1 globalPage-51" style="z-index: 449; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Validating Identities Online</h2><h3>or,  "Dr. Livingstone, I presume?"</h3></div><div class="left">
	<p class="drop-cap">In the physical world, you can see the people you share information with. You talk to them face-to-face, or meet them in a trusted place like a bank branch. That’s how you make your first judgments about giving them your trust.</p>
	<p>But online, it can be hard to tell who’s behind any website. The visual cues we normally rely on can be faked. For example, a phony webpage could copy the logo, icon, and</p>
</div>
<div class="right">
	<p class="continuation">design of your own bank’s website — almost as if they had set up a fake storefront on your block.</p>
	<p>Fortunately, there are tools to help you determine if a website is genuine or not. Some websites have an <strong>extended validation certificate</strong> that allows you to determine the</p>
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/identity01.png" data-src="media/identity01.png"></div>
</div><span class="pageNumber">51</span></div></section><section class="template-inner-5 title-identity page-2 globalPage-52" style="z-index: 448; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">name of the organization that runs the web site. The extended validation certificate gives you the information you need to help ensure that you’re not entrusting your information to a fake website.</p>
	<p>Here’s an example of extended validation in action in the browser. On a bank’s website that has been verified through extended validation, the bank’s name is displayed in a green box between the lock icon and the web address in the address bar:</p>
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/identity02.png" data-src="media/identity02.png"></div>
	<span class="image-description">Example of the extended validation indicator in Chrome</span>
</div>
<div class="right">
	<p>On most browsers, the extended validation indicator can be found by looking for the name of the organization in the green section of the browser’s address bar. You can also click on the indicator to see the website’s security information and inspect its digital certificate.</p>
</div><span class="pageNumber">52</span></div></section><section class="template-inner-7 title-identity page-3 globalPage-53" style="z-index: 447; display: none; width: 0px;"><div class="page">﻿<p>To receive extended validation certification, a website owner has to pass a series of checks confirming their legal identity and authority. In the previous example, extended validation on bankofamerica.com verifies that yes, the website is from the actual Bank of America. You can think of this certification as something that ties the domain name of the web address back to some real-world identity.</p>
<p>It’d be wise to share sensitive information with a website only if you trust the organization responsible for the site. So the next time you’re about to perform a sensitive transaction, take a moment to keep a look out for the website’s security information.  You’ll be glad you did.</p><span class="pageNumber">53</span></div></section><section class="template-start-7 title-page-load page-1 globalPage-54" style="z-index: 446; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Evolving to a Faster Web</h2><h3>or, speeding up images, video, and JavaScript on the web</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/pageload01.png" data-src="/media/illustrations/pageload01.png"></div>
<div class="left">
	<p class="drop-cap">The web today is an amazing visual and interactive stew, teeming with images, photos, videos, and whizzy web apps. Some of the web’s most vivid experiences come from images and videos, from shared photo albums</p>
</div>
<div class="right">
	<p class="continuation">of family vacations to online video coverage from journalists in war zones.</p>
	<p>It’s a far cry from the simple text and links that started it all. And it means that every time</p>
</div><span class="pageNumber">54</span></div></section><section class="template-inner-6 title-page-load page-2 globalPage-55" style="z-index: 445; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation"> your browser loads a web page, much more data and complex code needs to be processed.</p>
	<p>How much more, and how much more complex? A few astounding statistics:</p>
	<ul>
		<li>Images and photos now make up about <strong>65% of the information</strong> on a typical web page, in terms of bytes per page.</li>
		<li><strong>35 hours of video</strong> are uploaded to YouTube every minute of the day. (That’s like Hollywood releasing 130,000 new full-length movies every week, though with less popcorn.)</li>
		<li>JavaScript programs have grown from a few lines to <strong>several hundred kilobytes</strong> of source code that must be processed each time a web page or application loads.</li>
	</ul>
</div>
<div class="right">
	<p>So won’t all these gushing floods of data slow down page loads on the browser? Will the Internet clog up and turn to molasses soon?</p>
	<p>Probably not. Images and photos became commonplace on the web when computer scientists found ways to compress them into smaller files that could be sent and downloaded more easily. GIF and JPEG were the most popular of those early file-compression systems. Meanwhile, plug-ins were invented to work around the early limitations of HTML so that video could be embedded and played in web pages.</p>
</div><span class="pageNumber">55</span></div></section><section class="template-inner-2 title-page-load page-3 globalPage-56" style="z-index: 444; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p>Looking ahead, the &lt;video&gt; tag in HTML5 makes it easy for videos to be embedded and played in web pages. Google is also collaborating with the web community on WebM, an effort to build out a free, open-source video format that adapts to the computing power and bandwidth conditions on the web, so quality video can be delivered to a computer in a farm house in Nebraska or a smartphone in Nairobi.</p>
	<p>In the meantime, it’s true that web pages with lots of big photos or other images can still be very slow to load. That’s why a few engineers at Google have been experimenting with new ways to compress images even further while keeping the same image quality and resolution. The early results? Very promising. They’ve come up with a new image format called WebP that cuts down the average image file size by 39%.</p>
</div>
<div class="right">
	<p>The engines that run JavaScript code in modern web browsers have also been redesigned to process code faster than ever before. These fast JavaScript engines, such as Google Chrome’s V8, are now a core part of any modern web browser. That means the next generation of fabulously useful JavaScript-based web applications won’t be hampered by the complexity of more JavaScript code.</p>
	<p>Another technique that modern browsers like Chrome use to fetch and load web pages much more quickly is called “DNS pre-resolution”. The process of translating a web address into an IP address through a DNS lookup, or vice versa, is often called “resolving.” With DNS pre-resolution, Chrome will simultaneously look up all the other links on the web page and pre-resolve those links into IP addresses in the background. So when</p>
</div><span class="pageNumber">56</span></div></section><section class="template-inner-2 title-page-load page-4 globalPage-57" style="z-index: 443; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation">you do actually click on one of the links on the page, the browser is ready to take you to the new page instantly. Over time, Chrome also learns from past visits so that the next time you go to a web page that you’ve previously visited, Chrome knows to automatically pre-resolve all the relevant links and elements on the web page.</p>
	<p>Someday, browsers might be able to predict, <i>before</i> the page loads, not only which links to pre-resolve, but also which website elements (like images or videos) to pre-fetch ahead of time.  That will make the web even quicker.</p>
	<p>Soon enough, we hope, loading new pages on the browser will be as fast as flipping the pages of a picture book.</p>
</div>
<div class="right">
</div><span class="pageNumber">57</span></div></section><section class="template-start-7 title-open-source page-1 globalPage-58" style="z-index: 442; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>Open Source and Browsers</h2><h3>or, standing on the shoulders of giants</h3></div><div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/opensource01.png" data-src="/media/illustrations/opensource01.png"></div>
<div class="left">
	<p class="drop-cap">Today’s Internet stands on the shoulders of giants: the technologists, thinkers, developers, and organizations who continue to push the boundaries of innovation and share what they’ve learned.</p>
	<p>This spirit of sharing is at the very heart of</p>
</div>
<div class="right">
	<p class="continuation">open-source software. “Open source” means that the inner workings (or “source code”) of a software are made available to all, and the software is written in an open, collaborative way. Anyone can look into the source code, see how it works, tweak it or add to it, and reuse it</p>
</div><span class="pageNumber">58</span></div></section><section class="template-inner-2 title-open-source page-2 globalPage-59" style="z-index: 441; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<p class="continuation"> in other products or services.</p>
	<p>Open-source software plays a big role in many parts of the web, including today’s web browsers. The release of the open-source browser Mozilla Firefox paved the way for many exciting new browser innovations. Google Chrome was built with some components from Mozilla Firefox and with the open-source rendering engine WebKit, among others. In the same spirit, the code for Chrome was made open source so that the global web community could use Chrome’s innovations in their own products, or even improve on the original Chrome source code.</p>
	<p>Web developers and everyday users aren’t the only ones to benefit from the faster, simpler, and safer open-source browsers. Companies like Google also benefit from sharing their ideas openly. Better browsers</p>
</div>
<div class="right">
	<p class="continuation">mean a better web experience for everyone, and that makes happier users who browse the web even more.  Better browsers also let companies create web apps with the latest cutting-edge features, and that makes users happy, too.</p>
	<p>Browsers aren’t the only part of the web that can take the open-source approach. Talk to any group of web developers and you’re likely to hear that they use an open-source Apache HTTP Server to host and serve their websites, or that they developed their code on computers powered by the Linux open-source operating system — just to name a few examples. The good work of the open source community continues to help make the web even better: a web that can be the broad shoulders for the next generation.</p>
</div><span class="pageNumber">59</span></div></section><section class="template-start-5 title-conclusion page-1 globalPage-60" style="z-index: 440; display: none; width: 0px;"><div class="page"><div class="page-title"><h2>19 Things Later...</h2><h3>or, a day in the clouds</h3></div><div class="left">
	<p class="continuation">...and here we are at Thing 20. Let's recap.</p>
	<p>Today’s web is a colorful, visual, practical, nutty, busy, friend-filled, fun and incredibly useful place.  Many of us now live a life of <a href="#/cloud-computing/1">cloud computing</a> on the <a href="#/what-is-the-internet/1">Internet</a>: we read the news, watch movies, chat with friends, and do our daily tasks online with web-based applications right in the browser. <a href="#/web-apps/1">Web apps</a> let us do that from anywhere in the world, even if we left our laptops at home.</p>
	<p>It’s all possible thanks to the evolution of web standards like <a href="#/html/1">HTML, JavaScript, and CSS</a>,</p>
</div>
<div class="right">
	<p class="continuation">as well as <a href="#/plugins/1">browser plug-ins</a>. New capabilities in <a href="#/html5/1">HTML5</a> are helping developers create the next generation of truly inventive web apps.</p>
	<div class="image1"><img src="./20 Things I Learned About Browsers and the Web_files/conclusion01.png" data-src="media/conclusion01.png"></div>
	<p class="continuation">What else is taking shape in the clouds?</p>
	<ul>
		<li>It takes a <a href="#/old-vs-new-browsers/1">modern browser</a> to make the most of the web’s modern features.</li>
	</ul>
</div><span class="pageNumber">60</span></div></section><section class="template-inner-2 title-conclusion page-2 globalPage-61" style="z-index: 439; display: none; width: 0px;"><div class="page">﻿<div class="left">
	<ul>
		<li>Modern browsers also <a href="#">help protect</a> against <a href="#/malware/1">malware and phishing</a>.</li>
		<li><a href="#/open-source/1">Open-source</a> sharing has given us better browsers and a faster, richer, more complex web. And open-source brainpower is making the future of the web even brighter.</li>
		<li>What’s in that bright future? <a href="#/1">3D in the browser</a>, <a href="#">faster speeds</a>, and <a href="#/sync/1">sync</a> across all devices, among other fine <a href="#/dns/1">things</a>.</li>
		<li>Being an informed citizen of the web requires some self-education — for instance, learning to control your browser’s <a href="#/browser-privacy/1">privacy settings</a> for various types of content including <a href="#/browser-cookies/1">cookies</a>.</li>
		<li>You’re also safer on the web when you pay attention to visual cues in the browser, like checking the URLs you’re sent to, and looking for an “https://” <a href="#/url/1">secure connection</a> or <a href="#/identity/1">extended validation</a>.</li>
	</ul>
	<p>The final takeaways?</p>
</div>
<div class="right">
	<p><strong>Use a modern browser,</strong> first and foremost.  Or try a new one and see if it brings you happier browsing that’s better suited to your needs.</p>
	<p><strong>The web will keep evolving — dramatically!</strong>  Support cutting-edge web technologies like HTML5, CSS3 and WebGL, because they’ll help the web community imagine and create a future of great, innovative web apps.</p>
	<p><strong>Lastly, try new things.</strong> The web is a new and exciting place every day, so try tasks that you didn’t think could be done online -- such as researching your ancestry back ten generations, or viewing a real-time webcam image from a climbing basecamp in the Himalayas.  You might be surprised by what you find!</p>
</div><span class="pageNumber">61</span></div></section><section class="template-3 title-theend page-1 globalPage-62" style="z-index: 438; display: none; width: 0px;"><div class="page"><div class="page-title"><h2></h2></div><h2></h2>
<h3></h3>
<p></p><span class="pageNumber">62</span></div></section></div>
			<div id="left-page" style="width: 830px;">
				<img src="./20 Things I Learned About Browsers and the Web_files/left-page.jpg" data-src-flipped="/css/images/left-page-flipped.jpg" width="830" height="520">
			</div>
			<div id="right-page">
				<div id="paperstack">
					<div class="paper s1" style="opacity: 1;"></div>
					<div class="paper s2" style="opacity: 1;"></div>
					<div class="paper s3" style="opacity: 1;"></div>
					<div class="paper s4" style="opacity: 1;"></div>
					<div class="paper s5" style="opacity: 1;"></div>
					<div class="paper s6" style="opacity: 1;"></div>
					<div class="paper s7"></div>
					<div class="shadow" style="opacity: 1; margin-left: -3px;"></div>
				</div>
				<img src="./20 Things I Learned About Browsers and the Web_files/right-page.jpg" width="830" height="520">
			</div>
		<canvas id="pageflip" width="1700" height="680" style="position: absolute; top: -80px; left: -20px; z-index: 0;"></canvas></div>
		
		<nav id="chapter-nav" style="left: 269.5px; top: 600px; display: block;">
			<p>20 Things</p>
			<ul>
											
				<li class="what-is-the-internet read">
					<a href="#/what-is-the-internet" class="cnItem" title="What is the Internet?" data-title="What is the Internet?" data-subtitle="or, &#39;You Say Tomato, I Say TCP/IP&#39;" data-article="what-is-the-internet" data-globalstartpage="4" data-globalendpage="6" data-numberofpages="3">
						<div class="illustration"></div>
						<span>1</span>
					</a>
					<a class="over" href="#/what-is-the-internet" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">What is the Internet?</p>
							<p class="pagenumber">4-6</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">1</p>
						</div>
					</a>
				</li>
				
														
				<li class="cloud-computing read">
					<a href="#/cloud-computing" class="cnItem" title="Cloud Computing" data-title="Cloud Computing" data-subtitle="or, why it&#39;s ok for a truck to crush your laptop" data-article="cloud-computing" data-globalstartpage="7" data-globalendpage="8" data-numberofpages="2">
						<div class="illustration"></div>
						<span>2</span>
					</a>
					<a class="over" href="#/cloud-computing" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Cloud Computing</p>
							<p class="pagenumber">7-8</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">2</p>
						</div>
					</a>
				</li>
				
														
				<li class="web-apps read selected">
					<a href="#/web-apps" class="cnItem" title="Web Apps" data-title="Web Apps" data-subtitle="or, &#39;Life, Liberty and the Pursuit of Appiness&#39;" data-article="web-apps" data-globalstartpage="9" data-globalendpage="11" data-numberofpages="3">
						<div class="illustration"></div>
						<span>3</span>
					</a>
					<a class="over" href="#/web-apps" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Web Apps</p>
							<p class="pagenumber">9-11</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">3</p>
						</div>
					</a>
				</li>
				
														
				<li class="html read">
					<a href="#/html" class="cnItem" title="HTML, JavaScript, CSS and more" data-title="HTML, JavaScript, CSS and more" data-subtitle="or, this is not your mom&#39;s AJAX" data-article="html" data-globalstartpage="12" data-globalendpage="14" data-numberofpages="3">
						<div class="illustration"></div>
						<span>4</span>
					</a>
					<a class="over" href="#/html" style="top: -72px;">
						<div class="description" style="opacity: 0;">
							<p class="title">HTML, JavaScript, CSS and more</p>
							<p class="pagenumber">12-14</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">4</p>
						</div>
					</a>
				</li>
				
														
				<li class="html5">
					<a href="#/html5" class="cnItem" title="HTML5" data-title="HTML5" data-subtitle="or, in the beginning there was no &lt;video&gt;" data-article="html5" data-globalstartpage="15" data-globalendpage="16" data-numberofpages="2">
						<div class="illustration"></div>
						<span>5</span>
					</a>
					<a class="over" href="#/html5" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">HTML5</p>
							<p class="pagenumber">15-16</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">5</p>
						</div>
					</a>
				</li>
				
														
				<li class="threed">
					<a href="#" class="cnItem" title="3D in the Browser" data-title="3D in the Browser" data-subtitle="or, browsing with more depth" data-article="threed" data-globalstartpage="17" data-globalendpage="19" data-numberofpages="3">
						<div class="illustration"></div>
						<span>6</span>
					</a>
					<a class="over" href="#" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">3D in the Browser</p>
							<p class="pagenumber">17-19</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">6</p>
						</div>
					</a>
				</li>
				
														
				<li class="old-vs-new-browsers">
					<a href="#/old-vs-new-browsers" class="cnItem" title="A Browser Madrigal" data-title="A Browser Madrigal" data-subtitle="or, old vs. modern browsers" data-article="old-vs-new-browsers" data-globalstartpage="20" data-globalendpage="23" data-numberofpages="4">
						<div class="illustration"></div>
						<span>7</span>
					</a>
					<a class="over" href="#/old-vs-new-browsers" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">A Browser Madrigal</p>
							<p class="pagenumber">20-23</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">7</p>
						</div>
					</a>
				</li>
				
														
				<li class="plugins">
					<a href="#/plugins" class="cnItem" title="Plug-ins" data-title="Plug-ins" data-subtitle="or, pepperoni for your cheese pizza" data-article="plugins" data-globalstartpage="24" data-globalendpage="25" data-numberofpages="2">
						<div class="illustration"></div>
						<span>8</span>
					</a>
					<a class="over" href="#/plugins" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Plug-ins</p>
							<p class="pagenumber">24-25</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">8</p>
						</div>
					</a>
				</li>
				
														
				<li class="browser-extensions">
					<a href="#/browser-extensions" class="cnItem" title="Browser Extensions " data-title="Browser Extensions " data-subtitle="or, superpowers for your browser" data-article="browser-extensions" data-globalstartpage="26" data-globalendpage="28" data-numberofpages="3">
						<div class="illustration"></div>
						<span>9</span>
					</a>
					<a class="over" href="#/browser-extensions" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Browser Extensions </p>
							<p class="pagenumber">26-28</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">9</p>
						</div>
					</a>
				</li>
				
														
				<li class="sync">
					<a href="#/sync" class="cnItem" title="Synchronizing the Browser" data-title="Synchronizing the Browser" data-subtitle="or, why it&#39;s ok for a truck to crush your laptop, part II" data-article="sync" data-globalstartpage="29" data-globalendpage="30" data-numberofpages="2">
						<div class="illustration"></div>
						<span>10</span>
					</a>
					<a class="over" href="#/sync" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Synchronizing the Browser</p>
							<p class="pagenumber">29-30</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">10</p>
						</div>
					</a>
				</li>
				
														
				<li class="browser-cookies">
					<a href="#/browser-cookies" class="cnItem" title="Browser Cookies" data-title="Browser Cookies" data-subtitle="or, thanks for the memories" data-article="browser-cookies" data-globalstartpage="31" data-globalendpage="32" data-numberofpages="2">
						<div class="illustration"></div>
						<span>11</span>
					</a>
					<a class="over" href="#/browser-cookies" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Browser Cookies</p>
							<p class="pagenumber">31-32</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">11</p>
						</div>
					</a>
				</li>
				
														
				<li class="browser-privacy">
					<a href="#/browser-privacy" class="cnItem" title="Browsers and Privacy" data-title="Browsers and Privacy" data-subtitle="or, giving you choices to protect your privacy in the browser" data-article="browser-privacy" data-globalstartpage="33" data-globalendpage="36" data-numberofpages="4">
						<div class="illustration"></div>
						<span>12</span>
					</a>
					<a class="over" href="#/browser-privacy" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Browsers and Privacy</p>
							<p class="pagenumber">33-36</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">12</p>
						</div>
					</a>
				</li>
				
														
				<li class="malware">
					<a href="#/malware" class="cnItem" title="Malware, Phishing, and Security Risks" data-title="Malware, Phishing, and Security Risks" data-subtitle="or, if it quacks like a duck but isn&#39;t a duck" data-article="malware" data-globalstartpage="37" data-globalendpage="39" data-numberofpages="3">
						<div class="illustration"></div>
						<span>13</span>
					</a>
					<a class="over" href="#/malware" style="top: -72px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Malware, Phishing, and Security Risks</p>
							<p class="pagenumber">37-39</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">13</p>
						</div>
					</a>
				</li>
				
														
				<li class="browser-protection">
					<a href="#/browser-protection" class="cnItem" title="How Modern Browsers Help Protect You From Malware and Phishing" data-title="How Modern Browsers Help Protect You From Malware and Phishing" data-subtitle="or, beware the ne&#39;er-do-wells!" data-article="browser-protection" data-globalstartpage="40" data-globalendpage="42" data-numberofpages="3">
						<div class="illustration"></div>
						<span>14</span>
					</a>
					<a class="over" href="#/browser-protection" style="top: -83px;">
						<div class="description" style="opacity: 0;">
							<p class="title">How Modern Browsers Help Protect You From Malware and Phishing</p>
							<p class="pagenumber">40-42</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">14</p>
						</div>
					</a>
				</li>
				
														
				<li class="url">
					<a href="#/url" class="cnItem" title="Using Web Addresses to Stay Safe" data-title="Using Web Addresses to Stay Safe" data-subtitle="or, &#39;my name is URL&#39;" data-article="url" data-globalstartpage="43" data-globalendpage="47" data-numberofpages="5">
						<div class="illustration"></div>
						<span>15</span>
					</a>
					<a class="over" href="#/url" style="top: -72px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Using Web Addresses to Stay Safe</p>
							<p class="pagenumber">43-47</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">15</p>
						</div>
					</a>
				</li>
				
														
				<li class="dns">
					<a href="#/dns" class="cnItem" title="IP Addresses and DNS" data-title="IP Addresses and DNS" data-subtitle="or, the phantom phone booth" data-article="dns" data-globalstartpage="48" data-globalendpage="50" data-numberofpages="3">
						<div class="illustration"></div>
						<span>16</span>
					</a>
					<a class="over" href="#/dns" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">IP Addresses and DNS</p>
							<p class="pagenumber">48-50</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">16</p>
						</div>
					</a>
				</li>
				
														
				<li class="identity">
					<a href="#/identity" class="cnItem" title="Validating Identities Online" data-title="Validating Identities Online" data-subtitle="or,  &quot;Dr. Livingstone, I presume?&quot;" data-article="identity" data-globalstartpage="51" data-globalendpage="53" data-numberofpages="3">
						<div class="illustration"></div>
						<span>17</span>
					</a>
					<a class="over" href="#/identity" style="top: -72px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Validating Identities Online</p>
							<p class="pagenumber">51-53</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">17</p>
						</div>
					</a>
				</li>
				
														
				<li class="page-load">
					<a href="#/page-load" class="cnItem" title="Evolving to a Faster Web" data-title="Evolving to a Faster Web" data-subtitle="or, speeding up images, video, and JavaScript on the web" data-article="page-load" data-globalstartpage="54" data-globalendpage="57" data-numberofpages="4">
						<div class="illustration"></div>
						<span>18</span>
					</a>
					<a class="over" href="#/page-load" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Evolving to a Faster Web</p>
							<p class="pagenumber">54-57</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">18</p>
						</div>
					</a>
				</li>
				
														
				<li class="open-source">
					<a href="#/open-source" class="cnItem" title="Open Source and Browsers" data-title="Open Source and Browsers" data-subtitle="or, standing on the shoulders of giants" data-article="open-source" data-globalstartpage="58" data-globalendpage="59" data-numberofpages="2">
						<div class="illustration"></div>
						<span>19</span>
					</a>
					<a class="over" href="#/open-source" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">Open Source and Browsers</p>
							<p class="pagenumber">58-59</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">19</p>
						</div>
					</a>
				</li>
				
														
				<li class="conclusion">
					<a href="#/conclusion" class="cnItem" title="19 Things Later..." data-title="19 Things Later..." data-subtitle="or, a day in the clouds" data-article="conclusion" data-globalstartpage="60" data-globalendpage="61" data-numberofpages="2">
						<div class="illustration"></div>
						<span>20</span>
					</a>
					<a class="over" href="#/conclusion" style="top: -61px;">
						<div class="description" style="opacity: 0;">
							<p class="title">19 Things Later...</p>
							<p class="pagenumber">60-61</p>
						</div>
						<div class="small-book">
							<div class="illustration"></div>
							<p class="index">20</p>
						</div>
					</a>
				</li>
				
							
			</ul>
		</nav>
		
		<div id="overlay">
			<div class="bookmark" style="left: 674.5px; top: 340px; margin: 0px;">
				<div class="content">
					<a class="close" href="#">CLOSE</a>
					<h3>RESUME READING?</h3>
					<p>You can pick up from where you left off the last time, or start at the beginning. Do you want to:</p>
					<a class="action resume" href="#">RESUME<br>READING</a>
					<a class="action restart" href="#">GO TO THE<br>BEGINNING</a>
				</div>
			</div>
			
			<div class="print">
					<a class="close" href="#">CLOSE</a>
					<a class="printBook" href="#/en-US/all/print" _blank"="">
						<h2>Print Book</h2>
						<p>Print the book (in Letter or A4 size only)</p>
					</a>
					<a class="downloadPdf" target="_blank" href="media/20ThingsILearnedaboutBrowsersandtheWeb.pdf">
						<h2>Download PDF</h2>
						<p>Download the book in PDF. Size: 3.3MB</p>
					</a>
			</div>
		</div>
		
		<div id="credits" style="left: 354.5px; top: 85px; margin: 0px;">
			<div class="header">
				<h2><span>CREDITS</span></h2>
				<hr>
			</div>
			<div class="people">
				<ul>
					<li><h3>Illustration</h3><a href="#" target="_blank">Manjunath</a></li>
					<li><h3>Writers/Editors</h3>Manjunath</li>
					<li><h3>Project Curator</h3>Manjunath</li>
					<li><h3>Design</h3><a href="#" target="_blank">Fi</a><br><a href="#" target="_blank">Manjunath</a></li>
					<li><h3>Development</h3><a href="#" target="_blank">Fi</a></li>
				</ul>
				<h4>Very Special Thanks To</h4>
				<p class="special-thanks">=</p>
				<p class="html5-logo">Built in HTML5 <img src="./20 Things I Learned About Browsers and the Web_files/HTML5_Badge_32.png" title="Built in HTML5"></p>
			</div>
			<hr>
			<div class="share">
				<p>Share this book and what you've learned with friends and family; </p>
				<ul>
					<li class="facebook"><a href="#" title="Facebook"><span class="icon"></span><span class="text">Share On</span></a></li>
					<li class="twitter"><a href="#" title="Twitter"><span class="icon"></span><span class="text">Share On</span></a></li>
					<li class="gplus"><div id="___plusone_1" style="text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 38px; height: 24px; background-position: initial initial; background-repeat: initial initial;"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 38px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 24px;" tabindex="0" vspace="0" width="100%" id="I1_1376054403401" name="I1_1376054403401" src="./20 Things I Learned About Browsers and the Web_files/fastbutton.htm" allowtransparency="true" data-gapiattached="true" title="+1"></iframe></div></li>
				</ul>
			</div>
		</div>
		
		<div id="articleId">web-apps</div><div id="pageNumber">1</div>	<div id="pagination-prev" class="" style="top: 320px; left: 0px;"><a href="#/en-US/cloud-computing/2"><div class="arrow">LOCALE_PREVIOUS_PAGE</div></a><div class="page-progress"><p class="thing">THING 2</p><p class="number">Page <span>2/2</span></p></div></div>
	<div id="pagination-next" class="" style="top: 320px; right: auto; left: 1307px;"><a href="#/en-US/web-apps/2"><div class="arrow">LOCALE_NEXT_PAGE</div></a><div class="page-progress"><p class="thing">THING 3</p><p class="number">Page <span>2/3</span></p></div></div>
		
		<div id="table-of-contents" style="width: 1349px; opacity: 0; display: none;">
			<div class="center" style="left: 674.5px; top: 340px; margin: 0px;">
				<div class="header" style="opacity: 0;">
					<a class="go-back" href="#/">Go Back</a>
					<h2><span>Table of Things</span></h2>
					<hr>
				</div>
				<ul>
									
							<li class="what-is-the-internet read" style="opacity: 0;">
								<a href="#/what-is-the-internet" data-article="what-is-the-internet">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 1</p>
									</div>
									<h3>What is the Internet?</h3>
									<p>or, 'You Say Tomato, I Say TCP/IP'</p>
								</a>
							</li>
									
							<li class="cloud-computing read" style="opacity: 0;">
								<a href="#/cloud-computing" data-article="cloud-computing">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 2</p>
									</div>
									<h3>Cloud Computing</h3>
									<p>or, why it's ok for a truck to crush your laptop</p>
								</a>
							</li>
									
							<li class="web-apps read selected" style="opacity: 0;">
								<a href="#/web-apps" data-article="web-apps">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 3</p>
									</div>
									<h3>Web Apps</h3>
									<p>or, 'Life, Liberty and the Pursuit of Appiness'</p>
								</a>
							</li>
									
							<li class="html read" style="opacity: 0;">
								<a href="#/html" data-article="html">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 4</p>
									</div>
									<h3>HTML, JavaScript, CSS and more</h3>
									<p>or, this is not your mom's AJAX</p>
								</a>
							</li>
									
							<li class="html5" style="opacity: 0;">
								<a href="#/html5" data-article="html5">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 5</p>
									</div>
									<h3>HTML5</h3>
									<p>or, in the beginning there was no &lt;video&gt;</p>
								</a>
							</li>
									
							<li class="threed" style="opacity: 0;">
								<a href="#" data-article="threed">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 6</p>
									</div>
									<h3>3D in the Browser</h3>
									<p>or, browsing with more depth</p>
								</a>
							</li>
									
							<li class="old-vs-new-browsers" style="opacity: 0;">
								<a href="#/old-vs-new-browsers" data-article="old-vs-new-browsers">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 7</p>
									</div>
									<h3>A Browser Madrigal</h3>
									<p>or, old vs. modern browsers</p>
								</a>
							</li>
									
							<li class="plugins" style="opacity: 0;">
								<a href="#/plugins" data-article="plugins">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 8</p>
									</div>
									<h3>Plug-ins</h3>
									<p>or, pepperoni for your cheese pizza</p>
								</a>
							</li>
									
							<li class="browser-extensions" style="opacity: 0;">
								<a href="#/browser-extensions" data-article="browser-extensions">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 9</p>
									</div>
									<h3>Browser Extensions </h3>
									<p>or, superpowers for your browser</p>
								</a>
							</li>
									
							<li class="sync" style="opacity: 0;">
								<a href="#/sync" data-article="sync">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 10</p>
									</div>
									<h3>Synchronizing the Browser</h3>
									<p>or, why it's ok for a truck to crush your laptop, part II</p>
								</a>
							</li>
									
							<li class="browser-cookies" style="opacity: 0;">
								<a href="#/browser-cookies" data-article="browser-cookies">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 11</p>
									</div>
									<h3>Browser Cookies</h3>
									<p>or, thanks for the memories</p>
								</a>
							</li>
									
							<li class="browser-privacy" style="opacity: 0;">
								<a href="#/browser-privacy" data-article="browser-privacy">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 12</p>
									</div>
									<h3>Browsers and Privacy</h3>
									<p>or, giving you choices to protect your privacy in the browser</p>
								</a>
							</li>
									
							<li class="malware" style="opacity: 0;">
								<a href="#/malware" data-article="malware">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 13</p>
									</div>
									<h3>Malware, Phishing, and Security Risks</h3>
									<p>or, if it quacks like a duck but isn't a duck</p>
								</a>
							</li>
									
							<li class="browser-protection" style="opacity: 0;">
								<a href="#/browser-protection" data-article="browser-protection">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 14</p>
									</div>
									<h3>How Modern Browsers Help Protect You From Malware and Phishing</h3>
									<p>or, beware the ne'er-do-wells!</p>
								</a>
							</li>
									
							<li class="url" style="opacity: 0;">
								<a href="#/url" data-article="url">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 15</p>
									</div>
									<h3>Using Web Addresses to Stay Safe</h3>
									<p>or, 'my name is URL'</p>
								</a>
							</li>
									
							<li class="dns" style="opacity: 0;">
								<a href="#/dns" data-article="dns">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 16</p>
									</div>
									<h3>IP Addresses and DNS</h3>
									<p>or, the phantom phone booth</p>
								</a>
							</li>
									
							<li class="identity" style="opacity: 0;">
								<a href="#/identity" data-article="identity">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 17</p>
									</div>
									<h3>Validating Identities Online</h3>
									<p>or,  "Dr. Livingstone, I presume?"</p>
								</a>
							</li>
									
							<li class="page-load" style="opacity: 0;">
								<a href="#/page-load" data-article="page-load">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 18</p>
									</div>
									<h3>Evolving to a Faster Web</h3>
									<p>or, speeding up images, video, and JavaScript on the web</p>
								</a>
							</li>
									
							<li class="open-source" style="opacity: 0;">
								<a href="#/open-source" data-article="open-source">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 19</p>
									</div>
									<h3>Open Source and Browsers</h3>
									<p>or, standing on the shoulders of giants</p>
								</a>
							</li>
									
							<li class="conclusion" style="opacity: 0;">
								<a href="#/conclusion" data-article="conclusion">
									<div class="medium-book">
										<div class="illustration"></div>
										<p>THING 20</p>
									</div>
									<h3>19 Things Later...</h3>
									<p>or, a day in the clouds</p>
								</a>
							</li>
								</ul>
			</div>
		</div>	
		<footer style="width: 1349px; top: 655px; margin: 0px;">		
				<div class="right-side">
				<div class="divider"></div>
				<div class="sharing">
					<p>SHARE BOOK</p>
					<input type="text" class="clipboard-notification" value="#" readonly="readonly">
					<ul>
						<li class="facebook"><a href="" title="Facebook"></a></li>
						<li class="twitter"><a href="" title="Twitter"></a></li>
						<li class="gplus"><div id="___plusone_0" style="text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 24px; height: 15px; background-position: initial initial; background-repeat: initial initial;"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 24px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 15px;" tabindex="0" vspace="0" width="100%" id="I0_1376054403397" name="I0_1376054403397" src="./20 Things I Learned About Browsers and the Web_files/fastbutton(2).htm" allowtransparency="true" data-gapiattached="true" title="+1"></iframe></div></li>
						<li class="url"><a href="#"></a></li>
					</ul>
				</div>
				<div class="divider"></div>
				<div class="print">
					<a href="" target="_blank"><span class="icon"></span>PRINT BOOK</a>
				</div>
									<div class="divider"></div>
					<div class="lights-wrapper">
						<div class="lights">
							<a href="#"><span class="icon">LIGHTS</span></a>
						</div>
					</div>
					<div class="divider"></div>
					<div class="fullscreen-wrapper" style="">
						<div class="fullscreen">
							<a href="#"><span class="icon"></span>FULL SCREEN</a>
						</div>
					</div>
							</div>
		</footer>
		
    <script type="text/javascript" src="./20 Things I Learned About Browsers and the Web_files/plusone.js" gapi_processed="true"></script>
				
  		<script type="text/javascript" src="./20 Things I Learned About Browsers and the Web_files/twentythings.min.js"></script>
  		<script type="text/javascript">
  			TT.initialize();
  		</script><span id="currentPage">9</span>
		
					
		
	
</body></html>